<div class="w-[1080px] bg-white rounded-md border border-gray-300 p-4">
    <div class="w-full bg-slate-50 border border-slate-200 rounded-full p-2 flex gap-4 text-[12px] font-medium">
        <a href="{{ route('admin.order.index') }}" class="sort-btn px-3 py-2 rounded-full flex items-center gap-3 {{ request('status') === null ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Semua Order</a>
        <a href="{{ route('admin.order.index', ['status' => 'tertunda']) }}" class="sort-btn px-3 py-2 rounded-full flex items-center gap-3 {{ request('status') === 'tertunda' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Tertunda</a>
        <a href="{{ route('admin.order.index', ['status' => 'diproses']) }}" class="sort-btn px-3 py-2 rounded-full flex items-center gap-3 {{ request('status') === 'diproses' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Diproses</a>
        <a href="{{ route('admin.order.index', ['status' => 'dikirim']) }}" class="sort-btn px-3 py-2 rounded-full flex items-center gap-3 {{ request('status') === 'dikirim' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Dikirim</a>
        <a href="{{ route('admin.order.index', ['status' => 'terkirim']) }}" class="sort-btn px-3 py-2 rounded-full flex items-center gap-3 {{ request('status') === 'terkirim' ? 'bg-violet-700 text-white' : 'hover:bg-gray-100 text-gray-700' }}">Terkirim</a>
    </div>

    <form id="statusForm" method="GET">
        <input type="hidden" name="status" id="statusInput" value="{{ request('status','all') }}">
    </form>

    <div class="w-full flex items-center gap-3 mb-4">
        <div class="flex-1 relative mt-4">
            <svg class="absolute left-2 top-1/2 -translate-y-1/2 w-[14px] h-[14px] text-black/40 pointer-events-none" viewBox="0 0 19 19" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.5167 16.625L10.5292 11.6375C10.1333 11.9542 9.67813 12.2049 9.16354 12.3896C8.64896 12.5743 8.10139 12.6667 7.52083 12.6667C6.08264 12.6667 4.86558 12.1684 3.86967 11.172C2.87375 10.1756 2.37553 8.9585 2.375 7.52083C2.37447 6.08317 2.87269 4.86611 3.86967 3.86967C4.86664 2.87322 6.08369 2.375 7.52083 2.375C8.95797 2.375 10.1753 2.87322 11.1728 3.86967C12.1703 4.86611 12.6683 6.08317 12.6667 7.52083C12.6667 8.10139 12.5743 8.64896 12.3896 9.16354C12.2049 9.67812 11.9542 10.1333 11.6375 10.5292L16.625 15.5167L15.5167 16.625ZM7.52083 11.0833C8.51042 11.0833 9.3517 10.7371 10.0447 10.0447C10.7376 9.35222 11.0839 8.51094 11.0833 7.52083C11.0828 6.53072 10.7366 5.68971 10.0447 4.99779C9.35275 4.30588 8.51147 3.95939 7.52083 3.95833C6.53019 3.95728 5.68918 4.30376 4.99779 4.99779C4.3064 5.69182 3.95992 6.53283 3.95833 7.52083C3.95675 8.50883 4.30324 9.35011 4.99779 10.0447C5.69235 10.7392 6.53336 11.0854 7.52083 11.0833Z" fill="black" fill-opacity="0.4"/>
            </svg>
            <input type="text" placeholder="Cari Order" class="w-full h-6 bg-slate-50 pl-7 pr-2 text-[10px] rounded border border-slate-200 focus:border-violet-700 focus:outline-none transition"/>
        </div>

        <div class="relative mt-4">
            <button id="filterButton" class="h-6 px-2 border border-gray-100 rounded text-[10px] flex items-center justify-between w-32 bg-white">
                {{ request('filter') ? ucfirst(str_replace('_',' ',request('filter'))) : 'Urut Berdasarkan' }}
                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <ul id="filterMenu" class="absolute hidden w-full bg-white rounded shadow-md mt-1 z-50">
                <li data-value="order_id_asc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer">Order ID (Kecil → Besar)</li>
                <li data-value="order_id_desc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer">Order ID (Besar → Kecil)</li>
                <li data-value="pelanggan_asc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer">Pelanggan (A – Z)</li>
                <li data-value="pelanggan_desc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer">Pelanggan (Z – A)</li>
                <li data-value="tanggal_asc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer">Tanggal (Terlama → Terbaru)</li>
                <li data-value="tanggal_desc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer">Tanggal (Terbaru → Terlama)</li>
                <li data-value="jumlah_barang_asc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer">Jumlah Barang (Sedikit → Banyak)</li>
                <li data-value="jumlah_barang_desc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer">Jumlah Barang (Banyak → Sedikit)</li>
                <li data-value="total_harga_asc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer">Total Harga (Murah → Mahal)</li>
                <li data-value="total_harga_desc" class="px-2 py-1 text-[8px] hover:bg-violet-700 hover:text-white cursor-pointer rounded-b-md">Total Harga (Mahal → Murah)</li>
            </ul>
        </div>

        <form method="GET" action="{{ route('admin.order.index') }}" id="filterForm">
            <input type="hidden" name="filter" id="filterInput" value="{{ request('filter') }}">
            <button type="submit" class="h-6 px-2 bg-violet-700 text-white shadow-md rounded text-[10px] mt-4 cursor-pointer">Terapkan</button>
        </form>
    </div>

    <div class="w-[1037px] overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="grid grid-cols-7 border-b border-slate-200">
                    <th class="text-left text-[10px] font-medium py-2 px-2">Order ID</th>
                    <th class="text-left text-[10px] font-medium py-2 px-3">Pelanggan</th>
                    <th class="text-left text-[10px] font-medium py-2 px-1.5">Tanggal</th>
                    <th class="text-left text-[10px] font-medium py-2 px-4">Jumlah Barang</th>
                    <th class="text-left text-[10px] font-medium py-2">Total Harga</th>
                    <th class="text-left text-[10px] font-medium py-2">Status</th>
                    <th class="text-center text-[10px] font-medium py-2 px-2">Aksi</th>
                </tr>
            </thead>
        
            <tbody>
                @foreach ($orders as $order)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                        <td colspan="7" class="px-4">
                            <div class="grid grid-cols-7 items-center h-[50px] text-black text-[10px]">
                                <span class="font-medium">
                                    #{{ $order->id }}
                                </span>

                                <div class="flex flex-col w-[120px]">
                                    <span class="font-medium text-[8px]">
                                        {{ $order->username }}
                                    </span>
                                    <span class=" text-[8px] text-gray-500">
                                        {{ optional($order->user)->email ?? '-' }}
                                    </span>
                                </div>

                                <span class="">
                                    {{ $order->tanggal }}
                                </span>

                                <span class="text-center w-[40px]">
                                    {{ $order->jumlah_barang }}
                                </span>

                                <span class="w-[100px]">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </span>
            
                                <span class="px-2 py-1 rounded-md text-[8px] font-medium w-[45px] h-[20px] flex items-center justify-center
                                    @if($order->status === 'terkirim')
                                        bg-green-100 text-green-700
                                    @elseif($order->status === 'dikirim')
                                        bg-blue-100 text-blue-700
                                    @elseif($order->status === 'diproses')
                                        bg-yellow-100 text-yellow-700
                                    @else
                                        bg-red-100 text-red-700
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>

                                <div class="flex justify-end items-start gap-6 text-violet-700">
                                    <button type="button" class="btnShowOrder w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150" data-order='@json($order->load("user","products"))'>
                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.5 9.375C8.53553 9.375 9.375 8.53553 9.375 7.5C9.375 6.46447 8.53553 5.625 7.5 5.625C6.46447 5.625 5.625 6.46447 5.625 7.5C5.625 8.53553 6.46447 9.375 7.5 9.375Z" fill="#6D28D9"/>
                                            <path d="M14.5029 7.34062C13.9516 5.91452 12.9945 4.68123 11.7499 3.79317C10.5052 2.9051 9.02768 2.40121 7.4998 2.34375C5.97192 2.40121 4.49436 2.9051 3.24974 3.79317C2.00512 4.68123 1.048 5.91452 0.496676 7.34062C0.459441 7.44361 0.459441 7.55639 0.496676 7.65938C1.048 9.08548 2.00512 10.3188 3.24974 11.2068C4.49436 12.0949 5.97192 12.5988 7.4998 12.6562C9.02768 12.5988 10.5052 12.0949 11.7499 11.2068C12.9945 10.3188 13.9516 9.08548 14.5029 7.65938C14.5402 7.55639 14.5402 7.44361 14.5029 7.34062ZM7.4998 10.5469C6.89719 10.5469 6.3081 10.3682 5.80705 10.0334C5.30599 9.69859 4.91547 9.22273 4.68486 8.66599C4.45424 8.10924 4.39391 7.49662 4.51147 6.90558C4.62903 6.31455 4.91922 5.77165 5.34533 5.34553C5.77145 4.91942 6.31435 4.62923 6.90538 4.51167C7.49642 4.39411 8.10905 4.45444 8.66579 4.68505C9.22253 4.91567 9.69839 5.30619 10.0332 5.80725C10.368 6.3083 10.5467 6.89739 10.5467 7.5C10.5454 8.3077 10.224 9.08197 9.6529 9.6531C9.08177 10.2242 8.3075 10.5456 7.4998 10.5469Z" fill="#6D28D9"/>
                                        </svg>
                                    </button>

                                    <form action="{{ route('admin.order.send', $order->id) }}" method="POST">
                                        @csrf
                                        <button title="Kirim ke petugas" class=" w-[24px] h-[24px] flex items-center justify-center rounded transition-colors duration-150 {{ $order->status !== 'diproses' ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:bg-slate-200' }}" {{ $order->status !== 'diproses' ? 'disabled' : '' }}>
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.5 3.75C1.5 2.92266 2.17266 2.25 3 2.25H9.75C10.5773 2.25 11.25 2.92266 11.25 3.75V4.5H12.4383C12.8367 4.5 13.2188 4.65703 13.5 4.93828L14.5617 6C14.843 6.28125 15 6.66328 15 7.06172V10.5C15 11.3273 14.3273 12 13.5 12H13.4227C13.1789 12.8648 12.382 13.5 11.4375 13.5C10.493 13.5 9.69844 12.8648 9.45234 12H7.04766C6.80391 12.8648 6.00703 13.5 5.0625 13.5C4.11797 13.5 3.32344 12.8648 3.07734 12H3C2.17266 12 1.5 11.3273 1.5 10.5V9.375H0.5625C0.250781 9.375 0 9.12422 0 8.8125C0 8.50078 0.250781 8.25 0.5625 8.25H3.1875C3.49922 8.25 3.75 7.99922 3.75 7.6875C3.75 7.37578 3.49922 7.125 3.1875 7.125H0.5625C0.250781 7.125 0 6.87422 0 6.5625C0 6.25078 0.250781 6 0.5625 6H4.6875C4.99922 6 5.25 5.74922 5.25 5.4375C5.25 5.12578 4.99922 4.875 4.6875 4.875H0.5625C0.250781 4.875 0 4.62422 0 4.3125C0 4.00078 0.250781 3.75 0.5625 3.75H1.5ZM13.5 8.25V7.06172L12.4383 6H11.25V8.25H13.5ZM6 11.4375C6 10.9195 5.58047 10.5 5.0625 10.5C4.54453 10.5 4.125 10.9195 4.125 11.4375C4.125 11.9555 4.54453 12.375 5.0625 12.375C5.58047 12.375 6 11.9555 6 11.4375ZM11.4375 12.375C11.9555 12.375 12.375 11.9555 12.375 11.4375C12.375 10.9195 11.9555 10.5 11.4375 10.5C10.9195 10.5 10.5 10.9195 10.5 11.4375C10.5 11.9555 10.9195 12.375 11.4375 12.375Z" fill="#6D28D9"/>
                                            </svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus order ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button title="Hapus" class="w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150">
                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 3.5H9.75M4.125 5.375V10.375M6.625 5.375V10.375M4.125 1H6.625C6.79076 1 6.94973 1.06585 7.06694 1.18306C7.18415 1.30027 7.25 1.45924 7.25 1.625V3.5H3.5V1.625C3.5 1.45924 3.56585 1.30027 3.68306 1.18306C3.80027 1.06585 3.95924 1 4.125 1ZM1.625 3.5H9.125V11.625C9.125 11.7908 9.05915 11.9497 8.94194 12.0669C8.82473 12.1842 8.66576 12.25 8.5 12.25H2.25C2.08424 12.25 1.92527 12.1842 1.80806 12.0669C1.69085 11.9497 1.625 11.7908 1.625 11.625V3.5Z" stroke="#6D28D9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="flex items-center justify-between mt-6 text-[10px] text-slate-600">
        <span>
            Menampilkan
            {{ $orders->firstItem() ?? 0 }}
            -
            {{ $orders->lastItem() ?? 0 }}
            dari
            {{ $orders->total() }}
            order
        </span>

        <div class="flex gap-1">
            @if ($orders->onFirstPage())
                <span class="px-3 py-1 border rounded text-slate-400 cursor-pointer">Sebelumnya</span>
            @else
                <a href="{{ $orders->previousPageUrl() }}" class="px-3 py-1 border cursor-pointer rounded hover:bg-slate-100 cursor-pointer">
                    Selanjutnya
                </a>
            @endif

            @if ($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" class="px-3 py-1 border cursor-pointer rounded hover:bg-slate-100 cursor-pointer">
                    Sebelumnya
                </a>
            @else
                <span class="px-3 py-1 border rounded text-slate-400 cursor-pointer">Selanjutnya</span>
            @endif
        </div>
    </div>
</div>

<div id="cardDetailOrder" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 overflow-none">
    <div class="w-[392px] h-[566px] bg-white rounded-lg shadow-lg p-4 overflow-y-auto relative">

        <div class="flex justify-between items-center w-full">
            <span class="font-medium text-[15px] leading-[24px] text-black">
                Detail Order - #<span id="order_id"></span>
            </span>

            <button type="button" onclick="closeDetailOrderModal()" class="w-6 h-6 flex items-center justify-center text-gray-500 hover:text-gray-700 cursor-pointer">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-6">
                    <path d="M11.475 12.3625L7.49995 8.3812L3.52495 12.3625L2.63745 11.475L6.6187 7.49995L2.63745 3.52495L3.52495 2.63745L7.49995 6.6187L11.475 2.6437L12.3562 3.52495L8.3812 7.49995L12.3562 11.475L11.475 12.3625Z" fill="#6D28D9"/>
                </svg>
            </button>
        </div>


        <div class="flex justify-between items-start w-full mt-6">
            <div class="w-[104px] flex flex-col gap-0">
                <span class="font-medium text-[12px] leading-[16px] text-black/50 text-start">Customer</span>
                <span id="order_customer" class="font-medium text-[11px] leading-[16px] text-black text-start"></span>
                <span id="order_email" class="font-medium text-[11px] leading-[16px] text-black/50 text-start"></span>
                <span id="order_telepon" class="font-medium text-[11px] leading-[16px] text-black/50 text-start"></span>
            </div>

            <div class="w-[127px] flex flex-col gap-0">
                <span class="font-medium text-[10px] leading-[24px] text-start text-black/50">Tanggal Order</span>
                <span id="order_tanggal" class="font-medium text-[13px] leading-[24px] text-start text-black"></span>
                <span id="order_status_badge" class="px-2 py-1 rounded-md text-[8px] font-medium w-[45px] h-[20px] flex items-center justify-center"></span>
            </div>
        </div>

        <div class="flex flex-col justify-between mt-3">
            <span class="font-medium text-[12px] leading-[24px] text-left text-black block mb-4">
                Informasi Pengiriman
            </span>

            <div class="w-[360px] h-[60px] bg-slate-50 mx-auto p-2 rounded mb-2 overflow-y-auto flex flex-col gap-1">
                <span id="order_ekspedisi" class="font-medium text-[8px] text-black block"></span>
                <span id="order_alamat" class="font-medium text-[8px] text-black block"></span>
                <span id="order_tracking" class="font-medium text-[8px] text-black block"></span>
            </div>
        </div>

        <div class="flex flex-col justify-between mt-3">
            <span class="font-medium text-[12px] leading-[24px] text-left text-black block mb-2">
                Barang diorder
            </span>

            <div id="order_products" class="w-[360px] h-[60px] mx-auto mb-2 p-2 border border-gray-200 rounded flex flex-col gap-1 text-[8px]">
                
            </div>
        </div>

        <div class="w-[360px] mx-auto flex flex-col gap-1 mb-2 text-[12px] font-medium">
        <div class="flex justify-between"><span>Subtotal</span><span id="order_subtotal"></span></div>
        <div class="flex justify-between"><span>Pengiriman</span><span id="order_ongkir"></span></div>
        <div class="flex justify-between"><span>Pajak</span><span id="order_tax"></span></div>
        <div class="flex justify-between"><span>Diskon</span><span id="order_discount"></span></div>
        <div class="flex justify-between"><span>Total</span><span id="order_total"></span></div>
        </div>

        <div class="w-[360px] mt-8">
            <button class="w-full h-[40px] bg-violet-700 rounded-full flex items-center justify-center">
                <span class="font-medium text-[15px] leading-[18px] text-white">
                    Masukkan struk
                </span>
            </button>
        </div>

    </div>
</div>