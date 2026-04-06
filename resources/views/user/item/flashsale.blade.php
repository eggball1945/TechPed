@php
    if (!isset($jelajahProducts)) {
        $jelajahProducts = \App\Models\Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->inRandomOrder()
            ->take(10)
            ->get();
    }
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-24">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-8 mb-12 animate-fade-in-up">
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-2 bg-violet-700 rounded-full"></div>
                <span class="font-black text-xs text-violet-700 tracking-widest uppercase">
                    Pilihan Terbaik
                </span>
            </div>
            <h2 class="text-4xl sm:text-5xl font-black text-gray-900 tracking-tighter">
                Rekomendasi <span class="text-violet-700">Untukmu</span>
            </h2>
        </div>
        <a href="{{ route('user.products') }}"
            class="inline-flex items-center gap-2 text-xs font-black text-violet-700 hover:text-violet-800 transition-colors uppercase tracking-widest group">
            <span>Lihat Semua Produk</span>
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    </div>

    {{-- PRODUCTS --}}
    <div class="flex overflow-x-auto lg:grid lg:grid-cols-5 gap-6 pb-8 px-1 -mx-1 snap-x snap-mandatory hide-scrollbar animate-fade-in-up"
        style="animation-delay: 100ms">
        @foreach ($jelajahProducts as $product)
            @include('user.item.product-card')
        @endforeach
    </div>
</div>

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out both;
    }
</style>
