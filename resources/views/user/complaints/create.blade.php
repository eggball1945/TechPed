@extends('user.layouts.app')

@section('title', 'Ajukan Komplain | TechPed')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">
    {{-- Hero Section --}}
    <div class="relative bg-violet-600 rounded-t-[3rem] pt-32 pb-24 overflow-hidden shadow-2xl shadow-violet-200/50">
        
        <div class="container mx-auto px-4 relative z-10 max-w-4xl">
            <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-violet-100 mb-10 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in font-sans">
                <a href="{{ route('landing') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-2.5 h-2.5 text-violet-300 opacity-50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                <a href="{{ route('orders') }}" class="hover:text-white transition-colors">Pesanan Saya</a>
                <svg class="w-2.5 h-2.5 text-violet-300 opacity-50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                <span class="text-white truncate">Ajukan Komplain</span>
            </nav>
            
            <div class="animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-violet-50 text-xs font-bold tracking-wider uppercase mb-5 border border-white/10">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Pusat Bantuan
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-white leading-tight">
                    Ajukan Komplain
                </h1>
                <p class="text-violet-100/80 mt-4 font-medium max-w-lg leading-relaxed">
                    Kami di sini untuk membantu menyelesaikan masalah pada pesanan Anda dengan cepat dan transparan.
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-12 relative z-20 max-w-4xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Order Summary Card --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 p-6 border border-gray-50 sticky top-24">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-50 pb-4">Ringkasan Pesanan</h3>
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-2xl p-4">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">ID Transaksi</p>
                            <p class="text-sm font-bold text-gray-900">TRX-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-2xl p-4">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tanggal Pesanan</p>
                            <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($order->tanggal)->format('d F Y') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-2xl p-4">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</p>
                            <div class="inline-flex px-3 py-1 bg-violet-50 text-violet-700 rounded-lg text-xs font-black uppercase mt-1">
                                {{ ucfirst($order->status) }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-50">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Produk</h4>
                        <div class="space-y-3">
                            @foreach($order->products as $product)
                            <div class="flex items-center gap-3">
                                <img src="{{ $product->gambar_array[0] ? asset('storage/' . $product->gambar_array[0]) : asset('images/no-image.png') }}" class="w-10 h-10 rounded-lg object-cover shadow-sm">
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-gray-800 truncate">{{ $product->nama_produk }}</p>
                                    <p class="text-[10px] font-bold text-gray-400">Qty: {{ $product->pivot->jumlah }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Complaint Form Card --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 p-8 md:p-12 border border-gray-50 animate-fade-in-up">
                    <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <div class="space-y-8">
                            {{-- Complaint Type Selection --}}
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Pilih Jenis Masalah</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="relative group cursor-pointer">
                                        <input type="radio" name="type" value="DAMAGED" class="peer hidden" checked onchange="toggleFormFields(this.value)">
                                        <div class="p-5 rounded-3xl border-2 border-gray-100 bg-white peer-checked:border-violet-500 peer-checked:bg-violet-50 transition-all group-hover:bg-gray-50">
                                            <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center text-violet-600 mb-4 group-hover:scale-110 transition-transform">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                            </div>
                                            <h4 class="font-black text-gray-900">Barang Rusak</h4>
                                            <p class="text-xs font-medium text-gray-500 mt-1 leading-relaxed">Barang diterima dalam kondisi cacat/rusak.</p>
                                            <div class="absolute top-4 right-4 text-violet-500 opacity-0 peer-checked:opacity-100 transition-opacity">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="relative group {{ $is_delayed ? 'cursor-pointer' : 'cursor-not-allowed opacity-60' }}">
                                        <input type="radio" name="type" value="DELAYED" class="peer hidden" {{ !$is_delayed ? 'disabled' : '' }} onchange="toggleFormFields(this.value)">
                                        <div class="p-5 rounded-3xl border-2 border-gray-100 bg-white peer-checked:border-sky-500 peer-checked:bg-sky-50 transition-all {{ $is_delayed ? 'group-hover:bg-gray-50' : '' }}">
                                            <div class="w-12 h-12 rounded-2xl bg-sky-100 flex items-center justify-center text-sky-600 mb-4 {{ $is_delayed ? 'group-hover:scale-110' : '' }} transition-transform">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <h4 class="font-black text-gray-900">Paket Belum Sampai</h4>
                                            <p class="text-xs font-medium text-gray-500 mt-1 leading-relaxed">
                                                @if($is_delayed)
                                                    Tersedia untuk pesanan lebih dari 7 hari.
                                                @else
                                                    Tersedia setelah 7 hari pengiriman.
                                                @endif
                                            </p>
                                            <div class="absolute top-4 right-4 text-sky-500 opacity-0 peer-checked:opacity-100 transition-opacity">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @if(!$is_delayed)
                                    <p class="mt-3 text-[10px] font-bold text-gray-400 italic">
                                        * Opsi "Paket Belum Sampai" hanya aktif jika pesanan sudah melewati 7 hari dari tanggal transaksi.
                                    </p>
                                @endif
                            </div>

                            {{-- Description --}}
                            <div class="animate-fade-in" style="animation-delay: 100ms">
                                <label for="description" class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Ceritakan Masalah Anda</label>
                                <textarea name="description" id="description" rows="5" class="w-full rounded-2xl border-2 border-gray-100 bg-gray-50 px-6 py-4 text-sm font-medium focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none resize-none" placeholder="Jelaskan secara detail masalah yang Anda hadapi agar kami dapat memprosesnya dengan lebih cepat..." required></textarea>
                            </div>

                            {{-- Video Evidence (Damaged only) --}}
                            <div id="video-field" class="animate-fade-in" style="animation-delay: 200ms">
                                <div class="bg-violet-50/50 border-2 border-dashed border-violet-100 rounded-[2.5rem] p-8 md:p-10 text-center group hover:bg-violet-50 hover:border-violet-200 transition-all">
                                    <div class="w-16 h-16 rounded-full bg-violet-100 flex items-center justify-center text-violet-600 mx-auto mb-6 group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </div>
                                    <h4 class="text-lg font-black text-gray-900 mb-2">Video Unboxing (Wajib)</h4>
                                    <p class="text-sm font-medium text-gray-500 max-w-sm mx-auto mb-8 leading-relaxed">
                                        Harus menyertakan video unboxing <span class="text-violet-600 font-bold whitespace-nowrap">tanpa edit atau potong-potong</span> sebagai syarat sah komplain barang rusak.
                                    </p>
                                    
                                    <label class="inline-flex items-center gap-3 bg-white hover:bg-violet-600 hover:text-white text-violet-600 border-2 border-violet-100 hover:border-violet-600 font-black px-10 py-4 rounded-2xl transition-all cursor-pointer shadow-lg shadow-violet-100 active:scale-95 group/btn">
                                        <span class="uppercase tracking-widest text-xs">Pilih Video</span>
                                        <input type="file" name="evidence_video" id="evidence_video" accept="video/*" class="hidden" onchange="previewVideo(this)">
                                        <svg class="w-5 h-5 group-hover/btn:translate-y-[-2px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                    </label>

                                    <div id="video-preview-info" class="hidden mt-6 items-center justify-center gap-3 p-3 bg-white rounded-xl border border-violet-100 max-w-xs mx-auto">
                                        <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        <span id="video-filename" class="text-xs font-bold text-gray-600 truncate max-w-[150px]">video.mp4</span>
                                        <button type="button" onclick="removeVideo()" class="text-gray-300 hover:text-violet-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Form Actions --}}
                            <div class="pt-8 border-t border-gray-50 flex flex-col md:flex-row items-center gap-4">
                                <button type="submit" class="w-full md:w-auto flex-1 bg-violet-600 hover:bg-violet-700 hover:shadow-2xl hover:shadow-violet-200 text-white font-black px-12 py-5 rounded-2xl transition-all active:scale-[0.98] group shadow-xl shadow-violet-100 flex items-center justify-center gap-3 cursor-pointer">
                                    <span class="uppercase tracking-widest text-xs">Kirim Komplain Sekarang</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </button>
                                <a href="{{ route('orders') }}" class="w-full md:w-auto text-gray-400 hover:text-gray-900 font-bold px-8 py-5 transition-colors uppercase tracking-widest text-xs text-center">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Help Suggestion --}}
                <div class="mt-8 bg-violet-600 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl shadow-violet-100/50 animate-fade-in" style="animation-delay: 400ms">
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                        <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-black mb-1">Butuh bantuan lebih cepat?</h4>
                            <p class="text-violet-100/80 text-sm font-medium leading-relaxed">Tim dukungan kami siap melayani Anda melalui live chat 24/7 untuk setiap kendala teknologi Anda.</p>
                        </div>
                        <a href="{{ route('kontak') }}" class="whitespace-nowrap bg-white text-violet-700 font-black px-6 py-3 rounded-xl text-xs uppercase tracking-widest hover:bg-violet-50 transition-all shadow-lg active:scale-95">Chat Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFormFields(type) {
        const videoField = document.getElementById('video-field');
        const videoInput = document.getElementById('evidence_video');
        
        if (type === 'DELAYED') {
            videoField.classList.add('hidden');
            videoInput.removeAttribute('required');
        } else {
            videoField.classList.remove('hidden');
            videoInput.setAttribute('required', 'required');
        }
    }

    function previewVideo(input) {
        const previewInfo = document.getElementById('video-preview-info');
        const filename = document.getElementById('video-filename');
        
        if (input.files && input.files[0]) {
            filename.innerText = input.files[0].name;
            previewInfo.classList.remove('hidden');
        }
    }

    function removeVideo() {
        const input = document.getElementById('evidence_video');
        const previewInfo = document.getElementById('video-preview-info');
        input.value = '';
        previewInfo.classList.add('hidden');
    }

    // Initialize state
    document.addEventListener('DOMContentLoaded', () => {
        toggleFormFields(document.querySelector('input[name="type"]:checked').value);
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
    .hide-scrollbar::-webkit-scrollbar { display: none; }
</style>
@endsection
