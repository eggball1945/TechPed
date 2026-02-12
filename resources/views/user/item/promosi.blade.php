@php
    $promos = [
        [
            'image' => asset('images/produk/pc-work-gaming.webp'),
            'subtitle' => 'PC For Work And Gaming',
            'title' => 'Up to 10% off Voucher',
        ],
    ];
@endphp

<div class="w-full flex justify-center py-8">
    @foreach ($promos as $promo)
        <div class="w-[892px] h-[344px] bg-black rounded-lg overflow-hidden flex items-center px-12 gap-12">
            {{-- IMAGE --}}
            <div class="relative flex items-center justify-center w-[300px]">
                <div class="absolute w-[180px] h-[260px] bg-white/30 rounded-full blur-3xl"></div>
                <img src="{{ $promo['image'] }}" alt="{{ $promo['subtitle'] }}" class="w-[280px] h-auto object-contain relative z-10">
            </div>

            <div class="flex flex-col gap-4 text-left">
                <span class="font-normal text-base text-neutral-300">
                    {{ $promo['subtitle'] }}
                </span>
                <span class="font-semibold text-[42px] leading-[52px] text-white">
                    {{ $promo['title'] }}
                </span>
                <a href="#" class="group w-fit inline-block">
                    <span class="font-medium text-base text-white">
                        Belanja Sekarang
                    </span>
                    <div class="w-[142px] h-[2px] bg-white mt-1 scale-x-0 origin-left transition-transform duration-300 ease-out group-hover:scale-x-100"></div>
                </a>
            </div>
        </div>
    @endforeach
</div>