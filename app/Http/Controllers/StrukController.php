<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class StrukController extends Controller
{
    private function getViewPrefix()
    {
        if (request()->is('admin/*')) {
            return 'admin.struk.';
        }

        if (request()->is('petugas/*')) {
            return 'petugas.struk.';
        }

        return 'admin.struk.';
    }

    public function index()
    {
        $orders = Order::with(['user.addresses', 'products'])
            ->whereIn('status', ['diproses', 'tertunda'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $view = $this->getViewPrefix() . 'index';

        return view($view, compact('orders'));
    }

    public function cetak(Order $order)
    {
        $order->load('user', 'products');

        $view = $this->getViewPrefix() . 'cetak';

        return view($view, compact('order'));
    }

    public function kirim(Request $request, Order $order)
    {
        $order->update([
            'status' => 'dikirim'
        ]);

        return back()->with('success', 'Order berhasil ditandai dikirim.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:dikirim,diproses'
        ]);

        $oldStatus = $order->status;
        $updates = ['status' => $request->status];

        // Generate resi otomatis jika status dikirim dan resi masih kosong
        if ($request->status === 'dikirim' && (empty($order->resi) || $order->resi === '-')) {
            $updates['resi'] = 'TRK-' . mt_rand(1000000000, 9999999999);
        }

        $order->update($updates);

        // Kurangi stok jika status berubah dari non-processed menjadi processed
        if (in_array($request->status, ['diproses', 'dikirim']) && !in_array($oldStatus, ['diproses', 'dikirim'])) {
            foreach ($order->products as $product) {
                $product->decrement('stok', $product->pivot->jumlah);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Status order berhasil diupdate menjadi ' . $request->status,
            'order' => $order->fresh(['user','products'])
        ]);
    }
}