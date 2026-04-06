@extends('user.layouts.app')

@section('title', 'Privacy Policy - TechPed')

@section('content')
<div class="min-h-screen bg-gray-50/50 rounded pb-20">
    {{-- HERO SECTION --}}
    <div class="relative py-20 overflow-hidden bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-10 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in font-sans">
                <a href="{{ route('landing') }}" class="hover:text-violet-700 transition-colors">Beranda</a>
                <svg class="w-2.5 h-2.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                <span class="text-violet-700 truncate">Kebijakan Privasi</span>
            </nav>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-violet-50 text-violet-700 text-sm font-bold mb-6 animate-fade-in">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.744c0 5.562 3.82 10.29 9 11.622 5.18-1.332 9-6.06 9-11.622 0-1.31-.21-2.571-.598-3.744A11.959 11.959 0 0112 2.714z"></path></svg>
                Privasi Anda Prioritas Kami
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 tracking-tight animate-slide-up">
                Kebijakan <span class="text-transparent bg-clip-text bg-violet-700">Privasi</span>
            </h1>
            <p class="text-gray-500 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed animate-slide-up" style="animation-delay: 0.1s;">
                Terakhir diperbarui: 5 April 2026. Kami berkomitmen untuk melindungi informasi pribadi Anda dan hak privasi Anda.
            </p>
        </div>
    </div>

    {{-- CONTENT SECTION --}}
    <div class="max-w-5xl mx-auto px-6 -mt-10 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-8 rounded-4xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="w-14 h-14 bg-violet-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Informasi Kolektif</h2>
                <p class="text-gray-600 leading-relaxed">
                    Kami mengumpulkan informasi yang Anda berikan saat membuat akun, membeli produk, atau menghubungi layanan kami. Hal ini mencakup:
                </p>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-gray-50 text-gray-600 text-sm rounded-lg border border-gray-100">Nama Lengkap</span>
                    <span class="px-3 py-1 bg-gray-50 text-gray-600 text-sm rounded-lg border border-gray-100">Alamat Email</span>
                    <span class="px-3 py-1 bg-gray-50 text-gray-600 text-sm rounded-lg border border-gray-100">Nomor Telepon</span>
                    <span class="px-3 py-1 bg-gray-50 text-gray-600 text-sm rounded-lg border border-gray-100">Alamat Pengiriman</span>
                </div>
            </div>

            {{-- 2. Cara Kami Menggunakan Informasi --}}
            <div class="bg-white p-8 rounded-4xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="w-14 h-14 bg-fuchsia-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-fuchsia-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Pemanfaatan Data</h2>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-2 text-sm">
                        <svg class="w-5 h-5 text-fuchsia-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Memproses dan mengirimkan pesanan produk Anda.</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm">
                        <svg class="w-5 h-5 text-fuchsia-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Konfirmasi pesanan dan update pengiriman real-time.</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm">
                        <svg class="w-5 h-5 text-fuchsia-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Personalisasi pengalaman belanja Anda di TechPed.</span>
                    </li>
                </ul>
            </div>

            {{-- 3. Keamanan Data --}}
            <div class="bg-white p-8 rounded-4xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Protokol Keamanan</h2>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Keamanan Anda adalah prioritas mutlak. Kami menerapkan enkripsi SSL standar industri dan tembok api berlapis untuk melindungi data Anda dari akses yang tidak sah. Privasi Anda terlindungi 24/7.
                </p>
            </div>

            {{-- 4. Cookies --}}
            <div class="bg-white p-8 rounded-4xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Penggunaan Cookies</h2>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Kami menggunakan cookies untuk meningkatkan navigasi situs, menganalisis penggunaan situs secara anonim, dan memberikan rekomendasi produk yang lebih akurat.
                </p>
            </div>
        </div>

        {{-- Hubungi Kami --}}
        <div class="mt-12 bg-gradient-to-r from-violet-600 to-fuchsia-600 p-1 rounded-[2rem] animate-fade-in-up" style="animation-delay: 0.6s;">
            <div class="bg-white rounded-[1.8rem] p-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 mb-2">Punya Pertanyaan?</h2>
                    <p class="text-gray-500">Kami siap membantu menjawab keraguan Anda mengenai privasi data.</p>
                </div>
                <a href="mailto:lavviet20@gmail.com" class="px-8 py-4 bg-violet-700 text-white font-bold rounded-2xl hover:bg-violet-800 transition-all hover:scale-105 active:scale-95 shadow-lg shadow-violet-200 whitespace-nowrap text-center">
                    Hubungi Kami Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes slide-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fade-in 1s ease-out forwards; }
.animate-slide-up { animation: slide-up 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
.animate-fade-in-up { opacity: 0; animation: fade-in-up 0.8s ease-out forwards; }
</style>
@endsection
