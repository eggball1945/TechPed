@extends('user.layouts.app')

@section('title', 'Alamat Saya | TechPed')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-10 animate-fade-in flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-gray-900 tracking-tight mb-2 uppercase italic">Daftar <span class="text-violet-700">Alamat</span></h1>
            <p class="text-sm text-gray-500 font-medium">Kelola alamat pengiriman untuk kemudahan checkout</p>
        </div>
        <button onclick="scrollToAddAddress()" class="bg-violet-700 hover:shadow-2xl hover:shadow-violet-200 text-white font-black px-6 py-3.5 rounded-2xl transition-all active:scale-[0.98] shadow-lg shadow-violet-100 uppercase text-[10px] tracking-widest cursor-pointer group">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tambah Alamat
            </span>
        </button>
    </div>

    {{-- Address List Section --}}
    <div class="space-y-6 mb-12">
        @forelse($addresses as $address)
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/40 p-8 border border-gray-50 animate-fade-in-up group hover:shadow-2xl hover:shadow-violet-100/30 transition-all duration-300" style="animation-delay: {{ $loop->index * 50 }}ms" id="address-container-{{ $address->id }}">
                <div class="address-view flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-start gap-6 flex-1">
                        <div class="w-14 h-14 rounded-2xl bg-violet-50 flex items-center justify-center text-violet-700 shrink-0 border border-violet-100 group-hover:bg-violet-700 group-hover:text-white transition-colors duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div class="space-y-1.5">
                            <div class="flex items-center gap-3">
                                <span class="px-2.5 py-0.5 rounded-lg bg-gray-100 text-[9px] font-black text-gray-500 uppercase tracking-widest">Alamat #{{ $loop->iteration }}</span>
                                @if($loop->first)
                                    <span class="px-2.5 py-0.5 rounded-lg bg-emerald-50 text-[9px] font-black text-emerald-600 uppercase tracking-widest border border-emerald-100">Utama</span>
                                @endif
                            </div>
                            <p class="text-gray-900 font-bold leading-relaxed">{{ $address->alamat }}</p>
                            <p class="text-xs font-black text-violet-700 uppercase tracking-tighter">{{ $address->kota }}, {{ $address->provinsi }} &bull; {{ $address->kode_pos }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 justify-end">
                        <button onclick="editAddress({{ $address->id }})" class="p-3 text-gray-400 hover:text-violet-700 hover:bg-violet-50 rounded-xl transition-all cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </button>
                        <form method="POST" action="{{ route('addresses.destroy', $address->id) }}" id="delete-address-{{ $address->id }}">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $address->id }})" class="p-3 text-gray-400 hover:text-violet-700 hover:bg-violet-50 rounded-xl transition-all cursor-pointer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Edit Address View (Slide down) --}}
                <div class="address-edit hidden mt-8 pt-8 border-t border-gray-50 animate-fade-in text-left">
                    <form method="POST" action="{{ route('addresses.update', $address->id) }}" class="space-y-6">
                        @csrf @method('PUT')
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Alamat Lengkap</label>
                            <textarea name="alamat" rows="2" style="resize: none;" 
                                class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none">{{ old('alamat', $address->alamat) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Kota/Kabupaten</label>
                                <input type="text" name="kota" value="{{ old('kota', $address->kota) }}" 
                                    class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Provinsi</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi', $address->provinsi) }}" 
                                    class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Kode Pos</label>
                                <input type="text" name="kode_pos" value="{{ old('kode_pos', $address->kode_pos) }}" 
                                    class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none">
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" onclick="cancelEdit({{ $address->id }})" class="px-6 py-3 text-gray-400 text-[10px] font-black uppercase tracking-widest hover:text-gray-600 transition-colors cursor-pointer">Batal</button>
                            <button type="submit" class="bg-violet-700 text-white font-black px-8 py-3 rounded-xl transition-all shadow-lg shadow-violet-100 hover:shadow-xl hover:shadow-violet-200 active:scale-95 uppercase text-[10px] tracking-widest cursor-pointer">Simpan Alamat</button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/40 p-16 text-center border border-gray-50 animate-fade-in-up">
                <div class="w-24 h-24 bg-violet-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-violet-100">
                    <svg class="w-12 h-12 text-violet-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-4">Belum Ada Alamat</h3>
                <p class="text-gray-500 max-w-xs mx-auto mb-10 leading-relaxed text-sm font-medium">Anda belum menyimpan alamat pengiriman. Tambahkan sekarang untuk mempermudah pesanan Anda.</p>
            </div>
        @endforelse
    </div>

    <div id="addNewAddressSection" class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 border border-gray-50 overflow-hidden animate-fade-in-up {{ $errors->any() ? '' : 'hidden' }}" style="animation-delay: 200ms">
        <div class="px-10 py-8 border-b border-gray-50 bg-violet-700 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-violet-700"></div>
            <div class="relative z-10 flex items-center gap-5 text-left">
                <div class="w-12 h-12 rounded-[1.25rem] bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <h3 class="font-black text-white uppercase tracking-widest text-sm">Tambah Alamat Baru</h3>
                    <p class="text-violet-100/70 text-[10px] font-bold uppercase tracking-widest mt-0.5">Lengkapi data pengiriman Anda</p>
                </div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('addresses.store') }}" class="p-10 space-y-8">
            @csrf
            
            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" placeholder="Nama Jalan, Gedung, No. Rumah, RT/RW..." style="resize: none;" 
                    class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none">{{ old('alamat') }}</textarea>
                @error('alamat') <p class="text-rose-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Kota/Kabupaten</label>
                    <input type="text" name="kota" placeholder="Contoh: Jakarta Selatan" value="{{ old('kota') }}"
                        class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none">
                    @error('kota') <p class="text-rose-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Provinsi</label>
                    <input type="text" name="provinsi" placeholder="Contoh: DKI Jakarta" value="{{ old('provinsi') }}"
                        class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none">
                    @error('provinsi') <p class="text-rose-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Kode Pos</label>
                    <input type="text" name="kode_pos" placeholder="12xxx" value="{{ old('kode_pos') }}"
                        class="w-full rounded-2xl border-2 border-gray-50 bg-gray-50 px-5 py-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 focus:bg-white transition-all outline-none">
                    @error('kode_pos') <p class="text-rose-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="scrollToAddAddress()" class="px-6 py-4 text-gray-400 text-xs font-black uppercase tracking-widest hover:text-gray-600 transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="w-full sm:w-auto bg-violet-700 hover:shadow-2xl hover:shadow-violet-200 text-white font-black px-10 py-4 rounded-2xl transition-all active:scale-[0.98] shadow-lg shadow-violet-100 uppercase text-xs tracking-widest cursor-pointer">
                    Simpan Alamat Baru
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function editAddress(id) {
        const container = document.getElementById(`address-container-${id}`);
        const viewDiv = container.querySelector('.address-view');
        const editDiv = container.querySelector('.address-edit');
        
        viewDiv.classList.add('hidden');
        editDiv.classList.remove('hidden');
        editDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function cancelEdit(id) {
        const container = document.getElementById(`address-container-${id}`);
        const viewDiv = container.querySelector('.address-view');
        const editDiv = container.querySelector('.address-edit');
        
        editDiv.classList.add('hidden');
        viewDiv.classList.remove('hidden');
    }

    function scrollToAddAddress() {
        const section = document.getElementById('addNewAddressSection');
        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
            section.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            section.classList.add('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Alamat?',
            text: "Tindakan ini tidak dapat dibatalkan!",
            icon: 'warning',
            iconColor: '#7c3aed',
            showCancelButton: true,
            confirmButtonColor: '#7c3aed',
            cancelButtonColor: '#99A9C3',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '2rem'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-address-${id}`).submit();
            }
        })
    }
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
</style>
@endsection