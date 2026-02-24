<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $bulan = request('bulan', now()->month);
        $tahun = request('tahun', now()->year);

        $totalPendapatan = Order::whereIn('status', ['dikirim', 'terkirim'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total_harga');

        $totalOrder = Order::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();

        $pendapatanBulananRaw = Order::select(
                \DB::raw('MONTH(tanggal) as bulan'),
                \DB::raw('SUM(total_harga) as total')
            )
            ->whereIn('status', ['dikirim', 'terkirim'])
            ->whereYear('tanggal', $tahun)
            ->groupBy(\DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'bulan');

        $dataBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulanan[$i] = $pendapatanBulananRaw[$i] ?? 0;
        }

        $bulanSekarang = $bulan;
        $tahunSekarang = $tahun;
        $bulanLabel = [];
        $pendapatan6Bulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulanIndex = $bulanSekarang - $i;
            $tahunIndex = $tahunSekarang;
            if ($bulanIndex <= 0) {
                $bulanIndex += 12;
                $tahunIndex -= 1;
            }
            $bulanLabel[] = Carbon::createFromDate($tahunIndex, $bulanIndex, 1)->format('M');
            $pendapatan6Bulan[] = $dataBulanan[$bulanIndex] ?? 0;
        }

        return view('admin.landing', compact(
            'totalPendapatan',
            'totalOrder',
            'bulan',
            'tahun',
            'pendapatan6Bulan',
            'bulanLabel'
        ));
    }

    public function search(Request $request)
    {
        $q = $request->q;

        $users = User::where('nama_depan', 'like', "%$q%")->get();

        return view('admin.search-result', compact('users', 'q'));
    }

    public function latestOrders()
    {
        $orders = \App\Models\Order::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'kode' => $order->id,
                    'nama' => $order->user->nama_depan ?? 'Guest',
                    'status' => $order->status,
                ];
            });

        return response()->json($orders);
    }

    public function dashboard()
    {
        $activeUsers = User::where('is_suspended', false)->count();

        return view('admin.dashboard', compact('activeUsers'));
    }
}