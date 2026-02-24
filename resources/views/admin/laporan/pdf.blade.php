<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan {{ $tahun }}</title>

    {{-- Tailwind CDN (AMAN untuk DomPDF) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body class="bg-white text-black p-8">

    {{-- HEADER --}}
    <div class="text-center mb-6">
        <h1 class="text-xl font-bold uppercase">Laporan Penjualan</h1>
        <p class="text-sm text-gray-600">Tahun {{ $tahun }}</p>
        <hr class="mt-4 border-gray-300">
    </div>

    {{-- INFO --}}
    <div class="mb-6 text-sm">
        <p><strong>Tanggal Cetak:</strong> {{ now()->translatedFormat('d F Y') }}</p>
    </div>

    {{-- TABLE --}}
    <table class="w-full border border-gray-400 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-400 px-3 py-2 text-left">No</th>
                <th class="border border-gray-400 px-3 py-2 text-left">Nama Produk</th>
                <th class="border border-gray-400 px-3 py-2 text-right">Unit Terjual</th>
                <th class="border border-gray-400 px-3 py-2 text-right">Harga Rata-rata</th>
                <th class="border border-gray-400 px-3 py-2 text-right">Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp

            @forelse ($laporan as $index => $item)
                @php
                    $grandTotal += $item->pendapatan;
                @endphp
                <tr>
                    <td class="border border-gray-400 px-3 py-2">
                        {{ $index + 1 }}
                    </td>
                    <td class="border border-gray-400 px-3 py-2">
                        {{ $item->nama_produk }}
                    </td>
                    <td class="border border-gray-400 px-3 py-2 text-right">
                        {{ number_format($item->unit_terjual) }}
                    </td>
                    <td class="border border-gray-400 px-3 py-2 text-right">
                        Rp {{ number_format($item->harga_rata_rata, 0, ',', '.') }}
                    </td>
                    <td class="border border-gray-400 px-3 py-2 text-right">
                        Rp {{ number_format($item->pendapatan, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border border-gray-400 px-3 py-4 text-center text-gray-500">
                        Tidak ada data laporan
                    </td>
                </tr>
            @endforelse
        </tbody>

        {{-- FOOTER TOTAL --}}
        <tfoot>
            <tr class="bg-gray-100 font-semibold">
                <td colspan="4" class="border border-gray-400 px-3 py-2 text-right">
                    Total Pendapatan
                </td>
                <td class="border border-gray-400 px-3 py-2 text-right">
                    Rp {{ number_format($grandTotal, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>

    {{-- TTD --}}
    <div class="mt-12 flex justify-end text-sm">
        <div class="text-center">
            <p>Mengetahui,</p>
            <p class="mt-16 font-semibold mt-12">Admin</p>
        </div>
    </div>

</body>
</html>