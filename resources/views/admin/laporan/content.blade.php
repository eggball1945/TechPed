@php
    $maxValue = max($dataBulanan);
    $maxValue = $maxValue > 0 ? $maxValue : 1;
@endphp

<div class="bg-white rounded-xl p-6 shadow-sm">
    <p class="text-left text-[13px] font-medium mb-12">Ringkasan Pendapatan</p>

    @php
        $maxValue = max($dataBulanan) ?: 1;
        $bulanLabel = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    @endphp

    <div class="flex items-end justify-center gap-2 sm:gap-4 lg:gap-6 h-[260px] pb-4">
        @foreach($dataBulanan as $bulan => $pendapatan)
            @php
                $maxValue = max($dataBulanan) ?: 1;
                $height = ($pendapatan / $maxValue) * 220;
                $height = $height ?: 5;
            @endphp
            <div class="flex flex-col items-center gap-3 relative group w-8 sm:w-10 md:w-12 lg:w-16">
                <span class="mb-2 text-[10px] font-bold text-gray-700 opacity-0 group-hover:opacity-100 transition-all duration-300 absolute -top-12 whitespace-nowrap bg-white px-3 py-1.5 rounded-lg shadow-xl shadow-violet-100 border border-violet-50 z-10 pointer-events-none">
                    {{ $pendapatan > 0 ? 'Rp ' . number_format($pendapatan, 0, ',', '.') : 'Rp 0' }}
                </span>
                <div class="w-full rounded-t-xl bg-violet-700 transition-all duration-500 hover:bg-violet-800 hover:scale-x-105 origin-bottom relative shadow-lg shadow-violet-200/50" style="height: {{ $height }}px;">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/5 to-transparent rounded-t-xl"></div>
                </div>
                <span class="text-[9px] sm:text-[11px] font-black text-gray-500 uppercase tracking-tighter">{{ $bulanLabel[$bulan - 1] }}</span>
            </div>
        @endforeach
    </div>
</div>

<div class="w-[1080px] bg-white rounded-lg border border-gray-300 p-4 mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-medium text-[12px] leading-[24px] text-black">Laporan Penjualan</h2>
        <div class="flex gap-2">
            <a href="{{ route('admin.laporan.excel', ['tahun' => $tahun, 'user_id' => $user_id]) }}" class="px-3 py-1 text-xs bg-violet-700 text-white rounded">Excel</a>
            <a href="{{ route('admin.laporan.pdf', ['tahun' => $tahun, 'user_id' => $user_id]) }}" class="px-3 py-1 text-xs bg-violet-700 text-white rounded">PDF</a>
        </div>
    </div>

    <div class="grid grid-cols-[80px_1fr_150px_100px_150px] bg-gray-50/50 border-b border-gray-200 py-3 px-2 mb-2">
        <span class="text-left text-[9px] font-bold text-black uppercase tracking-widest">Peringkat</span>
        <span class="text-left text-[9px] font-bold text-black uppercase tracking-widest">Produk</span>
        <span class="text-right text-[9px] font-bold text-black uppercase tracking-widest">Harga Rata-rata</span>
        <span class="text-right text-[9px] font-bold text-black uppercase tracking-widest">Unit Terjual</span>
        <span class="text-right text-[9px] font-bold text-black uppercase tracking-widest">Pendapatan</span>
    </div>

    @foreach ($laporan as $index => $row)
        <div class="grid grid-cols-[80px_1fr_150px_100px_150px] text-xs py-3 border-b border-gray-200 px-2 items-center hover:bg-slate-50 transition-colors">
            <span class="text-gray-500 font-medium">#{{ $index + 1 }}</span>
            <span class="truncate pr-4 font-medium" title="{{ $row->nama_produk }}">{{ $row->nama_produk }}</span>
            <span class="text-right">Rp {{ number_format($row->harga_rata_rata, 0, ',', '.') }}</span>
            <span class="text-right">{{ number_format($row->unit_terjual) }}</span>
            <span class="text-right font-semibold text-violet-700">Rp {{ number_format($row->pendapatan, 0, ',', '.') }}</span>
        </div>
    @endforeach

    <div class="flex items-center justify-between mt-6 text-[10px] text-slate-600">
        <span>Menampilkan 5 Produk Terlaris</span>
    </div>
</div>

