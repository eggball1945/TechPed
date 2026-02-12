<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechPed')</title>
    {{-- nyambungin CSS sama JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{-- HEADER GLOBAL --}}
    @include('user.layouts.header')
    {{-- NAVBAR GLOBAL --}}
    @include('user.layouts.navbar')

    {{-- MAIN CONTENT --}}
    <main class="min-h-screen py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-10">
            @include('user.cart.content')
        </div>
    </main>

    {{-- FOOTER --}}
    @include('user.layouts.footer')
</body>
</html>