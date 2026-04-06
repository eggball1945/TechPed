<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderStatusNotification;

class OrderController extends Controller
{
    private function userRole()
    {
        if (auth('admin')->check()) {
            return 'admin';
        }

        if (auth('petugas')->check()) {
            return 'petugas';
        }

        if (auth()->check()) {
            return 'user';
        }

        abort(403);
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;
        $status = $request->status;

        $role = $this->userRole();
        $orders = Order::with(['user.addresses', 'products']);

        // Regular users can only see their own orders
        if ($role === 'user') {
            $orders->where('user_id', auth()->id());
        }

        if ($search) {
            $orders->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                    $uq->where('nama_depan', 'like', "%{$search}%")
                       ->orWhere('nama_belakang', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%")
                       ->orWhere('username', 'like', "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($filter) {
            switch ($filter) {
                case 'order_id_asc': $orders->orderBy('id', 'asc'); break;
                case 'order_id_desc': $orders->orderBy('id', 'desc'); break;
                case 'tanggal_asc': $orders->orderBy('tanggal', 'asc'); break;
                case 'tanggal_desc': $orders->orderBy('tanggal', 'desc'); break;
                case 'pelanggan_asc':
                    $orders->whereHas('user')->orderBy(
                        User::select('nama_depan')->whereColumn('users.id', 'orders.user_id'),
                        'asc'
                    );
                    break;
                case 'pelanggan_desc':
                    $orders->whereHas('user')->orderBy(
                        User::select('nama_depan')->whereColumn('users.id', 'orders.user_id'),
                        'desc'
                    );
                    break;
                case 'jumlah_barang_asc': $orders->orderBy('jumlah_barang', 'asc'); break;
                case 'jumlah_barang_desc': $orders->orderBy('jumlah_barang', 'desc'); break;
                case 'total_harga_asc': $orders->orderBy('total_harga', 'asc'); break;
                case 'total_harga_desc': $orders->orderBy('total_harga', 'desc'); break;
            }
        }

        if ($status) {
            $orders->where('status', $status);
        }

        $orders = $orders->latest()->paginate(10)->withQueryString();

        return view("{$role}.order.index", compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'products'])->findOrFail($id);
        $order->products->transform(function ($prod) {
            $prod->gambarArray = $prod->gambar ? explode(',', $prod->gambar) : [];
            return $prod;
        });

        $role = $this->userRole();
        return view("{$role}.order.show", compact('order'));
    }

    public function send(Request $request, Order $order)
    {
        if ($order->status !== 'diproses') {
            return back()->with('error', 'Order sudah dikirim atau selesai.');
        }

        $updates = ['status' => 'dikirim'];

        // Generate resi otomatis jika belum ada
        if (empty($order->resi) || $order->resi === '-') {
            $updates['resi'] = 'TRK-' . mt_rand(1000000000, 9999999999);
        }

        $order->update($updates);

        // Notify user
        $order->user->notify(new OrderStatusNotification($order, 'dikirim'));

        $role = $this->userRole();
        return redirect()->route("{$role}.order.index")
            ->with('success', 'Order berhasil dikirim ke pelanggan.');
    }

    public function complete(Order $order)
    {
        if ($order->status !== 'dikirim') {
            return back()->with('error', 'Hanya pesanan yang sudah dikirim yang dapat diselesaikan.');
        }

        $order->update(['status' => 'selesai']);

        // Notify user
        $order->user->notify(new OrderStatusNotification($order, 'selesai'));

        $role = $this->userRole();
        if ($role === 'user') {
            return redirect()->route('orders')->with('success', 'Pesanan telah selesai. Terima kasih telah berbelanja!');
        }

        return redirect()->route("{$role}.order.index")
            ->with('success', 'Pesanan berhasil diselesaikan.');
    }

    /**
     * Cancel order (for users only)
     */
    public function cancel(Order $order)
    {
        $role = $this->userRole();

        // Only users can cancel their own orders
        if ($role !== 'user') {
            abort(403, 'Anda tidak memiliki izin untuk membatalkan pesanan ini.');
        }

        // Ensure the order belongs to the logged-in user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow cancellation if status is 'tertunda' or 'diproses'
        if (!in_array($order->status, ['tertunda', 'diproses'])) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        $oldStatus = $order->status;

        // Update status
        $order->update(['status' => 'dibatalkan']);
        
        // Notify user
        $order->user->notify(new OrderStatusNotification($order, 'dibatalkan'));

        // Restore stock if it was previously reduced
        if (in_array($oldStatus, ['diproses', 'dikirim'])) {
            foreach ($order->products as $product) {
                $product->increment('stok', $product->pivot->jumlah);
            }
        }

        return redirect()->route('orders')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        $role = $this->userRole();
        return redirect()->route("{$role}.order.index")
            ->with('success', 'Order berhasil dihapus.');
    }  

    public function userDestroy(Order $order)
    {
        // Only users can delete their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow deletion if status is 'dibatalkan' or 'dikirim'
        if (!in_array($order->status, ['dibatalkan', 'dikirim'])) {
            return back()->with('error', 'Pesanan tidak dapat dihapus. Pesanan harus dibatalkan terlebih dahulu.');
        }

        $order->delete();

        return redirect()->route('orders')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}