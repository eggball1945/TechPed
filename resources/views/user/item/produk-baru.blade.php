<div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-24">
    {{-- HEADER (BARU) --}}
    <div class="flex flex-col gap-4 mb-12 text-left animate-fade-in-up">
        <div class="flex items-center justify-start gap-4">
            <div class="w-8 h-2 bg-violet-700 rounded-full"></div>
            <span class="font-black text-xs uppercase tracking-[0.3em] text-violet-700">Unggulan</span>
        </div>
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black text-gray-900 tracking-tighter">Produk <span class="text-violet-700">Terbaru</span> Kami</h2>
    </div>

    @if(isset($newProducts) && $newProducts->count() >= 4)
        @php
            $products = $newProducts->take(4);
            $largeProduct = $products[0];
            $mediumProduct = $products[1];
            $smallProduct1 = $products[2];
            $smallProduct2 = $products[3];

            function getFirstImage($product) {
                $images = $product->gambar_array ?? [];
                return !empty($images) ? asset('storage/' . $images[0]) : asset('images/no-image.png');
            }
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <div class="relative bg-black rounded-2xl overflow-hidden group h-[500px] md:h-[632px]">
                <div class="absolute inset-0 z-0">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] h-[80%] bg-white/20 rounded-full blur-3xl"></div>
                </div>
                <img src="{{ getFirstImage($largeProduct) }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 relative z-10"
                    alt="{{ $largeProduct->nama_produk }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-20"></div>
                <div class="absolute bottom-6 left-6 right-6 flex flex-col gap-4 text-white z-30">
                    <h3 class="font-bold text-2xl md:text-3xl line-clamp-2 tracking-tight">{{ $largeProduct->nama_produk }}</h3>
                    <p class="text-sm md:text-base opacity-70 line-clamp-3">{{ Str::limit($largeProduct->deskripsi ?? 'Deskripsi tidak tersedia', 100) }}</p>
                    <a href="{{ route('user.products.show', $largeProduct->id) }}"
                    class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest group/link w-fit">
                        <span>Belanja Sekarang</span>
                        <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="flex flex-col gap-6 md:gap-8">
                <div class="relative bg-black rounded-2xl overflow-hidden group h-[280px] md:h-[300px]">
                    <div class="absolute inset-0 z-0">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] h-[80%] bg-white/20 rounded-full blur-3xl"></div>
                    </div>
                    <div class="flex items-center justify-between h-full p-6 relative z-10">
                        <div class="flex-1 pr-4">
                            <h3 class="font-bold text-xl md:text-2xl text-white mb-2 line-clamp-2 tracking-tight">{{ $mediumProduct->nama_produk }}</h3>
                            <p class="text-sm text-white/60 line-clamp-2 mb-4">{{ Str::limit($mediumProduct->deskripsi ?? 'Deskripsi tidak tersedia', 70) }}</p>
                            <a href="{{ route('user.products.show', $mediumProduct->id) }}"
                            class="inline-flex items-center gap-2 text-xs font-bold text-white uppercase tracking-widest group/link">
                                <span>Belanja Sekarang</span>
                                <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        <div class="w-32 md:w-40 h-32 md:h-40 flex-shrink-0 relative">
                            <div class="absolute inset-0 bg-white/20 rounded-full blur-2xl"></div>
                            <img src="{{ getFirstImage($mediumProduct) }}" class="relative w-full h-full object-contain z-10 transform group-hover:scale-105 transition-transform duration-500" alt="{{ $mediumProduct->nama_produk }}">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 sm:gap-6">
                    @foreach([$smallProduct1, $smallProduct2] as $product)
                        <div class="bg-black rounded-2xl overflow-hidden group h-[260px] sm:h-[280px] md:h-[300px] flex flex-col justify-between p-3 sm:p-5 relative">
                            <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[110%] h-[110%] bg-white/10 rounded-full blur-3xl"></div>
                            </div>
                            
                            {{-- Stabilized Image Container --}}
                            <div class="flex items-center justify-center h-28 sm:h-32 md:h-40 w-full relative z-10 mt-2 overflow-hidden">
                                <img src="{{ getFirstImage($product) }}" 
                                    class="max-h-full max-w-full object-contain transition-all duration-500 group-hover:scale-[1.07]" 
                                    style="backface-visibility: hidden; transform: translateZ(0); -webkit-font-smoothing: subpixel-antialiased;"
                                    alt="{{ $product->nama_produk }}">
                            </div>

                            <div class="mt-2 relative z-10">
                                <h4 class="font-bold text-sm sm:text-lg text-white line-clamp-1 tracking-tight">{{ $product->nama_produk }}</h4>
                                <p class="text-[10px] sm:text-xs text-white/60 mt-1 line-clamp-2">{{ Str::limit($product->deskripsi ?? 'Deskripsi tidak tersedia', 40) }}</p>
                                <a href="{{ route('user.products.show', $product->id) }}"
                                class="inline-flex items-center gap-1 text-[10px] sm:text-xs font-bold text-white uppercase tracking-widest mt-2 sm:mt-3 group/link">
                                    <span>Belanja Sekarang</span>
                                    <svg class="w-3 h-3 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="text-center text-gray-500 py-16">
            <p class="text-lg">Belum ada produk baru.</p>
            <p class="text-sm mt-2">Pastikan database memiliki minimal 4 produk.</p>
        </div>
    @endif
</div>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out both;
    }
</style>