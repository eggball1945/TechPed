@php
$jelajahProduct = [
    [
        'name' => 'Microphone HD Sound',
        'price' => 'Rp. 400.000',
        'original_price' => null,
        'rating' => 3,
        'reviews' => 35,
        'image' => '/image/microphone.png',
        'badge' => null,
    ],
    [
        'name' => 'Kotion Each G9000 Headset',
        'price' => 'Rp. 1.200.000',
        'original_price' => null,
        'rating' => 4,
        'reviews' => 95,
        'image' => '/image/headset.png',
        'badge' => 'cart',
    ],
    [
        'name' => 'ASUS FHD Gaming Laptop',
        'price' => 'Rp. 28.000.000',
        'original_price' => null,
        'rating' => 5,
        'reviews' => 325,
        'image' => '/image/laptop.png',
        'badge' => null,
    ],
    [
        'name' => 'Mouse Logitech G502 Proteus',
        'price' => 'Rp. 700.000',
        'original_price' => null,
        'rating' => 4,
        'reviews' => 145,
        'image' => '/image/mouse.png',
        'badge' => null,
    ],
    [
        'name' => 'CPU Cooler GAMEMAX',
        'price' => 'Rp. 600.000',
        'original_price' => null,
        'rating' => 5,
        'reviews' => 7,
        'image' => '/image/cooler.png',
        'badge' => 'NEW',
    ],
    [
        'name' => 'Motherboard ROG Zenith Extreme',
        'price' => 'Rp. 12.000.000',
        'original_price' => null,
        'rating' => 5,
        'reviews' => 35,
        'image' => '/image/motherboard.png',
        'badge' => null,
    ],
    [
        'name' => 'GP11 Shooter USB Gamepad',
        'price' => 'Rp. 1.200.000',
        'original_price' => null,
        'rating' => 4.5,
        'reviews' => 55,
        'image' => '/image/gamepad.png',
        'badge' => 'NEW',
    ],
    [
        'name' => 'SSD GIGABYTE M.2 500GB',
        'price' => 'Rp. 1.200.000',
        'original_price' => null,
        'rating' => 4.5,
        'reviews' => 55,
        'image' => '/image/ssd.png',
        'badge' => null,
    ],
];
@endphp

<div class="container mx-auto px-6 py-16">
    {{-- HEADER --}}
    <div class="mb-14">
        <div class="flex items-center gap-4 mb-3">
            <div class="w-5 h-10 bg-violet-700 rounded-md"></div>
            <span class="font-semibold text-violet-700">
                Produk Kami
            </span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-black">
            Jelajah Produk Kami
        </h2>
    </div>

    {{-- ITEMS --}}
    <div class="flex justify-center">
        <div class="w-[1200px] flex gap-6 flex-wrap justify-center">
            @foreach ($jelajahProduct as $item)
                <div class="flex flex-col bg-neutral-100 rounded-lg p-3 w-[220px] h-[290px]">
                    {{-- IMAGE --}}
                    <div class="w-full h-[140px] flex justify-center items-center mb-2">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="object-contain w-full h-full">
                    </div>

                    {{-- INFO --}}
                    <div class="flex flex-col gap-2 py-6">
                        {{-- NAME --}}
                        <span class="font-medium text-sm text-black leading-tight overflow-hidden text-ellipsis whitespace-nowrap">
                            {{ $item['name'] }}
                        </span>

                        {{-- PRICE --}}
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

                        {{-- RATING --}}
                        <div class="flex items-center gap-1.5">
                            <div class="flex gap-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $item['rating'] ? 'text-[#ffad33]' : 'text-[#ffad33] opacity-25' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.068 9.382c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.955z"/>
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