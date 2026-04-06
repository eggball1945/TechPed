@extends('admin.layouts.app')

@section('title', 'Backup & Restore')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6">
    <div class="mb-6">
        <h1 class="text-[18px] font-semibold text-black">Backup & Restore Database</h1>
        <p class="text-[12px] text-gray-600">Amankan data sistem dengan melakukan backup berkala atau restore data dari file cadangan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- BACKUP CARD --}}
        <div class="bg-white rounded-xl p-6 border border-gray-300 shadow-sm flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 bg-violet-100 rounded-lg flex items-center justify-center mb-4">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                </div>
                <h2 class="text-[14px] font-semibold mb-2">Backup Database</h2>
                <p class="text-[12px] text-gray-500 mb-6">Unduh salinan terbaru dari seluruh database sistem (produk, order, user, dll) dalam format .sql.</p>
            </div>
            
            <a href="{{ route('admin.backup.download') }}" class="w-full py-2 bg-violet-700 text-white rounded text-[12px] font-medium text-center hover:bg-violet-800 transition-colors">
                Unduh Backup (.sql)
            </a>
        </div>

        {{-- RESTORE CARD --}}
        <div class="bg-white rounded-xl p-6 border border-gray-300 shadow-sm">
            <div class="w-12 h-12 bg-violet-100 rounded-lg flex items-center justify-center mb-4">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 4 23 10 17 10"></polyline>
                    <polyline points="1 20 1 14 7 14"></polyline>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                </svg>
            </div>
            <h2 class="text-[14px] font-semibold mb-2">Restore Database</h2>
            <p class="text-[12px] text-gray-500 mb-6">Unggah file .sql hasil backup sebelumnya untuk mengembalikan keadaan database.</p>
            
            <form action="{{ route('admin.backup.restore') }}" method="POST" enctype="multipart/form-data" id="restoreForm">
                @csrf
                <div class="mb-4">
                    <input type="file" name="backup_file" required accept=".sql" class="block w-full text-[11px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-[11px] file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 cursor-pointer border border-gray-200 rounded p-1">
                </div>
                <button type="button" onclick="confirmRestore()" class="w-full py-2 bg-white border border-violet-700 text-violet-700 rounded text-[12px] font-medium hover:bg-violet-50 transition-colors">
                    Mulai Restore Data
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function confirmRestore() {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Database saat ini akan ditimpa sepenuhnya oleh data dari file backup. Tindakan ini tidak dapat dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7c3aed',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Restore Sekarang',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('restoreForm').submit();
        }
    })
}
</script>
@endsection
