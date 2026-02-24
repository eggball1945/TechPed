<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechPed - Profile')</title>
    {{-- nyambungin CSS sama JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- HEADER --}}
    @include('user.layouts.header')

    {{-- NAVBAR --}}
    @include('user.layouts.navbar')

    <div class="mt-12">
        @include('user.profile.content')
    </div>

    {{-- FOOTER --}}
    @include('user.layouts.footer')
</body>
</html>