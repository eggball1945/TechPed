<div class="flex justify-center mt-20">
    <div class="w-[1170px] h-[500px] bg-black rounded-lg px-16 py-14 flex items-center justify-between">
        {{-- LEFT CONTENT --}}
        <div class="flex flex-col gap-8 max-w-[480px]">
            <span class="font-semibold text-[16px] text-violet-700">
                Kategori
            </span>
            <span class="font-semibold text-[48px] leading-[60px] text-neutral-50">
                Enhance Your Music Experience
            </span>

            {{-- COUNTDOWN --}}
            <div class="flex gap-6">
                @foreach ([
                    ['value' => '05', 'label' => 'Hari'],
                    ['value' => '23', 'label' => 'Jam'],
                    ['value' => '59', 'label' => 'Menit'],
                    ['value' => '35', 'label' => 'Detik'],
                ] as $time)
                    <div class="w-[62px] h-[62px] bg-white rounded-full flex flex-col items-center justify-center">
                        <span class="font-semibold text-[16px] text-black leading-none">
                            {{ $time['value'] }}
                        </span>
                        <span class="text-[11px] text-black leading-none">
                            {{ $time['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- BUTTON --}}
            <button class="w-fit bg-violet-700 px-12 py-4 rounded text-neutral-50 font-medium hover:bg-violet-800 transition">
                Belanja Sekarang
            </button>
        </div>

        {{-- RIGHT IMAGE --}}
        <div class="w-[600px] h-[420px] flex items-center justify-center relative">
            <div class="absolute w-[420px] h-[420px] bg-white/40 rounded-full blur-3xl"></div>
            <img src="{{ asset('images/produk/jbl.webp') }}" alt="Music Product" class="w-[568px] h-[330px] object-contain relative z-10">
        </div>
    </div>
</div>