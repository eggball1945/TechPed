<footer class="w-full bg-gray-50 mt-20 transition-all duration-500 footer-fullscreen shadow-[0_-4px_6px_-2px_rgba(0,0,0,0.05)]">
    {{-- Top gradient border --}}
    <div class="h-1 w-full bg-gradient-to-r from-violet-200 via-violet-500 to-violet-200"></div>

    <div class="max-w-[1440px] mx-auto px-6 md:px-20 py-10 md:py-16 min-h-screen flex flex-col justify-between">
        {{-- Main content (logo, links, social) --}}
        <div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 lg:gap-12">
                {{-- LOGO --}}
                <div class="col-span-1">
                    <a href="{{ route('landing') }}" class="font-extrabold text-3xl md:text-4xl text-violet-700 hover:opacity-80 transition-opacity">
                        TechPed
                    </a>
                </div>

                {{-- DUKUNGAN --}}
                <div class="flex flex-col gap-3">
                    <h4 class="font-semibold text-base md:text-lg text-gray-800">Dukungan</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Jl. Kemiri Jaya Rt 01 Rw 06, Tanah Baru, Beji, Depok
                    </p>
                    <p class="text-sm text-gray-600">techped@gmail.com</p>
                    <p class="text-sm text-gray-600">+88015-88888-9999</p>
                </div>

                {{-- AKUN --}}
                <div class="flex flex-col gap-3">
                    <h4 class="font-semibold text-base md:text-lg text-gray-800">Akun</h4>
                    @auth
                        <a href="{{ route('profile.edit') }}" class="text-sm text-gray-600 hover:text-violet-700 transition-colors">Akun Saya</a>
                    @endauth
                    
                    @guest
                        <a href="{{ route('user.login') }}" class="text-sm text-gray-600 hover:text-violet-700 transition-colors">Login / Register</a>
                    @endguest

                    <a href="{{ route('cart') }}" class="text-sm text-gray-600 hover:text-violet-700 transition-colors">Keranjang</a>
                    <a href="{{ route('user.products') }}" class="text-sm text-gray-600 hover:text-violet-700 transition-colors">Belanja</a>
                </div>

                {{-- LAINNYA --}}
                <div class="flex flex-col gap-3">
                    <h4 class="font-semibold text-base md:text-lg text-gray-800">Lainnya</h4>
                    <a href="{{ route('privacy') }}" class="text-sm text-gray-600 hover:text-violet-700 transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-sm text-gray-600 hover:text-violet-700 transition-colors">Terms Of Use</a>
                    <a href="{{ route('faq') }}" class="text-sm text-gray-600 hover:text-violet-700 transition-colors">FAQ</a>
                    <a href="{{ route('kontak') }}" class="text-sm text-gray-600 hover:text-violet-700 transition-colors">Kontak</a>
                </div>

                {{-- SOSIAL MEDIA --}}
                <div class="flex gap-4 items-start">
                    <a href="https://www.facebook.com/gol.roger.798278" class="text-gray-500 hover:text-violet-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 320 512">
                            <path d="M279.14 288l14.22-92.66h-88.91V127.41c0-25.35 12.42-50.06 52.24-50.06H295V6.26S259.36 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.2V288z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-violet-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H36L200.7 275.5 26.8 48h145.4l100.5 132.7L389.2 48z"/>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/fdball_/" class="text-gray-500 hover:text-violet-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" r="1"></circle>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/in/iqbal-fadilah-94329a38a" class="text-gray-500 hover:text-violet-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512">
                            <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 01107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="w-full border-t border-gray-200 pt-6 mt-8 text-center text-sm text-gray-500">
            © Copyright TechPed 2025. All right reserved
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const footer = document.querySelector('footer');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    footer.classList.add('fullscreen');
                } else {
                    footer.classList.remove('fullscreen');
                }
            });
        }, { threshold: 0.5 });
        observer.observe(footer);
    });
</script>   