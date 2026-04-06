@extends('user.auth.index')

@section('auth')
<div class="flex flex-col gap-8 w-full">
    {{-- Header Section --}}
    <div class="flex flex-col gap-3" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.1s; opacity: 0;">
        <h1 class="font-bold text-4xl text-gray-900 tracking-tight">Daftar Akun</h1>
        <p class="text-gray-500 font-medium">Bergabunglah dengan komunitas TechPed hari ini!</p>
    </div>

    <form method="POST" action="{{ route('user.register.submit') }}" class="flex flex-col gap-5">
        @csrf
        
        {{-- Name Fields (Side by Side) --}}
        <div class="grid grid-cols-2 gap-4" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.2s; opacity: 0;">
            <div class="flex flex-col gap-2">
                <label class="text-sm font-semibold text-gray-700 ml-1">Nama Depan</label>
                <input type="text" name="nama_depan" placeholder="John" value="{{ old('nama_depan') }}" 
                       class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300 @error('nama_depan') border-red-500 @enderror">
                @error('nama_depan') <span class="text-red-500 text-[10px] sm:text-xs mt-1 ml-1 font-medium">{{ $message }}</span> @enderror
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm font-semibold text-gray-700 ml-1">Nama Belakang</label>
                <input type="text" name="nama_belakang" placeholder="Doe" value="{{ old('nama_belakang') }}" 
                       class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300 @error('nama_belakang') border-red-500 @enderror">
                @error('nama_belakang') <span class="text-red-500 text-[10px] sm:text-xs mt-1 ml-1 font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Email Input --}}
        <div class="flex flex-col gap-2" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.3s; opacity: 0;">
            <label class="text-sm font-semibold text-gray-700 ml-1">Email</label>
            <div class="relative group">
                <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" 
                       class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300 @error('email') border-red-500 @enderror">
            </div>
            @error('email') <span class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</span> @enderror
        </div>

        {{-- Password Section --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.4s; opacity: 0;">
            <div class="flex flex-col gap-2">
                <label class="text-sm font-semibold text-gray-700 ml-1">Password</label>
                <input type="password" name="password" id="reg-password" placeholder="••••••••" 
                       class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm font-semibold text-gray-700 ml-1">Konfirmasi</label>
                <input type="password" name="password_confirmation" id="reg-confirm" placeholder="••••••••" 
                       class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300">
            </div>
        </div>
        @error('password') <div style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.45s; opacity: 0;"><span class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</span></div> @enderror

        {{-- Register Button --}}
        <div class="pt-2" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.5s; opacity: 0;">
            <button type="submit" 
                    class="w-full bg-violet-700 py-4 rounded-2xl text-white font-bold text-lg shadow-lg shadow-violet-200 hover:shadow-xl hover:shadow-violet-300 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-300">
                Buat Akun Sekarang
            </button>
        </div>

        {{-- Footer Section --}}
        <div class="flex items-center justify-center gap-2 text-sm pt-2" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.6s; opacity: 0;">
            <span class="text-gray-500 font-medium">Sudah punya akun?</span>
            <a href="{{ route('user.login') }}" class="font-bold text-violet-600 hover:text-violet-700 transition-all hover:underline underline-offset-4 decoration-2">
                Masuk Disini
            </a>
        </div>
    </form>
</div>
@endsection
