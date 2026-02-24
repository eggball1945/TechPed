@extends('petugas.layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-[18px] font-semibold text-black">
                Kelola Produk
            </h1>
            <p class="text-[12px] text-gray-600">
                Kelola katalog produk, inventaris, dan kategori Anda.
            </p>
        </div>

        <button id="btnTambahProduk" class="w-[91px] h-6 bg-white flex items-center justify-center gap-1 rounded border-gray-300 shadow cursor-pointer">
            <div class="w-[15px] h-[15px] flex items-center justify-center">
                <svg class="w-[7.5px] h-[7.5px] text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            
            <span class="font-medium text-[8px] leading-[10px] text-black">
                Tambah Produk
            </span>

        </button>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @include('petugas.product.content')
</div>

<div id="cardTambahProduk" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="w-[392px] max-h-[600px] overflow-y-auto bg-white rounded-lg shadow-lg p-4 relative">
        <h2 class="font-medium text-[15px] leading-[24px] text-start text-black mb-4">
            Tambah Produk Baru
        </h2>

        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="flex justify-between gap-4 mb-3">
                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">Nama Produk</label>
                    <input type="text" name="nama_produk" placeholder="Masukkan Nama Produk" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition"/>
                </div>

                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">SKU</label>
                    <input type="text" name="sku" placeholder="Masukkan SKU" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition"/>
                </div>
            </div>

            <div class="mb-3">
                <label class="font-medium text-[11px]">Deskripsi Produk</label>
                <textarea name="deskripsi" placeholder="Masukkan Deskripsi Produk" class="w-full h-[60px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition resize-none leading-relaxed"></textarea>
            </div>


            <div class="flex justify-between gap-4 mb-3">
                <div class="w-[170px]">
                    <label class="block font-medium text-[11px] mb-1 text-gray-700">
                        Kategori Produk
                    </label>

                    <div class="relative w-[170px]" id="customSelect">
                        <select name="kategori" class="w-full h-[30px] bg-slate-50 px-2 pr-7 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:outline-none transition appearance-none cursor-pointer">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="pc">PC</option>
                            <option value="mini pc">Mini PC</option>
                            <option value="laptop">Laptop</option>
                            <option value="gaming">Gaming</option>
                            <option value="hardware">Hardware</option>
                        </select>

                        <svg class="absolute right-2 top-1/2 -translate-y-1/2 w-3 h-3 text-gray-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>


                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">Harga</label>
                    <input type="number" name="harga" placeholder="Rp. 0" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition">
                </div>
            </div>

            <div class="flex justify-between gap-4 mb-3">
                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">Jumlah Stok</label>
                    <input type="number" name="stok" placeholder="Masukkan Stok" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition">
                </div>

                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">Peringatan Stok Rendah</label>
                    <input type="number" placeholder="10" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition">
                </div>
            </div>

            <div class="mb-4">
                <label class="font-medium text-[11px]">Gambar Produk</label>

                <label class="w-full h-[139px] border border-dashed border-gray-300 flex flex-col items-center justify-center text-center cursor-pointer rounded relative">
                    <input type="file" name="gambar[]" class="hidden" id="gambarInput" multiple accept="image/png, image/jpeg">

                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.4167 43.75C9.27083 43.75 8.29028 43.3424 7.475 42.5271C6.65972 41.7118 6.25139 40.7306 6.25 39.5833V10.4167C6.25 9.27083 6.65833 8.29028 7.475 7.475C8.29167 6.65972 9.27222 6.25139 10.4167 6.25H39.5833C40.7292 6.25 41.7104 6.65833 42.5271 7.475C43.3438 8.29167 43.7514 9.27222 43.75 10.4167V39.5833C43.75 40.7292 43.3424 41.7104 42.5271 42.5271C41.7118 43.3438 40.7306 43.7514 39.5833 43.75H10.4167ZM10.4167 39.5833H39.5833V10.4167H10.4167V39.5833ZM12.5 35.4167H37.5L29.6875 25L23.4375 33.3333L18.75 27.0833L12.5 35.4167Z" fill="black" fill-opacity="0.4"/>
                    </svg>

                    <span class="font-medium text-[11px] text-gray-500 mt-2">
                        Klik untuk mengunggah atau seret dan lepas<br>
                        PNG, JPG hingga 10MB (maks 5 gambar)
                    </span>
                </label>

                <div id="previewContainer" class="flex flex-wrap gap-2 mt-2"></div>
            </div>

            <div class="flex justify-end gap-3">
                <button type="submit" class="w-[54px] h-5 bg-violet-700 text-[10px] text-white rounded cursor-pointer">
                    Tambah
                </button>

                <button type="button" id="btnCloseCard" class="w-[54px] h-5 bg-gray-500 text-[10px] text-white rounded cursor-pointer">
                    Batal
                </button>
            </div>

        </form>
    </div>
</div>
@endsection