@guest
<div class="w-full flex justify-center items-center h-16 bg-white shadow-md">
    <div class="flex items-center gap-[210px] w-[1186px]">
        <div class="flex-shrink-0">
            <a href="/landing" class="font-extrabold text-2xl text-violet-700">TechPed</a>
        </div>

        <div class="flex items-center gap-12 whitespace-nowrap">
            <a href="/landing" class="font-title-16px-regular relative pb-1 {{ Request::is('landing') ? 'text-violet-700 border-b-2 border-violet-700' : 'text-black hover:border-b-2 hover:border-gray-400' }}">
                Home
            </a>
            <a href="/kontak" class="font-title-16px-regular relative pb-1 {{ Request::is('kontak') ? 'text-violet-700 border-b-2 border-violet-700' : 'text-black hover:border-b-2 hover:border-gray-400' }}">
                Kontak
            </a>
            <a href="/tentang" class="font-title-16px-regular relative pb-1 {{ Request::is('tentang') ? 'text-violet-700 border-b-2 border-violet-700' : 'text-black hover:border-b-2 hover:border-gray-400' }}">
                Tentang
            </a>
            <a href="/login" class="font-title-16px-regular relative pb-1 {{ Request::is('login', 'register') ? 'text-violet-700 border-b-2 border-violet-700' : 'text-black hover:border-b-2 hover:border-gray-400' }}" >
                Sign Up
            </a>
        </div>

        <div class="flex items-center gap-2 ml-12 border rounded px-2 py-1 w-64">
            <input type="text" name="q" placeholder="Apa yang ingin anda cari?" class="flex-1 text-sm outline-none" />
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
            </svg>
        </div>
    </div>
</div>
@endguest

