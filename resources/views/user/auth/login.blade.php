@extends('user.auth.index')

@section('auth-content')
<form method="POST" action="{{ route('user.login.submit') }}" class="flex flex-col gap-10 w-[370px]">
    @csrf
    <div class="flex flex-col gap-6">
        <span class="font-medium text-[36px] text-black">Login TechPed</span>
        <span class="font-normal text-base text-black">Masukkan data akun anda</span>
    </div>

    <div class="flex flex-col gap-8">
        <input type="text" name="email_or_phone" placeholder="Email atau nomor telepon" value="{{ old('email_or_phone') }}" class="w-full border-b border-black/50 py-2 focus:outline-none focus:border-violet-700">
        @error('email_or_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="password" name="password" placeholder="Password" class="w-full border-b border-black/50 py-2 focus:outline-none focus:border-violet-700">
        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="flex items-center gap-4">
        <span class="text-black opacity-70">Tidak punya akun?</span>
        <a href="{{ route('user.register') }}" class="text-black opacity-70 font-medium">Daftar</a>
    </div>

    <button type="submit" class="w-full bg-violet-700 py-4 rounded text-white hover:bg-violet-800 transition">Log In</button>
</form>
@endsection
