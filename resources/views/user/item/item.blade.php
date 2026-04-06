<div id="hardware-promo-section" class="w-full flex justify-center mt-12 sm:mt-20 px-4 scroll-mt-32">
    <div class="w-full max-w-5xl bg-black rounded-3xl sm:rounded-[3rem] px-6 sm:px-12 lg:px-16 py-10 sm:py-16 flex flex-col md:flex-row items-center justify-between gap-10 overflow-hidden relative">
        {{-- Decorative Background --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-64 h-64 bg-violet-600/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-48 h-48 bg-indigo-500/20 rounded-full blur-[80px]"></div>

        {{-- LEFT CONTENT --}}
        <div class="flex flex-col gap-6 w-full md:w-1/2 text-center md:text-left relative z-10">
            <div class="flex items-center justify-center md:justify-start gap-2">
                <span class="w-2 h-2 rounded-full bg-violet-600 animate-pulse"></span>
                <span class="font-bold text-xs uppercase tracking-[0.2em] text-violet-500">
                    Promo Terbatas
                </span>
            </div>
            <h2 class="font-black text-3xl sm:text-4xl lg:text-5xl leading-[1.1] text-white">
                Upgrade <span class="text-violet-500">Hardware</span> Terbaikmu
            </h2>
            <p class="text-gray-400 text-sm sm:text-base leading-relaxed max-w-md mx-auto md:mx-0">
                Dapatkan performa maksimal dengan pilihan komponen berkualitas tinggi yang kami kurasi khusus untuk Anda.
            </p>

            {{-- COUNTDOWN --}}
            <div class="flex justify-center md:justify-start gap-3 sm:gap-4" id="countdown">
                @foreach (['Hari' => 'days', 'Jam' => 'hours', 'Menit' => 'minutes', 'Detik' => 'seconds'] as $label => $unit)
                    <div class="flex flex-col items-center gap-1">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl flex items-center justify-center shadow-xl">
                            <span class="font-black text-xl sm:text-2xl text-white tracking-tighter" id="{{ $unit }}">00</span>
                        </div>
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-widest text-gray-500">{{ $label }}</span>
                    </div>
                @endforeach
            </div>

            {{-- BUTTON --}}
            <div class="mt-4">
                @if(isset($hardwareProduct) && $hardwareProduct)
                    <a href="{{ route('user.products', ['category' => 'Hardware']) }}" 
                    id="promo-button"
                    class="inline-flex items-center gap-3 bg-violet-700 hover:bg-violet-800 px-8 py-4 rounded-2xl text-white font-bold transition-all duration-300 shadow-xl shadow-violet-900/20 hover:shadow-violet-900/40 hover:-translate-y-1">
                        Belanja Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                @else
                    <button disabled class="bg-gray-800 px-8 py-4 rounded-2xl text-gray-500 font-bold cursor-not-allowed">
                        Stok Habis
                    </button>
                @endif
            </div>
        </div>

        {{-- RIGHT IMAGE --}}
        <div class="w-full md:w-1/2 flex items-center justify-center relative">
            <div class="absolute inset-0 bg-violet-600/20 rounded-full blur-[120px] scale-75 animate-pulse"></div>
            <img src="{{ asset('images/produk/hardware.png') }}" alt="Hardware Product" 
                 class="w-full max-w-[320px] sm:max-w-[450px] lg:max-w-[550px] h-auto object-contain relative z-10 drop-shadow-[0_20px_50px_rgba(109,40,217,0.3)] transition-transform duration-700 hover:scale-105">
        </div>
    </div>
</div>

<script>
    // Tanggal akhir promo yang dikirim dari server (format: Y-m-d H:i:s)
    const promoEndDate = new Date('{{ $promoEndDate ?? now()->addDays(3)->format("Y-m-d H:i:s") }}').getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = promoEndDate - now;

        if (distance < 0) {
            // Promo berakhir
            document.getElementById('days').innerText = '00';
            document.getElementById('hours').innerText = '00';
            document.getElementById('minutes').innerText = '00';
            document.getElementById('seconds').innerText = '00';

            // Nonaktifkan tombol (opsional)
            const btn = document.getElementById('promo-button');
            if (btn) {
                btn.classList.remove('bg-violet-700', 'hover:bg-violet-800');
                btn.classList.add('bg-gray-500', 'cursor-not-allowed');
                btn.href = 'javascript:void(0)'; // matikan link
                btn.innerText = 'Promo Berakhir';
            }
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('days').innerText = days.toString().padStart(2, '0');
        document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
        document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
</script>