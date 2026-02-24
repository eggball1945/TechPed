<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Order;
use App\Models\User;

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

        abort(403);
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;
        $status = $request->status;

        $orders = Order::with(['user', 'products']);

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
        $role = $this->userRole();

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

        $order->update([
            'status' => 'dikirim'
        ]);

        $role = $this->userRole();
        return redirect()->route("{$role}.order.index")
            ->with('success', 'Order berhasil diteruskan ke petugas.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        $role = $this->userRole();
        return redirect()->route("{$role}.order.index")
            ->with('success', 'Order berhasil dihapus.');
    }
}