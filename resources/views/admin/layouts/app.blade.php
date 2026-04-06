<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 m-0 p-0 overflow-hidden">

    <div class="flex w-screen h-screen">

        <aside class="w-[245px] h-screen bg-white border-r border-gray-300/70 flex flex-col justify-between">
            @include('admin.layouts.sidebar')
        </aside>

        <div class="flex flex-col flex-1 h-screen">

            <header class="font-[Poppins] h-14 flex items-center justify-between px-4 bg-white border-b border-gray-300/70 shrink-0">
                @include('admin.layouts.header')
            </header>

            <main class="font-[poppins] flex-1 overflow-y-auto bg-gray-100">
                @yield('content')
            </main>

        </div>

    </div>
    
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<script>
// Prevent Zooming
document.addEventListener('wheel', function(e) {
    if (e.ctrlKey) {
        e.preventDefault();
    }
}, { passive: false });

document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && (
        e.key === '+' || 
        e.key === '-' || 
        e.key === '=' || 
        e.key === '_' 
    )) {
        e.preventDefault();
    }

    if (e.ctrlKey && (
        e.keyCode === 187 ||
        e.keyCode === 189 ||
        e.keyCode === 107 ||
        e.keyCode === 109
    )) {
        e.preventDefault();
    }
});

document.addEventListener('gesturestart', function(e) {
    e.preventDefault();
});

// Flash SweetAlert2
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            timer: 4000,
            showConfirmButton: true,
            confirmButtonColor: '#7c3aed',
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            text: "{{ $errors->first() }}",
            timer: 4000,
            showConfirmButton: true,
            confirmButtonColor: '#7c3aed',
        });
    @endif
});
</script>