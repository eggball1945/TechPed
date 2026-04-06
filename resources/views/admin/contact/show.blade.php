@extends('admin.layouts.app')

@section('title', 'Detail Pesan')

@section('content')
<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-[18px] font-semibold text-black">
                Detail Pesan
            </h1>
            <p class="text-[12px] text-gray-600">
                Melihat rincian pesan dari pengguna.
            </p>
        </div>
        <a href="{{ route('admin.contact.index') }}" class="h-8 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded flex items-center gap-2 text-[11px] font-medium transition cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="w-full max-w-[800px] bg-white rounded-md border border-gray-300 p-8 shadow-sm">
        <div class="flex flex-col gap-6">
            <div class="flex justify-between items-start border-b border-gray-100 pb-4">
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] uppercase font-bold text-gray-400">Pengirim</span>
                    <h2 class="text-[16px] font-semibold text-black">{{ $message->name }}</h2>
                    <div class="flex gap-4 text-[12px] text-gray-600 mt-1">
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            {{ $message->email }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            {{ $message->phone }}
                        </span>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-[10px] uppercase font-bold text-gray-400">Tanggal</span>
                    <p class="text-[12px] font-medium text-gray-800">{{ $message->created_at->format('d F Y') }}</p>
                    <p class="text-[10px] text-gray-500">{{ $message->created_at->format('H:i') }}</p>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-[10px] uppercase font-bold text-gray-400 text-end">Isi Pesan</span>
                <div class="bg-gray-50/50 p-6 rounded-lg text-[13px] leading-relaxed text-gray-700 whitespace-pre-wrap border border-gray-100">
                    {{ $message->message }}
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <form action="{{ route('admin.contact.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini permanent?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="h-8 px-4 bg-red-50 hover:bg-red-100 text-red-600 rounded flex items-center gap-2 text-[11px] font-semibold transition cursor-pointer">
                        Hapus Pesan
                    </button>
                </form>
                <a href="mailto:{{ $message->email }}" class="h-8 px-4 bg-violet-700 hover:bg-violet-800 text-white rounded flex items-center gap-2 text-[11px] font-semibold transition cursor-pointer">
                    Balas via Email
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
