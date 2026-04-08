@extends('petugas.layouts.app')

@section('title', 'Kelola Komplain')

@section('content')
<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-[18px] font-semibold text-black">
                Kelola Komplain Pelanggan
            </h1>
            <p class="text-[12px] text-gray-600">
                Tinjau dan proses klaim barang rusak atau paket yang belum sampai.
            </p>
        </div>
    </div>

    <div class="w-full bg-white rounded-md border border-gray-300 p-4">
        <div class="w-full overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-50/50 border-b border-gray-200">
                    <tr>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">ID</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Pelanggan</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Order ID</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Jenis</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Tanggal</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Status</th>
                        <th class="text-center text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $complaint)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                        <td class="py-4 px-4 text-[10px] font-medium text-black">#{{ $complaint->id }}</td>
                        <td class="py-4 px-4">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-black">{{ $complaint->user->nama_depan ?? $complaint->user->username }}</span>
                                <span class="text-[9px] text-gray-500">{{ $complaint->user->email }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-[10px] font-medium text-violet-700">#{{ $complaint->order_id }}</td>
                        <td class="py-4 px-4">
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-medium {{ $complaint->type === 'DAMAGED' ? 'bg-violet-100 text-violet-700' : 'bg-sky-100 text-sky-700' }}">
                                {{ $complaint->type === 'DAMAGED' ? 'Barang Rusak' : 'Paket Belum Sampai' }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-[10px] text-gray-600">{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-4 px-4">
                            @php
                                $statusClasses = [
                                    'PENDING' => 'bg-orange-100 text-orange-700',
                                    'IN_PROGRESS' => 'bg-blue-100 text-blue-700',
                                    'RESOLVED' => 'bg-emerald-100 text-emerald-700',
                                    'REJECTED' => 'bg-violet-100 text-violet-700',
                                ];
                            @endphp
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-medium {{ $statusClasses[$complaint->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ str_replace('_', ' ', $complaint->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <div class="flex justify-center">
                                <a href="{{ route('petugas.complaints.show', $complaint->id) }}" class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 text-violet-700 transition-colors duration-150" title="Detail">
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 9.375C8.53553 9.375 9.375 8.53553 9.375 7.5C9.375 6.46447 8.53553 5.625 7.5 5.625C6.46447 5.625 5.625 6.46447 5.625 7.5C5.625 8.53553 6.46447 9.375 7.5 9.375Z" fill="currentColor"/>
                                        <path d="M14.5029 7.34062C13.9516 5.91452 12.9945 4.68123 11.7499 3.79317C10.5052 2.9051 9.02768 2.40121 7.4998 2.34375C5.97192 2.40121 4.49436 2.9051 3.24974 3.79317C2.00512 4.68123 1.048 5.91452 0.496676 7.34062C0.459441 7.44361 0.459441 7.55639 0.496676 7.65938C1.048 9.08548 2.00512 10.3188 3.24974 11.2068C4.49436 12.0949 5.97192 12.5988 7.4998 12.6562C9.02768 12.5988 10.5052 12.0949 11.7499 11.2068C12.9945 10.3188 13.9516 9.08548 14.5029 7.65938C14.5402 7.55639 14.5402 7.44361 14.5029 7.34062ZM7.4998 10.5469C6.89719 10.5469 6.3081 10.3682 5.80705 10.0334C5.30599 9.69859 4.91547 9.22273 4.68486 8.66599C4.45424 8.10924 4.39391 7.49662 4.51147 6.90558C4.62903 6.31455 4.91922 5.77165 5.34533 5.34553C5.77145 4.91942 6.31435 4.62923 6.90538 4.51167C7.49642 4.39411 8.10905 4.45444 8.66579 4.68505C9.22253 4.91567 9.69839 5.30619 10.0332 5.80725C10.368 6.3083 10.5467 6.89739 10.5467 7.5C10.5454 8.3077 10.224 9.08197 9.6529 9.6531C9.08177 10.2242 8.3075 10.5456 7.4998 10.5469Z" fill="currentColor"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center">
                            <p class="text-[12px] text-gray-400 italic">Belum ada komplain yang masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
