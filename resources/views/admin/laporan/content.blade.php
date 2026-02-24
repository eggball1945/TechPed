@php
    $maxValue = max($dataBulanan);
    $maxValue = $maxValue > 0 ? $maxValue : 1;
@endphp

<div class="w-[1080px] min-h-[300px] bg-white rounded-md border border-gray-300 p-4">
    <span class="font-medium text-[12px] leading-[24px] text-black">Ringkasan Pendapatan</span>
    <div class="relative h-[260px] flex items-end justify-between gap-2">
        @foreach ($dataBulanan as $bulan => $total)
            @php
                $tinggi = ($total / $maxValue) * 200;
            @endphp
    
            <div class="group flex flex-col items-center justify-end w-full max-w-[56px]">
                <span class="mb-2 text-[8px] text-gray-600 opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200" > {{ $total > 0 ? 'Rp ' . number_format($total, 0, ',', '.') : '' }}</span>
    
                    @php
                        $bulanLabel = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                    @endphp
    
                <div class="w-full bg-violet-600 rounded-t-md hover:bg-violet-700 transition-all duration-300" style="height: {{ $tinggi }}px"></div>
                <span class="mt-2 text-xs font-medium text-gray-700">{{ $bulanLabel[$bulan - 1] }}</span>
            </div>
        @endforeach
    </div>
</div>

<div class="w-[1080px] bg-white rounded-lg border border-gray-300 p-4 mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-medium text-[12px] leading-[24px] text-black">Laporan Barang</h2>
        <div class="flex gap-2">
            <a href="{{ route('admin.laporan.excel') }}" class="px-3 py-1 text-xs bg-violet-700 text-white rounded">Excel</a>
            <a href="{{ route('admin.laporan.pdf') }}" class="px-3 py-1 text-xs bg-violet-700 text-white rounded">PDF</a>
        </div>
    </div>

    <div class="grid grid-cols-5 text-xs font-medium border-b border-gray-300 pb-2 mb-2">
        <span>Peringkat</span>
        <span>Produk</span>
        <span>Harga Rata-rata</span>
        <span>Unit Terjual</span>
        <span>Pendapatan</span>
    </div>

    @foreach ($laporan as $index => $row)
        <div class="grid grid-cols-5 text-xs py-2 border-b border-gray-200">
            <span>{{ $index + 1 }}</span>
            <span class="truncate">{{ $row->nama_produk }}</span>
            <span>Rp {{ number_format($row->harga_rata_rata, 0, ',', '.') }}</span>
            <span>{{ $row->unit_terjual }}</span>
            <span>Rp {{ number_format($row->pendapatan, 0, ',', '.') }}</span>
        </div>
    @endforeach

    <div class="flex items-center justify-between mt-6 text-[10px] text-slate-600">
        <span>
            Menampilkan
            {{ $laporan->firstItem() ?? 0 }}
            -
            {{ $laporan->lastItem() ?? 0 }}
            dari
            {{ $laporan->total() }}
            order
        </span>

        <div class="flex gap-1">
            @if ($laporan->onFirstPage())
                <span class="px-3 py-1 border rounded text-slate-400 cursor-pointer">Sebelumnya</span>
            @else
                <a href="{{ $laporan->previousPageUrl() }}" class="px-3 py-1 border cursor-pointer rounded hover:bg-slate-100 cursor-pointer">
                    Sebelumnya
                </a>
            @endif

            @if ($laporan->hasMorePages())
                <a href="{{ $laporan->nextPageUrl() }}" class="px-3 py-1 border rounded hover:bg-slate-100 cursor-pointer">
                    Selanjutnya
                </a>
            @else
                <span class="px-3 py-1 border rounded text-slate-400 cursor-pointer">Selanjutnya</span>
            @endif
        </div>
    </div>
</div>

<div class="w-[1080px] bg-white rounded-lg border border-gray-300 p-4 mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-medium text-[12px] leading-[24px] text-black">Ulasan Produk</h2>
    </div>
        <div class="grid grid-cols-5 text-xs font-medium border-b border-gray-300 pb-2 mb-2">
        <span>#</span>
        <span>Produk</span>
        <span>Bintang</span>
        <span>Komentar</span>
        <span>Aksi</span>
    </div>

    <svg width="25" height="25" viewBox="0 0 15 15" fill="none"xmlns="http://www.w3.org/2000/svg">
        <path d="M13.9462 6.83183C15.0169 6.02194 14.4441 4.31527 13.1016 4.31527H10.6724C10.0585 4.31527 9.51621 3.9153 9.33488 3.32878L8.61073 0.986469C8.20409 -0.328848 6.3423 -0.328848 5.93566 0.986469L5.21151 3.32878C5.03018 3.9153 4.48788 4.31527 3.87397 4.31527H1.4028C0.0646122 4.31527 -0.510888 6.01283 0.551411 6.82663L2.66789 8.44802C3.13204 8.80359 3.32634 9.41018 3.15515 9.96926L2.38615 12.4808C1.98735 13.7833 3.49486 14.8304 4.5762 14.0021L6.4218 12.5882C6.92416 12.2033 7.62222 12.2033 8.12458 12.5882L9.95388 13.9896C11.0368 14.8191 12.5457 13.768 12.1428 12.4647L11.3631 9.9428C11.1891 9.37985 11.3862 8.76818 11.8561 8.41272L13.9462 6.83183Z"fill="#FFAD33"/>
    </svg>
</div>