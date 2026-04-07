@extends('admin.layouts.app')

@section('title', 'Pesan Kontak')

@section('content')
<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-[18px] font-semibold text-black">
                Pesan Masuk
            </h1>
            <p class="text-[12px] text-gray-600">
                Lihat dan kelola pesan yang dikirim oleh pengunjung atau pengguna.
            </p>
        </div>
    </div>


    <div class="w-full bg-white rounded-md border border-gray-300 p-4">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-50/50 border-b border-gray-200">
                    <tr>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-2">Nama</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-2">Email</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-2">Telepon</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-2">Tanggal</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Status</th>
                        <th class="text-center text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($messages as $msg)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-all duration-200 {{ !$msg->is_read ? 'bg-violet-50/20' : '' }}">
                            <td class="py-4 px-4 text-[11px] font-semibold text-gray-800">
                                {{ $msg->name }}
                            </td>
                            <td class="py-4 px-4 text-[11px] text-gray-600 font-medium">{{ $msg->email }}</td>
                            <td class="py-4 px-4 text-[11px] text-gray-600">{{ $msg->phone }}</td>
                            <td class="py-4 px-4 text-[11px] text-gray-500">{{ $msg->created_at->format('d M Y, H:i') }}</td>
                            <td class="py-4 px-4">
                                @if (!$msg->is_read)
                                    <span class="px-2.5 py-1 text-[9px] rounded-full bg-violet-100 text-violet-700 font-bold border border-violet-200 flex items-center justify-center w-fit gap-1">
                                        <span class="w-1.5 h-1.5 bg-violet-500 rounded-full animate-pulse"></span>
                                        Baru
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-[9px] rounded-full bg-gray-50 text-gray-500 font-medium border border-gray-200 flex items-center justify-center w-fit">
                                        Dibaca
                                    </span>
                                @endif
                            </td>
                            
                            <td class="py-3 px-2 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.contact.show', $msg->id) }}" class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150">
                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.5 9.375C8.53553 9.375 9.375 8.53553 9.375 7.5C9.375 6.46447 8.53553 5.625 7.5 5.625C6.46447 5.625 5.625 6.46447 5.625 7.5C5.625 8.53553 6.46447 9.375 7.5 9.375Z" fill="#6D28D9"/>
                                            <path d="M14.5029 7.34062C13.9516 5.91452 12.9945 4.68123 11.7499 3.79317C10.5052 2.9051 9.02768 2.40121 7.4998 2.34375C5.97192 2.40121 4.49436 2.9051 3.24974 3.79317C2.00512 4.68123 1.048 5.91452 0.496676 7.34062C0.459441 7.44361 0.459441 7.55639 0.496676 7.65938C1.048 9.08548 2.00512 10.3188 3.24974 11.2068C4.49436 12.0949 5.97192 12.5988 7.4998 12.6562C9.02768 12.5988 10.5052 12.0949 11.7499 11.2068C12.9945 10.3188 13.9516 9.08548 14.5029 7.65938C14.5402 7.55639 14.5402 7.44361 14.5029 7.34062ZM7.4998 10.5469C6.89719 10.5469 6.3081 10.3682 5.80705 10.0334C5.30599 9.69859 4.91547 9.22273 4.68486 8.66599C4.45424 8.10924 4.39391 7.49662 4.51147 6.90558C4.62903 6.31455 4.91922 5.77165 5.34533 5.34553C5.77145 4.91942 6.31435 4.62923 6.90538 4.51167C7.49642 4.39411 8.10905 4.45444 8.66579 4.68505C9.22253 4.91567 9.69839 5.30619 10.0332 5.80725C10.368 6.3083 10.5467 6.89739 10.5467 7.5C10.5454 8.3077 10.224 9.08197 9.6529 9.6531C9.08177 10.2242 8.3075 10.5456 7.4998 10.5469Z" fill="#6D28D9"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.contact.destroy', $msg->id) }}" method="POST" onsubmit="confirmAction(event, 'Hapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150">
                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 3.5H9.75M4.125 5.375V10.375M6.625 5.375V10.375M4.125 1H6.625C6.79076 1 6.94973 1.06585 7.06694 1.18306C7.18415 1.30027 7.25 1.45924 7.25 1.625V3.5H3.5V1.625C3.5 1.45924 3.56585 1.30027 3.68306 1.18306C3.80027 1.06585 3.95924 1 4.125 1ZM1.625 3.5H9.125V11.625C9.125 11.7908 9.05915 11.9497 8.94194 12.0669C8.82473 12.1842 8.66576 12.25 8.5 12.25H2.25C2.08424 12.25 1.92527 12.1842 1.80806 12.0669C1.69085 11.9497 1.625 11.7908 1.625 11.625V3.5Z" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center">
                                <p class="text-[11px] text-slate-400">
                                    Belum ada pesan yang diterima
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
