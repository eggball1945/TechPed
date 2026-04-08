@extends('user.layouts.app')

@section('title', 'Pesanan Saya | TechPed')

@section('content')
<div class="bg-gray-50 rounded-b-3xl min-h-screen">
    {{-- Hero Section --}}
    <div class="relative bg-violet-700 rounded-t-3xl pt-32 pb-24 overflow-hidden">  
        <div class="container mx-auto px-4 relative z-10 max-w-5xl">
            <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-violet-200 mb-10 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in font-sans">
                <a href="{{ route('landing') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-2.5 h-2.5 text-violet-300 opacity-50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                <span class="text-white truncate">Pesanan Saya</span>
            </nav>
            
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-violet-100 text-xs font-bold tracking-wider uppercase mb-5 border border-white/10">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        Riwayat Belanja
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight">
                        Pesanan Saya
                    </h1>
                </div>
                
                <div class="overflow-hidden -mb-2 pb-2">
                    <div class="flex items-center gap-2 overflow-x-auto pb-10 -mb-8 no-scrollbar animate-fade-in-up" style="animation-delay: 100ms">
                        @php
                            $currentStatus = request('status', 'all');
                            $statusTabs = [
                                'all' => 'Semua',
                                'tertunda' => 'Menunggu',
                                'diproses' => 'Diproses',
                                'dikirim' => 'Dikirim',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Batal',
                            ];
                        @endphp

                        @foreach($statusTabs as $key => $label)
                            <a href="{{ $key === 'all' ? route('orders') : route('orders', ['status' => $key]) }}"
                               class="px-6 py-3 rounded-2xl text-sm font-bold transition-all whitespace-nowrap border backdrop-blur-md
                               {{ $currentStatus === $key
                                  ? 'bg-white text-violet-700 border-white shadow-xl shadow-white/10'
                                  : 'bg-white/5 text-white border-white/10 hover:bg-white/10 hover:border-white/20' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-12 pb-20 relative z-20 max-w-5xl">
        @if(session('success'))
            <div class="mb-8 bg-white border border-violet-100 p-6 rounded-[2rem] shadow-xl shadow-violet-100/20 flex items-center gap-5 animate-fade-in-down">
                <div class="bg-linear-to-br from-violet-600 to-fuchsia-600 p-3 rounded-2xl shadow-lg shadow-violet-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-black text-violet-900 text-base">Berhasil!</h4>
                    <p class="text-sm text-violet-700/70 font-medium mt-0.5">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="bg-gray-50 p-2 rounded-xl text-gray-400 hover:text-red-500 transition-all hover:rotate-90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 bg-white border border-rose-100 p-6 rounded-[2rem] shadow-xl shadow-rose-100/20 flex items-center gap-5 animate-fade-in-down">
                <div class="bg-linear-to-br from-rose-500 to-red-600 p-3 rounded-2xl shadow-lg shadow-rose-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-black text-rose-900 text-base">Gagal!</h4>
                    <p class="text-sm text-rose-700/70 font-medium mt-0.5">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="bg-gray-50 p-2 rounded-xl text-gray-400 hover:text-red-500 transition-all hover:rotate-90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/50 p-20 text-center animate-fade-in-up border border-gray-50 flex flex-col items-center">
                <div class="relative w-48 h-48 mb-10">
                    <div class="absolute inset-0 bg-violet-100 rounded-full animate-pulse opacity-40"></div>
                    <div class="absolute inset-4 bg-violet-200 rounded-full animate-ping opacity-20" style="animation-duration: 3s"></div>
                    <div class="relative z-10 w-full h-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-violet-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-black text-gray-900 mb-4 tracking-tighter">
                    Belum Ada <span class="text-violet-700">Pesanan{{ request('status') && request('status') !== 'all' ? ' ' . ucfirst(request('status')) : '' }}</span>
                </h3>
                <p class="text-gray-500 max-w-sm mx-auto mb-12 leading-relaxed font-medium">
                    Sepertinya Anda belum memiliki riwayat belanja. Temukan produk teknologi terbaik kami sekarang!
                </p>
                <a href="{{ route('user.products') }}" class="inline-flex items-center gap-3 bg-violet-700 hover:shadow-2xl hover:shadow-violet-200 text-white font-black px-12 py-5 rounded-[2rem] transition-all active:scale-[0.98] group shadow-xl shadow-violet-100">
                    <span class="uppercase tracking-widest text-xs">Mulai Belanja</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/40 p-8 border border-gray-50 animate-fade-in-up group hover:shadow-2xl hover:shadow-violet-100/50 transition-all duration-300" style="animation-delay: {{ $loop->index * 50 }}ms">
                        <div class="flex flex-wrap items-center justify-between gap-6 pb-6 mb-6 border-b border-gray-50">
                            <div class="flex items-center gap-5">
                                <div class="bg-violet-50 p-3.5 rounded-2xl">
                                    <svg class="w-6 h-6 text-violet-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-black text-gray-900 group-hover:text-violet-700 transition-colors">TRX-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h4>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">{{ \Carbon\Carbon::parse($order->tanggal)->format('d F Y') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-3">
                                <div class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-tighter
                                    @if($order->status === 'selesai') bg-emerald-50 text-emerald-700 border border-emerald-100
                                    @elseif($order->status === 'dikirim') bg-sky-50 text-sky-700 border border-sky-100
                                    @elseif($order->status === 'diproses') bg-amber-50 text-amber-700 border border-amber-100
                                    @elseif($order->status === 'tertunda') bg-orange-50 text-orange-700 border border-orange-100
                                    @elseif($order->status === 'dibatalkan') bg-rose-50 text-rose-700 border border-rose-100
                                    @else bg-gray-50 text-gray-600 border border-gray-100
                                    @endif">
                                    {{ $order->status === 'selesai' ? 'Selesai' : ($order->status === 'dikirim' ? 'Dikirim' : ($order->status === 'diproses' ? 'Diproses' : ($order->status === 'tertunda' ? 'Menunggu' : 'Dibatalkan'))) }}
                                </div>

                                <div class="flex items-center gap-2 ml-2">
                                    <a href="{{ route('checkout.receipt', $order->id) }}" class="p-2.5 bg-violet-700 hover:bg-violet-800 text-white rounded-xl transition-all shadow-lg shadow-violet-100 hover:shadow-violet-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </a>
                                    
                                    @if($order->status === 'dikirim')
                                        <button onclick="confirmAction('complete', {{ $order->id }})" class="px-5 py-2.5 bg-violet-700 hover:bg-violet-800 text-white text-xs font-black rounded-xl transition-all shadow-lg shadow-violet-100 active:scale-95 uppercase cursor-pointer">
                                            Konfirmasi Terima
                                        </button>
                                        <form method="POST" action="{{ route('orders.complete', $order->id) }}" id="complete-form-{{ $order->id }}" class="hidden">@csrf</form>
                                    @endif

                                    @if(in_array($order->status, ['tertunda', 'diproses']))
                                        <button onclick="confirmAction('cancel', {{ $order->id }})" class="px-5 py-2.5 bg-violet-50 hover:bg-violet-100 text-violet-700 text-xs font-black rounded-xl transition-all uppercase cursor-pointer">
                                            Batal
                                        </button>
                                        <form method="POST" action="{{ route('orders.cancel', $order->id) }}" id="cancel-form-{{ $order->id }}" class="hidden">@csrf</form>
                                    @endif

                                    @if(in_array($order->status, ['dibatalkan', 'selesai']))
                                        <button onclick="confirmAction('delete', {{ $order->id }})" class="p-2.5 text-gray-300 hover:text-violet-700 transition-all hover:bg-violet-50 rounded-xl cursor-pointer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                        <form method="POST" action="{{ route('orders.destroy', $order->id) }}" id="delete-form-{{ $order->id }}" class="hidden">@csrf @method('DELETE')</form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Product Rows --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                @foreach($order->products as $product)
                                    <div class="flex items-center gap-5 p-3 rounded-2xl bg-gray-50/50 border border-transparent hover:border-violet-100 hover:bg-white transition-all group/prod">
                                        <div class="relative w-16 h-16 shrink-0 group-hover/prod:scale-110 transition-transform">
                                            <img src="{{ $product->gambar_array[0] ? asset('storage/' . $product->gambar_array[0]) : asset('images/no-image.png') }}"
                                                class="w-full h-full object-cover rounded-xl shadow-md border border-white" alt="{{ $product->nama_produk }}">
                                            <div class="absolute -top-2 -right-2 bg-violet-700 text-white text-[10px] font-black h-5 w-5 flex items-center justify-center rounded-full border-2 border-white shadow-sm">
                                                {{ $product->pivot->jumlah }}
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h5 class="text-sm font-bold text-gray-800 truncate">{{ $product->nama_produk }}</h5>
                                            <p class="text-xs font-black text-violet-700 mt-1">Rp {{ number_format($product->pivot->harga, 0, ',', '.') }}</p>
                                        </div>
                                        
                                        @if($order->status === 'selesai')
                                            <button type="button" onclick="openReviewModal({{ $order->id }}, {{ $product->id }}, '{{ addslashes($product->nama_produk) }}', '{{ addslashes($product->gambar_array[0] ?? '') }}')" 
                                                class="whitespace-nowrap px-4 py-2 bg-white text-violet-700 text-[11px] font-black rounded-lg border border-violet-100 hover:bg-violet-700 hover:text-white hover:border-violet-700 transition-all shadow-sm cursor-pointer">
                                                Ulas
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <div class="bg-gray-50/50 rounded-2xl p-6 flex flex-col justify-between border border-transparent hover:border-fuchsia-100 transition-all self-start">
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Pengiriman</p>
                                        <p class="text-xs font-bold text-gray-700">{{ $order->shipping ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Metode Bayar</p>
                                        <p class="text-xs font-bold text-gray-700">{{ str_replace('_', ' ', $order->payment ?? '-') }}</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">No. Resi</p>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-black text-violet-700">{{ $order->resi ?? '-' }}</span>
                                            @if($order->resi && $order->resi !== '-')
                                                <button onclick="copyResi('{{ $order->resi }}')" class="text-gray-300 hover:text-violet-600 transition-colors cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/></svg>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-gray-100 flex items-end justify-between">
                                    <div class="text-xs text-gray-400 font-bold">{{ count($order->products) }} barang &bull; {{ $order->jumlah_barang }} jumlah</div>
                                    <div class="text-right">
                                        <p class="text-[10px] font-black text-gray-400 uppercase mb-1">Total Pembayaran</p>
                                        <p class="text-2xl font-black text-violet-700">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>

<div id="reviewModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-110 hidden transition-all duration-300 opacity-0">
    <div class="bg-white rounded-[2rem] shadow-2xl max-w-sm w-full mx-4 p-6 transform scale-95 transition-all duration-300 overflow-hidden relative border border-white/20">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-violet-600 rounded-full blur-[50px] opacity-10"></div>
        
        <div class="flex justify-between items-center mb-6 relative z-10">
            <div>
                <h3 class="text-xl font-black text-gray-900 leading-none">Beri <span class="text-violet-700">Ulasan</span></h3>
                <p class="text-[10px] font-bold text-gray-400 mt-1.5 uppercase tracking-wider">Bagikan Pengalaman Anda</p>
            </div>
            <button onclick="closeReviewModal()" class="bg-gray-50 p-2 rounded-xl text-gray-400 hover:text-gray-900 transition-all hover:rotate-90">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div class="flex items-center gap-4 mb-6 p-3 rounded-2xl bg-gray-50 border border-gray-100">
            <div class="relative w-14 h-14 shrink-0">
                <img id="reviewProductImage" src="" class="w-full h-full object-cover rounded-xl shadow-sm border-2 border-white">
            </div>
            <div class="flex-1 min-w-0">
                <p id="reviewProductName" class="text-sm font-bold text-gray-900 leading-snug line-clamp-1"></p>
            </div>
        </div>

        {{-- Rating System --}}
        <div class="mb-6 text-center">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Rating Kualitas</p>
            <div class="flex items-center justify-center gap-2">
                @for ($i = 1; $i <= 5; $i++)
                    <button data-rating="{{ $i }}" class="rating-star transition-all duration-300 hover:scale-110 focus:outline-none">
                        <svg class="w-8 h-8 text-gray-200 cursor-pointer transition-colors" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.068 9.382c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.955z" />
                        </svg>
                    </button>
                @endfor
            </div>
            <input type="hidden" id="reviewRating" value="0">
        </div>

        <div class="space-y-4 mb-6 relative z-10">
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 px-1">Komentar (Opsional)</label>
                <textarea id="reviewComment" rows="3" class="w-full rounded-xl border-2 border-gray-50 bg-gray-50 px-4 py-3 text-sm font-medium focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none resize-none" placeholder="Tulis kepuasan Anda di sini..."></textarea>
            </div>

            <label class="flex items-center gap-3 cursor-pointer p-3 rounded-xl hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-100">
                <input type="checkbox" id="reviewShowName" checked class="hidden peer">
                <div class="w-5 h-5 rounded-lg border-2 border-gray-200 peer-checked:bg-violet-700 peer-checked:border-violet-700 transition-all flex items-center justify-center">
                    <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="text-xs font-bold text-gray-600">Tampilkan Nama Publik</span>
            </label>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Foto Produk (Opsional)</label>
                <div class="flex items-center gap-4">
                    <label for="reviewImage" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl border-2 border-dashed border-gray-200 hover:border-violet-300 hover:bg-violet-50 transition-all cursor-pointer group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-xs font-bold text-gray-400 group-hover:text-violet-700 uppercase tracking-widest">Pilih Foto</span>
                        <input type="file" id="reviewImage" class="hidden" accept="image/*" onchange="previewReviewImage(this)">
                    </label>
                    <div id="imagePreviewContainer" class="hidden relative w-12 h-12 shrink-0">
                        <img id="imagePreview" src="" class="w-full h-full object-cover rounded-xl shadow-md border-2 border-white">
                        <button onclick="removeReviewImage()" class="absolute -top-2 -right-2 bg-violet-500 text-white rounded-full p-0.5 shadow-sm hover:scale-110 transition-transform">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-2 relative z-10">
            <button id="submitReviewBtn" class="w-full bg-violet-700 hover:shadow-xl hover:shadow-violet-200 text-white font-black py-3.5 rounded-xl transition-all active:scale-[0.98] shadow-lg shadow-violet-100 cursor-pointer">
                Kirim Ulasan
            </button>
            <button onclick="closeReviewModal()" class="w-full py-2 text-gray-400 text-[10px] font-bold hover:text-gray-600 transition-colors uppercase tracking-widest cursor-pointer">
                Lain Kali
            </button>
        </div>
    </div>
</div>

{{-- Confirmation Modal --}}
<div id="confirmActionModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-120 hidden transition-all duration-300 opacity-0">
    <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-sm w-full mx-4 p-10 transform scale-95 transition-all duration-300 text-center">
        <div class="bg-violet-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-8 border border-violet-100">
            <svg class="w-10 h-10 text-violet-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <h3 class="text-2xl font-black text-gray-900 mb-2" id="confirmModalTitle">Peringatan!</h3>
        <p class="text-sm text-gray-500 leading-relaxed mb-10 font-medium px-2" id="confirmModalMessage">Apakah Anda yakin ingin melakukan tindakan ini?</p>
        
        <div class="flex flex-col gap-3">
            <button id="confirmBtn" class="w-full bg-violet-700 hover:bg-violet-800 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-violet-100 active:scale-[0.98] uppercase text-xs tracking-widest cursor-pointer">
                Ya, Konfirmasi
            </button>
            <button onclick="closeConfirmModal()" class="w-full bg-gray-50 hover:bg-gray-100 text-gray-400 font-black py-4 rounded-2xl transition-all active:scale-[0.98] uppercase text-xs tracking-widest cursor-pointer">
                Batal
            </button>
        </div>
    </div>
</div>

<div id="successModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-130 hidden transition-all duration-300 opacity-0">
    <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-sm w-full mx-4 p-10 transform scale-95 transition-all duration-300 text-center">
        <div class="bg-emerald-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-8 relative border border-emerald-100">
            <div class="absolute inset-0 bg-emerald-400 rounded-full animate-ping opacity-20"></div>
            <svg class="w-10 h-10 text-emerald-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h3 class="text-2xl font-black text-gray-900 mb-2">Terima Kasih!</h3>
        <p class="text-sm text-gray-500 leading-relaxed mb-8 font-medium px-2">Ulasan Anda sangat berarti untuk membangun pengalaman belanja terbaik di TechPed.</p>
        
        <div class="inline-flex items-center gap-3 px-6 py-3 bg-violet-50 rounded-2xl border border-violet-100">
            <div id="successStarsContainer" class="flex gap-1"></div>
            <span class="text-[10px] font-black text-violet-700 uppercase tracking-widest">Ulasan Dikirim</span>
        </div>
    </div>
</div>

<script>
    let currentOrderId = null;
    let currentProductId = null;

    function openReviewModal(orderId, productId, productName, productImage) {
        currentOrderId = orderId;
        currentProductId = productId;
        document.getElementById('reviewProductName').innerText = productName;
        document.getElementById('reviewProductImage').src = productImage ? '/storage/' + productImage : '/images/no-image.png';
        document.getElementById('reviewRating').value = '0';
        document.getElementById('reviewComment').value = '';
        document.getElementById('reviewShowName').checked = true;
        
        // reset stars
        document.querySelectorAll('.rating-star svg').forEach(star => {
            star.classList.replace('text-amber-400', 'text-gray-200');
        });

        const modal = document.getElementById('reviewModal');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.remove('scale-95');
        }, 10);
    }

    function closeReviewModal() {
        const modal = document.getElementById('reviewModal');
        modal.classList.add('opacity-0');
        modal.querySelector('div').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Star rating handler
    document.querySelectorAll('.rating-star').forEach(btn => {
        btn.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            document.getElementById('reviewRating').value = rating;
            
            document.querySelectorAll('.rating-star svg').forEach((star, idx) => {
                if (idx < rating) {
                    star.classList.replace('text-gray-200', 'text-amber-400');
                    star.classList.add('animate-bounce');
                    setTimeout(() => star.classList.remove('animate-bounce'), 500);
                } else {
                    star.classList.replace('text-amber-400', 'text-gray-200');
                }
            });
        });
    });

    // Submit review via AJAX
    document.getElementById('submitReviewBtn').addEventListener('click', async function() {
        const rating = document.getElementById('reviewRating').value;
        const comment = document.getElementById('reviewComment').value;
        const showName = document.getElementById('reviewShowName').checked;
        const imageFile = document.getElementById('reviewImage').files[0];

        if (rating == 0) {
            alert('Pilih rating terlebih dahulu.');
            return;
        }

        this.disabled = true;
        const originalText = this.innerHTML;
        this.innerHTML = '<svg class="animate-spin h-5 w-5 text-white mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

        try {
            const formData = new FormData();
            formData.append('order_id', currentOrderId);
            formData.append('product_id', currentProductId);
            formData.append('rating', rating);
            formData.append('komentar', comment);
            formData.append('show_name', showName);
            if (imageFile) {
                formData.append('gambar', imageFile);
            }

            const response = await fetch('{{ route('reviews.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await response.json();
            if (data.success) {
                closeReviewModal();
                showSuccessModal(rating);
            } else {
                alert('Gagal mengirim ulasan: ' + (data.message || 'Terjadi kesalahan'));
                this.disabled = false;
                this.innerHTML = originalText;
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan, coba lagi.');
            this.disabled = false;
            this.innerHTML = originalText;
        }
    });

    window.previewReviewImage = function(input) {
        const container = document.getElementById('imagePreviewContainer');
        const preview = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    window.removeReviewImage = function() {
        const input = document.getElementById('reviewImage');
        const container = document.getElementById('imagePreviewContainer');
        input.value = '';
        container.classList.add('hidden');
    }

    // Confirmation Modal System
    let currentActionModule = { action: '', orderId: null };

    function confirmAction(action, orderId) {
        currentActionModule = { action, orderId };
        
        const title = document.getElementById('confirmModalTitle');
        const message = document.getElementById('confirmModalMessage');
        const btn = document.getElementById('confirmBtn');

        if (action === 'cancel') {
            title.innerText = 'Batal Pesanan?';
            message.innerText = 'Pesanan ini akan dibatalkan secara permanen. Barang akan dikembalikan ke stok.';
            btn.className = btn.className.replace(/bg-(rose|emerald|violet)-(600|700|800)/g, 'bg-violet-700 hover:bg-violet-800 cursor-pointer').replace('shadow-violet-100', 'shadow-violet-100');
            btn.innerText = 'Ya, Batalkan';
        } else if (action === 'complete') {
            title.innerText = 'Konfirmasi Terima?';
            message.innerText = 'Pastikan pesanan sudah diterima dengan lengkap. Tindakan ini tidak dapat diubah.';
            btn.className = btn.className.replace(/bg-(rose|emerald|violet)-(600|700|800)/g, 'bg-violet-700 hover:bg-violet-800 cursor-pointer').replace('shadow-violet-100', 'shadow-violet-100');
            btn.innerText = 'Ya, Sudah Terima';
        } else {
            title.innerText = 'Hapus Riwayat?';
            message.innerText = 'Catatan pesanan ini akan dihapus permanen dari akun Anda.';
            btn.className = btn.className.replace(/bg-(rose|emerald|violet)-(600|700|800)/g, 'bg-violet-700 hover:bg-violet-800 cursor-pointer').replace('shadow-violet-100', 'shadow-violet-100');
            btn.innerText = 'Ya, Hapus Saja';
        }

        const modal = document.getElementById('confirmActionModal');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.remove('scale-95');
        }, 10);
    }

    window.copyResi = function(text) {
        navigator.clipboard.writeText(text).then(() => {
            if(typeof Swal !== 'undefined') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    iconColor: '#7c3aed',
                    title: 'Resi berhasil disalin!',
                    text: text,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    showCloseButton: true,
                    customClass: {
                        popup: '!bg-white !rounded-2xl !shadow-2xl border border-gray-100',
                        title: '!text-violet-700 !font-bold !text-sm',
                        htmlContainer: '!text-gray-500 !text-xs !font-medium'
                    }
                });
            } else {
                alert('Resi ' + text + ' disalin!');
            }
        });
    }

    function closeConfirmModal() {
        const modal = document.getElementById('confirmActionModal');
        modal.classList.add('opacity-0');
        modal.querySelector('div').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.getElementById('confirmBtn').addEventListener('click', function() {
        const { action, orderId } = currentActionModule;
        if (action && orderId) {
            if (action === 'complete') {
                document.getElementById(`complete-form-${orderId}`).submit();
            } else if (action === 'cancel') {
                document.getElementById(`cancel-form-${orderId}`).submit();
            } else {
                document.getElementById(`delete-form-${orderId}`).submit();
            }
        }
    });

    // Success Modal Logic
    function showSuccessModal(rating) {
        const modal = document.getElementById('successModal');
        const container = document.getElementById('successStarsContainer');
        container.innerHTML = '';
        for (let i = 0; i < 5; i++) {
            const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            svg.setAttribute('class', `w-4 h-4 ${i < rating ? 'text-amber-400' : 'text-gray-200'}`);
            svg.setAttribute('fill', 'currentColor');
            svg.setAttribute('viewBox', '0 0 20 20');
            svg.innerHTML = '<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.068 9.382c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.955z"/>';
            container.appendChild(svg);
        }

        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.remove('scale-95');
        }, 10);
        setTimeout(() => window.location.reload(), 2500);
    }

    // Modal backdrop closures
    [document.getElementById('confirmActionModal'), document.getElementById('reviewModal')].forEach(m => {
        m.addEventListener('click', function(e) { if (e.target === this) {
            if (this.id === 'reviewModal') closeReviewModal();
            else closeConfirmModal();
        }});
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
    @keyframes fade-in-down {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fade-in-up 0.6s ease-out both; }
    .animate-fade-in { animation: fade-in 0.8s ease-out both; }
    .animate-fade-in-down { animation: fade-in-down 0.5s ease-out both; }
    .no-scrollbar::-webkit-scrollbar { display: none !important; }
    .no-scrollbar { 
        -ms-overflow-style: none !important; 
        scrollbar-width: none !important; 
        -webkit-overflow-scrolling: touch;
    }
    .no-scrollbar::-webkit-scrollbar-track { background: transparent !important; }
    .no-scrollbar::-webkit-scrollbar-thumb { background: transparent !important; }
</style>
@endsection