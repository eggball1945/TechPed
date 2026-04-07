<div class="w-[1080px] flex gap-4">
    <div class="w-[740px] bg-white rounded-md border border-gray-300 p-4">
        <div class="w-[710px] overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-50/50 border-b border-gray-200">
                    <tr class="grid grid-cols-7">
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-2">Order ID</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-2">Pelanggan</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-2">Tanggal</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-1">Jumlah Barang</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-1">Total Harga</th>
                        <th class="text-left text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Status</th>
                        <th class="text-center text-[9px] font-bold text-black uppercase tracking-widest py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                            <td colspan="7" class="px-4">
                                <div class="grid grid-cols-7 items-center h-[50px] text-black text-[10px]">
                                    <span class="font-medium">#{{ $order->id }}</span>
                                    <div class="flex flex-col w-[120px]">
                                        <span class="font-medium text-[8px]">{{ $order->username }}</span>
                                        <span class="text-[8px] text-gray-500">{{ optional($order->user)->email ?? '-' }}</span>
                                    </div>
                                    <span>{{ $order->tanggal }}</span>
                                    <span class="text-center w-[40px]">{{ $order->jumlah_barang }}</span>
                                    <span class="w-[100px]">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                                    <span class="px-2 py-1 rounded-md text-[8px] font-medium w-[45px] h-[20px] flex items-center justify-center
                                        @if($order->status === 'selesai') bg-green-100 text-green-700
                                        @elseif($order->status === 'dikirim') bg-blue-100 text-blue-700
                                        @elseif($order->status === 'diproses') bg-yellow-100 text-yellow-700
                                        @elseif($order->status === 'tertunda') bg-orange-100 text-orange-700
                                        @else bg-red-100 text-red-700 @endif">
                                        @if($order->status === 'selesai') Selesai
                                        @elseif($order->status === 'dikirim') Dikirim
                                        @else {{ ucfirst($order->status) }} @endif
                                    </span>
                                    <div class="flex justify-end items-start gap-6 text-violet-700 px-5">
                                        <button type="button" class="btnShowOrder w-[24px] h-[24px] flex items-center justify-center rounded cursor-pointer hover:bg-slate-200 transition-colors duration-150" data-order='@json($order->load(['user.addresses', 'products']))'>
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.5 9.375C8.53553 9.375 9.375 8.53553 9.375 7.5C9.375 6.46447 8.53553 5.625 7.5 5.625C6.46447 5.625 5.625 6.46447 5.625 7.5C5.625 8.53553 6.46447 9.375 7.5 9.375Z" fill="#6D28D9"/>
                                                <path d="M14.5029 7.34062C13.9516 5.91452 12.9945 4.68123 11.7499 3.79317C10.5052 2.9051 9.02768 2.40121 7.4998 2.34375C5.97192 2.40121 4.49436 2.9051 3.24974 3.79317C2.00512 4.68123 1.048 5.91452 0.496676 7.34062C0.459441 7.44361 0.459441 7.55639 0.496676 7.65938C1.048 9.08548 2.00512 10.3188 3.24974 11.2068C4.49436 12.0949 5.97192 12.5988 7.4998 12.6562C9.02768 12.5988 10.5052 12.0949 11.7499 11.2068C12.9945 10.3188 13.9516 9.08548 14.5029 7.65938C14.5402 7.55639 14.5402 7.44361 14.5029 7.34062ZM7.4998 10.5469C6.89719 10.5469 6.3081 10.3682 5.80705 10.0334C5.30599 9.69859 4.91547 9.22273 4.68486 8.66599C4.45424 8.10924 4.39391 7.49662 4.51147 6.90558C4.62903 6.31455 4.91922 5.77165 5.34533 5.34553C5.77145 4.91942 6.31435 4.62923 6.90538 4.51167C7.49642 4.39411 8.10905 4.45444 8.66579 4.68505C9.22253 4.91567 9.69839 5.30619 10.0332 5.80725C10.368 6.3083 10.5467 6.89739 10.5467 7.5C10.5454 8.3077 10.224 9.08197 9.6529 9.6531C9.08177 10.2242 8.3075 10.5456 7.4998 10.5469Z" fill="#6D28D9"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between mt-6 text-[10px] text-slate-600">
            <span>Menampilkan {{ $orders->firstItem() ?? 0 }} - {{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() }} order</span>
            <div class="flex gap-1">
                @if ($orders->onFirstPage())
                    <span class="px-3 py-1 border rounded text-slate-400 cursor-not-allowed">Sebelumnya</span>
                @else
                    <a href="{{ $orders->previousPageUrl() }}" class="px-3 py-1 border rounded hover:bg-slate-100 cursor-pointer">Sebelumnya</a>
                @endif
                @if ($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}" class="px-3 py-1 border rounded hover:bg-slate-100 cursor-pointer">Selanjutnya</a>
                @else
                    <span class="px-3 py-1 border rounded text-slate-400 cursor-not-allowed">Selanjutnya</span>
                @endif
            </div>
        </div>
    </div>

