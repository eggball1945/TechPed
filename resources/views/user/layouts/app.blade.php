<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechPed')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen flex flex-col overflow-x-hidden">

    {{-- HEADER --}}
    <header class="fixed top-0 left-0 w-full z-50">
        @include('user.layouts.header')
    </header>

    {{-- NAVBAR --}}
    <nav class="fixed top-[40px] left-0 w-full z-50">
        @include('user.layouts.navbar')
    </nav>

    <div class="flex flex-col min-h-screen">
        <main class="flex-grow pt-[110px]">
            <div class="flex flex-col lg:flex-row flex-1">
                @if(request()->routeIs('landing'))
                    <aside class=" hidden lg:block w-[280px] shrink-0">
                        <div class="sticky top-[120px] p-6">
                            @include('user.layouts.sidebar')
                        </div>
                    </aside>
                @endif

                @if(Route::currentRouteName() === 'profile.edit' || Route::currentRouteName() === 'addresses')
                    <aside class="w-72 shrink-0 h-full">
                        <div class="sticky top-32 px-6">
                            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 border border-gray-50 overflow-hidden group">
                                {{-- User header in sidebar --}}
                                <div class="bg-violet-700 p-8 text-center relative overflow-hidden">
                                    <div class="absolute top-0 left-0 w-full h-full bg-violet-700"></div>
                                    <div class="relative z-10 flex flex-col items-center">
                                        <div class="w-20 h-20 rounded-[2rem] bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white font-black text-3xl shadow-xl mb-4 group-hover:scale-110 transition-transform duration-500">
                                            {{ strtoupper(substr(Auth::user()->nama_depan ?? 'U', 0, 1)) }}
                                        </div>
                                        <h4 class="text-white font-black text-lg truncate w-full mb-1">{{ Auth::user()->nama_depan ?? 'Pengguna' }}</h4>
                                        <p class="text-violet-100/70 text-[10px] font-bold uppercase tracking-widest">{{ Auth::user()->email ?? '' }}</p>
                                    </div>
                                    <div class="absolute -bottom-12 -right-12 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                                </div>

                                {{-- Account Navigation --}}
                                <div class="p-4 space-y-2">
                                    @php
                                        $navItems = [
                                            ['route' => 'profile.edit', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />', 'label' => 'Profil Saya'],
                                            ['route' => 'cart', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />', 'label' => 'Keranjang Saya'],
                                            ['route' => 'orders', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />', 'label' => 'Pesanan Saya'],
                                            ['route' => 'addresses', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />', 'label' => 'Daftar Alamat'],
                                        ];
                                    @endphp

                                    @foreach($navItems as $item)
                                        @php
                                            $isActive = (Route::currentRouteName() === $item['route']);
                                        @endphp
                                        <a href="{{ route($item['route']) }}" 
                                           class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 group/nav active:scale-[0.98]
                                           {{ $isActive 
                                              ? 'bg-violet-700 text-white shadow-lg shadow-violet-200 active-nav' 
                                              : 'text-gray-500 hover:bg-violet-50 hover:text-violet-700' }}">
                                            
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-500
                                                {{ $isActive ? 'bg-white/20 text-white rotate-6' : 'bg-gray-50 text-gray-400 group-hover/nav:bg-violet-100 group-hover/nav:text-violet-700 group-hover/nav:-rotate-6' }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    {!! $item['icon'] !!}
                                                </svg>
                                            </div>
                                            
                                            <span class="text-xs font-bold truncate">{{ $item['label'] }}</span>
                                        </a>
                                    @endforeach

                                    <div class="h-px bg-gray-50 my-4"></div>

                                    <form method="POST" action="{{ route('user.logout') }}">
                                        @csrf
                                        <button type="submit" 
                                                class="flex items-center gap-4 w-full px-5 py-4 rounded-2xl text-violet-500 hover:bg-violet-50 transition-all duration-300 group/nav cursor-pointer active:scale-[0.98]">
                                            
                                            <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-400 group-hover/nav:bg-violet-100 group-hover/nav:text-violet-700 transition-all duration-500 group-hover/nav:-rotate-6 flex items-center justify-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                            </div>

                                            <span class="text-xs font-bold truncate">Keluar Akun</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </aside>
                @endif

                <div class="flex-1 py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto pb-12 w-full">
                    @yield('content')
                </div>

                @if(Route::currentRouteName() === 'user.products.show')
                    <div class="hidden lg:block lg:w-80 lg:sticky lg:top-[200px] self-start lg:ml-4 lg:mr-8">
                        @include('user.product.summary')
                    </div>
                @endif
            </div>
        </main>

        {{-- FOOTER --}}
        @include('user.layouts.footer')
    </div>

    {{-- Global Flash Messages (SweetAlert2) --}}
    @if(session('success') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#7c3aed',
                timer: 3000,
                timerProgressBar: true
            });
            @endif

            @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444'
            });
            @endif
        });
    </script>
    @endif
</body>
</html>