<div class="w-[1080px] bg-white rounded-md border border-gray-300 p-4">
    <div class="w-full bg-slate-50 border border-slate-200 rounded-full p-2 flex gap-3 text-[12px] font-medium">
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-full flex items-center {{ request('role') === null ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}"> Semua</a>
        <a href="{{ route('admin.users.index', ['role' => 'user']) }}" class="px-4 py-2 rounded-full flex items-center {{ request('role') === 'user' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">User</a>
        <a href="{{ route('admin.users.index', ['role' => 'petugas']) }}" class="px-4 py-2 rounded-full flex items-center {{ request('role') === 'petugas' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Petugas</a>
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="px-4 py-2 rounded-full flex items-center {{ request('role') === 'admin' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Admin</a>
    </div>

    <div class="w-[1037px] overflow-x-auto">
        <table class="w-full border-collapse">
            <tr class="grid grid-cols-6 border-b border-slate-200">
                <th class="text-left text-[10px] font-medium py-2 px-4">User</th>
                <th class="text-left text-[10px] font-medium py-2 px-4">Role</th>
                <th class="text-left text-[10px] font-medium py-2 px-4">Jumlah Order</th>
                <th class="text-left text-[10px] font-medium py-2 px-4">Total Belanja</th>
                <th class="text-left text-[10px] font-medium py-2 px-4">Status</th>
                <th class="text-center text-[10px] font-medium py-2 px-4">Aksi</th>
            </tr>

            @foreach($items as $item)
                <tr class="grid grid-cols-6 items-center border-b border-slate-100 hover:bg-slate-50 text-[11px]">

                    {{-- USER --}}
                    <td class="py-3 px-4">
                        <div class="flex flex-col">
                            <span class="font-medium text-slate-800">
                                {{ $item->nama }}
                            </span>
                            <span class="text-slate-500 text-[10px]">
                                {{ $item->email ?? '-' }}
                            </span>
                        </div>
                    </td>

                    {{-- ROLE --}}
                    <td class="px-4">
                        @if($item->role === 'user')
                            <span class="px-2 py-1 rounded-md text-[8px] font-medium w-[50px] h-[20px] flex items-center justify-center bg-slate-200 text-slate-700">Pelanggan</span>
                        @elseif($item->role === 'petugas')
                            <span class="px-2 py-1 rounded-md text-[8px] font-medium w-[45px] h-[20px] flex items-center justify-center bg-violet-700/40 text-violet-700">Petugas</span>
                        @else
                            <span class="px-2 py-1 rounded-md text-[8px] font-medium w-[45px] h-[20px] flex items-center justify-center bg-violet-700/40 text-violet-700">Admin</span>
                        @endif
                    </td>

                    {{-- JUMLAH ORDER --}}
                    <td class="px-4">
                        {{ $item->orders_count ?? 0 }}
                    </td>

                    {{-- TOTAL BELANJA --}}
                    <td class="px-4">
                        Rp {{ number_format($item->orders_sum ?? 0, 0, ',', '.') }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-4">
                        @if($item->role === 'user')
                            @if($item->is_suspended ?? false)
                                <span class="px-2 py-1 rounded-md text-[8px] font-medium w-[45px] h-[20px] flex items-center justify-center bg-red-100 text-red-600">Suspend</span>
                            @else
                                <span class="px-2 py-1 rounded-md text-[8px] font-medium w-[45px] h-[20px] flex items-center justify-center bg-green-100 text-green-600">Aktif</span>
                            @endif
                        @else
                            <span class="px-2 py-1 rounded-md text-[8px] font-medium w-[45px] h-[20px] flex items-center justify-center bg-green-100 text-green-600">Aktif</span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 text-center">
                        <div class="flex justify-center gap-2">

                            {{-- DELETE --}}
                            @if($item->role === 'user')
                                <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1 rounded cursor-pointer hover:bg-slate-200 transition" aria-label="Hapus User">
                                        <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 3.5H9.75M4.125 5.375V10.375M6.625 5.375V10.375M4.125 1H6.625C6.79076 1 6.94973 1.06585 7.06694 1.18306C7.18415 1.30027 7.25 1.45924 7.25 1.625V3.5H3.5V1.625C3.5 1.45924 3.56585 1.30027 3.68306 1.18306C3.80027 1.06585 3.95924 1 4.125 1ZM1.625 3.5H9.125V11.625C9.125 11.7908 9.05915 11.9497 8.94194 12.0669C8.82473 12.1842 8.66576 12.25 8.5 12.25H2.25C2.08424 12.25 1.92527 12.1842 1.80806 12.0669C1.69085 11.9497 1.625 11.7908 1.625 11.625V3.5Z" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </form>

                            @elseif($item->role === 'petugas')
                                <form action="{{ route('admin.petugas.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1 rounded cursor-pointer hover:bg-slate-200 transition" aria-label="Hapus Petugas">
                                        <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 3.5H9.75M4.125 5.375V10.375M6.625 5.375V10.375M4.125 1H6.625C6.79076 1 6.94973 1.06585 7.06694 1.18306C7.18415 1.30027 7.25 1.45924 7.25 1.625V3.5H3.5V1.625C3.5 1.45924 3.56585 1.30027 3.68306 1.18306C3.80027 1.06585 3.95924 1 4.125 1ZM1.625 3.5H9.125V11.625C9.125 11.7908 9.05915 11.9497 8.94194 12.0669C8.82473 12.1842 8.66576 12.25 8.5 12.25H2.25C2.08424 12.25 1.92527 12.1842 1.80806 12.0669C1.69085 11.9497 1.625 11.7908 1.625 11.625V3.5Z" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </form>
                            @else
                                —
                            @endif

                            {{-- SUSPEND --}}
                            @if($item->role === 'user')
                                <form action="{{ route('admin.users.suspend', $item->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" class="p-1 rounded cursor-pointer hover:bg-slate-200 transition" aria-label="{{ ($item->is_suspended ?? false) ? 'Aktifkan User' : 'Suspend User' }}">
                                        @if($item->is_suspended ?? false)
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.62509 10.1062L3.45634 7.93749C3.33948 7.82063 3.18098 7.75497 3.01572 7.75497C2.85045 7.75497 2.69195 7.82063 2.57509 7.93749C2.45823 8.05435 2.39258 8.21285 2.39258 8.37811C2.39258 8.45994 2.4087 8.54097 2.44001 8.61658C2.47133 8.69218 2.51723 8.76087 2.57509 8.81874L5.18759 11.4312C5.43134 11.675 5.82509 11.675 6.06884 11.4312L12.6813 4.81874C12.7982 4.70188 12.8639 4.54338 12.8639 4.37811C12.8639 4.21285 12.7982 4.05435 12.6813 3.93749C12.5645 3.82063 12.406 3.75497 12.2407 3.75497C12.0754 3.75497 11.917 3.82063 11.8001 3.93749L5.62509 10.1062Z" fill="#6D28D9"/>
                                            </svg>
                                        @else
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.5 13.75C6.63542 13.75 5.82292 13.5858 5.0625 13.2575C4.30208 12.9292 3.64063 12.484 3.07813 11.9219C2.51563 11.3598 2.07042 10.6983 1.7425 9.9375C1.41458 9.17667 1.25042 8.36417 1.25 7.5C1.24958 6.63583 1.41375 5.82333 1.7425 5.0625C2.07125 4.30167 2.51646 3.64021 3.07813 3.07813C3.63979 2.51604 4.30125 2.07083 5.0625 1.7425C5.82375 1.41417 6.63625 1.25 7.5 1.25C8.36375 1.25 9.17625 1.41417 9.9375 1.7425C10.6988 2.07083 11.3602 2.51604 11.9219 3.07813C12.4835 3.64021 12.929 4.30167 13.2581 5.0625C13.5873 5.82333 13.7513 6.63583 13.75 7.5C13.7488 8.36417 13.5846 9.17667 13.2575 9.9375C12.9304 10.6983 12.4852 11.3598 11.9219 11.9219C11.3585 12.484 10.6971 12.9294 9.9375 13.2581C9.17792 13.5869 8.36542 13.7508 7.5 13.75ZM7.5 12.5C8.0625 12.5 8.60417 12.409 9.125 12.2269C9.64583 12.0448 10.125 11.7817 10.5625 11.4375L3.5625 4.4375C3.21875 4.875 2.95563 5.35417 2.77313 5.875C2.59063 6.39583 2.49958 6.9375 2.5 7.5C2.5 8.89583 2.98438 10.0781 3.95313 11.0469C4.92188 12.0156 6.10417 12.5 7.5 12.5ZM11.4375 10.5625C11.7813 10.125 12.0444 9.64583 12.2269 9.125C12.4094 8.60417 12.5004 8.0625 12.5 7.5C12.5 6.10417 12.0156 4.92187 11.0469 3.95312C10.0781 2.98437 8.89583 2.5 7.5 2.5C6.9375 2.5 6.39583 2.59104 5.875 2.77312C5.35417 2.95521 4.875 3.21833 4.4375 3.5625L11.4375 10.5625Z" fill="#6D28D9"/>
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>

    <div class="flex items-center justify-between mt-6 text-[10px] text-slate-600">
        <span>
            Menampilkan
            {{ $items->firstItem() ?? 0 }}
            -
            {{ $items->lastItem() ?? 0 }}
            dari
            {{ $items->total() }}
            akun
        </span>

        <div class="flex gap-1">
            @if ($items->onFirstPage())
                <span class="px-3 py-1 border rounded cursor-pointer text-slate-400">Sebelumnya</span>
            @else
                <a href="{{ $items->previousPageUrl() }}" class="px-3 py-1 border rounded cursor-pointer hover:bg-slate-100">
                    Sebelumnya
                </a>
            @endif

            @if ($items->hasMorePages())
                <a href="{{ $items->nextPageUrl() }}" class="px-3 py-1 border cursor-pointer rounded hover:bg-slate-100">
                    Selanjutnya
                </a>
            @else
                <span class="px-3 py-1 border rounded text-slate-400 cursor-pointer">Selanjutnya</span>
            @endif
        </div>
    </div>
</div>