<div class="w-[1070px] bg-white rounded-md border border-gray-300 p-4">
    <div class="w-full flex items-center gap-3 mb-4">
        <div class="flex-1 relative">
            <svg class="absolute left-2 top-1/2 -translate-y-1/2 w-[14px] h-[14px] text-black/40 pointer-events-none" viewBox="0 0 19 19" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.5167 16.625L10.5292 11.6375C10.1333 11.9542 9.67813 12.2049 9.16354 12.3896C8.64896 12.5743 8.10139 12.6667 7.52083 12.6667C6.08264 12.6667 4.86558 12.1684 3.86967 11.172C2.87375 10.1756 2.37553 8.9585 2.375 7.52083C2.37447 6.08317 2.87269 4.86611 3.86967 3.86967C4.86664 2.87322 6.08369 2.375 7.52083 2.375C8.95797 2.375 10.1753 2.87322 11.1728 3.86967C12.1703 4.86611 12.6683 6.08317 12.6667 7.52083C12.6667 8.10139 12.5743 8.64896 12.3896 9.16354C12.2049 9.67812 11.9542 10.1333 11.6375 10.5292L16.625 15.5167L15.5167 16.625ZM7.52083 11.0833C8.51042 11.0833 9.3517 10.7371 10.0447 10.0447C10.7376 9.35222 11.0839 8.51094 11.0833 7.52083C11.0828 6.53072 10.7366 5.68971 10.0447 4.99779C9.35275 4.30588 8.51147 3.95939 7.52083 3.95833C6.53019 3.95728 5.68918 4.30376 4.99779 4.99779C4.3064 5.69182 3.95992 6.53283 3.95833 7.52083C3.95675 8.50883 4.30324 9.35011 4.99779 10.0447C5.69235 10.7392 6.53336 11.0854 7.52083 11.0833Z" fill="black" fill-opacity="0.4"/>
            </svg>
            <input type="text" placeholder="Cari Produk" class="w-full h-6 bg-slate-50 pl-7 pr-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:outline-none transition"/>
        </div>

        <div class="flex gap-2 items-center">
            <div class="relative">
                <button id="sortButton" class="h-6 px-2 border border-gray-100 rounded text-[10px] flex items-center justify-between w-32 bg-white">
                    {{ request('sort') ? ucfirst(str_replace('_', ' ', request('sort'))) : 'Urut Berdasarkan' }}
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul id="sortMenu" class="absolute hidden w-full bg-white rounded shadow-md mt-1 z-50">
                    <li data-value="a_z" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer rounded-t-md">Nama A-Z</li>
                    <li data-value="z_a" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Nama Z-A</li>
                    <li data-value="sku_asc" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">SKU Terendah</li>
                    <li data-value="sku_desc" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">SKU Tertinggi</li>
                    <li data-value="harga_asc" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Harga Termurah</li>
                    <li data-value="harga_desc" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Harga Termahal</li>
                    <li data-value="stok_asc" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Stok Tersedikit</li>
                    <li data-value="stok_desc" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer rounded-b-md">Stok Terbanyak</li>
                </ul>
            </div>

            <div class="relative">
                <button id="filterButton" class="h-6 px-2 border border-gray-100 rounded text-[10px] flex items-center justify-between w-32 bg-white">
                    {{ request('filter') ? ucfirst(str_replace('_', ' ', request('filter'))) : 'Filter' }}
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul id="filterMenu" class="absolute hidden w-full bg-white rounded shadow-md mt-1 z-50">
                    <li data-value="semua" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer rounded-t-md">Semua</li>
                    <li data-value="pc" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer rounded-t-md">PC</li>
                    <li data-value="mini_pc" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Mini PC</li>
                    <li data-value="laptop" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Laptop</li>
                    <li data-value="gaming" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Gaming</li>
                    <li data-value="hardware" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Hardware</li>
                    <li data-value="tersedia" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Tersedia</li>
                    <li data-value="stok_sedikit" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer">Stok Sedikit</li>
                    <li data-value="habis" class="px-2 py-1 text-[10px] hover:bg-violet-700 hover:text-white cursor-pointer rounded-b-md">Habis</li>
                </ul>
            </div>

            <form method="GET" action="{{ route('admin.product.index') }}" id="filterForm">
                <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
                <input type="hidden" name="filter" id="filterInput" value="{{ request('filter') }}">
                <button type="submit" class="h-6 px-2 bg-violet-700 text-white shadow-md rounded text-[10px] cursor-pointer">Terapkan</button>
            </form>
        </div>
    </div>
    
    <div class="w-[1037px] overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b border-slate-200">
                    <th class="text-left text-[10px] font-medium py-2 px-2">Produk</th>
                    <th class="text-left text-[10px] font-medium py-2 px-2">SKU</th>
                    <th class="text-left text-[10px] font-medium py-2 px-2">Kategori</th>
                    <th class="text-left text-[10px] font-medium py-2 px-2">Harga</th>
                    <th class="text-left text-[10px] font-medium py-2 px-2">Stok</th>
                    <th class="text-left text-[10px] font-medium py-2 px-2">Status</th>
                    <th class="text-center text-[10px] font-medium py-2 px-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    @php
                        $gambarArray = json_decode($product->gambar, true) ?? [];
                    @endphp

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                        <td class="py-3 px-2 text-[10px] font-medium flex items-center gap-2">
                            @if(count($gambarArray) > 0)
                                <img src="{{ asset('storage/'.$gambarArray[0]) }}" class="w-5 h-5 object-cover rounded" alt="Produk">
                            @else
                                <span class="text-xs text-gray-400">Tidak ada gambar</span>
                            @endif
                            <span>{{ $product->nama_produk }}</span>
                        </td>

                        <td class="py-3 px-2 text-[10px]">{{ $product->sku }}</td>
                        <td class="py-3 px-2 text-[10px]">{{ $product->kategori }}</td>
                        <td class="py-3 px-2 text-[10px]">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td class="py-3 px-2 text-[10px]">{{ $product->stok }}</td>
                        <td class="py-3 px-2">
                            @if ($product->stok > 10)
                                <span class="px-2 py-[2px] text-[9px] rounded bg-green-100 text-green-700">
                                    Tersedia
                                </span>
                            @elseif ($product->stok > 0)
                                <span class="px-2 py-[2px] text-[9px] rounded bg-yellow-100 text-yellow-700">
                                    Stok Sedikit
                                </span>
                            @else
                                <span class="px-2 py-[2px] text-[9px] rounded bg-red-100 text-red-700">
                                    Habis
                                </span>
                            @endif
                        </td>
                        
                        <td class="py-3 px-2 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick='openEditModal(@json($product))' data-product='@json($product)'type="button" class="btn-edit-produk w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150">
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.375 4.375H3.75C3.41848 4.375 3.10054 4.5067 2.86612 4.74112C2.6317 4.97554 2.5 5.29348 2.5 5.625V11.25C2.5 11.5815 2.6317 11.8995 2.86612 12.1339C3.10054 12.3683 3.41848 12.5 3.75 12.5H9.375C9.70652 12.5 10.0245 12.3683 10.2589 12.1339C10.4933 11.8995 10.625 11.5815 10.625 11.25V10.625" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 3.12501L11.875 5.00001M12.7406 4.11563C12.9868 3.86948 13.1251 3.53562 13.1251 3.18751C13.1251 2.83939 12.9868 2.50553 12.7406 2.25938C12.4945 2.01323 12.1606 1.87494 11.8125 1.87494C11.4644 1.87494 11.1305 2.01323 10.8844 2.25938L5.625 7.50001V9.37501H7.5L12.7406 4.11563Z" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus order ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150">
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
                        <td colspan="7" class="py-10 text-center">
                            <p class="text-[11px] text-slate-400">
                                Belum ada produk yang ditambahkan
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between mt-6 text-[10px] text-slate-600">
        <span>
            Menampilkan
            {{ $products->firstItem() ?? 0 }}
            -
            {{ $products->lastItem() ?? 0 }}
            dari
            {{ $products->total() }}
            produk
        </span>

        <div class="flex gap-1">
            @if ($products->onFirstPage())
                <span class="px-3 py-1 border rounded text-slate-400 cursor-pointer">Sebelumnya</span>
            @else
                <a href="{{ $products->previousPageUrl() }}" class="px-3 py-1 border rounded hover:bg-slate-100 cursor-pointer">
                    Sebelumnya
                </a>
            @endif

            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="px-3 py-1 border rounded hover:bg-slate-100 cursor-pointer">
                    Selanjutnya
                </a>
            @else
                <span class="px-3 py-1 border rounded text-slate-400 cursor-pointer">Selanjutnya</span>
            @endif
        </div>
    </div>

