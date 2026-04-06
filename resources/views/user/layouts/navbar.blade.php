<div class="w-full bg-white border-b border-gray-100 shadow-sm sticky top-0 z-[100]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 gap-4">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="/" class="font-extrabold text-2xl text-violet-700 tracking-tight">TechPed</a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-8 whitespace-nowrap">
                <a href="/" class="font-medium text-sm transition-colors duration-200 {{ Request::is('/', '') ? 'text-violet-700' : 'text-gray-600 hover:text-violet-600' }}">Beranda</a>
                <a href="/kontak" class="font-medium text-sm transition-colors duration-200 {{ Request::is('kontak') ? 'text-violet-700' : 'text-gray-600 hover:text-violet-600' }}">Kontak</a>
                <a href="/tentang" class="font-medium text-sm transition-colors duration-200 {{ Request::is('tentang') ? 'text-violet-700' : 'text-gray-600 hover:text-violet-600' }}">Tentang</a>
                @guest
                    <a href="/login" class="font-medium text-sm transition-colors duration-200 {{ Request::is('login') ? 'text-violet-700' : 'text-gray-600 hover:text-violet-600' }}">Sign In</a>
                    {{-- <a href="/register" class="font-medium text-sm transition-colors duration-200 {{ Request::is('register') ? 'text-violet-700' : 'text-gray-600 hover:text-violet-600' }}">Sign Up</a> --}}
                @endguest
            </div>

            {{-- Search Bar (Desktop) --}}
            <div class="hidden md:flex flex-1 max-w-md">
                <form action="{{ route('user.products') }}" method="GET" class="w-full flex items-center gap-2 rounded-full px-4 py-2 bg-gray-50 border border-gray-100 transition-all duration-200 focus-within:ring-2 focus-within:ring-violet-700/20 focus-within:bg-white focus-within:border-violet-700">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari hardware terbaik..." class="flex-1 text-sm outline-none bg-transparent placeholder:text-gray-400">
                    <button type="submit" class="text-gray-400 hover:text-violet-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" /></svg>
                    </button>
                </form>
            </div>

            {{-- Right Icons & Mobile Menu Btn --}}
            <div class="flex items-center gap-2 sm:gap-4">
                @auth
                    {{-- Notifications --}}
                    <div class="relative">
                        <button id="notifBtn" type="button" class="relative p-2 text-gray-600 hover:text-violet-700 hover:bg-violet-50 rounded-full transition-all cursor-pointer">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span id="notifBadge" class="absolute top-1.5 right-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-violet-600 text-[10px] font-bold text-white ring-2 ring-white">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                        {{-- Dropdown (Simplified for briefness, keeping logic) --}}
                        @include('user.layouts.notif_dropdown')
                    </div>

                    {{-- Cart --}}
                    <a href="/cart" class="relative p-2 text-gray-600 hover:text-violet-700 hover:bg-violet-50 rounded-full transition-all cursor-pointer">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        @php $cartCount = auth()->user()->carts->count(); @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-1.5 right-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-violet-600 text-[10px] font-bold text-white ring-2 ring-white">{{ $cartCount }}</span>
                        @endif
                    </a>

                    {{-- Profile --}}
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center gap-2 p-1 rounded-full hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-violet-600 flex items-center justify-center text-white font-bold text-xs">
                                {{ strtoupper(substr(Auth::user()->nama_depan ?? 'U', 0, 1)) }}
                            </div>
                        </button>
                        @include('user.layouts.profile_dropdown')
                    </div>
                @endauth

                {{-- Mobile Menu Button --}}
                <button id="mobileMenuBtn" class="lg:hidden p-2 text-gray-600 hover:text-violet-700 hover:bg-violet-50 rounded-xl transition-all">
                    <svg id="menuIcon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                    <svg id="closeIcon" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Content --}}
    <div id="mobileMenu" class="hidden lg:hidden border-t border-gray-50 bg-white">
        <div class="px-4 pt-2 pb-6 space-y-2">
            <div class="py-2">
                <form action="{{ route('user.products') }}" method="GET" class="flex items-center gap-2 rounded-xl px-4 py-3 bg-gray-50 border border-gray-100">
                    <input type="text" name="search" placeholder="Cari produk..." class="flex-1 text-sm outline-none bg-transparent">
                    <button type="submit" class="text-gray-400"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" /></svg></button>
                </form>
            </div>
            <a href="/" class="block px-4 py-3 rounded-xl text-base font-semibold {{ Request::is('/') ? 'bg-violet-50 text-violet-700' : 'text-gray-600 hover:bg-gray-50' }}">Beranda</a>
            <a href="/kontak" class="block px-4 py-3 rounded-xl text-base font-semibold {{ Request::is('kontak') ? 'bg-violet-50 text-violet-700' : 'text-gray-600 hover:bg-gray-50' }}">Kontak</a>
            <a href="/tentang" class="block px-4 py-3 rounded-xl text-base font-semibold {{ Request::is('tentang') ? 'bg-violet-50 text-violet-700' : 'text-gray-600 hover:bg-gray-50' }}">Tentang</a>
            @guest
                <div class="pt-4 grid grid-cols-2 gap-3">
                    <a href="/login" class="flex justify-center items-center px-4 py-3 rounded-xl text-sm font-bold text-gray-700 border border-gray-200">Sign In</a>
                    <a href="/register" class="flex justify-center items-center px-4 py-3 rounded-xl text-sm font-bold text-white bg-violet-700">Sign Up</a>
                </div>
            @endguest
        </div>
    </div>
