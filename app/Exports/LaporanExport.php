<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    WithCustomStartCell
{
    public function collection()
    {
        return DB::table('order_product')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->whereIn('orders.status', ['dikirim', 'terkirim'])
            ->select(
                'products.nama_produk',
                DB::raw('SUM(order_product.jumlah) as unit_terjual'),
                DB::raw('SUM(order_product.jumlah * order_product.harga) as pendapatan'),
                DB::raw('AVG(order_product.harga) as harga_rata_rata')
            )
            ->groupBy('products.nama_produk')
            ->orderByDesc('pendapatan')
            ->get();
    }

    public function startCell(): string
    {
        return 'A4'; // tabel mulai dari baris 4
    }
    public function headings(): array
    {
        return [
            'Nama Produk',
            'Unit Terjual',
            'Pendapatan',
            'Harga Rata-rata',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:D1');
        $sheet->setCellValue('A1', 'LAPORAN PENJUALAN BARANG');

        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        $sheet->getStyle('A4:D4')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => 'E5E7EB'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A4:D{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                ],
            ],
        ]);

        $sheet->getStyle("C5:C{$lastRow}")
            ->getNumberFormat()
            ->setFormatCode('"Rp" #,##0');

        $sheet->getStyle("D5:D{$lastRow}")
            ->getNumberFormat()
            ->setFormatCode('"Rp" #,##0');

        return [];
    }
    

    public function columnWidths(): array
    {
        return [
            'A' => 35,
            'B' => 15,
            'C' => 20,
            'D' => 20,
        ];
    }
}