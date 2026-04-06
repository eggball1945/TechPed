@php
    $categories = [
        [
            'name' => 'PC', 
            'viewBox' => '0 0 512 512', 
            'icon' => '<path fill="currentColor" d="M29.65 117.89v276.22h124.62V117.89zm90.55 253.16a11 11 0 1 1 11-11a11 11 0 0 1-11 11m18-189.16H45.56v-16h92.63v16zm0-32H45.56v-16h92.63v16zm153 188.51h73.1v39.71h41.74v16H249.48v-16h41.74V338.4zm-118-220.51V322.4h309.15V117.89H173.19zM466.35 306.4H189.19V133.89h277.16z" />'
        ],
        [
            'name' => 'Mini PC', 
            'viewBox' => '0 0 16 16', 
            'icon' => '<path fill="currentColor" d="M1 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1zm11.5 1a.5.5 0 1 1 0 1a.5.5 0 0 1 0-1m2 0a.5.5 0 1 1 0 1a.5.5 0 0 1 0-1M1 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5M1.25 9h5.5a.25.25 0 0 1 0 .5h-5.5a.25.25 0 0 1 0-.5" />'
        ],
        [
            'name' => 'Laptop', 
            'viewBox' => '0 0 80 80', 
            'icon' => '<path fill="currentColor" d="M12 20.73a4 4 0 0 1 4-4h48a4 4 0 0 1 4 4v32H47.874a4 4 0 0 0-3.873 2.999L44 55.73h-8l-.001-.002a4 4 0 0 0-3.873-2.998H12zm20.126 36H4.152a.15.15 0 0 0-.152.153a7.85 7.85 0 0 0 7.848 7.848h56.304A7.85 7.85 0 0 0 76 56.883a.15.15 0 0 0-.152-.153H47.874a4 4 0 0 1-3.874 3h-8a4 4 0 0 1-3.874-3" />'
        ],
        [
            'name' => 'Gaming', 
            'viewBox' => '0 0 15 15', 
            'icon' => '<path fill="currentColor" d="M13.1 11.5c-.6.3-1.4.1-1.8-.5l-1.1-1.4H4.8L3.7 11c-.5.7-1.4.8-2.1.3c-.5-.4-.7-1-.6-1.5l.7-3.7C1.9 4.9 3 4 4.2 4H7V2.5C7 1.7 7.6 1 8.4 1h3.1c.3 0 .5.2.5.5s-.2.5-.5.5h-3c-.3 0-.5.2-.5.4V4h2.8c1.2 0 2.3.9 2.5 2.1l.7 3.7c.1.7-.2 1.4-.9 1.7M6 6.5C6 5.7 5.3 5 4.5 5S3 5.7 3 6.5S3.7 8 4.5 8S6 7.3 6 6.5m6 0c0-.3-.2-.5-.5-.5H11v-.5c0-.3-.2-.5-.5-.5s-.5.2-.5.5V6h-.5c-.3 0-.5.2-.5.5s.2.5.5.5h.5v.5c0 .3.2.5.5.5s.5-.2.5-.5V7h.5c.3 0 .5-.2.5-.5" />'
        ],
        [
            'name' => 'Hardware', 
            'viewBox' => '0 0 24 24', 
            'icon' => '<path fill="currentColor" d="M9.181 10.181c.053-.053.148-.119.45-.16c.323-.043.761-.044 1.439-.044h1.86c.678 0 1.116.001 1.438.045c.303.04.398.106.45.16c.054.052.12.147.16.45c.044.322.045.76.045 1.438v1.86c0 .678-.001 1.116-.045 1.438c-.04.303-.106.398-.16.45c-.052.054-.147.12-.45.16c-.322.044-.76.045-1.438.045h-1.86c-.678 0-1.116-.001-1.438-.045c-.303-.04-.398-.106-.45-.16c-.054-.052-.12-.147-.16-.45c-.044-.322-.045-.76-.045-1.438v-1.86c0-.678.001-1.116.045-1.438c.04-.303.106-.398.16-.45" /><path fill="currentColor" fill-rule="evenodd" d="M12 3c.385 0 .698.312.698.698v2.79q.764.001 1.395.017V3.698a.698.698 0 0 1 1.395 0v2.79a1 1 0 0 1-.008.108c.936.115 1.585.353 2.078.846s.731 1.142.846 2.078a1 1 0 0 1 .108-.008h2.79a.698.698 0 0 1 0 1.395h-2.807q.017.63.017 1.395h2.79a.698.698 0 0 1 0 1.396h-2.79q-.001.764-.017 1.395h2.807a.698.698 0 0 1 0 1.395h-2.79a1 1 0 0 1-.108-.008c-.115.936-.353 1.585-.846 2.078s-1.142.731-2.078.846q.009.053.008.108v2.79a.698.698 0 0 1-1.395 0v-2.807q-.63.017-1.395.017v2.79a.698.698 0 0 1-1.396 0v-2.79a56 56 0 0 1-1.395-.017v2.807a.698.698 0 0 1-1.395 0v-2.79q0-.056.008-.108c-.936-.115-1.585-.353-2.078-.846s-.731-1.142-.846-2.078a1 1 0 0 1-.108.008h-2.79a.698.698 0 0 1 0-1.395h2.807a56 56 0 0 1-.017-1.395h-2.79a.698.698 0 0 1 0-1.396h2.79q.001-.764.017-1.395H2.698a.698.698 0 0 1 0-1.395h2.79q.056 0 .108.008c.115-.936.353-1.585.846-2.078s1.142-.731 2.078-.846a1 1 0 0 1-.008-.108v-2.79a.698.698 0 0 1 1.395 0v2.807q.63-.017 1.395-.017v-2.79c0-.386.313-.698.698-.698m-.976 5.581c-.619 0-1.152 0-1.578.058c-.458.061-.896.2-1.252.555c-.355.356-.494.794-.555 1.252c-.058.427-.058.96-.058 1.578v1.952c0 .619 0 1.151.058 1.578c.061.458.2.896.555 1.252c.356.355.794.494 1.252.555c.426.058.96.058 1.578.058h1.952c.619 0 1.151 0 1.578-.058c.458-.061.896-.2 1.252-.555c.355-.356.494-.794.555-1.252c.058-.427.058-.96.058-1.578v-1.952c0-.619 0-1.151-.058-1.578c-.061-.458-.2-.896-.555-1.252c-.356-.355-.794-.494-1.252-.555c-.427-.058-.96-.058-1.578-.058z" clip-rule="evenodd" />'
        ],
    ];
    $currentCategory = request('category');
