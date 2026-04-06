@extends('user.layouts.app')

@section('title', $product->nama_produk . ' - TechPed')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
    {{-- BREADCRUMB (MINIMALIST) --}}
    <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-8 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in-up font-sans">
        <a href="{{ route('landing') }}" class="hover:text-violet-700 transition-colors">Beranda</a>
        <svg class="w-2.5 h-2.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
        <a href="{{ route('user.products') }}" class="hover:text-violet-700 transition-colors">Produk</a>
        @if($product->kategori)
            <svg class="w-2.5 h-2.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
            <a href="{{ route('user.products', ['category' => $product->kategori]) }}" class="hover:text-violet-700 transition-colors">{{ $product->kategori }}</a>
        @endif
        <svg class="w-2.5 h-2.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
        <span class="text-violet-700 truncate">{{ $product->nama_produk }}</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
        {{-- LEFT COLUMN: IMAGES --}}
        <div class="lg:w-[55%] animate-fade-in-up" style="animation-delay: 100ms">
            @php
                $images = $product->gambar_array ?? [];
                $mainImage = !empty($images) ? asset('storage/' . $images[0]) : asset('images/no-image.png');
            @endphp
            
            <div class="relative group">
                <div class="aspect-square bg-gray-50/50 rounded-[2.5rem] p-8 md:p-12 mb-6 flex items-center justify-center overflow-hidden border border-gray-100 shadow-xl shadow-gray-200/20 transition-all duration-500 hover:shadow-2xl hover:shadow-violet-100/50">
                    <img id="mainImage" src="{{ $mainImage }}" alt="{{ $product->nama_produk }}"
                        class="max-h-full max-w-full object-contain transform group-hover:scale-105 transition-transform duration-700 drop-shadow-[0_25px_45px_rgba(0,0,0,0.1)]">
                </div>
                
            </div>

            @if (count($images) > 1)
                <div class="flex gap-4 overflow-x-auto pb-4 hide-scrollbar snap-x snap-mandatory">
                    @foreach ($images as $index => $image)
                        <button class="w-20 md:w-24 aspect-square flex-shrink-0 bg-white rounded-2xl p-2 cursor-pointer border-2 shadow-sm transition-all duration-300 snap-start {{ $index === 0 ? 'border-violet-700 shadow-md scale-105' : 'border-gray-50 hover:border-violet-200' }}"
                            onclick="changeImage('{{ asset('storage/' . $image) }}', this)">
                            <img src="{{ asset('storage/' . $image) }}" class="w-full h-full object-contain">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- RIGHT COLUMN: INFO & PURCHASE --}}
        <div class="lg:w-[45%] flex flex-col gap-10 animate-fade-in-up" style="animation-delay: 200ms">
            <div class="space-y-6">
                <div class="space-y-3">
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter leading-none">{{ $product->nama_produk }}</h1>
                    
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-1.5 bg-gray-50 px-3 py-1.5 rounded-xl border border-gray-100">
                            <div class="flex">
                                @php $rating = round($product->reviews_avg_rating ?? 0); @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i <= $rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.068 9.382c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.955z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs font-black text-gray-500 uppercase tracking-tight">{{ $product->reviews_count ?? 0 }} Reviews</span>
                        </div>
                        <div class="flex items-center gap-2 bg-violet-50 px-3 py-1.5 rounded-xl border border-violet-100">
                            <span class="text-xs font-black text-violet-700 uppercase tracking-tight">{{ $product->total_sold ?? 0 }} Terjual</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    @if ($product->harga_diskon && $product->harga_diskon < $product->harga)
                        <div class="flex items-center gap-4">
                            <span class="text-4xl font-black text-violet-700 tracking-tighter">Rp {{ number_format($product->harga_diskon, 0, ',', '.') }}</span>
                            <span class="px-2 py-1 bg-red-50 text-red-600 text-[10px] font-black rounded-lg uppercase tracking-widest border border-red-100">Save {{ round((($product->harga - $product->harga_diskon) / $product->harga) * 100) }}%</span>
                        </div>
                        <span class="text-sm text-gray-400 line-through font-bold opacity-60">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                    @else
                        <span class="text-4xl font-black text-violet-700 tracking-tighter">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                    @endif
                </div>

                {{-- DESKRIPSI SINGKAT --}}
                @if($product->deskripsi)
                    <div class="pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-600 leading-relaxed">{!! nl2br(e($product->deskripsi)) !!}</p>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-6 rounded-3xl border border-gray-50 shadow-sm flex flex-col gap-2">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kategori</span>
                    <span class="text-sm font-black text-gray-900 uppercase italic">{{ $product->kategori ?? 'Tech Item' }}</span>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-gray-50 shadow-sm flex flex-col gap-2">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Ketersediaan</span>
                    <span class="text-sm font-black text-violet-700 uppercase italic">Ready Stock</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ULASAN PEMBELI --}}
    <div class="mt-24 mb-24 animate-fade-in-up" style="animation-delay: 300ms">
        <div class="flex items-center gap-4 mb-10">
            <div class="w-10 h-2 bg-violet-700 rounded-full"></div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic">Ulasan Pembeli</h2>
        </div>

        @if ($product->reviews && $product->reviews->count() > 0)
            <div class="flex flex-col gap-4 max-w-3xl mx-auto w-full">
                @foreach ($product->reviews as $review)
                    <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/10 p-5 md:p-6 border border-gray-50 group hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-violet-50 border border-violet-100 flex items-center justify-center text-violet-700 font-black text-sm">
                                    {{ $review->show_name ? substr($review->user->nama_depan ?? 'U', 0, 1) : 'A' }}
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="font-black text-gray-900 text-sm uppercase tracking-tight leading-none mb-1">
                                        {{ $review->show_name ? ($review->user->nama_depan ?? 'Pengguna') : 'Anonim' }}
                                    </h4>
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-2.5 h-2.5 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-100' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.068 9.382c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.955z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end justify-end gap-1">
                                <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">{{ $review->created_at->diffForHumans() }}</span>
                                @if(auth()->check() && auth()->id() === $review->user_id)
                                    <button type="button" class="delete-review-btn p-1.5 text-violet-500 hover:text-violet-800 hover:bg-violet-50 rounded-lg transition-all duration-300" data-review-id="{{ $review->id }}" data-delete-url="{{ route('reviews.destroy', $review->id) }}" title="Hapus ulasan">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <p class="text-gray-500 text-xs leading-relaxed italic opacity-85 underline-offset-2">{{ $review->komentar }}</p>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-50/50 rounded-4xl p-20 text-center border-2 border-dashed border-gray-100">
                <div class="w-20 h-20 bg-white rounded-3xl shadow-sm border border-gray-50 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8 text-violet-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                </div>
                <h3 class="text-lg font-black text-violet-900 tracking-tight uppercase">Belum Ada Ulasan</h3>
                <p class="text-gray-400 text-xs font-bold mt-1 uppercase tracking-widest">Jadilah pembeli pertama yang memberikan ulasan</p>
            </div>
        @endif
    </div>

    {{-- PRODUK SERUPA (GRID) --}}
    @if (isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="mt-20 mb-20">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-10 h-2 bg-violet-700 rounded-full"></div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic">Produk Serupa</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($relatedProducts as $related)
                    @include('user.item.product-card', ['product' => $related])
                @endforeach
            </div>
        </div>
    @endif

    {{-- PRODUK REKOMENDASI --}}
    @if (isset($jelajahProducts) && $jelajahProducts->count() > 0)
        <div class="mt-20 mb-12">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-10 h-2 bg-violet-700 rounded-full"></div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic">Mungkin Anda Suka</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($jelajahProducts as $recommendation)
                    @include('user.item.product-card', ['product' => $recommendation])
                @endforeach
            </div>
        </div>
    @endif
</div>

<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-[1000] p-4 animate-fade-in">
    <div class="bg-white rounded-[2rem] max-w-md w-full shadow-2xl transform transition-all animate-scale-up">
        {{-- Header --}}
        <div class="p-8 border-b border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-violet-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-black text-gray-900">Hapus Ulasan?</h3>
                    <p class="text-xs text-gray-500 mt-1">Tindakan ini tidak dapat dibatalkan</p>
                </div>
            </div>
        </div>

        <div class="p-8">
            <p class="text-sm text-gray-600 leading-relaxed">
                Apakah Anda yakin ingin menghapus ulasan ini? Data akan dihapus secara permanen dari sistem.
            </p>
        </div>

        <div class="p-6 bg-gray-50/50 border-t border-gray-100 flex gap-3 rounded-b-[2rem]">
            <button id="cancelBtn" class="flex-1 px-6 py-3 rounded-xl border border-gray-300 font-bold text-gray-700 hover:bg-gray-50 transition-all duration-200">
                Batal
            </button>
            <button id="confirmBtn" class="flex-1 px-6 py-3 rounded-xl bg-violet-500 hover:bg-violet-600 text-white font-bold transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Hapus
            </button>
        </div>
    </div>
</div>

<script>
    let currentReviewId = null;
    let currentDeleteUrl = null;

    function changeImage(src, element) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('button.snap-start').forEach(el => {
            el.classList.remove('border-violet-700', 'shadow-md', 'scale-105');
            el.classList.add('border-gray-50');
        });
        element.classList.add('border-violet-700', 'shadow-md', 'scale-105');
        element.classList.remove('border-gray-50');
    }

    document.querySelectorAll('.delete-review-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentReviewId = this.dataset.reviewId;
            currentDeleteUrl = this.dataset.deleteUrl;
            document.getElementById('deleteModal').classList.remove('hidden');
        });
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('deleteModal').classList.add('hidden');
        currentReviewId = null;
        currentDeleteUrl = null;
    });

    document.getElementById('confirmBtn').addEventListener('click', async function() {
        if (!currentReviewId || !currentDeleteUrl) return;

        // Disable button during request
        this.disabled = true;
        const originalText = this.innerHTML;
        this.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';

        try {
            const response = await fetch(currentDeleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (response.ok) {
                // Find and remove the review card
                const reviewCards = document.querySelectorAll('[data-review-id]');
                reviewCards.forEach(btn => {
                    if (btn.dataset.reviewId === currentReviewId) {
                        const card = btn.closest('.bg-white.rounded-3xl');
                        if (card) {
                            // Fade out animation before removing
                            card.style.animation = 'fade-out 0.3s ease-out forwards';
                            setTimeout(() => {
                                card.remove();
                                
                                // Check if there are no more reviews
                                const reviewContainer = document.querySelector('.flex.flex-col.gap-4.max-w-3xl');
                                if (!reviewContainer || reviewContainer.children.length === 0) {
                                    location.reload();
                                }
                            }, 300);
                        }
                    }
                });

                // Close modal
                document.getElementById('deleteModal').classList.add('hidden');
                currentReviewId = null;
                currentDeleteUrl = null;
            } else {
                const data = await response.json().catch(() => ({}));
                const errorMsg = data.message || 'Gagal menghapus ulasan. Silakan coba lagi.';
                alert(errorMsg);
                
                // Re-enable button
                this.disabled = false;
                this.innerHTML = originalText;
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan. Silakan coba lagi.');
            
            // Re-enable button
            this.disabled = false;
            this.innerHTML = originalText;
        }
    });

    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            currentReviewId = null;
            currentDeleteUrl = null;
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('deleteModal');
            if (!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
                currentReviewId = null;
                currentDeleteUrl = null;
            }
        }
    });
</script>

<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes fade-out {
        from { opacity: 1; }
        to { opacity: 0; transform: translateX(-20px); }
    }
    @keyframes scale-up {
        from { 
            opacity: 0; 
            transform: scale(0.95) translateY(10px);
        }
        to { 
            opacity: 1; 
            transform: scale(1) translateY(0);
        }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .animate-fade-in {
        animation: fade-in 0.3s ease-out forwards;
    }
    .animate-scale-up {
        animation: scale-up 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
@endsection