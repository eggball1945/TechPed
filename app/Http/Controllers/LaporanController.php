<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    private array $orderValid = ['dikirim'];

    private function userRole()
    {
        if (auth('admin')->check()) return 'admin';
        if (auth('petugas')->check()) return 'petugas';
        abort(403);
    }

    public function index()
    {
        $role  = $this->userRole();
        $bulan = request('bulan', now()->month);
        $tahun = request('tahun', now()->year);
        $user_id = request('user_id');

        $jumlahUlasan = Review::count();

        $rataRating = Review::avg('rating');
        $rataRating = $rataRating ? number_format($rataRating, 1) : 0;

        $reviews = Review::with(['user', 'product'])
            ->latest()
            ->paginate(10);

        $totalPendapatan = Order::whereIn('status', ['dikirim', 'selesai'])
            ->when($user_id, fn($q) => $q->where('user_id', $user_id))
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total_harga');

        $totalOrder = Order::where('status', '!=', 'dibatalkan')
            ->when($user_id, fn($q) => $q->where('user_id', $user_id))
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();

        $laporan = $this->getLaporan($tahun, $user_id)->paginate(10);
        $barangMasuk = \App\Models\Product::orderBy('nama_produk')->paginate(10, ['*'], 'barang_masuk_page');

        $pendapatanBulananRaw = Order::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereIn('status', ['dikirim', 'selesai'])
            ->whereYear('tanggal', $tahun)
            ->when($user_id, fn($q) => $q->where('user_id', $user_id))
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'bulan');

        $dataBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulanan[$i] = $pendapatanBulananRaw[$i] ?? 0;
        }

        $users = \App\Models\User::orderBy('nama_depan')->get();
        $totalProducts = \App\Models\Product::count();

        return view("{$role}.laporan.index", compact(
            'totalPendapatan',
            'totalOrder',
            'bulan',
            'tahun',
            'user_id',
            'users',
            'rataRating',
            'jumlahUlasan',
            'laporan',
            'dataBulanan',
            'reviews',
            'barangMasuk',
            'totalProducts'
        ));
    }

    public function exportPdf()
    {
        $role  = $this->userRole();
        $tahun = request('tahun', now()->year);
        $user_id = request('user_id');

        $laporan = $this->getLaporan($tahun, $user_id)->get();
        $barangMasuk = \App\Models\Product::orderBy('nama_produk')->get();

        $pdf = Pdf::loadView("{$role}.laporan.pdf", compact('laporan', 'tahun', 'barangMasuk'))
            ->setPaper('A4', 'portrait');

        return $pdf->download("laporan-penjualan-{$tahun}.pdf");
    }

    public function exportExcel()
    {
        $tahun = request('tahun', now()->year);
        $user_id = request('user_id');

        return Excel::download(
            new LaporanExport($tahun, $user_id),
            "laporan-penjualan-{$tahun}.xlsx"
        );
    }

    private function getLaporan(int $tahun, $user_id = null)
    {
        return DB::table('order_product')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->whereIn('orders.status', ['dikirim', 'selesai'])
            ->whereYear('orders.tanggal', $tahun)
            ->when($user_id, fn($q) => $q->where('orders.user_id', $user_id))
            ->select(
                'products.nama_produk',
                DB::raw('SUM(order_product.jumlah) as unit_terjual'),
                DB::raw('SUM(order_product.jumlah * order_product.harga) as pendapatan'),
                DB::raw('AVG(order_product.harga) as harga_rata_rata')
            )
            ->groupBy('products.nama_produk')
            ->orderByDesc('pendapatan')
            ->take(5);
    }
}