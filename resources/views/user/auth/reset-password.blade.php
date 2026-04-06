@extends('user.auth.index')

@section('auth')
<div class="flex flex-col gap-8 w-full">
    {{-- Header Section --}}
    <div class="flex flex-col gap-3" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.1s; opacity: 0;">
        <h1 class="font-bold text-4xl text-gray-900 tracking-tight">Atur Ulang Password</h1>
        <p class="text-gray-500 font-medium whitespace-nowrap">Masukkan kode verifikasi dan password baru Anda.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl flex items-center gap-3 text-sm font-medium slide-in" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.2s; opacity: 0;">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('user.password.update') }}" class="flex flex-col gap-6">
        @csrf
        
        {{-- Password Section --}}
        <div class="grid grid-cols-1 gap-5" style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.2s; opacity: 0;">
            <div class="flex flex-col gap-2">
                <label class="text-sm font-semibold text-gray-700 ml-1">Password Baru</label>
                <div class="relative group">
                    <input type="password" name="password" id="reset-password"
                           placeholder="••••••••" 
                           class="w-full px-5 py-4 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300">
                    <button type="button" onclick="togglePassword('reset-password')" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-violet-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </button>
                </div>
            </div>
            
            <div class="flex flex-col gap-2">
                <label class="text-sm font-semibold text-gray-700 ml-1">Konfirmasi Password</label>
                <div class="relative group">
                    <input type="password" name="password_confirmation" id="reset-confirm"
                           placeholder="••••••••" 
                           class="w-full px-5 py-4 rounded-2xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-violet-500 focus:bg-white focus:ring-4 focus:ring-violet-500/10 transition-all duration-300">
                    <button type="button" onclick="togglePassword('reset-confirm')" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-violet-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </button>
                </div>
            </div>
            @error('password') <span class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</span> @enderror
        </div>

        {{-- Submit Button --}}
        <div style="animation: fadeInUp 0.8s ease-out forwards; animation-delay: 0.5s; opacity: 0;">
            <button type="submit" 
                    class="w-full bg-violet-700 py-4 rounded-2xl text-white font-bold text-lg shadow-lg shadow-violet-200 hover:shadow-xl hover:shadow-violet-300 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-300">
                Ubah Password
            </button>
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
