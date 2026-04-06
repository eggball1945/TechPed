<div id="tambahPetugasModal" class="hidden fixed inset-0 bg-black/40 z-[9999] items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-[400px] overflow-hidden" onclick="event.stopPropagation()">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-white">
            <h3 class="text-[14px] font-semibold text-black">Tambah Petugas</h3>
        </div>
        <form action="{{ route('admin.setting.petugas.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label for="add_username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="add_username" name="username" required autocomplete="off" placeholder="petugas" class="mt-1 w-full h-[40px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition resize-none leading-relaxed">
            </div>
            <div>
                <label for="add_password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="add_password" name="password" required autocomplete="new-password" placeholder="password" class="mt-1 w-full h-[40px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition resize-none leading-relaxed">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="const m = document.getElementById('tambahPetugasModal'); m.classList.add('hidden'); m.classList.remove('flex')" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 bg-violet-700 text-white text-sm font-medium rounded-md hover:bg-violet-800 cursor-pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="editPetugasModal" class="hidden fixed inset-0 bg-black/40 z-[9999] items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-[400px] overflow-hidden" onclick="event.stopPropagation()">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-white">
            <h3 class="text-[14px] font-semibold text-black">Edit Petugas</h3>
        </div>
        <form id="editPetugasForm" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label for="edit_username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="edit_username" name="username" required  class="mt-1 w-full h-[40px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition resize-none leading-relaxed">
            </div>
            <div>
                <label for="edit_password" class="block text-sm font-medium text-gray-700">Password <span class="text-gray-400 text-[10px]">(kosongkan jika tidak diubah)</span></label>
                <input type="password" id="edit_password" name="password" class="mt-1 w-full h-[40px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition resize-none leading-relaxed">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="const m = document.getElementById('editPetugasModal'); m.classList.add('hidden'); m.classList.remove('flex')" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 bg-violet-700 text-white text-sm font-medium rounded-md hover:bg-violet-800 cursor-pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="deletePetugasModal" class="hidden fixed inset-0 bg-black/40 z-[9999] items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-[350px] overflow-hidden" onclick="event.stopPropagation()">
        <div class="p-6 text-center">
            <div class="w-16 h-16 bg-violet-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 7L18.1327 19.1425C18.0579 20.1891 17.187 21 16.1378 21H7.86224C6.81296 21 5.94208 20.1891 5.86732 19.1425L5 7M10 11V17M14 11V17M15 7V4C15 3.44772 14.5523 3 14 3H10C9.44772 3 9 3.44772 9 4V7M4 7H20" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3 class="text-[16px] font-semibold text-gray-900 mb-2">Hapus Petugas?</h3>
            <p class="text-[12px] text-gray-500 mb-6">Tindakan ini tidak dapat dibatalkan. Petugas akan dihapus selamanya.</p>
            <div class="flex justify-center gap-3">
                <button type="button" onclick="const m = document.getElementById('deletePetugasModal'); m.classList.add('hidden'); m.classList.remove('flex')" class="px-4 py-2 text-[12px] font-medium text-gray-600 hover:text-gray-800 cursor-pointer">Batal</button>
                <form id="deletePetugasForm" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-violet-700 text-white text-[12px] font-medium rounded-md hover:bg-violet-800 cursor-pointer shadow-sm transition">Hapus Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="w-full bg-slate-50 border border-slate-200 rounded-full p-2 flex gap-3 text-[12px] font-medium">
    <a href="{{ route('admin.setting.index') }}?tab=umum" class="px-4 py-2 rounded-full flex items-center {{ $tab === 'umum' || $tab === null || $tab === '' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Umum</a>
    <a href="{{ route('admin.setting.index') }}?tab=admin" class="px-4 py-2 rounded-full flex items-center {{ $tab === 'admin' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Admin</a>
    <a href="{{ route('admin.setting.index') }}?tab=pembayaran" class="px-4 py-2 rounded-full flex items-center {{ $tab === 'pembayaran' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Pembayaran</a>
</div>

@if($tab === 'umum' || $tab === null || $tab === '')
    <div class="w-full bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-6">
        <h2 class="text-[15px] font-semibold text-black mb-4">Pengaturan Umum (Pajak PPN)</h2>
        <form action="{{ route('admin.setting.umum.update') }}" method="POST" class="max-w-md space-y-4">
            @csrf
            <div>
                <label for="tax_percentage" class="block text-sm font-medium text-gray-700 mb-1">Pajak PPN (%)</label>
                <input type="number" step="0.01" min="0" max="100" id="tax_percentage" name="tax_percentage" value="{{ \App\Models\SystemSetting::get('tax_percentage', 11) }}" required class="w-full h-[40px] bg-slate-50 px-3 text-[13px] rounded border border-slate-200 focus:border-violet-700 focus:ring-1 focus:ring-violet-700 focus:outline-none transition">
                <p class="text-xs text-gray-500 mt-1">Sistem akan secara otomatis menghitung persentase dari subtotal pesanan pelanggan.</p>
            </div>
            
            <button type="submit" class="px-4 py-2 bg-violet-700 text-white text-[13px] font-medium rounded-md hover:bg-violet-800 cursor-pointer shadow-sm transition">
                Simpan Pengaturan
            </button>
        </form>
    </div>
@elseif($tab === 'admin')
    <div class="w-full bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-[15px] font-semibold text-black">Kelola Petugas</h2>
            <button type="button" onclick="const m = document.getElementById('tambahPetugasModal'); m.classList.remove('hidden'); m.classList.add('flex')" class="px-4 py-2 rounded bg-violet-700 text-white text-[11px] font-medium hover:bg-violet-800 cursor-pointer transition shadow-sm">
                Tambah Petugas
            </button>
        </div>
        @foreach($users as $user)
            <div class="w-full h-[41px] bg-white border-b border-slate-100 flex items-center px-4 hover:bg-slate-50">
                <div class="flex-1 flex items-center gap-3">
                    <span class="font-medium text-[11px] text-black">{{ $user->username }}</span>
                    <span class="px-2 py-1 rounded-md text-[8px] font-medium w-[50px] h-[20px] flex items-center justify-center bg-violet-700/40 text-violet-700">
                        {{ $user->role === 'admin' ? 'Admin' : 'Petugas' }}
                    </span>
                </div>
                <div class="w-[150px] flex justify-center gap-2">
                    @if($user->role === 'petugas')
                        <button type="button" onclick="window.showEditPetugas({{ $user->id }}, '{{ $user->username }}')" class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150 text-violet-700" title="Kelola">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.375 4.375H3.75C3.41848 4.375 3.10054 4.5067 2.86612 4.74112C2.6317 4.97554 2.5 5.29348 2.5 5.625V11.25C2.5 11.5815 2.6317 11.8995 2.86612 12.1339C3.10054 12.3683 3.41848 12.5 3.75 12.5H9.375C9.70652 12.5 10.0245 12.3683 10.2589 12.1339C10.4933 11.8995 10.625 11.5815 10.625 11.25V10.625" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 3.12501L11.875 5.00001M12.7406 4.11563C12.9868 3.86948 13.1251 3.53562 13.1251 3.18751C13.1251 2.83939 12.9868 2.50553 12.7406 2.25938C12.4945 2.01323 12.1606 1.87494 11.8125 1.87494C11.4644 1.87494 11.1305 2.01323 10.8844 2.25938L5.625 7.50001V9.37501H7.5L12.7406 4.11563Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button type="button" onclick="window.showDeleteConfirm({{ $user->id }})" class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150 text-violet-700" title="Hapus">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.125 4.375H11.875M6.25 6.25V11.25M8.75 6.25V11.25M6.25 1.875H8.75C8.91576 1.875 9.07473 1.94085 9.19194 2.05806C9.30915 2.17527 9.375 2.33424 9.375 2.5V4.375H5.625V2.5C5.625 2.33424 5.69085 2.17527 5.80806 2.05806C5.92527 1.94085 6.08424 1.875 6.25 1.875ZM3.75 4.375H11.25V12.5C11.25 12.6658 11.1842 12.8247 11.0669 12.9419C10.9497 13.0592 10.7908 13.125 10.625 13.125H4.375C4.20924 13.125 4.05027 13.0592 3.93306 12.9419C3.81585 12.8247 3.75 12.6658 3.75 12.5V4.375Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    @else
                        <span class="text-slate-400 text-[10px]">—</span>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="flex items-center justify-between mt-6 text-[10px] text-slate-600 px-2">
            <span>Menampilkan {{ $users->firstItem() }}-{{ $users->lastItem() }} dari {{ $users->total() }} Admin & Petugas</span>
            <div class="flex gap-1">
                @if ($users->onFirstPage())
                    <span class="px-3 py-1 border border-slate-200 rounded text-slate-300 cursor-not-allowed">Sebelumnya</span>
                @else
                    <a href="{{ $users->appends(['tab' => 'admin'])->previousPageUrl() }}"
                       class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-100 cursor-pointer text-slate-700">Sebelumnya</a>
                @endif

                @if ($users->hasMorePages())
                    <a href="{{ $users->appends(['tab' => 'admin'])->nextPageUrl() }}"
                       class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-100 cursor-pointer text-slate-700">Selanjutnya</a>
                @else
                    <span class="px-3 py-1 border border-slate-200 rounded text-slate-300 cursor-not-allowed">Selanjutnya</span>
                @endif
            </div>
        </div>
    </div>

    <script>
        window.showEditPetugas = function(id, username) {
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_password').value = '';
            document.getElementById('editPetugasForm').action = '/admin/setting/petugas/' + id;
            const modal = document.getElementById('editPetugasModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };

        window.showDeleteConfirm = function(id) {
            document.getElementById('deletePetugasForm').action = '/admin/setting/petugas/' + id;
            const modal = document.getElementById('deletePetugasModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };

        const modalBackdrops = ['tambahPetugasModal', 'editPetugasModal', 'deletePetugasModal'];
        modalBackdrops.forEach(id => {
            document.getElementById(id).addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                    this.classList.remove('flex');
                }
            });
        });
    </script>
@elseif($tab === 'pembayaran')
    <div class="w-full bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-6">
        <h2 class="text-[15px] font-semibold text-black mb-4">Pengaturan Pembayaran Transfer Bank</h2>
        <form action="{{ route('admin.setting.pembayaran.update') }}" method="POST" class="max-w-md space-y-4">
            @csrf
            <div>
                <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                <input type="text" id="bank_name" name="bank_name" value="{{ \App\Models\SystemSetting::get('bank_name', 'Bank Central Asia (BCA)') }}" required placeholder="Contoh: Bank Mandiri" class="w-full h-[40px] bg-slate-50 px-3 text-[13px] rounded border border-slate-200 focus:border-violet-700 focus:ring-1 focus:ring-violet-700 focus:outline-none transition">
            </div>
            
            <div>
                <label for="bank_account_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                <input type="text" id="bank_account_number" name="bank_account_number" value="{{ \App\Models\SystemSetting::get('bank_account_number', '1234 5678 9012 3456') }}" required class="w-full h-[40px] bg-slate-50 px-3 text-[13px] rounded border border-slate-200 focus:border-violet-700 focus:ring-1 focus:ring-violet-700 focus:outline-none transition">
            </div>

            <div>
                <label for="bank_account_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                <input type="text" id="bank_account_name" name="bank_account_name" value="{{ \App\Models\SystemSetting::get('bank_account_name', 'TechPed Indonesia') }}" required class="w-full h-[40px] bg-slate-50 px-3 text-[13px] rounded border border-slate-200 focus:border-violet-700 focus:ring-1 focus:ring-violet-700 focus:outline-none transition">
            </div>
            
            <button type="submit" class="px-4 py-2 bg-violet-700 text-white text-[13px] font-medium rounded-md hover:bg-violet-800 cursor-pointer shadow-sm transition mt-2">
                Simpan Rekening Utama
            </button>
        </form>
    </div>
@endif

