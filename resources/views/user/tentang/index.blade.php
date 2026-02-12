<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - TechPed    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    
    {{-- HEADER GLOBAL --}}
    @include('user.layouts.header')
    
    {{-- NAVBAR GLOBAL --}}
    @include('user.layouts.navbar')
    
    <div class="isi-section mt-16">
        @include('user.tentang.isi')
    </div>

    <div class="circle-section mt-16">
        @include('user.tentang.circle')
    </div>

    <div class="staff-section mt-16">
        @include('user.tentang.staff')
    </div>

    <div class="mt-16">
        @include('user.layouts.circle')
    </div>

    {{-- FOOTER GLOBAL --}}
    @include('user.layouts.footer')

</body>
</html>