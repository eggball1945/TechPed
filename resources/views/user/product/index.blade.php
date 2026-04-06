@extends('user.layouts.app')

@section('title', 'Katalog Produk | TechPed')

@section('content')
<div class="px-6 py-10">
    {{-- Header Section --}}
    <div class="mb-12 animate-fade-in relative z-20">
        <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6 font-sans">
            <a href="{{ route('landing') }}" class="hover:text-violet-700 transition-colors">Beranda</a>
            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
            <span class="text-violet-700">Katalog</span>
        </nav>
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight leading-none mb-4">
                    Katalog <span class="text-violet-700">Produk</span>
                </h1>
                <p class="text-sm text-gray-500 font-medium">
                    @if(request('category'))
                        Menampilkan koleksi terbaik untuk kategori <span class="text-violet-700 font-black uppercase tracking-widest text-[10px] bg-violet-50 px-2 py-1 rounded-lg ml-1">{{ request('category') }}</span>
                    @else
                        Temukan perangkat impian Anda dengan kualitas terbaik dari TechPed.
                    @endif
                </p>
            </div>
            
            @php
                $sortOptions = [
                    'terbaru' => 'Terbaru',
                    'harga_rendah' => 'Harga Terendah',
                    'harga_tinggi' => 'Harga Tertinggi',
                    'terlaris' => 'Terpopuler'
                ];
                $currentSort = request('sort', 'terbaru');
                $currentSortLabel = $sortOptions[$currentSort] ?? 'Terbaru';
            @endphp

            <div class="relative inline-block text-left font-['Poppins']">
                <form action="{{ route('user.products') }}" method="GET" id="sortForm">
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                    <input type="hidden" name="sort" id="sortInput" value="{{ $currentSort }}">

                    <button type="button" id="productSortButton" class="group flex items-center gap-4 bg-white px-6 py-4 rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/40 hover:border-violet-200 transition-all cursor-pointer">
                        <div class="flex items-center gap-3 border-r border-gray-100 pr-4">
                            <svg class="w-4 h-4 text-violet-700 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" /></svg>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Urutkan</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-black text-gray-900 uppercase tracking-widest">{{ $currentSortLabel }}</span>
                            <svg class="w-4 h-4 text-gray-400 group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </button>

                    <ul id="productSortMenu" class="hidden absolute right-0 mt-3 w-64 bg-white rounded-[2rem] shadow-2xl border border-gray-50 overflow-hidden z-50 animate-fade-in origin-top-right">
                        @foreach($sortOptions as $value => $label)
                            <li data-value="{{ $value }}" class="px-7 py-5 text-[10px] font-black text-gray-900 uppercase tracking-[0.2em] cursor-pointer hover:bg-violet-700 hover:text-white transition-all flex items-center justify-between group/item {{ $currentSort === $value ? 'bg-violet-50 text-violet-700' : '' }}">
                                {{ $label }}
                                @if($currentSort === $value)
                                    <div class="w-1.5 h-1.5 rounded-full bg-violet-700"></div>
                                @endif
                                <svg class="w-4 h-4 opacity-0 -translate-x-2 group-hover/item:opacity-100 group-hover/item:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </li>
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 relative z-10">
            @foreach ($products as $product)
                <div class="animate-fade-in-up" style="animation-delay: {{ ($loop->index % 10) * 100 }}ms">
                    @include('user.item.product-card')
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="mt-20 flex justify-center animate-fade-in-up" style="animation-delay: 500ms">
                <div class="bg-white p-4 rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-50">
                    {{ $products->links() }}
                </div>
            </div>
        @endif
    @else
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-32 animate-fade-in-up">
            <div class="w-32 h-32 bg-violet-50 rounded-full flex items-center justify-center mb-8 border border-violet-100">
                <svg class="w-16 h-16 text-violet-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <h3 class="text-3xl font-black text-gray-900 mb-4 uppercase italic">Produk <span class="text-violet-700">Tidak Ditemukan</span></h3>
            <p class="text-gray-500 font-medium text-center max-w-sm mb-10">Kami tidak dapat menemukan produk yang Anda cari. Coba gunakan kata kunci lain atau pilih kategori berbeda.</p>
            <a href="{{ route('user.products') }}" class="bg-violet-700 text-white font-black px-10 py-4 rounded-2xl shadow-lg shadow-violet-200 hover:shadow-2xl hover:scale-105 active:scale-95 transition-all uppercase text-xs tracking-widest">Lihat Semua Produk</a>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sBtn = document.getElementById('productSortButton');
        const sMenu = document.getElementById('productSortMenu');
        const sInp = document.getElementById('sortInput');
        const sForm = document.getElementById('sortForm');

        if (sBtn && sMenu && sForm) {
            sBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                sMenu.classList.toggle('hidden');
            });

            sMenu.querySelectorAll('li').forEach(item => {
                item.addEventListener('click', function() {
                    const val = this.getAttribute('data-value');
                    sInp.value = val;
                    sForm.submit();
                });
            });

            // Close when clicking outside
            window.addEventListener('click', () => {
                sMenu.classList.add('hidden');
            });
        }
    });
</script>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fade-in-up { animation: fade-in-up 0.6s ease-out both; }
    .animate-fade-in { animation: fade-in 0.2s ease-out both; }
    .hide-scrollbar::-webkit-scrollbar { display: none; }
</style>
@endsection