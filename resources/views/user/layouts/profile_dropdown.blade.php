<div id="profileDropdown" 
    class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100/80
        invisible opacity-0 scale-95 transition-all duration-200 origin-top-right
        z-[9999] overflow-hidden">
    {{-- Header --}}
    <div class="px-5 py-4 bg-gray-50/50 border-b border-gray-100">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Akun Saya</p>
        <p class="font-bold text-gray-900 truncate">{{ Auth::user()->name ?? Auth::user()->nama_depan }}</p>
        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
    </div>

    {{-- Menu --}}
    <div class="p-2">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-violet-50 hover:text-violet-700 transition-all group">
            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-white shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <span class="font-medium">Profil Saya</span>
        </a>
        <a href="{{ route('orders') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-violet-50 hover:text-violet-700 transition-all group">
            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-white shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <span class="font-medium">Pesanan Saya</span>
        </a>
        <a href="{{ route('addresses') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-violet-50 hover:text-violet-700 transition-all group">
            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-white shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="font-medium">Alamat Pengiriman</span>
        </a>
    </div>

    {{-- Footer --}}
    <div class="p-2 border-t border-gray-50">
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-sm text-violet-600 hover:bg-violet-50 transition-all group cursor-pointer">
                <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center group-hover:bg-white shadow-sm transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </div>
                <span class="font-bold">Keluar</span>
            </button>
        </form>
    </div>
</div>
