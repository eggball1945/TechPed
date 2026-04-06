<div class="w-full px-4 py-20 bg-gradient-to-b from-white to-gray-50/50">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">

        {{-- Products Card --}}
        <div class="h-[250px] rounded-2xl border border-violet-100 bg-white p-8 flex flex-col items-center justify-center gap-6 text-center transition-all duration-500 hover:bg-violet-600 hover:border-transparent hover:-translate-y-3 hover:shadow-2xl hover:shadow-violet-200 group relative overflow-hidden opacity-0" style="animation: slideUp 0.8s ease-out forwards; animation-delay: 0.1s;">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-violet-50 rounded-full group-hover:bg-violet-500/20 transition-colors duration-500"></div>
            
            <div class="w-20 h-20 flex items-center justify-center rounded-2xl bg-violet-50 group-hover:bg-white/20 transition-all duration-500 transform group-hover:rotate-12">
                <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-violet-600 transition-colors duration-500 group-hover:bg-white">
                    <svg class="w-8 h-8 text-white group-hover:text-violet-600 transition-colors duration-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
            </div>

            <div class="flex flex-col gap-2 relative z-10">
                <span class="font-bold text-4xl text-gray-900 group-hover:text-white transition-colors duration-500">{{ $stats['products'] }}</span>
                <span class="text-sm font-medium uppercase tracking-wider text-gray-500 group-hover:text-violet-100 transition-colors duration-500">Pilihan Produk Terbaik</span>
            </div>
        </div>

        {{-- Monthly Sales Card --}}
        <div class="h-[250px] rounded-2xl border border-emerald-100 bg-white p-8 flex flex-col items-center justify-center gap-6 text-center transition-all duration-500 hover:bg-emerald-600 hover:border-transparent hover:-translate-y-3 hover:shadow-2xl hover:shadow-emerald-200 group relative overflow-hidden opacity-0" style="animation: slideUp 0.8s ease-out forwards; animation-delay: 0.2s;">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:bg-emerald-500/20 transition-colors duration-500"></div>

            <div class="w-20 h-20 flex items-center justify-center rounded-2xl bg-emerald-50 group-hover:bg-white/20 transition-all duration-500 transform group-hover:rotate-12">
                <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-emerald-600 transition-colors duration-500 group-hover:bg-white">
                    <svg class="w-8 h-8 text-white group-hover:text-emerald-600 transition-colors duration-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
            </div>

            <div class="flex flex-col gap-2 relative z-10">
                <span class="font-bold text-4xl text-gray-900 group-hover:text-white transition-colors duration-500">{{ $stats['monthly_sales'] }}</span>
                <span class="text-sm font-medium uppercase tracking-wider text-gray-500 group-hover:text-emerald-100 transition-colors duration-500">Transaksi Bulanan</span>
            </div>
        </div>

        {{-- Active Users Card --}}
        <div class="h-[250px] rounded-2xl border border-blue-100 bg-white p-8 flex flex-col items-center justify-center gap-6 text-center transition-all duration-500 hover:bg-blue-600 hover:border-transparent hover:-translate-y-3 hover:shadow-2xl hover:shadow-blue-200 group relative overflow-hidden opacity-0" style="animation: slideUp 0.8s ease-out forwards; animation-delay: 0.3s;">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:bg-blue-500/20 transition-colors duration-500"></div>

            <div class="w-20 h-20 flex items-center justify-center rounded-2xl bg-blue-50 group-hover:bg-white/20 transition-all duration-500 transform group-hover:rotate-12">
                <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-blue-600 transition-colors duration-500 group-hover:bg-white">
                    <svg class="w-8 h-8 text-white group-hover:text-blue-600 transition-colors duration-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
            </div>

            <div class="flex flex-col gap-2 relative z-10">
                <span class="font-bold text-4xl text-gray-900 group-hover:text-white transition-colors duration-500">{{ $stats['active_users'] }}</span>
                <span class="text-sm font-medium uppercase tracking-wider text-gray-500 group-hover:text-blue-100 transition-colors duration-500">Pelanggan Terdaftar</span>
            </div>
        </div>

        {{-- Annual Revenue Card --}}
        <div class="h-[250px] rounded-2xl border border-amber-100 bg-white p-8 flex flex-col items-center justify-center gap-6 text-center transition-all duration-500 hover:bg-amber-600 hover:border-transparent hover:-translate-y-3 hover:shadow-2xl hover:shadow-amber-200 group relative overflow-hidden opacity-0" style="animation: slideUp 0.8s ease-out forwards; animation-delay: 0.4s;">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full group-hover:bg-amber-500/20 transition-colors duration-500"></div>

            <div class="w-20 h-20 flex items-center justify-center rounded-2xl bg-amber-50 group-hover:bg-white/20 transition-all duration-500 transform group-hover:rotate-12">
                <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-amber-600 transition-colors duration-500 group-hover:bg-white">
                    <svg class="w-8 h-8 text-white group-hover:text-amber-600 transition-colors duration-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
            </div>

            <div class="flex flex-col gap-2 relative z-10">
                <span class="font-bold text-4xl text-gray-900 group-hover:text-white transition-colors duration-500">{{ $stats['annual_revenue'] }}</span>
                <span class="text-sm font-medium uppercase tracking-wider text-gray-500 group-hover:text-amber-100 transition-colors duration-500">Omzet Tahunan</span>
            </div>
        </div>

    </div>
</div>

<style>
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>