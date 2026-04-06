@php
    $promos = [
        [
            'image' => asset('images/produk/pc-work-gaming.webp'),
            'subtitle' => 'PERFORMA ULTRA',
            'title' => 'PC Kerja & Gaming',
            'discount' => 'Diskon 10% Khusus Hari Ini',
        ],
    ];
@endphp

<div class="w-full flex justify-center py-10 px-4 md:px-6">
    @foreach ($promos as $promo)
        <div class="max-w-5xl w-full md:min-h-[320px] bg-black rounded-[2rem] overflow-hidden flex flex-col md:flex-row items-center justify-between p-6 md:p-10 gap-8 relative group hover:shadow-2xl hover:shadow-violet-200/20 transition-all duration-700 border border-white/5">            
            <div class="flex flex-col gap-4 text-center md:text-left relative z-20 flex-1">
                <div class="flex flex-col gap-1.5">
                    <span class="font-black text-[10px] md:text-xs text-violet-400 tracking-[0.3em] uppercase animate-fade-in">
                        {{ $promo['subtitle'] }}
                    </span>
                    <h2 class="font-black text-3xl md:text-4xl lg:text-5xl text-white leading-tight tracking-tighter animate-fade-in-up">
                        {{ $promo['title'] }}
                    </h2>
                    <p class="text-violet-200/70 font-bold text-xs md:text-base animate-fade-in-up" style="animation-delay: 100ms">
                        {{ $promo['discount'] }}
                    </p>
                </div>

                <div class="flex justify-center md:justify-start items-center gap-6 mt-4 animate-fade-in-up" style="animation-delay: 200ms">
                    @isset($pcProduct)
                        <a href="{{ route('user.products.show', $pcProduct->id) }}" class="group relative inline-flex items-center gap-3 bg-white text-violet-900 font-black px-8 py-4 rounded-2xl transition-all duration-300 hover:bg-violet-50 hover:shadow-xl active:scale-95 overflow-hidden">
                            <span class="relative z-10 text-sm uppercase tracking-widest leading-none">Belanja Sekarang</span>
                            <svg class="w-5 h-5 relative z-10 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        </a>
                    @else
                        <button disabled class="bg-white/10 backdrop-blur-md text-white/40 border border-white/10 px-8 py-4 rounded-2xl cursor-not-allowed font-black text-sm uppercase tracking-widest">
                            Segera Hadir
                        </button>
                    @endisset
                </div>
            </div>

            <div class="relative flex items-center justify-center w-full md:w-[400px] lg:w-[500px] animate-fade-in-right">
                <div class="absolute inset-0 bg-white/5 rounded-full blur-[80px] scale-110 group-hover:bg-white/10 transition-colors"></div>
                
                <div class="relative z-10 transform group-hover:scale-105 group-hover:-rotate-2 transition-all duration-700">
                    <img src="{{ $promo['image'] }}" alt="{{ $promo['title'] }}" 
                        class="w-full h-auto max-h-[300px] md:max-h-[450px] object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                </div>
            </div>
            
            <div class="absolute bottom-6 right-16 hidden lg:flex items-center gap-6 opacity-30 group-hover:opacity-100 transition-opacity">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                    <span class="text-[10px] font-black text-white uppercase tracking-widest">Gratis Ongkir</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-amber-400"></div>
                    <span class="text-[10px] font-black text-white uppercase tracking-widest">Kualitas Premium</span>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in-right {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-fade-in-up { animation: fade-in-up 1s ease-out both; }
    .animate-fade-in-right { animation: fade-in-right 1s ease-out both; }
    .animate-fade-in { animation: fade-in 1.2s ease-out both; }
</style>