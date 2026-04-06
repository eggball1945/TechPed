@extends('user.layouts.app')

@section('title', 'Profil Saya | TechPed')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-10 animate-fade-in">
        <h1 class="text-4xl font-black text-gray-900 tracking-tight mb-2 uppercase italic">Pengaturan <span class="text-violet-700">Profil</span></h1>
        <p class="text-sm text-gray-500 font-medium">Kelola informasi data diri dan keamanan akun Anda</p>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Basic Information Section --}}
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 border border-gray-50 overflow-hidden animate-fade-in-up">
            <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/50 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-violet-100 flex items-center justify-center text-violet-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <h3 class="font-black text-gray-900 uppercase tracking-widest text-sm">Informasi Dasar</h3>
            </div>
            
            <div class="p-8 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Nama Lengkap</label>
                        <input type="text" name="nama_depan" value="{{ old('nama_depan', $user->nama_depan) }}"
                            class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none"
                            placeholder="Masukkan nama lengkap">
                        @error('nama_depan') <p class="text-rose-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none"
                            placeholder="nama@email.com">
                        @error('email') <p class="text-rose-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2 md:col-span-2 text-left">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">No. Telepon / WhatsApp</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400">
                                <span class="text-sm font-bold">+62</span>
                            </div>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}"
                                class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 pl-14 pr-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none"
                                placeholder="812xxxxxxx">
                        </div>
                        @error('no_telepon') <p class="text-rose-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Password Section --}}
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 border border-gray-50 overflow-hidden animate-fade-in-up" style="animation-delay: 100ms">
            <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-violet-100 flex items-center justify-center text-violet-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <h3 class="font-black text-gray-900 uppercase tracking-widest text-sm">Keamanan Akun</h3>
                </div>
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" onclick="toggleAllPasswords(this)" class="hidden peer">
                    <div class="w-5 h-5 rounded-lg border-2 border-gray-200 peer-checked:bg-violet-700 peer-checked:border-violet-700 transition-all flex items-center justify-center">
                        <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="text-[10px] font-black text-gray-400 group-hover:text-violet-700 transition-colors uppercase tracking-widest">Lihat Password</span>
                </label>
            </div>
            
            <div class="p-8 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <div class="p-4 rounded-2xl bg-violet-50 border border-violet-100 flex items-start gap-4">
                            <div class="text-violet-600 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <p class="text-xs font-bold text-violet-800 leading-relaxed uppercase tracking-tight py-0.5">Kosongkan kolom password di bawah ini jika Anda tidak ingin mengubah password akun Anda.</p>
                        </div>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password"
                            class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none"
                            placeholder="••••••••">
                        @error('current_password') <p class="text-rose-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Password Baru</label>
                        <input type="password" id="password" name="password"
                            class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none"
                            placeholder="Minimal 8 karakter">
                        @error('password') <p class="text-rose-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none"
                            placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row items-center gap-4 pt-6 animate-fade-in-up" style="animation-delay: 200ms text-left">
            <button type="submit"
                class="w-full sm:w-auto bg-violet-700 hover:shadow-2xl hover:shadow-violet-200 text-white font-black px-12 py-4 rounded-2xl transition-all active:scale-[0.98] shadow-lg shadow-violet-100 uppercase text-xs tracking-widest cursor-pointer">
                Simpan Perubahan
            </button>
            <a href="{{ url()->previous() }}" class="w-full sm:w-auto text-center py-4 px-8 text-gray-400 text-xs font-black hover:text-gray-600 transition-colors uppercase tracking-widest cursor-pointer">
                Batalkan
            </a>
        </div>
    </form>
</div>

<script>
    function toggleAllPasswords(checkbox) {
        const passwordFields = document.querySelectorAll('input[type="password"], input[name$="password"]');
        passwordFields.forEach(input => {
            if(input.tagName === 'INPUT') {
                input.type = checkbox.checked ? 'text' : 'password';
            }
        });
    }
</script>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-fade-in-up { animation: fade-in-up 0.6s ease-out both; }
    .animate-fade-in { animation: fade-in 0.8s ease-out both; }
</style>
@endsection
