<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
    {{-- BREADCRUMB --}}
    <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-10 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in font-sans">
        <a href="{{ route('landing') }}" class="hover:text-violet-700 transition-colors">Beranda</a>
        <svg class="w-2.5 h-2.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
        <span class="text-violet-700 truncate">Tentang TechPed</span>
    </nav>

    <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
        {{-- TEKS --}}
        <div class="flex-1 space-y-8 opacity-0" style="animation: slideInLeft 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
            <div class="inline-flex items-center justify-center sm:justify-start gap-3">
                <div class="w-10 h-1 bg-violet-700 rounded-full"></div>
                <span class="font-bold text-sm uppercase tracking-[0.2em] text-violet-700">Sejarah Kami</span>
            </div>
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-black text-gray-900 tracking-tight leading-tight">
                Membangun Ekosistem <br class="hidden lg:block"/>
                <span class="text-violet-700">Teknologi</span>
            </h1>
            <div class="space-y-6 text-gray-600 leading-relaxed text-lg text-justify sm:text-left">
                <p>
                    Diluncurkan pada tahun 2025, TechPed adalah pasar belanja online terkemuka di Indonesia
                    dengan kehadiran aktif di seluruh negeri. Didukung oleh berbagai solusi pemasaran, data,
                    dan layanan yang disesuaikan, TechPed menawarkan <strong class="text-violet-700 font-bold bg-violet-50 px-2 py-0.5 rounded">{{ $stats['products'] ?? 'Beragam' }}</strong> pilihan produk terbaik
                    serta melayani <strong class="text-violet-700 font-bold bg-violet-50 px-2 py-0.5 rounded">{{ $stats['active_users'] ?? 'Banyak' }}</strong> pelanggan aktif.
                </p>
                <p>
                    TechPed memiliki beragam produk untuk ditawarkan, dan terus berkembang dengan
                    sangat pesat. Kami menawarkan pilihan berkualitas tinggi dalam berbagai kategori, mulai dari
                    komponen PC, laptop, hingga kebutuhan gaming dengan garansi resmi.
                </p>
            </div>
        </div>

        {{-- IMG --}}
        <div class="flex-1 w-full flex justify-center lg:justify-end opacity-0" style="animation: slideInRight 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; animation-delay: 0.2s;">
            <div class="relative group">
                <div class="absolute -inset-4 bg-gradient-to-r from-violet-600/20 to-fuchsia-600/20 rounded-full blur-3xl group-hover:from-violet-600/30 group-hover:to-fuchsia-600/30 transition duration-700"></div>
                <img src="{{ asset('images/tentang.png') }}" alt="Tentang TechPed" class="relative w-full max-w-[300px] sm:max-w-[400px] lg:max-w-[500px] xl:max-w-[600px] h-auto object-contain drop-shadow-2xl hover:-translate-y-2 hover:scale-105 transition-all duration-700 ease-out">
            </div>
        </div>
    </div>
</div>

<style>
@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-40px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes slideInRight {
    from { opacity: 0; transform: translateX(40px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>