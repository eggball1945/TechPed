<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        $totalPendapatan = Order::whereIn('status', ['dikirim', 'terkirim'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total_harga');

        $totalOrder = Order::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();

        return view('petugas.landing', compact(
            'totalPendapatan',
            'totalOrder',
            'bulan',
            'tahun'
        ));
    }

    public function latestOrders()
    {
        $orders = Order::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id'     => $order->id,
                    'kode'   => $order->id,
                    'nama'   => $order->user->nama_depan ?? 'Guest',
                    'status' => $order->status,
                ];
            });

        return response()->json($orders);
    }
}