@auth
<div class="w-full flex justify-center items-center h-16 bg-white shadow-md">
    <div class="flex items-center justify-between w-[1186px]">

        <a href="/landing" class="font-extrabold text-2xl text-violet-700">
            TechPed
        </a>

        <div class="flex items-center gap-12">
            @foreach ([
                'landing' => 'Home',
                'kontak' => 'Kontak',
                'tentang' => 'Tentang',
                'keranjang' => 'Keranjang'
            ] as $route => $label)
                <a href="/{{ $route }}"
                   class="font-title-16px-regular relative pb-1
                   {{ Request::is($route) ? 'text-violet-700 border-b-2 border-violet-700' : 'text-black hover:border-b-2 hover:border-gray-400' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="flex items-center gap-4 relative">

            <div class="flex items-center gap-2 border rounded px-3 py-2 bg-neutral-100">
                <input type="text" placeholder="Apa yang ingin anda cari?"
                       class="flex-1 text-sm outline-none bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 text-gray-400"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z"/>
                </svg>
            </div>

            <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 21V12C6 10.4087 6.63214 8.88258 7.75736 7.75736C8.88258 6.63214 10.4087 6 12 6C13.5913 6 15.1174 6.63214 16.2426 7.75736C17.3679 8.88258 18 10.4087 18 12V21M6 21H18M6 21H4M18 21H20M11 24H13" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="black" stroke-width="1.5"/>
                <circle cx="22" cy="8" r="8" fill="#6D28D9"/>
                <path d="M21.0341 4.32V3.324H23.2901V12H22.1861V4.32H21.0341Z" fill="#FAFAFA"/>
            </svg>

            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.25 24.25C12.6642 24.25 13 23.9142 13 23.5C13 23.0858 12.6642 22.75 12.25 22.75C11.8358 22.75 11.5 23.0858 11.5 23.5C11.5 23.9142 11.8358 24.25 12.25 24.25Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22.75 24.25C23.1642 24.25 23.5 23.9142 23.5 23.5C23.5 23.0858 23.1642 22.75 22.75 22.75C22.3358 22.75 22 23.0858 22 23.5C22 23.9142 22.3358 24.25 22.75 24.25Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.25 7.75H9.25L11.5 20.5H23.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11.5 16.5H23.1925C23.2792 16.5001 23.3633 16.4701 23.4304 16.4151C23.4975 16.3601 23.5434 16.2836 23.5605 16.1986L24.9105 9.44859C24.9214 9.39417 24.92 9.338 24.9066 9.28414C24.8931 9.23029 24.8679 9.18009 24.8327 9.13717C24.7975 9.09426 24.7532 9.05969 24.703 9.03597C24.6528 9.01225 24.598 8.99996 24.5425 9H10" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="23" cy="10" r="8" fill="#6D28D9"/>
                <path d="M20.6608 13.124C21.6768 12.308 22.4728 11.64 23.0488 11.12C23.6248 10.592 24.1088 10.044 24.5008 9.476C24.9008 8.9 25.1008 8.336 25.1008 7.784C25.1008 7.264 24.9728 6.856 24.7168 6.56C24.4688 6.256 24.0648 6.104 23.5048 6.104C22.9608 6.104 22.5368 6.276 22.2328 6.62C21.9368 6.956 21.7768 7.408 21.7528 7.976H20.6968C20.7288 7.08 21.0008 6.388 21.5128 5.9C22.0248 5.412 22.6848 5.168 23.4928 5.168C24.3168 5.168 24.9688 5.396 25.4488 5.852C25.9368 6.308 26.1808 6.936 26.1808 7.736C26.1808 8.4 25.9808 9.048 25.5808 9.68C25.1888 10.304 24.7408 10.856 24.2368 11.336C23.7328 11.808 23.0888 12.36 22.3048 12.992H26.4328V13.904H20.6608V13.124Z" fill="#FAFAFA"/>
            </svg>


            <div class="relative">

                <button id="profileBtn" class="focus:outline-none">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <rect width="32" height="32" rx="16" fill="#6D28D9"/>
                        <path d="M21 23V21.3333C21 20.4493 20.691 19.6014 20.1408 18.9763C19.5907 18.3512 18.8446 18 18.0667 18H12.9333C12.1554 18 11.4093 18.3512 10.8592 18.9763C10.309 19.6014 10 20.4493 10 21.3333V23"
                              stroke="white" stroke-width="1.5"/>
                        <path d="M16 15C17.6569 15 19 13.6569 19 12C19 10.3431 17.6569 9 16 9C14.3431 9 13 10.3431 13 12C13 13.6569 14.3431 15 16 15Z"
                              stroke="white" stroke-width="1.5"/>
                    </svg>
                </button>

                <div id="profileDropdown"
                     class="absolute right-0 mt-3 w-[329px] bg-white p-6 rounded-xl shadow-lg
                            opacity-0 scale-95 pointer-events-none
                            transition-all duration-200 origin-top">

                    <div class="mb-4">
                        <p class="font-semibold text-sm">{{ auth()->user()->nama_depan ?? 'User' }}</p>
                        <p class="text-xs opacity-70">Online</p>
                    </div>

                    <div class="h-px bg-gray-200 my-3"></div>

                    <div class="flex flex-col gap-3 text-sm">
                        <a href="/akun" class="flex items-center gap-2 hover:text-violet-700">
                            <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.0071 1.14539C9.32294 0.406758 8.36739 0 7.3127 0C6.25239 0 5.29368 0.404297 4.6127 1.13836C3.92434 1.88051 3.58895 2.88914 3.6677 3.97828C3.8238 6.12703 5.45891 7.875 7.3127 7.875C9.16649 7.875 10.7988 6.12738 10.9573 3.97898C11.0372 2.89969 10.6997 1.89316 10.0071 1.14539V1.14539ZM13.5002 15.75H1.1252C0.963224 15.7521 0.802814 15.7181 0.655642 15.6504C0.508469 15.5827 0.378237 15.4831 0.27442 15.3587C0.0459042 15.0855 -0.0462052 14.7125 0.0219979 14.3353C0.318717 12.6893 1.24473 11.3066 2.7002 10.3359C3.99325 9.47426 5.63118 9 7.3127 9C8.99422 9 10.6322 9.47461 11.9252 10.3359C13.3807 11.3063 14.3067 12.6889 14.6034 14.335C14.6716 14.7122 14.5795 15.0852 14.351 15.3584C14.2472 15.4828 14.117 15.5825 13.9698 15.6502C13.8226 15.718 13.6622 15.7521 13.5002 15.75V15.75Z" fill="#6D28D9"/>
                            </svg>
                            <span>Akun Saya</span>
                        </a>

                        <a href="/pesanan" class="flex items-center gap-2 hover:text-violet-700">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.125 13.2188C1.125 13.7409 1.33242 14.2417 1.70163 14.6109C2.07085 14.9801 2.57161 15.1875 3.09375 15.1875H14.9062C15.4284 15.1875 15.9292 14.9801 16.2984 14.6109C16.6676 14.2417 16.875 13.7409 16.875 13.2188V7.80469H1.125V13.2188ZM3.44531 10.5469C3.44531 10.2672 3.55643 9.99889 3.75422 9.8011C3.95202 9.60331 4.22028 9.49219 4.5 9.49219H6.1875C6.46722 9.49219 6.73548 9.60331 6.93328 9.8011C7.13107 9.99889 7.24219 10.2672 7.24219 10.5469V11.25C7.24219 11.5297 7.13107 11.798 6.93328 11.9958C6.73548 12.1936 6.46722 12.3047 6.1875 12.3047H4.5C4.22028 12.3047 3.95202 12.1936 3.75422 11.9958C3.55643 11.798 3.44531 11.5297 3.44531 11.25V10.5469ZM14.9062 2.8125H3.09375C2.57161 2.8125 2.07085 3.01992 1.70163 3.38913C1.33242 3.75835 1.125 4.25911 1.125 4.78125V5.69531H16.875V4.78125C16.875 4.25911 16.6676 3.75835 16.2984 3.38913C15.9292 3.01992 15.4284 2.8125 14.9062 2.8125V2.8125Z" fill="#6D28D9"/>
                            </svg>
                            <span>Pesanan Saya</span>
                        </a>
                    </div>

                    <div class="h-px bg-violet-700 opacity-30 my-3"></div>

                    <form method="POST" action="/logout">
                        @csrf   
                        <button class="flex items-center gap-2 text-sm w-full hover:text-red-600">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.625 9C5.625 8.85082 5.68426 8.70774 5.78975 8.60225C5.89524 8.49676 6.03832 8.4375 6.1875 8.4375H11.25V4.78125C11.25 3.65625 10.0621 2.8125 9 2.8125H3.65625C3.13428 2.81306 2.63384 3.02066 2.26475 3.38975C1.89566 3.75884 1.68806 4.25928 1.6875 4.78125V13.2188C1.68806 13.7407 1.89566 14.2412 2.26475 14.6102C2.63384 14.9793 3.13428 15.1869 3.65625 15.1875H9.28125C9.80322 15.1869 10.3037 14.9793 10.6727 14.6102C11.0418 14.2412 11.2494 13.7407 11.25 13.2188V9.5625H6.1875C6.03832 9.5625 5.89524 9.50324 5.78975 9.39775C5.68426 9.29226 5.625 9.14918 5.625 9ZM16.1476 8.60238L13.3351 5.78988C13.2288 5.68885 13.0872 5.63335 12.9405 5.63523C12.7938 5.63711 12.6537 5.69621 12.5499 5.79994C12.4462 5.90366 12.3871 6.0438 12.3852 6.19048C12.3834 6.33716 12.4388 6.47877 12.5399 6.58512L14.3919 8.4375H11.25V9.5625H14.3919L12.5399 11.4149C12.4855 11.4666 12.4419 11.5287 12.4119 11.5975C12.3818 11.6663 12.3658 11.7404 12.3649 11.8155C12.3639 11.8906 12.378 11.9651 12.4063 12.0346C12.4346 12.1042 12.4765 12.1673 12.5296 12.2204C12.5827 12.2735 12.6458 12.3154 12.7154 12.3437C12.7849 12.372 12.8594 12.3861 12.9345 12.3851C13.0096 12.3842 13.0837 12.3682 13.1525 12.3381C13.2213 12.3081 13.2834 12.2645 13.3351 12.2101L16.1476 9.39762C16.253 9.29214 16.3122 9.14912 16.3122 9C16.3122 8.85088 16.253 8.70786 16.1476 8.60238V8.60238Z" fill="#6D28D9"/>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endauth
