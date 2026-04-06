<a href="{{ route('user.products.show', $product->id) }}"
    class="group bg-white rounded-[2rem] p-4 border border-gray-50 shadow-xl shadow-gray-200/20 hover:shadow-2xl hover:shadow-violet-100/50 hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">

    {{-- IMAGE --}}
    <div
        class="aspect-square bg-gray-50/50 rounded-[1.5rem] overflow-hidden mb-5 relative group-hover:scale-95 transition-transform duration-500 flex items-center justify-center">
        <img src="{{ !empty($product->gambar_array) ? asset('storage/' . $product->gambar_array[0]) : asset('images/no-image.png') }}"
            alt="{{ $product->nama_produk }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

        {{-- TERJUAL BADGE --}}
        @php
            $soldCount = $product->order_product_count ?? ($product->total_sold ?? 0);
        @endphp
        @if ($soldCount > 0)
            <div
                class="absolute top-3 right-3 bg-white/90 backdrop-blur-md px-2.5 py-1.5 rounded-xl shadow-sm border border-gray-100">
                <span class="text-[10px] font-black text-violet-700 uppercase tracking-tighter">
                    {{ $soldCount }} Terjual
                </span>
            </div>
        @endif
    </div>

    {{-- CONTENT --}}
    <div class="flex flex-col gap-2 flex-grow px-1">
        {{-- NAME --}}
        <h3
            class="font-black text-sm text-gray-900 group-hover:text-violet-700 transition-colors line-clamp-1 truncate uppercase tracking-tight">
            {{ $product->nama_produk }}
        </h3>

        {{-- PRICE --}}
        <div class="flex items-center justify-between mt-auto pt-2">
            <div class="flex items-center gap-1.5 flex-wrap">
                <span class="text-xs font-black text-violet-700 whitespace-nowrap">
                    Rp {{ number_format($product->harga_diskon ?? $product->harga, 0, ',', '.') }}
                </span>
                @if ($product->harga_diskon)
                    <span class="text-[9px] text-gray-400 line-through font-bold whitespace-nowrap">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </span>
                @endif
            </div>

            {{-- RATING --}}
            <div class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-lg">
                <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.068 9.382c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.955z" />
                </svg>
                <span
                    class="text-[10px] font-black text-gray-500">{{ round($product->reviews_avg_rating ?? 0, 1) }}</span>
            </div>
        </div>
    </div>
</a>
