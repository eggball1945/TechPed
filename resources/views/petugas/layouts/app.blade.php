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
            @include('petugas.layouts.sidebar')
        </aside>

        <div class="flex flex-col flex-1 h-screen">

            <header class="font-[Poppins] h-14 flex items-center justify-between px-4 bg-white border-b border-gray-300/70 shrink-0">
                @include('petugas.layouts.header')
            </header>

            <main class="font-[poppins] flex-1 overflow-y-auto bg-gray-100">
                @yield('content')
            </main>

        </div>

    </div>
    
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Simple Confirm Modal --}}
    <div id="simple-confirm-modal" class="hidden fixed inset-0 bg-black/40 z-[9999] items-center justify-center font-[Poppins]">
        <div class="bg-white border border-gray-300 w-[320px] rounded-sm p-5 shadow-sm">
            <h3 class="text-[13px] text-gray-800 font-medium mb-4 leading-relaxed" id="simple-confirm-msg">Apakah Anda yakin?</h3>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeSimpleConfirm()" class="px-4 py-1.5 text-[11px] text-gray-600 bg-gray-100 hover:bg-gray-200 border border-gray-300 cursor-pointer uppercase font-semibold">
                    Batal
                </button>
                <button type="button" id="simple-confirm-ok" class="px-4 py-1.5 text-[11px] text-white bg-violet-700 hover:bg-violet-800 border-none cursor-pointer uppercase font-semibold">
                    OK
                </button>
            </div>
        </div>
    </div>

    {{-- Simple Alert Modal --}}
    <div id="simple-alert-modal" class="hidden fixed inset-0 bg-black/40 z-[9999] items-center justify-center font-[Poppins]">
        <div class="bg-white border border-gray-300 w-[320px] rounded-sm p-5 shadow-sm">
            <h3 class="text-[13px] text-gray-800 font-medium mb-4 leading-relaxed" id="simple-alert-msg">Peringatan</h3>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeSimpleAlert()" class="px-4 py-1.5 text-[11px] text-white bg-violet-700 hover:bg-violet-800 border-none cursor-pointer uppercase font-semibold">
                    OK
                </button>
            </div>
        </div>
    </div>
</body>
</html>

<script>
// Prevent Zooming
document.addEventListener('wheel', function(e) {
    if (e.ctrlKey) {
        e.preventDefault();
    }
}, { passive: false });

// Simple Confirm Logic
let confirmFormToSubmit = null;
window.confirmAction = function(event, message) {
    event.preventDefault();
    confirmFormToSubmit = event.target;
    document.getElementById('simple-confirm-msg').innerText = message;
    
    let modal = document.getElementById('simple-confirm-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

window.closeSimpleConfirm = function() {
    let modal = document.getElementById('simple-confirm-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    confirmFormToSubmit = null;
}

document.getElementById('simple-confirm-ok').addEventListener('click', function() {
    if (confirmFormToSubmit) {
        confirmFormToSubmit.onsubmit = null;
        confirmFormToSubmit.submit();
    }
    closeSimpleConfirm();
});

// Simple Alert Logic
window.alertAction = function(message) {
    document.getElementById('simple-alert-msg').innerText = message;
    let modal = document.getElementById('simple-alert-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

window.closeSimpleAlert = function() {
    let modal = document.getElementById('simple-alert-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

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