</div>

    {{-- JavaScript for all Navbar Interactions --}}
    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');

        mobileMenuBtn?.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        // Dropdowns Logic (Re-using/Improving existing)
        function setupDropdown(btnId, menuId) {
            const btn = document.getElementById(btnId);
            const menu = document.getElementById(menuId);
            if (!btn || !menu) return;

            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isVisible = !menu.classList.contains('invisible');
                // Close others
                document.querySelectorAll('[id$="Dropdown"]').forEach(m => {
                    m.classList.add('invisible', 'opacity-0', 'scale-95');
                });
                if (!isVisible) {
                    menu.classList.remove('invisible', 'opacity-0', 'scale-95');
                }
            });
        }

        setupDropdown('notifBtn', 'notifDropdown');
        setupDropdown('profileBtn', 'profileDropdown');

        document.addEventListener('click', () => {
            document.querySelectorAll('[id$="Dropdown"]').forEach(m => {
                m.classList.add('invisible', 'opacity-0', 'scale-95');
            });
        });
        // Delete notification
        document.querySelectorAll('.delete-notif').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();
                const id = btn.dataset.id;
                const parent = btn.closest('[data-notification-id]');
                try {
                    const response = await fetch(`/notifications/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });
                    if (response.ok) {
                        parent.remove();
                        // If no notifications left, show empty state
                        const container = document.querySelector('.max-h-\\[280px\\].overflow-y-auto');
                        if (container && container.children.length === 0) {
                            container.innerHTML = `
                                <div class="flex flex-col items-center justify-center py-8 px-4">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M37.0752 47.5C36.5587 48.9638 35.6008 50.2314 34.3337 51.128C33.0665 52.0246 31.5525 52.5061 30.0002 52.5061C28.4479 52.5061 26.9338 52.0246 25.6667 51.128C24.3995 50.2314 23.4417 48.9638 22.9252 47.5H37.0752ZM30.0002 5.00001C34.6415 5.00001 39.0927 6.84375 42.3746 10.1256C45.6564 13.4075 47.5002 17.8587 47.5002 22.5V31.32C47.5006 31.708 47.5913 32.0906 47.7652 32.4375L52.0552 41.02C52.2649 41.4393 52.3639 41.9052 52.3428 42.3736C52.3218 42.8419 52.1813 43.2971 51.9348 43.6959C51.6884 44.0946 51.344 44.4238 50.9345 44.652C50.525 44.8803 50.064 45.0001 49.5952 45H48.5352L51.2127 47.6775C51.6681 48.149 51.9201 48.7805 51.9144 49.436C51.9087 50.0915 51.6458 50.7185 51.1822 51.1821C50.7187 51.6456 50.0917 51.9085 49.4362 51.9142C48.7807 51.9199 48.1492 51.6679 47.6777 51.2125L8.78769 12.325C8.54892 12.0944 8.35846 11.8185 8.22744 11.5135C8.09642 11.2085 8.02745 10.8805 8.02457 10.5485C8.02168 10.2166 8.08494 9.88736 8.21064 9.58012C8.33634 9.27288 8.52197 8.99375 8.7567 8.75902C8.99144 8.52429 9.27057 8.33865 9.57781 8.21295C9.88505 8.08725 10.2142 8.024 10.5462 8.02688C10.8781 8.02976 11.2062 8.09873 11.5112 8.22975C11.8162 8.36077 12.0921 8.55123 12.3227 8.79001L15.8027 12.27C17.4227 10.0181 19.5555 8.18426 22.0247 6.92008C24.4939 5.6559 27.2287 4.99773 30.0027 5.00001M12.5577 21.0675L36.4902 45H10.4052C9.93639 45.0001 9.47535 44.8803 9.06586 44.652C8.65637 44.4238 8.31204 44.0946 8.06555 43.6959C7.81907 43.2971 7.67863 42.8419 7.65756 42.3736C7.6365 41.9052 7.73551 41.4393 7.94519 41.02L12.2377 32.4375C12.4107 32.0904 12.5006 31.7078 12.5002 31.32V22.5C12.5002 22.0167 12.5194 21.5392 12.5577 21.0675Z" fill="currentColor"/>
                                    </svg>
                                    <span class="text-xs text-gray-500">Belum ada notifikasi</span>
                                </div>
                            `;
                        }
                    } else {
                        console.error('Failed to delete notification');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });

        // Mark as read when clicking notif button
        document.getElementById('notifBtn')?.addEventListener('click', async () => {
            const badge = document.getElementById('notifBadge');
            if (badge) {
                badge.style.display = 'none';
                try {
                    await fetch('/notifications/read-all', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });
                } catch (error) {
                    console.error('Error marking notifications as read:', error);
                }
            }
        });
    </script>
