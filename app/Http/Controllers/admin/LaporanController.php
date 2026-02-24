<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    private array $orderValid = ['dikirim', 'terkirim'];

    public function index()
    {
        $bulan = request('bulan', now()->month);
        $tahun = request('tahun', now()->year);

        $jumlahUlasan = Review::count();

        $rataRating = Review::avg('rating');
        $rataRating = $rataRating ? number_format($rataRating, 1) : 0;

        $totalPendapatan = Order::whereIn('status', $this->orderValid)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total_harga');

        $totalOrder = Order::whereIn('status', $this->orderValid)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();

        $laporan = $this->getLaporan($tahun)->paginate(10);

        $pendapatanBulananRaw = Order::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereIn('status', $this->orderValid)
            ->whereYear('tanggal', $tahun)
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'bulan');

        $dataBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulanan[$i] = $pendapatanBulananRaw[$i] ?? 0;
        }

        return view('admin.laporan.index', compact(
            'totalPendapatan',
            'totalOrder',
            'bulan',
            'tahun',
            'rataRating',
            'jumlahUlasan',
            'laporan',
            'dataBulanan'
        ));
    }

    public function exportPdf()
    {
        $tahun = request('tahun', now()->year);

        $laporan = $this->getLaporan($tahun)->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan', 'tahun'))
            ->setPaper('A4', 'portrait');

        return $pdf->download("laporan-penjualan-{$tahun}.pdf");
    }

    public function exportExcel()
    {
        $tahun = request('tahun', now()->year);

        return Excel::download(
            new LaporanExport($tahun),
            "laporan-penjualan-{$tahun}.xlsx"
        );
    }

    private function getLaporan(int $tahun)
    {
        return DB::table('order_product')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->whereIn('orders.status', $this->orderValid)
            ->whereYear('orders.tanggal', $tahun)
            ->select(
                'products.nama_produk',
                DB::raw('SUM(order_product.jumlah) as unit_terjual'),
                DB::raw('SUM(order_product.jumlah * order_product.harga) as pendapatan'),
                DB::raw('AVG(order_product.harga) as harga_rata_rata')
            )
            ->groupBy('products.nama_produk')
            ->orderByDesc('pendapatan');
    }
}