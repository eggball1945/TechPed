@extends('user.auth.index')

@section('auth-content')
<form method="POST" action="{{ route('user.register.submit') }}" class="flex flex-col gap-10 w-[370px]">
    @csrf
    <div class="flex flex-col gap-6">
        <span class="font-medium text-[36px] text-black">Buat akun anda</span>
        <span class="font-normal text-base text-black">Masukkan data valid!</span>
    </div>

    <div class="flex flex-col gap-8">
        <input type="text" name="nama_depan" placeholder="Nama Depan" value="{{ old('nama_depan') }}" class="w-full border-b border-black/50 py-2 focus:outline-none focus:border-violet-700">
        <input type="text" name="nama_belakang" placeholder="Nama Belakang" value="{{ old('nama_belakang') }}" class="w-full border-b border-black/50 py-2 focus:outline-none focus:border-violet-700">
        <input type="text" name="email" placeholder="Email atau nomor telepon" value="{{ old('email') }}" class="w-full border-b border-black/50 py-2 focus:outline-none focus:border-violet-700">
        <input type="password" name="password" placeholder="Password" class="w-full border-b border-black/50 py-2 focus:outline-none focus:border-violet-700">
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full border-b border-black/50 py-2 focus:outline-none focus:border-violet-700">
    </div>

    <div class="flex items-center gap-2 text-sm">
        <span class="text-gray-600">
            Sudah punya akun?
        </span>

        <a href="{{ route('user.login') }}" class="relative font-medium text-violet-700 transition-all duration-300 hover:text-violet-800 after:content-[''] after:absolute after:left-0 after:-bottom-0.5 after:h-[2px] after:w-0 after:bg-violet-700 after:transition-all after:duration-300 hover:after:w-full">
            Login
        </a>
    </div>


    <button type="submit" class="w-full bg-violet-700 py-4 rounded text-white hover:bg-violet-800 transition">Daftar</button>
</form>
@endsection
