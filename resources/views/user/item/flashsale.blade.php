@php
    $flashsales = [
        [
            'discount' => '-40%',
            'name' => 'HAVIT HV-G92 Gamepad',
            'price' => 'Rp. 300.000',
            'original_price' => 'Rp. 500.000',
            'rating' => 5,
            'reviews' => 88,
            'image' => 'path/to/gamepad.png',
        ],
        [
            'discount' => '-35%',
            'name' => 'AK-900 Wired Keyboard',
            'price' => 'Rp. 300.000',
            'original_price' => 'Rp. 500.000',
            'rating' => 4,
            'reviews' => 75,
            'image' => 'path/to/keyboard.png',
        ],
        [
            'discount' => '-30%',
            'name' => 'IPS LCD Gaming Monitor',
            'price' => 'Rp. 5.000.000',
            'original_price' => 'Rp. 5.500.000',
            'rating' => 5,
            'reviews' => 99,
            'image' => 'path/to/monitor.png',
        ],
        [
            'discount' => '-25%',
            'name' => 'Ram DDR 5 TridentZ 32 x 2 GB',
            'price' => 'Rp. 7.000.000',
            'original_price' => 'Rp. 7.500.000',
            'rating' => 5,
            'reviews' => 10,
            'image' => 'path/to/ram.png',
        ],
        [
            'discount' => '-25%',
            'name' => 'S-Series Comfort Chair',
            'price' => 'Rp. 1.000.000',
            'original_price' => 'Rp. 1.250.000',
            'rating' => 5,
            'reviews' => 99,
            'image' => 'path/to/chair.png',
        ],
    ];
@endphp

{{-- HEADER FLASHSALE --}}
<div class="flex px-20 py-8">
    <div class="flex items-end gap-[87px]">
        <div class="flex flex-col gap-6">
            <div class="flex items-center gap-4">
                <div class="w-5 h-10 bg-violet-700 rounded-md "></div>
                <span class="font-semibold text-[16px] text-violet-700 leading-[20px]">Hari Ini</span>
            </div>
            <span class="font-semibold text-[36px] text-black leading-[48px]">Flash Sales</span>
        </div>

        {{-- COUNTDOWN TIMER --}}
        <div class="flex gap-4" id="flashsale-timer">
            <div class="flex flex-col items-center gap-1 w-[50px]">
                <span class="font-medium text-[12px]">Hari</span>
                <span id="days" class="font-bold text-[32px]">00</span>
            </div>
            <div class="flex flex-col items-center gap-1 w-[50px]">
                <span class="font-medium text-[12px]">Jam</span>
                <span id="hours" class="font-bold text-[32px]">00</span>
            </div>
            <div class="flex flex-col items-center gap-1 w-[50px]">
                <span class="font-medium text-[12px]">Menit</span>
                <span id="minutes" class="font-bold text-[32px]">00</span>
            </div>
            <div class="flex flex-col items-center gap-1 w-[50px]">
                <span class="font-medium text-[12px]">Detik</span>
                <span id="seconds" class="font-bold text-[32px]">00</span>
            </div>
        </div>

    </div>
</div>

{{-- FLASHSALE ITEMS --}}
<div class="flex justify-center">
    <div class="w-[1200px] flex gap-6 flex-wrap justify-center">
        @foreach ($flashsales as $item)
            <div class="flex flex-col bg-neutral-100 rounded-lg p-3 w-[220px] h-[290px]">
                
                {{-- DISKON --}}
                <div class="mb-2">
                    <span class="inline-block bg-violet-700 px-2 py-0.5 rounded text-[11px] text-white">
                        {{ $item['discount'] }}
                    </span>
                </div>

                {{-- IMAGE --}}
                <div class="w-full h-[140px] flex justify-center items-center mb-2">
                    <img 
                        src="{{ $item['image'] }}" 
                        alt="{{ $item['name'] }}" 
                        class="object-contain w-full h-full"
                    >
                </div>

                {{-- INFO --}}
                <div class="flex flex-col gap-2">
                    
                    {{-- PRODUCT NAME --}}
                    <span
                        class="font-medium text-sm text-black leading-tight
                               overflow-hidden text-ellipsis whitespace-nowrap">
                        {{ $item['name'] }}
                    </span>

                    {{-- PRICE --}}
                    <div class="flex items-end gap-2">
                        <span class="font-semibold text-sm text-violet-700">
                            {{ $item['price'] }}
                        </span>

                        <span
                            class="text-[11px] line-through text-black opacity-50
                                   overflow-hidden text-ellipsis whitespace-nowrap max-w-[90px]">
                            {{ $item['original_price'] }}
                        </span>
                    </div>

                    {{-- RATING --}}
                    <div class="flex items-center gap-1.5">
                        <div class="flex gap-0.5">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg 
                                    class="w-4 h-4 {{ $i <= $item['rating'] ? 'text-[#ffad33]' : 'text-[#ffad33] opacity-25' }}"
                                    fill="currentColor" 
                                    viewBox="0 0 20 20"
                                >
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
