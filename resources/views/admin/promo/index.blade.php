@extends('admin.layouts.app')

@section('title', 'Kelola Promo')

@section('content')
<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-[18px] font-semibold text-black">
                Kelola Promo
            </h1>
            <p class="text-[12px] text-gray-600">
                Atur promosi dan batas masa berlaku promo produk.
            </p>
        </div>

        <button onclick="document.getElementById('modalTambahPromo').classList.remove('hidden')" class="w-[91px] h-6 bg-white flex items-center justify-center gap-1 rounded border-gray-300 shadow cursor-pointer">
            <div class="w-[15px] h-[15px] flex items-center justify-center">
                <svg class="w-[7.5px] h-[7.5px] text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <span class="font-medium text-[8px] leading-[10px] text-black">
                Tambah Promo
            </span>
        </button>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded text-[12px]">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded text-[12px]">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/50 border-b border-gray-200">
                <tr>
                    <th class="px-2 py-3 text-left text-[9px] font-bold text-black uppercase tracking-widest">No</th>
                    <th class="px-2 py-3 text-left text-[9px] font-bold text-black uppercase tracking-widest">Nama Promo</th>
                    <th class="px-2 py-3 text-left text-[9px] font-bold text-black uppercase tracking-widest">Batas Waktu</th>
                    <th class="px-2 py-3 text-left text-[9px] font-bold text-black uppercase tracking-widest">Diperbarui</th>
                    <th class="px-4 py-3 text-right text-[9px] font-bold text-black uppercase tracking-widest">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-[12px] text-gray-700">
                @forelse($promos as $index => $promo)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $promos->firstItem() + $index }}</td>
                    <td class="px-4 py-3 font-medium text-black">{{ $promo->name }}</td>
                    <td class="px-4 py-3">{{ $promo->end_date->format('d M Y H:i:s') }}</td>
                    <td class="px-4 py-3">{{ $promo->updated_at->diffForHumans() }}</td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="editPromo({{ $promo->id }}, '{{ $promo->name }}', '{{ $promo->end_date->format('Y-m-d\TH:i') }}')" class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.375 4.375H3.75C3.41848 4.375 3.10054 4.5067 2.86612 4.74112C2.6317 4.97554 2.5 5.29348 2.5 5.625V11.25C2.5 11.5815 2.6317 11.8995 2.86612 12.1339C3.10054 12.3683 3.41848 12.5 3.75 12.5H9.375C9.70652 12.5 10.0245 12.3683 10.2589 12.1339C10.4933 11.8995 10.625 11.5815 10.625 11.25V10.625" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 3.12501L11.875 5.00001M12.7406 4.11563C12.9868 3.86948 13.1251 3.53562 13.1251 3.18751C13.1251 2.83939 12.9868 2.50553 12.7406 2.25938C12.4945 2.01323 12.1606 1.87494 11.8125 1.87494C11.4644 1.87494 11.1305 2.01323 10.8844 2.25938L5.625 7.50001V9.37501H7.5L12.7406 4.11563Z" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <form action="{{ route('admin.promo.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Hapus promo ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150">
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.125 4.375H11.875M6.25 6.25V11.25M8.75 6.25V11.25M6.25 1.875H8.75C8.91576 1.875 9.07473 1.94085 9.19194 2.05806C9.30915 2.17527 9.375 2.33424 9.375 2.5V4.375H5.625V2.5C5.625 2.33424 5.69085 2.17527 5.80806 2.05806C5.92527 1.94085 6.08424 1.875 6.25 1.875ZM3.75 4.375H11.25V12.5C11.25 12.6658 11.1842 12.8247 11.0669 12.9419C10.9497 13.0592 10.7908 13.125 10.625 13.125H4.375C4.20924 13.125 4.05027 13.0592 3.93306 12.9419C3.81585 12.8247 3.75 12.6658 3.75 12.5V4.375Z" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        Belum ada promo.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($promos->hasPages())
        <div class="px-4 py-3 border-t border-gray-200">
            {{ $promos->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah/Edit Promo -->
<div id="modalTambahPromo" class="hidden fixed flex inset-0 bg-black/40 items-center justify-center z-50">
    <div class="w-[392px] bg-white rounded-lg shadow-lg p-5 relative">
        <h2 id="modalTitle" class="font-semibold text-[15px] text-black mb-4">
            Tambah Promo Baru
        </h2>

        <form id="formPromo" method="POST" action="{{ route('admin.promo.store') }}">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <div class="mb-4">
                <label class="block font-medium text-[12px] text-gray-700 mb-1">Nama Promo</label>
                <input type="text" name="name" id="promoName" required placeholder="Contoh: hardware_promo" class="w-full h-8 px-2 text-[12px] border border-gray-300 rounded focus:border-violet-700 outline-none">
                <p class="text-[10px] text-gray-500 mt-1">Ganti 'hardware_promo' akan berdampak pada timer landing page.</p>
            </div>

            <div class="mb-5">
                <label class="block font-medium text-[12px] text-gray-700 mb-1">Batas Waktu (End Date)</label>
                <input type="datetime-local" name="end_date" id="promoEndDate" required class="w-full h-8 px-2 text-[12px] border border-gray-300 rounded focus:border-violet-700 outline-none">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="px-4 py-1.5 bg-gray-200 text-gray-700 text-[12px] rounded font-medium hover:bg-gray-300 transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-4 py-1.5 bg-violet-700 text-white text-[12px] rounded font-medium hover:bg-violet-800 transition cursor-pointer">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('modalTambahPromo').classList.add('hidden');
        document.getElementById('formPromo').reset();
        document.getElementById('formPromo').action = "{{ route('admin.promo.store') }}";
        document.getElementById('formMethod').value = "POST";
        document.getElementById('modalTitle').innerText = "Tambah Promo Baru";
    }

    function editPromo(id, name, endDate) {
        document.getElementById('modalTambahPromo').classList.remove('hidden');
        document.getElementById('modalTitle').innerText = "Edit Promo";
        document.getElementById('formPromo').action = "/admin/promo/" + id;
        document.getElementById('formMethod').value = "PUT";
        
        document.getElementById('promoName').value = name;
        document.getElementById('promoEndDate').value = endDate;
    }
</script>
@endsection
