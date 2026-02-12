<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechPed')</title>
    {{-- nyambungin CSS sama JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col">

    {{-- HEADER --}}
    @include('user.layouts.header')

    {{-- NAVBAR --}}
    @include('user.layouts.navbar')

    {{-- KONTEN UTAMA --}}
    <main class="flex-grow">

        {{-- KONTEN --}}
        <div class="flex min-h-[calc(100vh-160px)]">

            {{-- SIDEBAR --}}
            <div class="w-[250px] shrink-0 hidden lg:block">
                @include('user.layouts.sidebar')
            </div>

            <div class="flex flex-col flex-1 px-4 sm:px-6 lg:px-10 py-4">
                @yield('content')

                {{-- PROMOSI --}}
                <div class="mt-8">
                    @include('user.item.promosi')
                </div>
            </div>
        </div>

        {{-- FLASHSALE --}}
        <div class="mt-12">
            @include('user.item.flashsale')
        </div>

        <div class="flex justify-center py-20">
            <a href="/products"
                class="inline-flex items-center justify-center gap-2.5 bg-violet-700 px-12 py-4 rounded-lg font-medium text-base text-white hover:bg-violet-800 transition">
                Lihat Semua Produk
            </a>
        </div>

        {{-- ITEM --}}
        <div class="mt-16">@include('user.item.kategori')</div>
        <div class="mt-16">@include('user.item.terlaris')</div>
        <div class="mt-16">@include('user.item.item')</div>
        <div class="mt-16">@include('user.item.jelajah')</div>

        {{-- TOMBOL --}}
        <div class="flex justify-center py-20">
            <a href="/products"
                class="inline-flex items-center justify-center gap-2.5 bg-violet-700 px-12 py-4 rounded-lg font-medium text-base text-white hover:bg-violet-800 transition">
                Lihat Semua Produk
            </a>
        </div>

        {{-- ITEM LAINNYA --}}
        <div class="mt-16">@include('user.item.produk-baru')</div>
        <div class="mt-16">@include('user.layouts.circle')</div>
    </main>

    {{-- FOOTER --}}
    @include('user.layouts.footer')
</body>
</html>