<div class="w-[329px] bg-white rounded-md border border-gray-300 p-4">
    <h3 class="font-medium text-[15px] leading-[24px] text-black mb-4">Cetak Struk</h3>

    <div class="mb-4">
        <label class="font-medium text-[12px] leading-[24px] text-black block">Produk</label>
        <select id="struk_produk" class="w-full h-9 px-3 border border-gray-300 rounded-md text-[12px] focus:outline-none focus:ring-1 focus:ring-violet-700">
            <option value="">Pilih produk yang diorder</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="font-medium text-[12px] leading-[24px] text-black block">Order ID</label>
        <input type="text" id="struk_order_id" readonly value="#" class="w-full h-9 px-3 border border-gray-300 rounded-md bg-white text-[12px] focus:outline-none focus:ring-1 focus:ring-violet-700">
    </div>

    <div class="mb-4">
        <label class="font-medium text-[12px] leading-[24px] text-black block">Alamat</label>
        <textarea id="struk_alamat" placeholder="Masukkan alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md text-[12px] focus:outline-none focus:ring-1 focus:ring-violet-700 resize-none"></textarea>
    </div>

    <div class="grid grid-cols-2 gap-3 mb-4">
        <div>
            <label class="font-medium text-[12px] leading-[24px] text-black block">Jumlah</label>
            <input type="number" id="struk_jumlah" min="1" value="1" class="w-full h-9 px-3 border border-gray-300 rounded-md text-[12px] focus:outline-none focus:ring-1 focus:ring-violet-700">
        </div>
        <div>
            <label class="font-medium text-[12px] leading-[24px] text-black block">Pelanggan</label>
            <input type="text" id="struk_pelanggan" readonly value="Username" class="w-full h-9 px-3 border border-gray-300 rounded-md bg-white text-[12px] focus:outline-none focus:ring-1 focus:ring-violet-700">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-3 mb-4">
        <div>
            <label class="font-medium text-[12px] leading-[24px] text-black block">Tanggal</label>
            <input type="date" id="struk_tanggal" class="w-full h-9 px-3 border border-gray-300 rounded-md text-[12px] focus:outline-none focus:ring-1 focus:ring-violet-700">
        </div>
        <div>
            <label class="font-medium text-[12px] leading-[24px] text-black block">Total Harga</label>
            <input type="text" id="struk_total_harga" readonly value="Rp 0" class="w-full h-9 px-3 border border-gray-300 rounded-md bg-white text-[12px] focus:outline-none focus:ring-1 focus:ring-violet-700">
        </div>
    </div>

    <div class="border-t border-gray-200 pt-3 mt-3">
        <div class="flex justify-between text-[12px] leading-[15px] text-black mb-2">
            <span>Subtotal</span>
            <span id="struk_subtotal">Rp 0</span>
        </div>
        <div class="flex justify-between text-[12px] leading-[15px] text-black mb-2">
            <span>Pengiriman</span>
            <span id="struk_ongkir">Rp 0</span>
        </div>
        <div class="flex justify-between text-[12px] leading-[15px] text-black mb-2">
            <span>Pajak</span>
            <span id="struk_tax">Rp 0</span>
        </div>
        <div class="flex justify-between text-[12px] leading-[15px] text-black mb-2">
            <span>Diskon</span>
            <span id="struk_discount">Rp 0</span>
        </div>
        <div class="flex justify-between font-semibold text-[12px] leading-[15px] text-black border-t border-gray-200 pt-2 mt-1">
            <span>Total</span>
            <span id="struk_total">Rp 0</span>
        </div>
    </div>

    <button id="cetakStrukBtn" class="w-full mt-4 h-9 bg-violet-700 text-white rounded-md text-[15px] font-medium hover:bg-violet-800 transition">
        Cetak Struk
    </button>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="cardDetailOrder" class="hidden fixed inset-0 bg-black/40 items-center justify-center z-50">
    <div class="w-[392px] max-h-[90vh] bg-white rounded-lg shadow-lg p-4 overflow-y-auto overflow-x-hidden relative">
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
                <span id="order_status_badge" class="px-2 py-1 rounded-md text-[8px] font-medium min-w-[45px] h-[20px] flex items-center justify-center"></span>
            </div>
        </div>

        <div class="flex flex-col justify-between mt-3">
            <span class="font-medium text-[12px] leading-[24px] text-left text-black block mb-2">
                Informasi Pengiriman
            </span>

            <div class="w-full min-h-[80px] max-h-[120px] bg-slate-50 p-3 rounded mb-2 overflow-y-auto flex flex-col gap-1 border border-slate-100">
                <div class="flex flex-col gap-0.5">
                    <span class="text-[9px] text-black/40 font-medium uppercase tracking-wider">Ekspedisi</span>
                    <span id="order_ekspedisi" class="font-semibold text-[10px] text-black block"></span>
                </div>
                <div class="flex flex-col gap-0.5 mt-1">
                    <span class="text-[9px] text-black/40 font-medium uppercase tracking-wider">Alamat</span>
                    <span id="order_alamat" class="font-medium text-[10px] text-black block leading-relaxed"></span>
                </div>
                <div class="flex flex-col gap-0.5 mt-1">
                    <span class="text-[9px] text-black/40 font-medium uppercase tracking-wider">Nomor Resi</span>
                    <span id="order_tracking" class="font-semibold text-[10px] text-violet-700 block"></span>
                </div>
            </div>
        </div>

        <div id="order_proof_container" class="hidden flex flex-col justify-between mt-3">
            <span class="font-medium text-[12px] leading-[24px] text-left text-black block mb-2">
                Bukti Pembayaran
            </span>
            <div class="w-full h-[150px] bg-slate-50 border border-slate-100 rounded-lg overflow-hidden flex items-center justify-center">
                <img id="order_proof_img" src="" class="max-h-full max-w-full object-contain cursor-zoom-in hover:scale-105 transition-transform duration-300" onclick="if(typeof Swal !== 'undefined') { Swal.fire({imageUrl: this.src, imageAlt: 'Bukti Pembayaran', width: 'auto', padding: '1em', customClass: {image: 'max-h-[80vh] object-contain w-auto rounded-lg', closeButton: '!text-violet-700 hover:!text-violet-800 transition-colors'}, showConfirmButton: false, showCloseButton: true, backdrop: 'rgba(0,0,20,0.8)'}); } else { window.open(this.src); }" title="Klik untuk memperbesar">
            </div>
        </div>

        <div class="flex flex-col justify-between mt-4">
            <span class="font-medium text-[12px] leading-[24px] text-left text-black block mb-2">
                Barang diorder
            </span>

            <div id="order_products" class="w-full min-h-[100px] max-h-[180px] mb-2 p-2 border border-gray-100 rounded-lg flex flex-col gap-1 overflow-y-auto"></div>
        </div>

        <div class="w-full flex flex-col gap-2 mb-2 text-[12px] font-medium mt-4 bg-slate-50/50 p-3 rounded-xl border border-slate-100">
            <div class="flex justify-between text-black/60 text-[11px]"><span>Subtotal</span><span id="order_subtotal" class="text-black font-semibold"></span></div>
            <div class="flex justify-between text-black/60 text-[11px]"><span>Biaya Pengiriman</span><span id="order_ongkir" class="text-black font-semibold"></span></div>
            <div class="flex justify-between text-black/60 text-[11px]"><span>Pajak (PPN {{ \App\Models\SystemSetting::get('tax_percentage', 11) }}%)</span><span id="order_tax" class="text-black font-semibold"></span></div>
            <div class="flex justify-between text-red-500/80 text-[11px]"><span>Diskon</span><span id="order_discount" class="font-semibold"></span></div>
            <div class="w-full h-px my-1 bg-gray-200"></div>
            <div class="flex justify-between text-[14px] text-black"><span>Total Pembayaran</span><span id="order_total" class="text-violet-700 font-bold"></span></div>
        </div>

        <div class="w-[360px] mt-8">
            <button id="btnMasukkanStruk" class="w-full h-[40px] bg-violet-700 rounded-full flex items-center justify-center transition hover:bg-violet-800 disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="font-medium text-[15px] leading-[18px] text-white">Masukkan struk</span>
            </button>
        </div>
    </div>
