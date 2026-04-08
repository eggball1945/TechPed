@extends('admin.layouts.app')

@section('title', 'Detail Komplain')

@section('content')
<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <nav class="flex items-center gap-2 text-[10px] text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-violet-700">Dashboard</a>
                <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('admin.complaints.index') }}" class="hover:text-violet-700">Komplain</a>
                <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                <span class="text-gray-600">#{{ $complaint->id }}</span>
            </nav>
            <h1 class="text-[18px] font-semibold text-black flex items-center gap-3">
                Detail Komplain
                <span class="px-2 py-0.5 rounded text-[9px] font-medium {{ $complaint->type === 'DAMAGED' ? 'bg-violet-100 text-violet-700' : 'bg-sky-100 text-sky-700' }}">
                    {{ $complaint->type === 'DAMAGED' ? 'Barang Rusak' : 'Paket Belum Sampai' }}
                </span>
            </h1>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-[10px] font-medium text-gray-500">Status:</span>
            @php
                $statusClasses = [
                    'PENDING' => 'bg-orange-100 text-orange-700',
                    'IN_PROGRESS' => 'bg-blue-100 text-blue-700',
                    'RESOLVED' => 'bg-emerald-100 text-emerald-700',
                    'REJECTED' => 'bg-violet-100 text-violet-700',
                ];
            @endphp
            <span class="px-2 py-0.5 rounded text-[9px] font-bold {{ $statusClasses[$complaint->status] ?? 'bg-gray-100 text-gray-700' }}">
                {{ str_replace('_', ' ', $complaint->status) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Description Card --}}
            <div class="bg-white rounded-md border border-gray-300 p-6">
                <h3 class="text-[12px] font-semibold text-black mb-4 pb-3 border-b border-gray-100">Deskripsi Masalah</h3>
                <div class="text-[11px] text-gray-700 leading-relaxed bg-gray-50 p-4 rounded border border-gray-200">
                    {{ $complaint->description }}
                </div>
            </div>

            {{-- Evidence Card (Video) --}}
            @if($complaint->evidence_video)
            <div class="bg-white rounded-md border border-gray-300 p-6">
                <h3 class="text-[12px] font-semibold text-black mb-4 pb-3 border-b border-gray-100 flex items-center justify-between">
                    Bukti Video Unboxing
                    <span class="text-[9px] text-violet-600 font-bold bg-violet-50 px-2 py-0.5 rounded">Wajib Tanpa Edit</span>
                </h3>
                <div class="aspect-video bg-black rounded overflow-hidden shadow-sm relative group">
                    <video id="unboxing-video" class="w-full h-full" controls>
                        <source src="{{ asset('storage/' . $complaint->evidence_video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            @endif

            {{-- Update Status Card --}}
            <div class="bg-white rounded-md border border-gray-300 p-6">
                <h3 class="text-[12px] font-semibold text-black mb-6 pb-3 border-b border-gray-100">Tindakan Petugas</h3>
                <form action="{{ route('admin.complaints.update', $complaint->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-medium text-gray-500 ml-0.5">Perbarui Status</label>
                            <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded px-3 py-2 text-[11px] font-medium focus:border-violet-700 focus:outline-none transition-all">
                                <option value="PENDING" {{ $complaint->status === 'PENDING' ? 'selected' : '' }}>Tertunda (Pending)</option>
                                <option value="IN_PROGRESS" {{ $complaint->status === 'IN_PROGRESS' ? 'selected' : '' }}>Sedang Ditinjau (In Progress)</option>
                                <option value="RESOLVED" {{ $complaint->status === 'RESOLVED' ? 'selected' : '' }}>Selesai/Diterima (Resolved)</option>
                                <option value="REJECTED" {{ $complaint->status === 'REJECTED' ? 'selected' : '' }}>Ditolak (Rejected)</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-violet-700 hover:bg-violet-800 text-white font-bold py-2 px-4 rounded transition-all active:scale-95 text-[11px] uppercase">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar Info --}}
        <div class="space-y-6">
            {{-- User Info --}}
            <div class="bg-white rounded-md border border-gray-300 p-5">
                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-4">Informasi Pelanggan</h4>
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded bg-violet-100 flex items-center justify-center text-violet-700 font-bold text-base">
                        {{ strtoupper(substr($complaint->user->nama_depan ?? $complaint->user->username, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-[12px] font-bold text-black truncate">{{ $complaint->user->nama_depan ?? $complaint->user->username }}</p>
                        <p class="text-[10px] text-gray-500 truncate">{{ $complaint->user->email }}</p>
                    </div>
                </div>
                <div class="space-y-2.5">
                    <div class="flex justify-between text-[10px]">
                        <span class="text-gray-500">Username</span>
                        <span class="font-medium text-black">{{ $complaint->user->nama_depan }}</span>
                    </div>
                    <div class="flex justify-between text-[10px]">
                        <span class="text-gray-500">No. Telepon</span>
                        <span class="font-medium text-black">{{ $complaint->user->no_telepon ?? '-' }}</span>
                    </div>
                </div>
            </div>

            {{-- Order Info --}}
            <div class="bg-white rounded-md border border-gray-300 p-5">
                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-4">Informasi Pesanan</h4>
                <div class="space-y-3">
                    <div class="flex justify-between items-center text-[10px]">
                        <span class="text-gray-500">Order ID</span>
                        <span class="font-bold text-violet-700">#{{ $complaint->order_id }}</span>
                    </div>
                    <div class="flex justify-between items-center text-[10px]">
                        <span class="text-gray-500">Total Harga</span>
                        <span class="font-medium text-black">Rp {{ number_format($complaint->order->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-[10px]">
                        <span class="text-gray-500">No. Resi</span>
                        <span class="font-medium text-violet-600">{{ $complaint->order->resi ?? 'Belum Ada' }}</span>
                    </div>
                </div>
                <div class="mt-5 pt-4 border-t border-gray-100">
                    <p class="text-[9px] font-bold text-gray-400 uppercase mb-3 text-center">Item Pesanan</p>
                    <div class="space-y-2">
                        @foreach($complaint->order->products as $product)
                        <div class="flex items-center gap-2 p-1.5 bg-gray-50 rounded border border-gray-100">
                            <img src="{{ $product->gambar_array[0] ? asset('storage/' . $product->gambar_array[0]) : asset('images/no-image.png') }}" class="w-7 h-7 rounded object-cover">
                            <div class="min-w-0">
                                <p class="text-[9px] font-bold text-gray-800 truncate">{{ $product->nama_produk }}</p>
                                <p class="text-[8px] text-gray-500">Qty: {{ $product->pivot->jumlah }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Petugas handling --}}
            @if($complaint->petugas)
            <div class="bg-emerald-50 rounded-md border border-emerald-100 p-5">
                <h4 class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider mb-3">Ditangani Oleh</h4>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded bg-emerald-600 flex items-center justify-center text-white text-[10px] font-bold">
                        {{ strtoupper(substr($complaint->petugas->username, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-bold text-emerald-900 truncate">{{ $complaint->petugas->username }}</p>
                        <p class="text-[9px] text-emerald-600">Petugas</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
