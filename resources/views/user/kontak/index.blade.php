<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - TechPed </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    {{-- HEADER GLOBAL --}}
    @include('user.layouts.header')

    {{-- NAVBAR GLOBAL --}}
    @include('user.layouts.navbar')

    <div class="isi-section mt-16">
        @include('user.kontak.isi')
    </div>

    {{-- FOOTER GLOBAL --}}
    @include('user.layouts.footer')

</body>

</html>