<div class="w-[1080px] bg-white rounded-lg border border-gray-300 p-4 mt-8">
    <h2 class="font-medium text-[12px] leading-[24px] text-black mb-4">Laporan Barang Masuk (Inventaris)</h2>

    <div class="grid grid-cols-[1fr_150px_120px_120px] bg-gray-50/50 border-b border-gray-200 py-3 px-2 mb-2">
        <span class="text-left text-[9px] font-bold text-black uppercase tracking-widest">Produk</span>
        <span class="text-left text-[9px] font-bold text-black uppercase tracking-widest">SKU</span>
        <span class="text-left text-[9px] font-bold text-black uppercase tracking-widest">Kategori</span>
        <span class="text-right text-[9px] font-bold text-black uppercase tracking-widest">Stok Saat Ini</span>
    </div>

    @foreach ($barangMasuk as $item)
        <div class="grid grid-cols-[1fr_150px_120px_120px] text-xs py-3 border-b border-gray-200 px-2 items-center hover:bg-slate-50 transition-colors">
            <span class="truncate pr-4 font-medium" title="{{ $item->nama_produk }}">{{ $item->nama_produk }}</span>
            <span class="truncate text-gray-600">{{ $item->sku }}</span>
            <span class="capitalize text-gray-600 truncate">{{ $item->kategori }}</span>
            <span class="text-right font-medium {{ $item->stok <= 10 ? 'text-red-600' : 'text-gray-900' }}">
                {{ number_format($item->stok) }}
            </span>
        </div>
    @endforeach

    <div class="flex items-center justify-between mt-6 text-[10px] text-slate-600">
        <span>
            Menampilkan
            {{ $barangMasuk->firstItem() ?? 0 }}
            -
            {{ $barangMasuk->lastItem() ?? 0 }}
            dari
            {{ $barangMasuk->total() }}
            produk
        </span>

        <div class="flex gap-1">
            @if ($barangMasuk->onFirstPage())
                <span class="px-3 py-1 border rounded text-slate-400 cursor-not-allowed">Sebelumnya</span>
            @else
                <a href="{{ $barangMasuk->previousPageUrl() }}" class="px-3 py-1 border rounded hover:bg-slate-100 cursor-pointer">
                    Sebelumnya
                </a>
            @endif

            @if ($barangMasuk->hasMorePages())
                <a href="{{ $barangMasuk->nextPageUrl() }}" class="px-3 py-1 border rounded hover:bg-slate-100 cursor-pointer">
                    Selanjutnya
                </a>
            @else
                <span class="px-3 py-1 border rounded text-slate-400 cursor-not-allowed">Selanjutnya</span>
            @endif
        </div>
    </div>
</div>

