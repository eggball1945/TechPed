<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $carts->sum(function ($item) {
            return $item->product->harga * $item->qty;
        });

        $discount = $subtotal * 0.10; // 10% discount
        $total = $subtotal - $discount;

        return view('user.cart.index', compact('carts', 'subtotal', 'discount', 'total'));
    }

    public function updateQty(Cart $cart, $type)
    {
        if ($type === 'plus') {
            $cart->qty++;
        } elseif ($type === 'minus' && $cart->qty > 1) {
            $cart->qty--;
        }

        $cart->save();
        return back();
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back();
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Tidak ada item yang dipilih.']);
        }

        Cart::where('user_id', auth()->id())
            ->whereIn('id', $ids)
            ->delete();

        return response()->json(['success' => true]);
    }

    public function add(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Anda harus login terlebih dahulu.'], 401);
            }

            $productId = $request->product_id;
            $quantity = $request->quantity;

            $cart = Cart::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($cart) {
                $cart->qty += $quantity;
                $cart->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'qty' => $quantity,
                ]);
            }

            $cartCount = Cart::where('user_id', $user->id)->sum('qty');

            return response()->json([
                'success' => true,
                'message' => 'Produk ditambahkan ke keranjang!',
                'cart_count' => $cartCount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}