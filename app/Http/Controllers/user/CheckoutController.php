<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Notifications\OrderStatusNotification;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $cartIds = $request->query('cart_ids');
        $productId = $request->query('product_id');

        if ($cartIds) {
            $cartIds = explode(',', $cartIds);
            $carts = Cart::with('product')
                ->where('user_id', $user->id)
                ->whereIn('id', $cartIds)
                ->get();

            if ($carts->isEmpty()) {
                return redirect()->route('cart')->with('error', 'Keranjang Anda kosong.');
            }
        } elseif ($productId) {
            $product = \App\Models\Product::findOrFail($productId);
            $qty = $request->query('quantity', 1);

            // Create a temporary cart object (not persisted)
            $cart = new Cart();
            $cart->id = 'temp';
            $cart->product_id = $product->id;
            $cart->qty = $qty;
            $cart->setRelation('product', $product);

            $carts = collect([$cart]);
        } else {
            return redirect()->route('cart')->with('error', 'Pilih produk terlebih dahulu.');
        }

        // Calculate totals
        $taxPercentage = \App\Models\SystemSetting::get('tax_percentage', 11) / 100;
        $subtotal = $carts->sum(fn($item) => ($item->product->harga_diskon ?? $item->product->harga) * $item->qty);
        $tax = $subtotal * $taxPercentage; // calculated PPN
        $shipping = 20000; // Fixed shipping cost (will be overwritten by JS, but initial)
        $total = $subtotal + $shipping + $tax;

        $addresses = $user->addresses;

        return view('user.checkout.index', compact('carts', 'subtotal', 'tax', 'shipping', 'total', 'user', 'addresses'));
    }

    /**
     * Quick checkout: redirect to checkout with product_id and quantity
     */
    public function quickCheckout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        return redirect()->route('checkout', [
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_depan'      => 'required|string|max:255',
            'nama_belakang'   => 'nullable|string|max:255',
            'alamat_tambahan' => 'nullable|string',
            'no_telepon'      => 'required|string|max:20',
            'email'           => 'required|email',
            'shipping'        => 'required|in:jne_reguler,jne_express,jnt_reguler,jnt_express',
            'payment'         => 'required|in:bank,cod,qris',
            'cart_ids'        => 'required_without:product_id|string|nullable',
            'product_id'      => 'required_without:cart_ids|exists:products,id|nullable',
            'quantity'        => 'required_with:product_id|integer|min:1|nullable',
            'address_id'      => 'nullable|string',
            'alamat'          => 'required_unless:address_id,|string',
            'kota'            => 'required_unless:address_id,|string|max:100',
            'provinsi'        => 'required_unless:address_id,|string|max:100',
            'kode_pos'        => 'required_unless:address_id,|string|max:10',
            'proof_image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'proof_image_bank' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'proof_image_qris' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->has('product_id')) {
            $product = \App\Models\Product::findOrFail($request->product_id);
            $qty = $request->quantity;

            $cart = new Cart();
            $cart->id = 'temp';
            $cart->product_id = $product->id;
            $cart->qty = $qty;
            $cart->setRelation('product', $product);

            $carts = collect([$cart]);
        } else {
            $cartIds = explode(',', $request->cart_ids);
            $carts = Cart::with('product')
                ->where('user_id', $user->id)
                ->whereIn('id', $cartIds)
                ->get();
        }

        if ($carts->isEmpty()) {
            return back()->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
        }

        $taxPercentage = \App\Models\SystemSetting::get('tax_percentage', 11) / 100;
        $subtotal = $carts->sum(fn($item) => ($item->product->harga_diskon ?? $item->product->harga) * $item->qty);
        $tax = $subtotal * $taxPercentage; // calculate calculated PPN

        // Resolve address details early to determine shipping zone
        $alamat = $request->alamat;
        $kota = $request->kota;
        $provinsi = $request->provinsi;
        $kode_pos = $request->kode_pos;

        if ($request->address_id) {
            $savedAddress = UserAddress::find($request->address_id);
            if ($savedAddress) {
                $alamat = $savedAddress->alamat;
                $kota = $savedAddress->kota;
                $provinsi = $savedAddress->provinsi;
                $kode_pos = $savedAddress->kode_pos;
            }
        }

        // Determine Shipping Zone based on both Kota and Provinsi to prevent mismatch
        $locationStr = strtolower($kota . ' ' . $provinsi);
        $zona = 3; // Default Luar Jawa

        $zone1Keywords = ['jakarta', 'dki', 'banten', 'jawa barat', 'jabar', 'depok', 'bogor', 'tangerang', 'bekasi', 'cilegon', 'serang'];
        $zone2Keywords = ['jawa tengah', 'jateng', 'yogyakarta', 'jogja', 'diy', 'jawa timur', 'jatim', 'surabaya', 'semarang', 'malang', 'solo', 'sleman', 'bantul'];

        foreach ($zone1Keywords as $keyword) {
            if (strpos($locationStr, $keyword) !== false) {
                $zona = 1;
                break;
            }
        }

        if ($zona === 3) {
            foreach ($zone2Keywords as $keyword) {
                if (strpos($locationStr, $keyword) !== false) {
                    $zona = 2;
                    break;
                }
            }
        }

        // Shipping costs & estimated days mapping per zone
        if ($zona === 1) {
            $shippingCosts = ['jne_reguler' => 10000, 'jne_express' => 15000, 'jnt_reguler' => 10000, 'jnt_express' => 15000];
            $estimatedDays = ['jne_reguler' => '2-3 hari', 'jne_express' => '1 hari', 'jnt_reguler' => '2-5 hari', 'jnt_express' => '1-2 hari'];
        } elseif ($zona === 2) {
            $shippingCosts = ['jne_reguler' => 20000, 'jne_express' => 30000, 'jnt_reguler' => 20000, 'jnt_express' => 30000];
            $estimatedDays = ['jne_reguler' => '2-4 hari', 'jne_express' => '1-2 hari', 'jnt_reguler' => '3-5 hari', 'jnt_express' => '1-3 hari'];
        } else {
            $shippingCosts = ['jne_reguler' => 40000, 'jne_express' => 60000, 'jnt_reguler' => 40000, 'jnt_express' => 60000];
            $estimatedDays = ['jne_reguler' => '3-7 hari', 'jne_express' => '2-4 hari', 'jnt_reguler' => '4-7 hari', 'jnt_express' => '2-5 hari'];
        }

        $shippingCost = $shippingCosts[$request->shipping] ?? $shippingCosts['jne_reguler'];
        $total = $subtotal + $shippingCost + $tax;

        // Shipping label mapping (for database)
        $shippingMap = [
            'jne_reguler' => 'JNE Reguler',
            'jne_express' => 'JNE Express',
            'jnt_reguler' => 'J&T Reguler',
            'jnt_express' => 'J&T Express',
        ];

        $paymentMap = ['bank' => 'Bank_Transfer', 'cod' => 'COD', 'qris' => 'QRIS'];

        try {
            $orderId = null;
            DB::transaction(function () use ($request, $user, $carts, $total, $subtotal, $tax, $shippingCost, $shippingMap, $paymentMap, $estimatedDays, $alamat, $kota, $provinsi, $kode_pos, &$orderId) {
                $proofPath = null;
                $proofFile = $request->file('proof_image_bank') ?? $request->file('proof_image_qris') ?? $request->file('proof_image');
                if ($proofFile && in_array($request->payment, ['bank', 'qris'])) {
                    $proofPath = $proofFile->store('order_proofs', 'public');
                }

                $status = in_array($request->payment, ['bank', 'qris']) ? 'tertunda' : 'diproses';

                $order = Order::create([
                    'user_id'       => $user->id,
                    'username'      => $request->nama_depan . ($request->nama_belakang ? ' ' . $request->nama_belakang : ''),
                    'no_telepon'    => $request->no_telepon,
                    'email'         => $request->email,
                    'alamat'        => $alamat,
                    'kota'          => $kota,
                    'provinsi'      => $provinsi,
                    'kode_pos'      => $kode_pos,
                    'tanggal'       => now()->toDateTimeString(), // use datetime for receipt
                    'jumlah_barang' => $carts->sum('qty'),
                    'subtotal'      => $subtotal,
                    'total_harga'   => $total,
                    'shipping'      => $shippingMap[$request->shipping],
                    'shipping_cost' => $shippingCost,
                    'pajak'         => $tax,
                    'estimasi_hari' => $estimatedDays[$request->shipping] ?? null,
                    'payment'       => $paymentMap[$request->payment],
                    'status'        => $status,
                    'proof_image'   => $proofPath,
                    'resi'          => 'TRK-' . mt_rand(1000000000, 9999999999),
                ]);

                $orderId = $order->id;

                // Load products for the notification (so product names are available)
                $order->load('products');

                // Send notification (use 'checkout' as the event type)
                $order->user->notify(new OrderStatusNotification($order, 'checkout'));

                foreach ($carts as $cart) {
                    OrderProduct::create([
                        'order_id'   => $order->id,
                        'product_id' => $cart->product_id,
                        'jumlah'     => $cart->qty,
                        'harga'      => $cart->product->harga_diskon ?? $cart->product->harga,
                    ]);

                    // Update stock if status is 'diproses'
                    if ($status === 'diproses') {
                        $cart->product->decrement('stok', $cart->qty);
                    }
                }

                // Delete real cart items (skip temporary ones)
                $realCartIds = $carts->filter(fn($c) => $c->id !== 'temp')->pluck('id')->toArray();
                if (!empty($realCartIds)) {
                    Cart::whereIn('id', $realCartIds)->delete();
                }
            });

            $message = in_array($request->payment, ['bank', 'qris'])
                ? 'Pesanan berhasil dibuat. Silakan transfer dan pastikan bukti bayar sudah sesuai.'
                : 'Pesanan berhasil dibuat!';
            
            return redirect()->route('checkout.receipt', $orderId)->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Checkout error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.')->withInput();
        }
    }

    public function receipt(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('products');
        
        return view('user.checkout.receipt', compact('order'));
    }
}