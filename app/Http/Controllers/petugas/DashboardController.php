<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);
        $user_id = $request->get('user_id');

        $totalPendapatan = Order::whereIn('status', ['dikirim', 'selesai'])
            ->when($user_id, fn($q) => $q->where('user_id', $user_id))
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total_harga');

        $totalOrder = Order::where('status', '!=', 'dibatalkan')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->when($user_id, fn($q) => $q->where('user_id', $user_id))
            ->count();

        // Calculate the range for the last 6 months (ending at the selected month/year)
        $endDate = Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();
        $startDate = $endDate->copy()->subMonths(5)->startOfMonth();

        $pendapatanBulananRaw = Order::select(
                DB::raw('YEAR(tanggal) as tahun'),
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereIn('status', ['dikirim', 'selesai'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->when($user_id, fn($q) => $q->where('user_id', $user_id))
            ->groupBy(DB::raw('YEAR(tanggal)'), DB::raw('MONTH(tanggal)'))
            ->get();

        $dataMap = [];
        foreach ($pendapatanBulananRaw as $row) {
            $dataMap[$row->tahun . '-' . $row->bulan] = $row->total;
        }

        $bulanLabel = [];
        $pendapatan6Bulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = $endDate->copy()->subMonths($i);
            $key = $date->year . '-' . $date->month;
            $bulanLabel[] = $date->translatedFormat('M');
            $pendapatan6Bulan[] = $dataMap[$key] ?? 0;
        }

        $topProducts = Product::select('products.id', 'products.nama_produk', 'products.harga')
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->where('orders.status', '!=', 'dibatalkan')
            ->when($user_id, fn($q) => $q->where('orders.user_id', $user_id))
            ->selectRaw('SUM(order_product.jumlah) as total_sold')
            ->groupBy('products.id', 'products.nama_produk', 'products.harga')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $users = User::orderBy('nama_depan')->get();
        $activeUsers = User::where('is_suspended', false)->count();
        $totalProducts = Product::count();

        return view('petugas.landing', compact(
            'totalPendapatan',
            'totalOrder',
            'bulan',
            'tahun',
            'user_id',
            'users',
            'pendapatan6Bulan',
            'bulanLabel',
            'topProducts',
            'activeUsers',
            'totalProducts'
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
                    'kode'   => 'ORD-' . $order->id,
                    'nama'   => $order->user->nama_depan ?? 'Guest',
                    'status' => $order->status,
                ];
            });

        return response()->json($orders);
    }
}