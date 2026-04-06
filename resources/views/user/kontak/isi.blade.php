<div class="min-h-screen pb-20 bg-gray-50/50">
    
    {{-- BREADCRUMB --}}
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-10 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in font-sans">
            <a href="{{ route('landing') }}" class="hover:text-violet-700 transition-colors">Beranda</a>
            <svg class="w-2.5 h-2.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
            <span class="text-violet-700 truncate">Kontak</span>
        </nav>
    </div>

    {{-- HERO SECTION --}}
    <div class="relative py-20 overflow-hidden mb-12">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full pointer-events-none">
            <div
                class="absolute top-[-10%] right-[-5%] w-[400px] h-[400px] bg-violet-50 rounded-full blur-3xl opacity-50">
            </div>
            <div
                class="absolute bottom-[-10%] left-[-5%] w-[300px] h-[300px] bg-fuchsia-50 rounded-full blur-3xl opacity-50">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-violet-50 text-violet-700 text-sm font-bold mb-6 animate-fade-in">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
                Terhubung dengan TechPed
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 tracking-tight animate-slide-up">
                Hubungi <span class="text-transparent bg-clip-text bg-violet-700">Kami</span>
            </h1>
            <p class="text-gray-500 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed animate-slide-up"
                style="animation-delay: 0.1s;">
                Punya pertanyaan atau butuh bantuan teknis? Tim kami siap merespons pesan Anda dalam waktu kurang dari
                24 jam.
            </p>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row gap-12 items-stretch">
        {{-- SIDEBAR: CONTACT INFO --}}
        <div class="w-full lg:w-[380px] space-y-6 animate-slide-up" style="animation-delay: 0.3s;">
            {{-- Info Card 1 --}}
            <div
                class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group">
                <div
                    class="w-14 h-14 bg-violet-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Hubungi Kami</h3>
                <p class="text-gray-500 text-sm mb-6">Kami tersedia 24 jam sehari, 7 hari seminggu untuk menjawab
                    panggilan Anda.</p>
                <div class="space-y-3">
                    <div
                        class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 group-hover:bg-violet-50 group-hover:border-violet-100 transition-colors">
                        <span class="font-bold text-violet-700">+8801611112222</span>
                    </div>
                </div>
            </div>

            {{-- Info Card 2 --}}
            <div
                class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group">
                <div
                    class="w-14 h-14 bg-fuchsia-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Pesan Untuk Kami</h3>
                <p class="text-gray-500 text-sm mb-6">Tulis pertanyaan Anda dan tim ahli kami akan membalas via email
                    segera.</p>
                <div class="space-y-3">
                    <div
                        class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 group-hover:bg-fuchsia-50 group-hover:border-fuchsia-100 transition-colors">
                        <span class="text-sm font-medium text-violet-700">customer@techped.com</span>
                    </div>
                    <div
                        class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 group-hover:bg-fuchsia-50 group-hover:border-fuchsia-100 transition-colors">
                        <span class="text-sm font-medium text-violet-700">support@techped.com</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM SECTION --}}
        <div class="flex-1 bg-white rounded-[2rem] p-8 md:p-12 shadow-xl shadow-gray-200/50 border border-gray-100 animate-slide-up"
            style="animation-delay: 0.4s;">
            {{-- SUCCESS NOTIFICATION (Already implemented in previous version) --}}
            @if (session('success'))
                <div
                    class="mb-10 w-full bg-emerald-50 border border-emerald-200 rounded-3xl p-8 flex flex-col sm:flex-row items-center sm:items-start gap-6 relative overflow-hidden animate-fade-in-up">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-400/10 rounded-full -mr-16 -mt-16 blur-2xl">
                    </div>
                    <div
                        class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-emerald-200 transform rotate-3">
                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1 text-center sm:text-left">
                        <h3 class="font-bold text-emerald-900 text-xl mb-1">Terima Kasih!</h3>
                        <p class="text-emerald-800 leading-relaxed">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()"
                        class="absolute top-4 right-4 text-emerald-400 hover:text-emerald-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pesan Terkirim!',
                            text: "{{ session('success') }}",
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            iconColor: '#10b981',
                            customClass: {
                                popup: 'rounded-3xl border-none shadow-2xl'
                            }
                        });
                    });
                </script>
            @endif

            <form action="{{ route('kontak.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                            placeholder="Masukkan nama Anda"
                            class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl outline-none focus:bg-white focus:ring-2 focus:ring-violet-600/20 focus:border-violet-600 transition-all @error('name') border-red-500 @enderror">
                        @error('name')
                            <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 ml-1">Email Aktif</label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                            placeholder="Contoh: user@gmail.com"
                            class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl outline-none focus:bg-white focus:ring-2 focus:ring-violet-600/20 focus:border-violet-600 transition-all @error('email') border-red-500 @enderror">
                        @error('email')
                            <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Nomor Telepon/WhatsApp</label>
                    <input type="tel" name="phone" required value="{{ old('phone') }}"
                        placeholder="Contoh: 08123456789"
                        class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl outline-none focus:bg-white focus:ring-2 focus:ring-violet-600/20 focus:border-violet-600 transition-all @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Isi Pesan</label>
                    <textarea name="message" required rows="5" placeholder="Tuliskan pesan atau pertanyaan Anda di sini..."
                        class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl outline-none focus:bg-white focus:ring-2 focus:ring-violet-600/20 focus:border-violet-600 transition-all resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <p class="text-xs text-gray-400 italic max-w-sm">
                        * Kami menjamin kerahasiaan data pribadi Anda sesuai dengan kebijakan privasi kami.
                    </p>
                    <button type="submit"
                        class="w-full sm:w-auto px-12 py-4 bg-violet-700 text-white font-bold rounded-2xl hover:bg-violet-800 transition-all hover:scale-105 active:scale-95 shadow-lg shadow-violet-200">
                        Kirim Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 1s ease-out forwards;
    }

    .animate-slide-up {
        opacity: 0;
        animation: slide-up 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
</style>
