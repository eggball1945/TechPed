@extends('user.layouts.app')

@section('title', 'Terms of Use - TechPed')

@section('content')
<div class="min-h-screen rounded pb-20">
    {{-- HERO SECTION --}}
    <div class="relative py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-10 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in font-sans">
                <a href="{{ route('landing') }}" class="hover:text-violet-700 transition-colors">Beranda</a>
                <svg class="w-2.5 h-2.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                <span class="text-violet-700 truncate">Ketentuan Layanan</span>
            </nav>
        </div>

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full pointer-events-none">
            <div class="absolute top-[-10%] left-[-5%] w-[400px] h-[400px] bg-violet-50 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-[-10%] right-[-5%] w-[300px] h-[300px] bg-fuchsia-50 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-violet-50 text-violet-700 text-sm font-bold mb-6 animate-fade-in">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Kesepakatan Layanan Pengguna
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 tracking-tight animate-slide-up">
                Ketentuan <span class="text-transparent bg-clip-text bg-violet-700">Penggunaan</span>
            </h1>
            <p class="text-gray-500 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed animate-slide-up" style="animation-delay: 0.1s;">
                Terakhir diperbarui: 5 April 2026. Mohon baca ketentuan ini dengan seksama sebelum menggunakan layanan TechPed.
            </p>
        </div>
    </div>

    {{-- CONTENT SECTION --}}
    <div class="max-w-5xl mx-auto px-6 -mt-10 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- 1. Penerimaan Ketentuan --}}
            <div class="bg-white p-8 rounded-4xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="w-14 h-14 bg-violet-50 rounded-4xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Persetujuan Layanan</h2>
                <p class="text-gray-600 leading-relaxed">
                    Dengan mengakses atau menggunakan platform TechPed, Anda secara otomatis menyetujui untuk terikat oleh syarat dan ketentuan ini. Jika Anda berkeberatan, harap segera menghentikan penggunaan layanan kami.
                </p>
            </div>

            {{-- 2. Akun Pengguna --}}
            <div class="bg-white p-8 rounded-4xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="w-14 h-14 bg-fuchsia-50 rounded-4xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-fuchsia-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.744c0 5.562 3.82 10.29 9 11.622 5.18-1.332 9-6.06 9-11.622 0-1.31-.21-2.571-.598-3.744A11.959 11.959 0 0112 2.714z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Keamanan Akun</h2>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Anda bertanggung jawab penuh atas kerahasiaan kata sandi dan aktivitas akun Anda. Harap segera laporkan jika terdapat indikasi penyalahgunaan akun pihak ketiga demi keamanan bersama.
                </p>
            </div>

            {{-- 3. Kekayaan Intelektual --}}
            <div class="bg-white p-8 rounded-4xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="w-14 h-14 bg-indigo-50 rounded-4xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Hak Cipta & Brand</h2>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Seluruh konten, gambar, logo, dan kode sumber adalah hak milik eksklusif TechPed. Penggunaan materi tanpa izin tertulis merupakan pelanggaran hukum hak cipta yang serius.
                </p>
            </div>

            {{-- 4. Batasan Tanggung Jawab --}}
            <div class="bg-white p-8 rounded-4xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group animate-fade-in-up" style="animation-delay: 0.5s;">
                <div id="successModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-130 hidden transition-all duration-300 opacity-0">
                    <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Batasan Risiko</h2>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Kami berupaya menyajikan layanan terbaik, namun TechPed tidak bertanggung jawab atas kerugian tidak langsung yang timbul dari gangguan teknis atau penggunaan platform di luar kendali kami.
                </p>
            </div>

             {{-- 5. Perubahan Ketentuan --}}
             <div class="md:col-span-2 bg-white p-8 rounded-4xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-16 h-16 bg-emerald-50 rounded-4xl flex items-center justify-center shrink-0 group-hover:rotate-12 transition-transform duration-500">
                        <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">5. Fleksibilitas Pembaruan</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Kami berhak mengubah Ketentuan Penggunaan ini kapan saja demi meningkatkan kualitas layanan. Pembaruan akan berlaku efektif segera setelah kami publikasikan di halaman ini. Mari tetap pantau halaman ini secara berkala.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hubungi Kami --}}
        <div class="mt-12 bg-linear-to-r from-violet-600 to-fuchsia-600 p-1 rounded-4xl animate-fade-in-up" style="animation-delay: 0.7s;">
            <div class="bg-white rounded-4xl p-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 mb-2">Butuh Bantuan?</h2>
                    <p class="text-gray-500">Tim kami siap membantu menjawab pertanyaan mengenai syarat dan layanan kami.</p>
                </div>
                <a href="mailto:lavviet20@gmail.com" class="px-8 py-4 bg-violet-700 text-white font-bold rounded-2xl hover:bg-violet-800 transition-all hover:scale-105 active:scale-95 shadow-lg shadow-violet-200 whitespace-nowrap text-center">
                    Hubungi Dukungan
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
