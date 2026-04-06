@extends('user.auth.index')

@section('auth')
<div class="flex flex-col gap-8 w-full">
    {{-- Header Section --}}
    <div class="flex flex-col gap-3" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.1s; opacity: 0;">
        <h1 class="font-bold text-4xl text-gray-900 tracking-tight">Lupa Password?</h1>
        <p class="text-gray-500 font-medium whitespace-nowrap">Jangan khawatir, kami bantu Anda masuk kembali!</p>
    </div>

    <form method="POST" action="{{ route('user.password.email') }}" class="flex flex-col gap-6">
        @csrf
        
        {{-- Email/Phone Input --}}
        <div class="flex flex-col gap-2" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.2s; opacity: 0;">
            <label class="text-sm font-semibold text-gray-700 ml-1">Email atau No. Telepon</label>
            <div class="relative group">
                <input type="text" name="email_or_phone" 
                       placeholder="Masukkan akun Anda" 
                       value="{{ old('email_or_phone') }}" 
                       class="w-full px-5 py-4 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300">
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400 group-focus-within:text-violet-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </div>
            </div>
            @error('email_or_phone') <span class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</span> @enderror
        </div>

        {{-- Submit Button --}}
        <div style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.3s; opacity: 0;">
            <button type="submit" 
                    class="w-full bg-violet-700 py-4 rounded-2xl text-white font-bold text-lg shadow-lg shadow-violet-200 hover:shadow-xl hover:shadow-violet-300 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-300">
                Lanjutkan Reset Password
            </button>
        </div>

        {{-- Footer Section --}}
        <div class="flex items-center justify-center gap-2 text-sm pt-4" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.5s; opacity: 0;">
            <a href="{{ route('user.login') }}" class="font-bold text-violet-600 hover:text-violet-700 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Login
            </a>
        </div>
    </form>
</div>
@endsection
