@extends('user.layouts.app')

@section('title', 'Keranjang Belanja | TechPed')

@section('content')
<div class="bg-gray-50 rounded-b-3xl min-h-screen">
    <div class="relative bg-violet-700 pt-32 pb-24 overflow-hidden rounded-t-3xl">        
        <div class="container mx-auto px-4 relative z-10 max-w-7xl">
            <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-violet-200 mb-10 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in font-sans">
                <a href="{{ route('landing') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-2.5 h-2.5 text-violet-300 opacity-50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                <span class="text-white truncate">Keranjang Saya</span>
            </nav>
            
            <div class="animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-violet-100 text-xs font-bold tracking-wider uppercase mb-5 border border-white/10">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Your Items
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight">
                    Keranjang Belanja
                </h1>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-10 pb-24 relative z-20 max-w-7xl">
        @if($carts->count() > 0)
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                {{-- Product List (left) --}}
                <div class="flex-1 space-y-6">
                    {{-- Selection header --}}
                    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-6 mb-6 border border-gray-50 flex items-center justify-between animate-fade-in-up" style="animation-delay: 50ms">
                        <label class="flex items-center gap-4 cursor-pointer group">
                            <div class="relative w-6 h-6">
                                <input type="checkbox" id="selectAllCheckbox" class="hidden peer">
                                <div class="absolute inset-0 bg-white border-2 border-gray-100 rounded-lg group-hover:border-violet-300 peer-checked:bg-violet-700 peer-checked:border-violet-700 transition-all flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </div>
                            <span class="text-sm font-black text-gray-900 uppercase tracking-widest">Pilih Semua</span>
                        </label>
                        
                        <button id="deleteSelectedBtn" class="flex items-center gap-2 px-5 py-2.5 bg-violet-50 hover:bg-violet-100 text-violet-600 rounded-2xl transition-all duration-300 group">
                            <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            <span class="text-xs font-black uppercase tracking-widest leading-none">Hapus Terpilih</span>
                        </button>
                    </div>

                    <div class="space-y-6">
                        @foreach ($carts as $item)
                            <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/40 p-6 md:p-8 border border-gray-50 flex flex-col md:flex-row items-center gap-6 md:gap-8 animate-fade-in-up hover:shadow-2xl hover:shadow-violet-100/50 transition-all duration-500 group"
                                data-cart-id="{{ $item->id }}"
                                data-price="{{ $item->product->harga_diskon ?? $item->product->harga }}"
                                data-qty="{{ $item->qty }}"
                                style="animation-delay: {{ $loop->index * 100 + 100 }}ms">
                                
                                <div class="md:shrink-0">
                                    <label class="relative w-8 h-8 cursor-pointer flex items-center justify-center">
                                        <input type="checkbox" class="cart-select hidden peer" checked>
                                        <div class="absolute inset-0 bg-white border-2 border-gray-100 rounded-xl peer-checked:bg-violet-700 peer-checked:border-violet-700 shadow-sm transition-all flex items-center justify-center group-hover:scale-110">
                                            <svg class="w-5 h-5 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                    </label>
                                </div>

                                <div class="relative w-full md:w-32 h-32 shrink-0 group-hover:scale-105 transition-transform duration-500">
                                    <img src="{{ $item->product->gambar_array[0] ? asset('storage/'.$item->product->gambar_array[0]) : asset('images/no-image.png') }}"
                                        class="w-full h-full object-cover rounded-[1.5rem] shadow-xl border-4 border-white"
                                        alt="{{ $item->product->nama_produk }}">
                                    @if($item->product->harga_diskon)
                                        <div class="absolute -top-3 -right-3 bg-fuchsia-600 text-white text-[10px] font-black px-2.5 py-1.5 rounded-lg shadow-lg border-2 border-white uppercase tracking-widest">PROMO</div>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0 text-center md:text-left">
                                    <div class="flex flex-col gap-2 mb-6">
                                        <h3 class="text-lg font-black text-gray-900 group-hover:text-violet-700 transition-colors leading-snug line-clamp-2 md:line-clamp-1">{{ $item->product->nama_produk }}</h3>
                                        <div class="flex items-center justify-center md:justify-start gap-3">
                                            <span class="text-xl font-black text-violet-700 tracking-tighter">Rp {{ number_format($item->product->harga_diskon ?? $item->product->harga, 0, ',', '.') }}</span>
                                            @if($item->product->harga_diskon)
                                                <span class="text-sm font-bold text-gray-300 line-through">Rp {{ number_format($item->product->harga, 0, ',', '.') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
                                        <div class="flex items-center bg-gray-50 p-1 rounded-2xl border border-gray-100 shadow-inner group/qty">
                                            <form method="POST" action="{{ route('cart.update', ['cart' => $item->id, 'type' => 'minus']) }}" class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-violet-700 bg-white rounded-xl shadow-sm hover:shadow-md transition-all active:scale-90">−</button>
                                            </form>
                                            <span class="w-12 text-center text-sm font-black text-gray-700">{{ $item->qty }}</span>
                                            <form method="POST" action="{{ route('cart.update', ['cart' => $item->id, 'type' => 'plus']) }}" class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-violet-700 bg-white rounded-xl shadow-sm hover:shadow-md transition-all active:scale-90">+</button>
                                            </form>
                                        </div>


                                        <form method="POST" action="{{ route('cart.destroy', $item->id) }}" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-4 py-2.5 text-gray-400 hover:text-rose-500 hover:bg-rose-50 rounded-2xl transition-all duration-300 text-[11px] font-black uppercase tracking-widest flex items-center gap-2 group/del">
                                                <svg class="w-4 h-4 group-hover/del:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Summary (right) --}}
                @include('user.cart.summary')
            </div>
        @else
            {{-- Modern Empty State --}}
            <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/50 p-20 text-center animate-fade-in-up border border-gray-50 flex flex-col items-center">
                <div class="relative w-48 h-48 mb-10">
                    <div class="absolute inset-0 bg-violet-100 rounded-full animate-pulse opacity-40"></div>
                    <div class="absolute inset-4 bg-violet-200 rounded-full animate-ping opacity-20" style="animation-duration: 3s"></div>
                    <div class="relative z-10 w-full h-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-violet-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-black text-gray-900 mb-4 tracking-tighter">Keranjang Anda <span class="text-violet-700">Kosong</span></h3>
                <p class="text-gray-500 max-w-sm mx-auto mb-12 leading-relaxed font-medium">Temukan koleksi teknologi terbaru kami dan penuhi kebutuhan digital Anda sekarang juga.</p>
                <a href="{{ route('user.products') }}" class="inline-flex items-center gap-3 bg-violet-700 hover:shadow-2xl hover:shadow-violet-200 text-white font-black px-12 py-5 rounded-[2rem] transition-all active:scale-[0.98] group shadow-xl shadow-violet-100">
                    <span class="uppercase tracking-widest text-xs">Mulai Jelajah Produk</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        @endif

        {{-- Recommendations --}}
        @php
            if (!isset($jelajahProducts)) {
                $jelajahProducts = \App\Models\Product::withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            }
        @endphp

        <div class="mt-24">
            <div class="flex items-end justify-between mb-12 animate-fade-in-up" style="animation-delay: 500ms">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-2 bg-violet-700 rounded-full"></div>
                        <span class="font-black text-xs text-violet-700 tracking-widest uppercase">Pilihan Terbaik</span>
                    </div>
                    <h2 class="text-4xl font-black text-gray-900 tracking-tighter">Rekomendasi <span class="text-violet-700">Untukmu</span></h2>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-5 gap-8 animate-fade-in-up" style="animation-delay: 600ms">
                @foreach ($jelajahProducts as $product)
                    <a href="{{ route('user.products.show', $product->id) }}"
                        class="group bg-white rounded-[2rem] p-4 border border-gray-50 shadow-xl shadow-gray-200/20 hover:shadow-2xl hover:shadow-violet-100/50 hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                        <div class="aspect-square bg-gray-50/50 rounded-[1.5rem] overflow-hidden mb-5 relative group-hover:scale-95 transition-transform duration-500">
                            <img src="{{ !empty($product->gambar_array) ? asset('storage/' . $product->gambar_array[0]) : asset('images/no-image.png') }}" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>
                        <div class="flex flex-col gap-2 flex-grow">
                            <h3 class="font-black text-sm text-gray-900 group-hover:text-violet-700 transition-colors line-clamp-1 truncate uppercase tracking-tight">{{ $product->nama_produk }}</h3>
                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-sm font-black text-violet-700">Rp {{ number_format($product->harga_diskon ?? $product->harga, 0, ',', '.') }}</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.068 9.382c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.955z"/></svg>
                                    <span class="text-[10px] font-black text-gray-400">{{ round($product->reviews_avg_rating ?? 0, 1) }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItems = document.querySelectorAll('[data-cart-id]');
        const subtotalSpan = document.getElementById('subtotal-display');
        const totalSpan = document.getElementById('total-display');
        const checkoutBtn = document.getElementById('checkout-selected');
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');

        function updateSummary() {
            let subtotal = 0;
            const selectedIds = [];
            let allChecked = true;
            let totalSelected = 0;

            cartItems.forEach(item => {
                const checkbox = item.querySelector('.cart-select');
                if (checkbox) {
                    if (checkbox.checked) {
                        const price = parseFloat(item.dataset.price);
                        const qty = parseInt(item.dataset.qty);
                        subtotal += price * qty;
                        selectedIds.push(item.dataset.cartId);
                        totalSelected++;
                    } else {
                        allChecked = false;
                    }
                }
            });

            if (subtotalSpan) subtotalSpan.textContent = 'Rp ' + subtotal.toLocaleString('id');
            if (totalSpan) totalSpan.textContent = 'Rp ' + subtotal.toLocaleString('id');
            if (checkoutBtn) checkoutBtn.dataset.selected = selectedIds.join(',');

            if (selectAllCheckbox) {
                const customCheckbox = selectAllCheckbox.nextElementSibling;
                selectAllCheckbox.checked = allChecked && cartItems.length > 0;
            }
        }

        cartItems.forEach(item => {
            const checkbox = item.querySelector('.cart-select');
            if (checkbox) {
                checkbox.addEventListener('change', updateSummary);
            }
        });

        if (selectAllCheckbox) {
            selectAllCheckbox.parentElement.addEventListener('click', function(e) {
                if (e.target !== selectAllCheckbox) {
                    selectAllCheckbox.checked = !selectAllCheckbox.checked;
                    selectAllCheckbox.dispatchEvent(new Event('change'));
                }
            });
            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                cartItems.forEach(item => {
                    const checkbox = item.querySelector('.cart-select');
                    if (checkbox) checkbox.checked = isChecked;
                });
                updateSummary();
            });
        }

        if (deleteSelectedBtn) {
            deleteSelectedBtn.addEventListener('click', async function() {
                const selectedCheckboxes = document.querySelectorAll('.cart-select:checked');
                if (selectedCheckboxes.length === 0) {
                    alert('Harap pilih minimal satu produk.');
                    return;
                }

                if (!confirm(`Hapus ${selectedCheckboxes.length} item dari keranjang Anda?`)) return;

                const selectedIds = Array.from(selectedCheckboxes).map(cb => cb.closest('[data-cart-id]').dataset.cartId);

                try {
                    const response = await fetch('{{ route("cart.delete-selected") }}', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ ids: selectedIds })
                    });
                    const data = await response.json();
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Gagal menghapus: ' + data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan teknis.');
                }
            });
        }

        updateSummary();

        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', function() {
                const selected = this.dataset.selected;
                if (!selected) {
                    alert('Pilih item yang ingin Anda checkout.');
                    return;
                }
                window.location.href = '{{ route("checkout") }}?cart_ids=' + encodeURIComponent(selected);
            });
        }
    });
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