<div class="container mx-auto px-6 py-16">
    {{-- HEADER --}}
    <div class="flex flex-col gap-5 mb-10">
        <div class="flex items-center gap-4">
            <div class="w-5 h-10 bg-violet-700 rounded-md"></div>
            <span class="font-semibold text-base text-violet-700">
                Unggulan
            </span>
        </div>
        <h2 class="font-semibold text-4xl leading-tight text-black">
            Produk Baru Kami
        </h2>
    </div>

    {{-- LIST PRODUK --}}
    <div class="flex gap-[60px]">
        {{-- PRODUK BESAR --}}
        <div class="w-[570px] h-[600px] bg-black rounded p-6 relative overflow-hidden">
            <img src="{{ asset('images/produk/tuf.webp') }}" class="w-full h-full object-contain scale-110"
                alt="ASUS TUF A15" />

            <div class="absolute bottom-6 left-6 flex flex-col gap-4 max-w-[260px]">
                <span class="font-semibold text-[24px] text-white">
                    ASUS TUF A15
                </span>
                <span class="font-normal text-[14px] leading-[21px] text-white opacity-80">
                    Bodi tangguh, garis tegas futuristik, dan tampilan gaming yang profesional.
                </span>
                <a href="#" class="group w-fit inline-block">
                    <span class="font-medium text-base text-white">
                        Belanja Sekarang
                    </span>
                    <div
                        class="w-[142px] h-[2px] bg-white mt-1 scale-x-0 origin-left transition-transform duration-300 ease-out group-hover:scale-x-100">
                    </div>
                </a>
            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div class="flex flex-col gap-8">
            {{-- CPU COOLER --}}
            <div class="w-[570px] h-[284px] bg-[#0d0d0d] rounded p-6 flex justify-between items-center">
                <div class="flex flex-col gap-6 max-w-[260px]">
                    <div class="flex flex-col gap-3">
                        <span class="font-semibold text-[24px] text-neutral-50">
                            CPU Cooler
                        </span>
                        <span class="font-normal text-[14px] text-neutral-50 opacity-80">
                            CPU Cooler dengan performa tinggi dan RGB
                        </span>
                    </div>
                    <a href="#" class="group w-fit inline-block">
                        <span class="font-medium text-base text-white">
                            Belanja Sekarang
                        </span>
                        <div
                            class="w-[142px] h-[2px] bg-white mt-1 scale-x-0 origin-left transition-transform duration-300 ease-out group-hover:scale-x-100">
                        </div>
                    </a>
                </div>
                <img src="/image/cooler.png" class="w-[220px] h-[220px] object-contain" alt="CPU Cooler" />
            </div>

            {{-- SPEAKER & RAM --}}
            <div class="flex gap-[30px]">
                {{-- SPEAKER --}}
                <div class="w-[270px] h-[284px] bg-black rounded p-6 flex flex-col justify-between">
                    <img src="/image/speaker.png" class="w-full h-[140px] object-contain" alt="Speaker" />
                    <div class="flex flex-col gap-3">
                        <span class="font-semibold text-[20px] text-neutral-50">
                            Speakers
                        </span>
                        <span class="font-normal text-[14px] text-neutral-50 opacity-80">
                            Amazon wireless speakers
                        </span>
                        <a href="#" class="group w-fit inline-block">
                            <span class="font-medium text-base text-white">
                                Belanja Sekarang
                            </span>
                            <div
                                class="w-[142px] h-[2px] bg-white mt-1 scale-x-0 origin-left transition-transform duration-300 ease-out group-hover:scale-x-100">
                            </div>
                        </a>
                    </div>
                </div>

                {{-- RAM --}}
                <div class="w-[270px] h-[284px] bg-black rounded p-6 flex flex-col justify-between">
                    <img src="/image/ram.png" class="w-full h-[140px] object-contain" alt="RAM TridentZ" />
                    <div class="flex flex-col gap-3">
                        <span class="font-semibold text-[20px] text-neutral-50">
                            RAM TridentZ
                        </span>
                        <span class="font-normal text-[14px] text-neutral-50 opacity-80">
                            RAM Super Cepat dengan RGB
                        </span>
                        <a href="#" class="group w-fit inline-block">
                            <span class="font-medium text-base text-white">
                                Belanja Sekarang
                            </span>
                            <div
                                class="w-[142px] h-[2px] bg-white mt-1 scale-x-0 origin-left transition-transform duration-300 ease-out group-hover:scale-x-100">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
