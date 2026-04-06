@extends('user.auth.index')

@section('auth')
<div class="flex flex-col gap-8 w-full">
    {{-- Header Section --}}
    <div class="flex flex-col gap-3" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.2s; opacity: 0;">
        <h1 class="font-bold text-4xl text-gray-900 tracking-tight">Selamat Datang!</h1>
        <p class="text-gray-500 font-medium">Silahkan login ke akun TechPed Anda</p>
    </div>

    <form method="POST" action="{{ route('user.login.submit') }}" class="flex flex-col gap-6">
        @csrf
        
        {{-- Email/Phone Input --}}
        <div class="flex flex-col gap-2" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.4s; opacity: 0;">
            <label class="text-sm font-semibold text-gray-700 ml-1">Email atau No. Telepon</label>
            <div class="relative group">
                <input type="text" name="email_or_phone" 
                       placeholder="nama@email.com" 
                       value="{{ old('email_or_phone') }}" 
                       class="w-full px-5 py-4 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300">
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400 group-focus-within:text-violet-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </div>
            </div>
            @error('email_or_phone') <span class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</span> @enderror
        </div>

        {{-- Password Input --}}
        <div class="flex flex-col gap-2" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.5s; opacity: 0;">
            <div class="flex justify-between items-center px-1">
                <label class="text-sm font-semibold text-gray-700">Password</label>
                <a href="{{ route('user.password.request') }}" class="text-xs font-bold text-violet-600 hover:text-violet-700 transition-colors">Lupa Password?</a>
            </div>
            <div class="relative group">
                <input type="password" name="password" id="login-password"
                       placeholder="••••••••" 
                       class="w-full px-5 py-4 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300">
                <button type="button" onclick="togglePassword('login-password')" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-violet-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </button>
            </div>
            @error('password') <span class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</span> @enderror
        </div>

        {{-- Login Button --}}
        <div style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.6s; opacity: 0;">
            <button type="submit" 
                    class="w-full bg-violet-700 py-4 rounded-2xl text-white font-bold text-lg shadow-lg shadow-violet-200 hover:shadow-xl hover:shadow-violet-300 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-300">
                Masuk Sekarang
            </button>
        </div>

        {{-- Footer Section --}}
        <div class="flex items-center justify-center gap-2 text-sm pt-4" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.7s; opacity: 0;">
            <span class="text-gray-500 font-medium">Belum punya akun?</span>
            <a href="{{ route('user.register') }}" class="font-bold text-violet-600 hover:text-violet-700 transition-all hover:underline underline-offset-4 decoration-2">
                Daftar
            </a>
        </div>
    </form>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection
