{{-- BREADCRUMB --}}
<div class="flex justify-center mb-10">
    <div class="w-full max-w-[1140px] px-6">
        <div class="flex items-center gap-3 text-sm">
            <a href="/landing" class="text-black/50 hover:text-violet-700 transition">
                Home
            </a>
            <span class="text-black/30">/</span>
            <span class="text-black font-medium">
                Tentang
            </span>
        </div>
    </div>
</div>

<div class="flex items-center gap-[75px]">
    {{-- TEKS --}}
    <div class="flex flex-col gap-10 max-w-[690px] pl-6 lg:pl-[80px]">
        <span class="font-semibold text-[54px] leading-[64px] text-justify text-black">
            Kisah Kami
        </span>
        <div class="flex flex-col gap-6">
            <span class="font-normal text-[16px] leading-[26px] text-black">
                Diluncurkan pada tahun 2025, TechPed adalah pasar belanja online terkemuka di Indonesia
                dengan kehadiran aktif di seluruh negeri. Didukung oleh berbagai solusi pemasaran, data,
                dan layanan yang disesuaikan, TechPed bermitra dengan 1.500 penjual dan 100 merek serta
                melayani 12.000 pelanggan di seluruh negeri.
            </span>
            <span class="font-normal text-[16px] leading-[26px] text-black">
                TechPed memiliki lebih dari 2000 produk untuk ditawarkan, dan terus berkembang dengan
                sangat pesat. Exclusive menawarkan beragam pilihan dalam berbagai kategori, mulai dari
                produk konsumen.
            </span>
        </div>
    </div>

    {{-- IMG --}}
    <div class="flex-shrink-0 ml-auto max-w-full">
        <img src="{{ asset('images/tentang.webp') }}" alt="Tentang TechPed" class="transition-all duration-300 ease-out max-w-[260px] sm:max-w-[360px] md:max-w-[480px] lg:max-w-[600px] xl:max-w-[690px] h-auto object-contain">
    </div>
</div>