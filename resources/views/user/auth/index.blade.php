<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechPed')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col overflow-x-hidden bg-white">

    {{-- HEADER --}}
    <header class="w-full">
        @include('user.layouts.header')
    </header>

    {{-- NAVBAR --}}
    <nav class="w-full">
        @include('user.layouts.navbar')
    </nav>

    {{-- MAIN --}}
    <main class="flex-1 w-full pt-20">

        <div class="flex flex-col lg:flex-row w-full min-h-[calc(100vh-80px)]">

                <div class="flex-shrink-0 mr-auto max-w-full">
                    <img src="{{ asset('images/image.webp') }}" alt="Tentang TechPed" class=" transition-all duration-300 ease-out max-w-[260px] sm:max-w-[340px] md:max-w-[480px] lg:max-w-[600px] xl:max-w-[690px] h-auto object-contain">
                </div>

            <div class="w-full lg:w-1/2 flex justify-center lg:justify-end items-center px-6 sm:px-10 lg:px-20 ">
                <div class="w-full max-w-[420px] sm:max-w-[460px] lg:max-w-[480px] bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.08)] border border-black/5 p-6 sm:p-8 lg:p-10 transition-all duration-300 ">
                    @yield('auth-content')
                </div>
            </div>


        </div>

    </main>

    {{-- FOOTER --}}
    <footer class="w-full mt-auto">
        @include('user.layouts.footer')
    </footer>

</body>
</html>
