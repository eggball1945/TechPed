@php
    $displayProducts = [];
    $excludeIds = isset($jelajahProducts) ? $jelajahProducts->pluck('id')->toArray() : [];

    // Get products from controller variable or query if not set
    $sourceProducts = $bestProducts ?? ($bestSellingProducts ?? collect());
    
    // Filter out products already in flashsale
    $products = $sourceProducts->filter(function ($product) use ($excludeIds) {
        return !in_array($product->id, $excludeIds);
    });

    // If too few products after filtering, fetch more best selling items
    if ($products->count() < 5) {
        $salesSubquery = \Illuminate\Support\Facades\DB::table('order_product')
            ->select('product_id', \Illuminate\Support\Facades\DB::raw('SUM(jumlah) as total_sold'))
            ->groupBy('product_id');

        $additional = \App\Models\Product::leftJoinSub($salesSubquery, 'sales', function ($join) {
                $join->on('products.id', '=', 'sales.product_id');
            })
            ->select('products.*', \Illuminate\Support\Facades\DB::raw('COALESCE(sales.total_sold, 0) as total_sold'))
            ->whereNotIn('products.id', $excludeIds)
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();
        
        $products = $products->concat($additional)->unique('id');
    }

    // Shuffle and pick 5-10
    $shuffledProducts = $products->shuffle()->take(10);

    foreach ($shuffledProducts as $product) {
        $images = json_decode($product->gambar, true);

        $displayProducts[] = [
            'name' => $product->nama_produk,
            'price' => 'Rp. ' . number_format($product->harga, 0, ',', '.'),
            'original_price' => null, // Backend doesn't have diskon field currently for terlaris
            'rating' => intval($product->reviews_avg_rating ?? 0),
            'reviews' => intval($product->reviews_count ?? 0),
            'image' => !empty($images) 
                ? asset('storage/' . $images[0]) 
                : asset('images/no-image.png'),
            'url' => route('user.products.show', $product->id),
            'total_sold' => intval($product->total_sold ?? 0),
        ];
    }
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-24">
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-8 mb-12 animate-fade-in-up">
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-2 bg-violet-700 rounded-full"></div>
                <span class="font-black text-xs text-violet-700 tracking-widest uppercase">
                    Populer
                </span>
            </div>
            <h2 class="text-4xl sm:text-5xl font-black text-gray-900 tracking-tighter">
                Produk <span class="text-violet-700">Terpopuler</span>
            </h2>
        </div>
        <a href="{{ route('user.products', ['sort' => 'terlaris']) }}" class="inline-flex items-center gap-2 text-xs font-black text-violet-700 hover:text-violet-800 transition-colors uppercase tracking-widest group">
            <span>Lihat Semua Terpopuler</span> 
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </a>
    </div>

    {{-- PRODUCTS --}}
    <div class="flex overflow-x-auto lg:grid lg:grid-cols-5 gap-6 pb-8 px-1 -mx-1 snap-x snap-mandatory hide-scrollbar animate-fade-in-up" style="animation-delay: 100ms">
        @foreach ($displayProducts as $item)
            <a href="{{ $item['url'] }}"
                class="group w-[240px] min-w-[240px] lg:w-auto lg:min-w-0 shrink-0 snap-start lg:snap-none bg-white rounded-4xl p-4 border border-gray-50 shadow-xl shadow-gray-200/20 hover:shadow-2xl hover:shadow-violet-100/50 hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">

                {{-- IMAGE --}}
                <div class="aspect-square bg-gray-50/50 rounded-3xl overflow-hidden mb-5 relative group-hover:scale-95 transition-transform duration-500 flex items-center justify-center">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                    {{-- SALES BADGE --}}
                    @if ($item['total_sold'] > 0)
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-md px-2.5 py-1.5 rounded-xl shadow-sm border border-gray-100">
                            <span class="text-[10px] font-black text-violet-700 uppercase tracking-tighter">
                                {{ $item['total_sold'] }} Terjual
                            </span>
                        </div>
                    @endif
                </div>

                {{-- CONTENT --}}
                <div class="flex flex-col gap-2 grow px-1">
                    {{-- NAME --}}
                    <h3 class="font-black text-sm text-gray-900 group-hover:text-violet-700 transition-colors line-clamp-1 truncate uppercase tracking-tight">
                        {{ $item['name'] }}
                    </h3>

                    {{-- PRICE --}}
                    <div class="flex items-center justify-between mt-auto pt-2">
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span class="text-xs font-black text-violet-700 whitespace-nowrap">
                                {{ $item['price'] }}
                            </span>
                            @if ($item['original_price'])
                                <span class="text-[9px] text-gray-400 line-through font-bold whitespace-nowrap">
                                    {{ $item['original_price'] }}
                                </span>
                            @endif
                        </div>

                        {{-- RATING --}}
                        <div class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-lg">
                            <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.068 9.382c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.955z"/>
                            </svg>
                            <span class="text-[10px] font-black text-gray-500">{{ $item['rating'] }}</span>
                        </div>
                    </div>
                </div>
            </a>
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
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out both;
    }
</style>