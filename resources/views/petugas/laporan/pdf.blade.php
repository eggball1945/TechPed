<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan {{ $tahun }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 30px;
        }
        .header {
            border-bottom: 2px solid #6D28D9;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .header table {
            width: 100%;
        }
        .brand {
            font-size: 28px;
            font-weight: bold;
            color: #6D28D9;
        }
        .report-title {
            text-align: right;
            font-size: 20px;
            text-transform: uppercase;
            color: #555;
        }
        .info-section {
            margin-bottom: 30px;
        }
        .info-table {
            width: 100%;
            font-size: 13px;
        }
        .info-table td {
            padding: 2px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        .table th {
            background-color: #6D28D9;
            color: white;
            text-align: left;
            padding: 12px 8px;
            font-size: 12px;
            text-transform: uppercase;
        }
        .table td {
            padding: 10px 8px;
            border-bottom: 1px solid #eee;
            font-size: 12px;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer-total {
            background-color: #f3f4f6;
            font-weight: bold;
        }
        .signature-section {
            margin-top: 50px;
            float: right;
            width: 200px;
            text-align: center;
        }
        .signature-space {
            margin-top: 80px;
            border-bottom: 1px solid #333;
        }
        .page-number:before {
            content: "Halaman " counter(page);
        }
        .footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 30px;
            font-size: 10px;
            color: #999;
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="footer">
        <span class="page-number"></span> | TechPed - Laporan Penjualan Otomatis
    </div>

    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td class="brand">TechPed</td>
                    <td class="report-title">Laporan Penjualan</td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <table class="info-table">
                <tr>
                    <td width="150"><strong>Periode Laporan</strong></td>
                    <td>: Tahun {{ $tahun }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Cetak</strong></td>
                    <td>: {{ now()->translatedFormat('d F Y, H:i') }}</td>
                </tr>
                <tr>
                    <td><strong>Dicetak Oleh</strong></td>
                    <td>: Petugas TechPed</td>
                </tr>
            </table>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th width="30" class="text-center">No</th>
                    <th>Nama Produk</th>
                    <th class="text-right">Unit Terjual</th>
                    <th class="text-right">Harga Rata-rata</th>
                    <th class="text-right">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @forelse ($laporan as $index => $item)
                    @php $grandTotal += $item->pendapatan; @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td class="text-right">{{ number_format($item->unit_terjual) }}</td>
                        <td class="text-right">Rp {{ number_format($item->harga_rata_rata, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($item->pendapatan, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center" style="padding: 30px;">Tidak ada data transaksi untuk periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="footer-total">
                    <td colspan="4" class="text-right">GRAND TOTAL</td>
                    <td class="text-right">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="signature-section">
            <p>Sidoarjo, {{ now()->translatedFormat('d F Y') }}</p>
            <p style="margin-top: 5px;">Hormat Kami,</p>
            <div class="signature-space"></div>
            <p style="margin-top: 8px;"><strong>Petugas TechPed</strong></p>
        </div>

        <div style="page-break-before: always;"></div>

        <div class="header">
            <table>
                <tr>
                    <td class="brand">TechPed</td>
                    <td class="report-title">Laporan Barang Masuk</td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <table class="info-table">
                <tr>
                    <td width="150"><strong>Kategori Laporan</strong></td>
                    <td>: Inventaris Produk (Barang Masuk)</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Cetak</strong></td>
                    <td>: {{ now()->translatedFormat('d F Y, H:i') }}</td>
                </tr>
            </table>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th width="30" class="text-center">No</th>
                    <th>Nama Produk</th>
                    <th>SKU</th>
                    <th>Kategori</th>
                    <th class="text-right">Stok Saat Ini</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangMasuk as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->sku }}</td>
                        <td class="capitalize">{{ $item->kategori }}</td>
                        <td class="text-right {{ $item->stok <= 10 ? 'color: #dc2626; font-weight: bold;' : '' }}">
                            {{ number_format($item->stok) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="signature-section">
            <p>Sidoarjo, {{ now()->translatedFormat('d F Y') }}</p>
            <p style="margin-top: 5px;">Hormat Kami,</p>
            <div class="signature-space"></div>
            <p style="margin-top: 8px;"><strong>Petugas TechPed</strong></p>
        </div>
    </div>
</body>
</html>
