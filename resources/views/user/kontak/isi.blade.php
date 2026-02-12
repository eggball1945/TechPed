{{-- BREADCRUMB --}}
<div class="flex justify-center mb-10">
    <div class="w-full max-w-[1140px] px-6">
        <div class="flex items-center gap-3 text-sm">
            <a href="/landing" class="text-black/50 hover:text-violet-700 transition">
                Home
            </a>
            <span class="text-black/30">/</span>
            <span class="text-black font-medium">
                Kontak
            </span>
        </div>
    </div>
</div>

{{-- WRAPPER UTAMA --}}
<div class="flex flex-col lg:flex-row gap-10 justify-center items-stretch mb-24 px-6">
    {{-- CARD KONTAK --}}
    <div class="w-full lg:w-[360px] bg-white rounded-2xl p-8 shadow-[0_20px_50px_rgba(0,0,0,0.08)] border border-black/5">
        <div class="flex flex-col gap-10">
            {{-- HUBUNGI KAMI --}}
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-violet-700 rounded-full flex items-center justify-center">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5542 14.24L15.1712 10.335C14.7812 9.88503 14.0662 9.88703 13.6132 10.341L10.8312 13.128C10.0032 13.957 9.76623 15.188 10.2452 16.175C13.1069 22.1 17.8853 26.8851 23.8062 29.755C24.7922 30.234 26.0222 29.997 26.8502 29.168L29.6582 26.355C30.1132 25.9 30.1142 25.181 29.6602 24.791L25.7402 21.426C25.3302 21.074 24.6932 21.12 24.2822 21.532L22.9182 22.898C22.8484 22.9712 22.7565 23.0195 22.6566 23.0354C22.5567 23.0513 22.4543 23.0339 22.3652 22.986C20.1357 21.7021 18.2862 19.8503 17.0052 17.619C16.9573 17.5298 16.9399 17.4273 16.9558 17.3272C16.9717 17.2271 17.02 17.135 17.0932 17.065L18.4532 15.704C18.8652 15.29 18.9102 14.65 18.5542 14.239V14.24Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span class="font-semibold text-base text-black">
                        Hubungi Kami
                    </span>
                </div>
                <div class="flex flex-col gap-3 text-sm text-black/80 leading-relaxed">
                    <span>Kami tersedia 24 jam sehari, 7 hari seminggu.</span>
                    <span>Telepon: +8801611112222</span>
                </div>
            </div>

            {{-- GARIS --}}
            <div class="w-full h-px bg-black/10"></div>

            {{-- PESAN --}}
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-violet-700 rounded-full flex items-center justify-center">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 13L20 20L30 13M10 27H30V13H10V27Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span class="font-semibold text-base text-black">
                        Pesan Untuk Kami
                    </span>
                </div>
                <div class="flex flex-col gap-3 text-sm text-black/80 leading-relaxed">
                    <span>Isilah formulir kami dan kami akan menghubungi Anda dalam waktu 24 jam.</span>
                    <span>Email: customer@techped.com</span>
                    <span>Email: support@techped.com</span>
                </div>
            </div>
        </div>
    </div>

    {{-- CARD FORM --}}
    <div class="w-full lg:max-w-[820px] bg-white rounded-2xl p-8 sm:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.08)] border border-black/5">
        <form class="flex flex-col gap-8">
            {{-- INPUT --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <input type="text" placeholder="Nama Anda *" class="h-[50px] bg-neutral-100 rounded-lg px-4 text-base placeholder:text-black/40 outline-none focus:ring-2 focus:ring-violet-600/30" />
                <input type="email" placeholder="Email Anda *" class="h-[50px] bg-neutral-100 rounded-lg px-4 text-base placeholder:text-black/40 outline-none focus:ring-2 focus:ring-violet-600/30" />
                <input type="tel" placeholder="Nomor Telepon Anda *" class="h-[50px] bg-neutral-100 rounded-lg px-4 text-base placeholder:text-black/40 outline-none focus:ring-2 focus:ring-violet-600/30" />
            </div>

            {{-- TEXTAREA --}}
            <textarea placeholder="Pesan Anda" class="w-full h-[200px] bg-neutral-100 rounded-lg p-4 text-base placeholder:text-black/40 outline-none resize-none focus:ring-2 focus:ring-violet-600/30"></textarea>

            {{-- BUTTON --}}
            <div class="flex justify-end">
                <button type="submit" class="bg-violet-700 hover:bg-violet-800 px-12 py-4 rounded-lg text-base font-medium text-white transition">
                    Kirim Pesan
                </button>
            </div>
        </form>
    </div>
</div>