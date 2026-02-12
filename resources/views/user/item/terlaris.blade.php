@php
    $bestProducts = [
        [
            'name' => 'PC Gaming I7-14700k RAM 32 GB',
            'price' => 'Rp. 15.000.000',
            'original_price' => 'Rp. 15.200.000',
            'rating' => 5,
            'reviews' => 65,
            'image' => '/image/pc.png',
        ],
        [
            'name' => 'Processor AMD Ryzen 5600X',
            'price' => 'Rp. 2.000.000',
            'original_price' => 'Rp. 2.300.000',
            'rating' => 4,
            'reviews' => 65,
            'image' => '/image/ryzen.png',
        ],
        [
            'name' => 'RGB Liquid CPU Cooler',
            'price' => 'Rp. 3.000.000',
            'original_price' => 'Rp. 2.700.000',
            'rating' => 4,
            'reviews' => 65,
            'image' => '/image/cooler.png',
        ],
        [
            'name' => 'Geforce RTX™ 5060 Ti',
            'price' => 'Rp. 6.500.000',
            'original_price' => null,
            'rating' => 5,
            'reviews' => 65,
            'image' => '/image/gpu.png',
        ],
    ];
@endphp


<div class="container mx-auto px-6 py-12">
    {{-- HEADER --}}
    <div class="flex flex-col gap-5 mb-10">
        <div class="flex items-end justify-between w-full max-w-[1200px]">
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-5 h-10 bg-violet-700 rounded-md"></div>
                    <span class="font-semibold text-[16px] text-violet-700">
                        Bulan Ini
                    </span>
                </div>
                <span class="font-semibold text-[36px] text-black">
                    Produk Terlaris
                </span>
            </div>

            <div class="flex justify-center">
                <a href="/products" class="inline-flex items-center justify-center gap-2.5 bg-violet-700 px-12 py-4 rounded-lg font-medium text-base text-white hover:bg-violet-800 transition">
                    Lihat Semua
                </a>
            </div>
        </div>
    </div>

    {{-- ITEMS --}}
    <div class="flex justify-center">
        <div class="w-[1200px] flex gap-6 flex-wrap justify-center">
            @foreach ($bestProducts as $item)
                <div class="flex flex-col bg-neutral-100 rounded-lg p-3 w-[220px] h-[290px]">

                    <div class="w-full h-[140px] flex justify-center items-center mb-2">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="object-contain w-full h-full">
                    </div>

                    <div class="flex flex-col gap-2 py-6">

                        <span
                            class="font-medium text-sm text-black leading-tight
                                    overflow-hidden text-ellipsis whitespace-nowrap">
                            {{ $item['name'] }}
                        </span>

                        <div class="flex items-end gap-2">
                            <span class="font-semibold text-sm text-violet-700">
                                {{ $item['price'] }}
                            </span>

                            @if ($item['original_price'])
                                <span class="text-[11px] line-through text-black opacity-50">
                                    {{ $item['original_price'] }}
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center gap-1.5">
                            <div class="flex gap-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $item['rating'] ? 'text-[#ffad33]' : 'text-[#ffad33] opacity-25' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.068 9.382c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.955z" />
                                    </svg>
                                @endfor
                            </div>

                            <span class="text-xs font-semibold text-black opacity-50">
                                ({{ $item['reviews'] }})
                            </span>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