@endphp

<aside class="relative group">
    <div class="mb-6 px-1">
        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Kategori Produk</h3>
        <div class="h-1 w-8 bg-violet-700 rounded-full"></div>
    </div>

    <div class="space-y-2">
        @foreach ($categories as $cat)
            @php
                $isActive = ($currentCategory === $cat['name']);
            @endphp
            <a href="{{ route('user.products', ['category' => $cat['name']]) }}" 
               class="flex items-center justify-between w-full px-5 py-4 rounded-2xl transition-all duration-300 group/nav relative overflow-hidden
               {{ $isActive 
                  ? 'bg-violet-700 text-white shadow-xl shadow-violet-200' 
                  : 'bg-white border border-gray-50 text-gray-600 hover:border-violet-100 hover:bg-violet-50/30 hover:text-violet-700' }}">
                
                @if($isActive)
                    <div class="absolute inset-0 bg-linear-to-br from-violet-600 to-fuchsia-600 opacity-90"></div>
                @endif

                <div class="relative z-10 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-500
                        {{ $isActive ? 'bg-white/20 text-white rotate-6' : 'bg-gray-50 text-gray-400 group-hover/nav:bg-violet-100 group-hover/nav:text-violet-700 group-hover/nav:-rotate-6' }}">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="{{ $cat['viewBox'] }}">
                            {!! $cat['icon'] !!}
                        </svg>
                    </div>
                    <span class="text-xs font-black uppercase tracking-widest">{{ $cat['name'] }}</span>
                </div>

                <div class="relative z-10 w-6 h-6 flex items-center justify-center transition-all duration-300
                    {{ $isActive ? 'translate-x-0 opacity-100' : '-translate-x-4 opacity-0 group-hover/nav:translate-x-0 group-hover/nav:opacity-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        @endforeach
    </div>
</aside>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fade-in-up 0.5s ease-out both; }
</style>