</div>

<script>
    window.lastOrder = null;

    document.addEventListener('DOMContentLoaded', () => {
        // Show Order Details
        document.querySelectorAll('.btnShowOrder').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                try {
                    const orderJson = this.dataset.order;
                    const order = JSON.parse(orderJson);
                    openDetailOrderModal(order);
                } catch (error) {
                    console.error('Error parsing order:', error);
                    alertAction('Gagal memuat data order: ' + error.message);
                }
            });
        });

        // Load saved order from session
        const savedOrder = sessionStorage.getItem('selectedOrder');
        if (savedOrder) {
            try {
                const order = JSON.parse(savedOrder);
                sessionStorage.removeItem('selectedOrder');
                window.lastOrder = order;
                fillStrukForm(order);
            } catch (e) {
                console.error('Error loading saved order:', e);
            }
        }

        // Insert Struk Button (from modal to form)
        const btnStruk = document.getElementById('btnMasukkanStruk');
        if (btnStruk) {
            btnStruk.addEventListener('click', function() {
                if (window.lastOrder) {
                    fillStrukForm(window.lastOrder);
                    closeDetailOrderModal();
                } else {
                    alertAction('Tidak ada order yang dipilih. Silakan buka detail order terlebih dahulu.');
                }
            });
        }

        // Cetak Struk Button (Save Status to DIKIRIM/Selesai)
        const cetakBtn = document.getElementById('cetakStrukBtn');
        if (cetakBtn) {
            cetakBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (!window.lastOrder) {
                    alertAction('Tidak ada order yang dipilih. Silakan isi form dengan memilih order terlebih dahulu.');
                    return;
                }

                // Confirmation removed as per user request
                cetakBtn.disabled = true;
                cetakBtn.textContent = 'Menyimpan...';

                const orderId = window.lastOrder.id;
                const alamat = document.getElementById('struk_alamat').value;
                const jumlah = document.getElementById('struk_jumlah').value;
                const tanggal = document.getElementById('struk_tanggal').value;
                const produkId = document.getElementById('struk_produk').value;

                fetch(`/petugas/orders/${orderId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: 'dikirim',
                        alamat: alamat,
                        jumlah: jumlah,
                        tanggal: tanggal,
                        produk_id: produkId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh page to clear list
                        window.location.reload();
                    } else {
                        alertAction('Gagal mengubah status: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alertAction('Terjadi kesalahan saat mengirim data');
                })
                .finally(() => {
                    cetakBtn.disabled = false;
                    cetakBtn.textContent = 'Cetak Struk';
                });
            });
        }
    });

    window.openDetailOrderModal = function(order) {
        try {
            const card = document.getElementById('cardDetailOrder');
            if (!card) return;

            card.classList.remove('hidden');
            card.classList.add('flex');

            document.getElementById('order_id').textContent = order.id;
            document.getElementById('order_tanggal').textContent = order.tanggal;
            document.getElementById('order_customer').textContent = order.user?.nama_depan ?? order.username ?? '-';
            document.getElementById('order_email').textContent = order.email ?? order.user?.email ?? '-';
            document.getElementById('order_telepon').textContent = order.no_telepon ?? order.user?.no_telepon ?? '-';

            const statusBadge = document.getElementById('order_status_badge');
            if (statusBadge) {
                if (order.status === 'selesai') {
                    statusBadge.textContent = 'Selesai';
                } else if (order.status === 'dikirim') {
                    statusBadge.textContent = 'Dikirim';
                } else {
                    statusBadge.textContent = order.status.charAt(0).toUpperCase() + order.status.slice(1);
                }
                statusBadge.className = "px-2 py-1 rounded-md text-[8px] font-medium min-w-[45px] h-[20px] flex items-center justify-center";
                switch (order.status) {
                    case 'selesai': statusBadge.classList.add('bg-green-100', 'text-green-700'); break;
                    case 'dikirim': statusBadge.classList.add('bg-blue-100', 'text-blue-700'); break;
                    case 'diproses': statusBadge.classList.add('bg-yellow-100', 'text-yellow-700'); break;
                    case 'tertunda': statusBadge.classList.add('bg-orange-100', 'text-orange-700'); break;
                    case 'dibatalkan': statusBadge.classList.add('bg-red-100', 'text-red-700'); break;
                    default: statusBadge.classList.add('bg-gray-100', 'text-gray-700'); break;
                }
            }

            const productsContainer = document.getElementById('order_products');
            if (productsContainer) {
                productsContainer.innerHTML = '';
                if (order.products && Array.isArray(order.products)) {
                    order.products.forEach(prod => {
                        const div = document.createElement('div');
                        div.className = 'flex flex-row items-center gap-2 py-1 border-b border-gray-50 last:border-0';
                        const img = document.createElement('img');
                        img.className = 'w-10 h-10 object-cover rounded flex-shrink-0';
                        img.src = (prod.gambar_array && prod.gambar_array.length > 0) ? `/storage/${prod.gambar_array[0]}` : '/images/default.webp';
                        const textDiv = document.createElement('div');
                        textDiv.className = 'flex flex-col';
                        textDiv.innerHTML = `<span class="font-medium text-[11px] text-black">${prod.nama_produk}</span>
                                             <span class="font-medium text-[9px] text-black/50">${prod.pivot?.jumlah ?? 1} x Rp ${Number(prod.pivot?.harga ?? prod.harga).toLocaleString('id')}</span>`;
                        div.appendChild(img);
                        div.appendChild(textDiv);
                        productsContainer.appendChild(div);
                    });
                }
            }

            document.getElementById('order_subtotal').textContent = `Rp ${Number(order.subtotal ?? 0).toLocaleString('id')}`;
            document.getElementById('order_ongkir').textContent = `Rp ${Number(order.shipping_cost ?? 0).toLocaleString('id')}`;
            document.getElementById('order_tax').textContent = `Rp ${Number(order.pajak ?? 0).toLocaleString('id')}`;
            document.getElementById('order_discount').textContent = `- Rp ${Number(order.diskon ?? 0).toLocaleString('id')}`;
            document.getElementById('order_total').textContent = `Rp ${Number(order.total_harga ?? 0).toLocaleString('id')}`;

            document.getElementById('order_ekspedisi').textContent = order.shipping ?? '-';
            const fullAlamat = [order.alamat, order.kota, order.provinsi, order.kode_pos].filter(Boolean).join(', ');
            document.getElementById('order_alamat').textContent = fullAlamat || '-';
            document.getElementById('order_tracking').textContent = order.resi ?? '-';

            const proofContainer = document.getElementById('order_proof_container');
            const proofImg = document.getElementById('order_proof_img');
            if (proofContainer && proofImg) {
                if (order.proof_image) {
                    proofContainer.classList.remove('hidden');
                    proofImg.src = `/storage/${order.proof_image}`;
                } else {
                    proofContainer.classList.add('hidden');
                }
            }

            window.lastOrder = order;

            const btnStruk = document.getElementById('btnMasukkanStruk');
            if (btnStruk) {
                if (order.status === 'diproses' || order.status === 'tertunda') {
                    btnStruk.disabled = false;
                    btnStruk.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    btnStruk.disabled = true;
                    btnStruk.classList.add('opacity-50', 'cursor-not-allowed');
                }
            }

        } catch (error) {
            console.error('Error in openDetailOrderModal:', error);
        }
    };

    window.closeDetailOrderModal = function() {
        const card = document.getElementById('cardDetailOrder');
        if (card) {
            card.classList.add('hidden');
            card.classList.remove('flex');
        }
    };

    function fillStrukForm(order) {
        if (!order) return;

        const selectProduk = document.getElementById('struk_produk');
        if (selectProduk) {
            selectProduk.innerHTML = '<option value="">Pilih produk yang diorder</option>';
            if (order.products && Array.isArray(order.products)) {
                order.products.forEach((prod, index) => {
                    const option = document.createElement('option');
                    option.value = prod.id;
                    option.textContent = prod.nama_produk;
                    if (index === 0) option.selected = true;
                    selectProduk.appendChild(option);
                });
            }
        }

        const idStr = order.id.toString().replace('#', '');
        const orderIdInput = document.getElementById('struk_order_id');
        if (orderIdInput) orderIdInput.value = `#${idStr}`;

        const alamatInput = document.getElementById('struk_alamat');
        const fullAddr = [order.alamat, order.kota, order.provinsi, order.kode_pos].filter(Boolean).join(', ');
        if (alamatInput) alamatInput.value = fullAddr || '';

        const jumlahInput = document.getElementById('struk_jumlah');
        if (jumlahInput && order.products && order.products.length > 0) {
            jumlahInput.value = order.products[0].pivot?.jumlah || 1;
        }

        const pelangganInput = document.getElementById('struk_pelanggan');
        if (pelangganInput) {
            pelangganInput.value = order.user?.nama_depan || order.username || '-';
        }

        const tanggalInput = document.getElementById('struk_tanggal');
        if (tanggalInput && order.tanggal) {
            let date = new Date(order.tanggal);
            if (!isNaN(date.getTime())) {
                tanggalInput.value = date.toISOString().split('T')[0];
            }
        }

        const totalHargaInput = document.getElementById('struk_total_harga');
        if (totalHargaInput) totalHargaInput.value = `Rp ${Number(order.total_harga).toLocaleString('id')}`;

        const subtotalSpan = document.getElementById('struk_subtotal');
        if (subtotalSpan) subtotalSpan.textContent = `Rp ${Number(order.subtotal ?? 0).toLocaleString('id')}`;

        const ongkirSpan = document.getElementById('struk_ongkir');
        if (ongkirSpan) ongkirSpan.textContent = `Rp ${Number(order.shipping_cost ?? 0).toLocaleString('id')}`;

        const taxSpan = document.getElementById('struk_tax');
        if (taxSpan) taxSpan.textContent = `Rp ${Number(order.pajak ?? 0).toLocaleString('id')}`;

        const discountSpan = document.getElementById('struk_discount');
        if (discountSpan) discountSpan.textContent = `Rp ${Number(order.diskon ?? 0).toLocaleString('id')}`;

        const totalSpan = document.getElementById('struk_total');
        if (totalSpan) totalSpan.textContent = `Rp ${Number(order.total_harga).toLocaleString('id')}`;
    }

    function updateStatusInTable(orderId, newStatus) {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const idSpan = row.querySelector('span.font-medium');
            if (idSpan && idSpan.textContent.includes(orderId)) {
                const statusBadge = row.querySelector('span.px-2.py-1.rounded-md');
                if (statusBadge) {
                    if (newStatus === 'selesai') {
                        statusBadge.textContent = 'Selesai';
                    } else if (newStatus === 'dikirim') {
                        statusBadge.textContent = 'Dikirim';
                    } else {
                        statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    }
                    statusBadge.className = "px-2 py-1 rounded-md text-[8px] font-medium min-w-[45px] h-[20px] flex items-center justify-center";
                    if (newStatus === 'selesai') {
                        statusBadge.classList.add('bg-green-100', 'text-green-700');
                    } else if (newStatus === 'dikirim') {
                        statusBadge.classList.add('bg-blue-100', 'text-blue-700');
                    } else if (newStatus === 'diproses') {
                        statusBadge.classList.add('bg-yellow-100', 'text-yellow-700');
                    } else if (newStatus === 'tertunda') {
                        statusBadge.classList.add('bg-orange-100', 'text-orange-700');
                    } else {
                        statusBadge.classList.add('bg-red-100', 'text-red-700');
                    }
                }
            }
        });
    }
</script>