<div class="w-[1080px] bg-white rounded-lg border border-gray-300 p-4 mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-medium text-[12px]">Ulasan Produk</h2>
        @if($reviews->count() > 0)
            <form action="{{ route('admin.review.destroyAll') }}" method="POST" onsubmit="confirmAction(event, 'Apakah Anda yakin ingin menghapus SEMUA ulasan?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center gap-2 px-3 py-1.5 bg-violet-50 hover:bg-violet-100 text-violet-600 rounded transition-colors group cursor-pointer">
                    <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform">
                        <path d="M1 3.5H9.75M4.125 5.375V10.375M6.625 5.375V10.375M4.125 1H6.625C6.79076 1 6.94973 1.06585 7.06694 1.18306C7.18415 1.30027 7.25 1.45924 7.25 1.625V3.5H3.5V1.625C3.5 1.45924 3.56585 1.30027 3.68306 1.18306C3.80027 1.06585 3.95924 1 4.125 1ZM1.625 3.5H9.125V11.625C9.125 11.7908 9.05915 11.9497 8.94194 12.0669C8.82473 12.1842 8.66576 12.25 8.5 12.25H2.25C2.08424 12.25 1.92527 12.1842 1.80806 12.0669C1.69085 11.9497 1.625 11.7908 1.625 11.625V3.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-[11px] font-bold uppercase tracking-widest">Hapus Semua</span>
                </button>
            </form>
        @endif
    </div>

    <div class="grid grid-cols-[200px_1fr_100px_100px] bg-gray-50/50 border-b border-gray-200 py-3 px-2 mb-2 items-center">
        <span class="text-left text-[9px] font-bold text-black uppercase tracking-widest">Reviewer</span>
        <span class="text-center text-[9px] font-bold text-black uppercase tracking-widest">Rating</span>
        <span class="text-center text-[9px] font-bold text-black uppercase tracking-widest">Detail</span>
        <span class="text-center text-[9px] font-bold text-black uppercase tracking-widest">Aksi</span>
    </div>

    @forelse($reviews as $review)
        <div class="grid grid-cols-[200px_1fr_100px_100px] items-center text-xs py-4 border-b border-gray-200 px-2 hover:bg-slate-50 transition-colors">
            {{-- USER --}}
            <div class="flex flex-col">
                <span class="font-medium truncate pr-2" title="{{ $review->user->nama_depan ?? 'User' }}">
                    {{ $review->user->nama_depan ?? 'User' }}
                </span>
                <span class="text-[10px] text-gray-500">{{ optional($review->created_at)->format('d M Y') ?? '-' }}</span>
            </div>

            {{-- RATING --}}
            <div class="flex justify-center gap-1">
                @for ($i = 1; $i <= 5; $i++)
                    <svg width="14" height="14" viewBox="0 0 15 15" fill="{{ $i <= $review->rating ? '#FFAD33' : '#E5E7EB' }}">
                        <path d="M13.9459 6.83183C15.0166 6.02194 14.4439 4.31527 13.1013 4.31527H10.6722C10.0583 4.31527 9.51596 3.9153 9.33463 3.32878L8.61049 0.986469C8.20385 -0.328848 6.34205 -0.328848 5.93541 0.986469L5.21126 3.32878C5.02994 3.9153 4.48764 4.31527 3.87373 4.31527H1.40256C0.064368 4.31527 -0.511132 6.01283 0.551167 6.82663L2.66764 8.44802C3.1318 8.80359 3.32609 9.41018 3.15491 9.96926L2.38591 12.4808C1.98711 13.7833 3.49462 14.8304 4.57596 14.0021L6.42156 12.5882C6.92392 12.2033 7.62198 12.2033 8.12434 12.5882L9.95364 13.9896C11.0365 14.8191 12.5455 13.768 12.1426 12.4647L11.3629 9.9428C11.1889 9.37985 11.3859 8.76818 11.8559 8.41272L13.9459 6.83183Z"/>
                    </svg>
                @endfor
            </div>

            <div class="flex items-center justify-center">
                <button onclick="openReview({{ $review->id }})" class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 9.375C8.53553 9.375 9.375 8.53553 9.375 7.5C9.375 6.46447 8.53553 5.625 7.5 5.625C6.46447 5.625 5.625 6.46447 5.625 7.5C5.625 8.53553 6.46447 9.375 7.5 9.375Z" fill="#6D28D9"/>
                        <path d="M14.5029 7.34062C13.9516 5.91452 12.9945 4.68123 11.7499 3.79317C10.5052 2.9051 9.02768 2.40121 7.4998 2.34375C5.97192 2.40121 4.49436 2.9051 3.24974 3.79317C2.00512 4.68123 1.048 5.91452 0.496676 7.34062C0.459441 7.44361 0.459441 7.55639 0.496676 7.65938C1.048 9.08548 2.00512 10.3188 3.24974 11.2068C4.49436 12.0949 5.97192 12.5988 7.4998 12.6562C9.02768 12.5988 10.5052 12.0949 11.7499 11.2068C12.9945 10.3188 13.9516 9.08548 14.5029 7.65938C14.5402 7.55639 14.5402 7.44361 14.5029 7.34062ZM7.4998 10.5469C6.89719 10.5469 6.3081 10.3682 5.80705 10.0334C5.30599 9.69859 4.91547 9.22273 4.68486 8.66599C4.45424 8.10924 4.39391 7.49662 4.51147 6.90558C4.62903 6.31455 4.91922 5.77165 5.34533 5.34553C5.77145 4.91942 6.31435 4.62923 6.90538 4.51167C7.49642 4.39411 8.10905 4.45444 8.66579 4.68505C9.22253 4.91567 9.69839 5.30619 10.0332 5.80725C10.368 6.3083 10.5467 6.89739 10.5467 7.5C10.5454 8.3077 10.224 9.08197 9.6529 9.6531C9.08177 10.2242 8.3075 10.5456 7.4998 10.5469Z" fill="#6D28D9"/>
                    </svg>
                </button>
            </div>

            <div class="flex items-center justify-center">
                <form action="{{ route('admin.review.destroy', $review->id) }}" method="POST" onsubmit="confirmAction(event, 'Apakah Anda yakin ingin menghapus ulasan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150 group">
                        <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 3.5H9.75M4.125 5.375V10.375M6.625 5.375V10.375M4.125 1H6.625C6.79076 1 6.94973 1.06585 7.06694 1.18306C7.18415 1.30027 7.25 1.45924 7.25 1.625V3.5H3.5V1.625C3.5 1.45924 3.56585 1.30027 3.68306 1.18306C3.80027 1.06585 3.95924 1 4.125 1ZM1.625 3.5H9.125V11.625C9.125 11.7908 9.05915 11.9497 8.94194 12.0669C8.82473 12.1842 8.66576 12.25 8.5 12.25H2.25C2.08424 12.25 1.92527 12.1842 1.80806 12.0669C1.69085 11.9497 1.625 11.7908 1.625 11.625V3.5Z" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div id="review-{{ $review->id }}" class="hidden fixed inset-0 bg-black/50 items-center justify-center z-50">
            <div class="bg-white w-[500px] rounded-lg p-5">
                <h3 class="text-sm font-semibold mb-3">Detail Review</h3>

                @php
                    $gambar = optional($review->product)->gambar
                        ? json_decode($review->product->gambar)[0]
                        : null;
                @endphp

                @if($gambar)
                    <img src="{{ asset('storage/' . $gambar) }}" class="items-center w-20 h-20 object-cover rounded mb-3">
                @endif
                <p class="text-xs font-semibold mb-2 truncate" title="{{ $review->product->nama_produk ?? '-' }}">
                    {{ $review->product->nama_produk ?? '-' }}
                </p>
                <div class="flex gap-1 my-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg width="15" height="15" fill="{{ $i <= $review->rating ? '#FFAD33' : '#E5E7EB' }}">
                            <path d="M13.9459 6.83183C15.0166 6.02194 14.4439 4.31527 13.1013 4.31527H10.6722C10.0583 4.31527 9.51596 3.9153 9.33463 3.32878L8.61049 0.986469C8.20385 -0.328848 6.34205 -0.328848 5.93541 0.986469L5.21126 3.32878C5.02994 3.9153 4.48764 4.31527 3.87373 4.31527H1.40256C0.064368 4.31527 -0.511132 6.01283 0.551167 6.82663L2.66764 8.44802C3.1318 8.80359 3.32609 9.41018 3.15491 9.96926L2.38591 12.4808C1.98711 13.7833 3.49462 14.8304 4.57596 14.0021L6.42156 12.5882C6.92392 12.2033 7.62198 12.2033 8.12434 12.5882L9.95364 13.9896C11.0365 14.8191 12.5455 13.768 12.1426 12.4647L11.3629 9.9428C11.1889 9.37985 11.3859 8.76818 11.8559 8.41272L13.9459 6.83183Z"/>
                        </svg>
                    @endfor
                </div>
                <div class="max-h-[150px] overflow-y-auto mb-3">
                    <p class="text-xs text-gray-600 leading-relaxed">{{ $review->komentar ?? '-' }}</p>
                </div>
                <p class="text-[10px] text-gray-500 mb-4 border-t border-gray-100 pt-2">Diterima pada: {{ $review->created_at->format('d M Y') }}</p>
                <div class="text-right">
                    <button onclick="closeReview({{ $review->id }})" class="px-5 py-1.5 bg-violet-700 rounded text-xs text-white font-medium cursor-pointer hover:bg-violet-800 transition-colors">Tutup</button>
                </div>
            </div>
        </div>

    @empty
        <p class="text-xs text-gray-500 py-4">Belum ada review</p>
    @endforelse

    <div class="mt-4">
        {{ $reviews->appends(request()->all())->links() }}
    </div>

    <div class="flex items-center justify-between mt-6 text-[10px] text-slate-600">
        <span>
            Menampilkan
            {{ $reviews->firstItem() ?? 0 }}
            -
            {{ $reviews->lastItem() ?? 0 }}
            dari
            {{ $reviews->total() }}
            ulasan
        </span>

        <div class="flex gap-1">
            @if ($reviews->onFirstPage())
                <span class="px-3 py-1 border rounded text-slate-400 cursor-not-allowed">Sebelumnya</span>
            @else
                <a href="{{ $reviews->appends(request()->all())->previousPageUrl() }}" class="px-3 py-1 border rounded hover:bg-slate-100 cursor-pointer">
                    Sebelumnya
                </a>
            @endif

            @if ($reviews->hasMorePages())
                <a href="{{ $reviews->appends(request()->all())->nextPageUrl() }}" class="px-3 py-1 border rounded hover:bg-slate-100 cursor-pointer">
                    Selanjutnya
                </a>
            @else
                <span class="px-3 py-1 border rounded text-slate-400 cursor-not-allowed">Selanjutnya</span>
            @endif
        </div>
    </div>
</div>

<script>
function openReview(id) {
    const el = document.getElementById('review-' + id);
    el.classList.remove('hidden');
    el.classList.add('flex');
}
function closeReview(id) {
    const el = document.getElementById('review-' + id);
    el.classList.add('hidden');
    el.classList.remove('flex');
}
</script>