</div>

<div id="cardEditProduk" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="w-[392px] max-h-[600px] overflow-y-auto bg-white rounded-lg shadow-lg p-4 relative">

        <h2 class="font-medium text-[15px] leading-[24px] text-start text-black mb-4">
            Edit Produk
        </h2>

        <form id="formEditProduk" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_product_id">

            <div class="flex justify-between gap-4 mb-3">
                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">Nama Produk</label>
                    <input type="text" name="nama_produk" id="edit_nama_produk" value="{{ old('nama_produk', $produk->nama_produk ?? '') }}" placeholder="Masukkan Nama Produk" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition">
                </div>

                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">SKU</label>
                    <input type="text" name="sku" id="edit_sku" value="{{ old('sku', $produk->sku ?? '') }}" placeholder="Masukkan SKU" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition">
                </div>
            </div>

            <div class="mb-3">
                <label class="font-medium text-[11px]">Deskripsi Produk</label>
                <textarea name="deskripsi" id="edit_deskripsi" placeholder="Masukkan Deskripsi Produk" class="w-full h-[60px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition resize-none leading-relaxed">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
            </div>

            <div class="flex justify-between gap-4 mb-3">
                <div class="w-[170px]">
                    <label class="block font-medium text-[11px] mb-1 text-gray-700">
                        Kategori Produk
                    </label>

                    <div class="relative w-[170px]">
                        <select name="kategori" id="edit_kategori" class="w-full h-[30px] bg-slate-50 px-2 pr-7 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:outline-none transition appearance-none cursor-pointer">
                            <option value="pc" {{ ($produk->kategori ?? '') == 'pc' ? 'selected' : '' }}>PC</option>
                            <option value="mini pc" {{ ($produk->kategori ?? '') == 'mini pc' ? 'selected' : '' }}>Mini PC</option>
                            <option value="laptop" {{ ($produk->kategori ?? '') == 'laptop' ? 'selected' : '' }}>Laptop</option>
                            <option value="gaming" {{ ($produk->kategori ?? '') == 'gaming' ? 'selected' : '' }}>Gaming</option>
                            <option value="hardware" {{ ($produk->kategori ?? '') == 'hardware' ? 'selected' : '' }}>Hardware</option>
                        </select>

                        <svg class="absolute right-2 top-1/2 -translate-y-1/2 w-3 h-3 text-gray-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">Harga</label>
                    <input type="number" name="harga" id="edit_harga" value="{{ old('harga', $produk->harga ?? '') }}" placeholder="Rp. 0" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition">
                </div>
            </div>

            <div class="flex justify-between gap-4 mb-3">
                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">Jumlah Stok</label>
                    <input type="number" name="stok" id="edit_stok" value="{{ old('stok', $produk->stok ?? '') }}" placeholder="Masukkan Stok" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition">
                </div>

                <div class="w-[170px]">
                    <label class="font-medium text-[11px]">Peringatan Stok Rendah</label>
                    <input type="number" name="stok_min" id="edit_stok_min" value="{{ old('stok_min', $produk->stok_min ?? '') }}" placeholder="10" class="w-full h-[30px] bg-slate-50 px-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:ring-[0.3px] focus:ring-violet-700 focus:outline-none transition">
                </div>
            </div>

            <div class="mb-4">
                <label class="font-medium text-[11px]">Gambar Produk</label>

                <label for="gambarInputEdit" class="w-full h-[139px] border border-dashed border-gray-300 flex flex-col items-center justify-center text-center cursor-pointer rounded relative">
                    <input type="file" name="gambar[]" id="gambarInputEdit" multiple accept="image/png,image/jpeg" class="hidden">

                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.4167 43.75C9.27083 43.75 8.29028 43.3424 7.475 42.5271C6.65972 41.7118 6.25139 40.7306 6.25 39.5833V10.4167C6.25 9.27083 6.65833 8.29028 7.475 7.475C8.29167 6.65972 9.27222 6.25139 10.4167 6.25H39.5833C40.7292 6.25 41.7104 6.65833 42.5271 7.475C43.3438 8.29167 43.7514 9.27222 43.75 10.4167V39.5833C43.75 40.7292 43.3424 41.7104 42.5271 42.5271C41.7118 43.3438 40.7306 43.7514 39.5833 43.75H10.4167ZM10.4167 39.5833H39.5833V10.4167H10.4167V39.5833ZM12.5 35.4167H37.5L29.6875 25L23.4375 33.3333L18.75 27.0833L12.5 35.4167Z" fill="black" fill-opacity="0.4"/>
                    </svg>

                    <span class="font-medium text-[11px] text-gray-500">
                        Klik untuk mengganti gambar<br>
                        PNG, JPG hingga 10MB
                    </span>
                </label>

                <div id="previewContainerEdit" class="flex flex-wrap gap-2 mt-2"></div>
            </div>

            <div class="flex justify-end gap-3">
                <button type="submit" class="w-[54px] h-5 bg-violet-700 text-[10px] text-white rounded cursor-pointer">
                    Simpan
                </button>

                <button type="button" id="btnCloseEdit" onclick="closeEditModal()" class="w-[54px] h-5 bg-gray-500 text-[10px] text-white rounded cursor-pointer">
                    Batal
                </button>
            </div>

        </form>
    </div>
</div>