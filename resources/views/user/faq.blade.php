@extends('user.layouts.app')

@section('title', 'Frequently Asked Questions - TechPed')

@section('content')
<div class="min-h-screen bg-gray-50/50 pb-20">
    {{-- HERO SECTION --}}
    <div class="relative py-20 overflow-hidden bg-white border-b border-gray-100">
        {{-- Background Decoration --}}
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-10 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in font-sans">
                <a href="{{ route('landing') }}" class="hover:text-violet-700 transition-colors">Beranda</a>
                <svg class="w-2.5 h-2.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                <span class="text-violet-700 truncate">Pusat Bantuan</span>
            </nav>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-violet-50 text-violet-700 text-sm font-bold mb-6 animate-fade-in">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Pusat Bantuan TechPed
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 tracking-tight animate-slide-up">
                Frequently Asked <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-700 to-fuchsia-600">Questions</span>
            </h1>
            <p class="text-gray-500 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed animate-slide-up" style="animation-delay: 0.1s;">
                Temukan jawaban cepat untuk pertanyaan yang sering diajukan mengenai layanan kami.
            </p>
            
            {{-- <div class="mt-10 max-w-xl mx-auto relative animate-slide-up" style="animation-delay: 0.2s;">
                <input type="text" placeholder="Cari pertanyaan Anda..." class="w-full px-6 py-4 bg-white border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition-all pl-14 outline-none">
                <svg class="w-6 h-6 text-gray-400 absolute left-5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div> --}}
        </div>
    </div>

    {{-- FAQ ACCORDION SECTION --}}
    <div class="max-w-4xl mx-auto px-6 mt-12 space-y-4">
        {{-- KATEGORI: PEMESANAN --}}
        <div class="pt-8 mb-4">
            <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                <span class="w-8 h-8 bg-violet-100 text-violet-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </span>
                Pemesanan & Produk
            </h2>
        </div>

        <div class="space-y-4">
            {{-- Q1 --}}
            <div class="faq-item group bg-white border border-gray-100 rounded-4xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 animate-slide-up" style="animation-delay: 0.3s;">
                <button class="faq-button w-full px-8 py-6 text-left flex items-center justify-between gap-4 outline-none">
                    <span class="font-bold text-gray-900 group-hover:text-violet-700 transition-colors">Bagaimana cara memesan di TechPed?</span>
                    <svg class="faq-icon w-5 h-5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-content overflow-hidden max-h-0 transition-all duration-500">
                    <div class="px-8 pb-6 text-gray-600 leading-relaxed">
                        Anda dapat memesan dengan memilih produk yang Anda inginkan, menambahkannya ke keranjang, dan mengikuti proses checkout yang tersedia. Pastikan alamat pengiriman sudah sesuai sebelum melakukan konfirmasi pesanan.
                    </div>
                </div>
            </div>

            {{-- Q2 --}}
            <div class="faq-item group bg-white border border-gray-100 rounded-4xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 animate-slide-up" style="animation-delay: 0.4s;">
                <button class="faq-button w-full px-8 py-6 text-left flex items-center justify-between gap-4 outline-none">
                    <span class="font-bold text-gray-900 group-hover:text-violet-700 transition-colors">Apakah produk di TechPed bergaransi resmi?</span>
                    <svg class="faq-icon w-5 h-5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-content overflow-hidden max-h-0 transition-all duration-500">
                    <div class="px-8 pb-6 text-gray-600 leading-relaxed">
                        Tentu saja. Semua produk yang kami jual di TechPed dijamin keasliannya dan menyertakan garansi resmi dari distributor atau produsen masing-masing. Informasi garansi dapat Anda lihat pada detail setiap produk.
                    </div>
                </div>
            </div>
        </div>

        {{-- KATEGORI: PEMBAYARAN & PENGIRIMAN --}}
        <div class="pt-12 mb-4">
            <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                <span class="w-8 h-8 bg-fuchsia-100 text-fuchsia-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </span>
                Pembayaran & Pengiriman
            </h2>
        </div>

        <div class="space-y-4">
            {{-- Q3 --}}
            <div class="faq-item group bg-white border border-gray-100 rounded-4xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 animate-slide-up" style="animation-delay: 0.5s;">
                <button class="faq-button w-full px-8 py-6 text-left flex items-center justify-between gap-4 outline-none">
                    <span class="font-bold text-gray-900 group-hover:text-violet-700 transition-colors">Metode pembayaran apa saja yang diterima?</span>
                    <svg class="faq-icon w-5 h-5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-content overflow-hidden max-h-0 transition-all duration-500">
                    <div class="px-8 pb-6 text-gray-600 leading-relaxed">
                        Kami menerima berbagai metode pembayaran termasuk transfer bank (Mandiri, BCA, BNI), dompet digital (OVO, GoPay, Dana), serta kartu kredit/debit berlogo Visa dan Mastercard.
                    </div>
                </div>
            </div>

            {{-- Q4 --}}
            <div class="faq-item group bg-white border border-gray-100 rounded-4xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 animate-slide-up" style="animation-delay: 0.6s;">
                <button class="faq-button w-full px-8 py-6 text-left flex items-center justify-between gap-4 outline-none">
                    <span class="font-bold text-gray-900 group-hover:text-violet-700 transition-colors">Berapa lama waktu pengiriman?</span>
                    <svg class="faq-icon w-5 h-5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-content overflow-hidden max-h-0 transition-all duration-500">
                    <div class="px-8 pb-6 text-gray-600 leading-relaxed">
                        Waktu pengiriman tergantung pada lokasi Anda. Biasanya membutuhkan waktu antara 2 hingga 5 hari kerja. Untuk wilayah Jabodetabek, kami menyediakan opsi pengiriman satu hari sampai (Express Delivery).
                    </div>
                </div>
            </div>
        </div>

        {{-- BANTUAN LANJUTAN --}}
        <div class="mt-16 bg-white p-10 rounded-4xl border-2 border-dashed border-violet-100 text-center animate-fade-in" style="animation-delay: 0.7s;">
            <div class="w-20 h-20 bg-violet-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            </div>
            <h3 class="text-2xl font-black text-gray-900 mb-4">Masih Butuh Bantuan?</h3>
            <p class="text-gray-500 mb-8 max-w-lg mx-auto">Tim dukungan pelanggan kami siap menjawab pertanyaan teknis Anda selama hari kerja 09:00 - 17:00.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-center">
                <a href="mailto:lavviet20@gmail.com" class="px-8 py-4 bg-violet-700 text-white font-bold rounded-2xl hover:bg-violet-800 transition-all hover:scale-105 active:scale-95 shadow-lg shadow-violet-200 whitespace-nowrap text-center">
                    Hubungi Dukungan
                </a>
                <a href="{{ route('kontak') }}" class="px-8 py-4 bg-white text-violet-700 border-2 border-violet-700 font-bold rounded-2xl hover:bg-violet-50 transition-all hover:scale-105 active:scale-95 whitespace-nowrap text-center">
                    Halaman Kontak
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqButtons = document.querySelectorAll('.faq-button');
    
    faqButtons.forEach(button => {
        button.addEventListener('click', () => {
            const item = button.parentElement;
            const content = item.querySelector('.faq-content');
            const icon = item.querySelector('.faq-icon');
            const isOpen = !content.style.maxHeight || content.style.maxHeight === '0px';

            // Close other items
            document.querySelectorAll('.faq-content').forEach(c => {
                c.style.maxHeight = '0px';
                c.parentElement.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
                c.parentElement.classList.remove('bg-violet-50/50');
            });

            if (isOpen) {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
                item.classList.add('bg-violet-50/50');
            }
        });
    });
});
</script>

<style>
@keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
@keyframes slide-up { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
.animate-fade-in { animation: fade-in 1s ease-out forwards; }
.animate-slide-up { opacity: 0; animation: slide-up 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

/* Custom Accordion Logic Helper */
.faq-content {
    transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
@endsection
