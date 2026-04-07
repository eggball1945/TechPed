@extends('user.layouts.app')

@section('title', 'Checkout | TechPed')

@section('content')
<div class="bg-gray-50 rounded-b-3xl min-h-screen">
    <div class="relative bg-violet-700 pt-32 pb-24 overflow-hidden rounded-t-3xl">        
        <div class="container mx-auto px-4 relative z-10 max-w-7xl">
            <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-violet-200 mb-10 overflow-x-auto whitespace-nowrap hide-scrollbar animate-fade-in font-sans">
                <a href="{{ route('landing') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-2.5 h-2.5 text-violet-300 opacity-50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                <a href="{{ route('user.products') }}" class="hover:text-white transition-colors">Produk</a>
                @if(request()->has('from') && request()->from == 'cart')
                    <svg class="w-2.5 h-2.5 text-violet-300 opacity-50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                    <a href="{{ route('cart') }}" class="hover:text-white transition-colors">Keranjang</a>
                @endif
                <svg class="w-2.5 h-2.5 text-violet-300 opacity-50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                <span class="text-white truncate">Checkout</span>
            </nav>
            
            <div class="animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-violet-100 text-xs font-bold tracking-wider uppercase mb-5 border border-white/10">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Aman & Terpercaya
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight">
                    Selesaikan Pesanan
                </h1>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-10 pb-24 relative z-20 max-w-7xl animate-fade-in-up" style="animation-delay: 200ms;">
        <div class="flex flex-col lg:flex-row gap-8">
        {{-- Left: Billing Details --}}
        <div class="flex-1">
            <div class="bg-white rounded-4xl shadow-xl shadow-gray-200/50 p-8 md:p-10 border border-gray-50">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-10 h-2 bg-violet-700 rounded-full"></div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tighter">Detail Penagihan</h2>
                </div>

                <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form" enctype="multipart/form-data">
                @csrf
                @if(request()->has('product_id'))
                    <input type="hidden" name="product_id" value="{{ request()->query('product_id') }}">
                    <input type="hidden" name="quantity" value="{{ request()->query('quantity', 1) }}">
                @else
                    <input type="hidden" name="cart_ids" value="{{ request()->query('cart_ids') }}">
                @endif

                {{-- Address Selection --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Alamat</label>
                    <select id="address-select"
                        onclick="event.stopPropagation();"
                        class="w-full rounded-lg border border-gray-200 px-4 py-3.5 text-sm font-medium text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-violet-500 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M7%2010L12%2015L17%2010%22%20stroke%3D%22%236B7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.5rem_1.5rem] bg-[position:right_1rem_center] bg-no-repeat cursor-pointer transition-all outline-none hover:border-violet-300">
                        <option value="new" class="font-medium">+ Tambah Alamat Baru</option>
                        @foreach ($addresses as $addr)
                            <option value="{{ $addr->id }}" data-alamat="{{ $addr->alamat }}"
                                data-kota="{{ $addr->kota }}" data-provinsi="{{ $addr->provinsi }}"
                                data-kode_pos="{{ $addr->kode_pos }}">
                                {{ $addr->alamat }}, {{ $addr->kota }}, {{ $addr->provinsi }} - {{ $addr->kode_pos }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- New Address Fields --}}
                <div id="new-address-fields" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
                        <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent hover:border-violet-700 transition outline-none">
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kota *</label>
                        <input type="text" name="kota" id="kota" value="{{ old('kota') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent hover:border-violet-700 transition outline-none">
                        @error('kota')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
                        <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent hover:border-violet-700 transition outline-none">
                        @error('provinsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos *</label>
                        <input type="text" name="kode_pos" id="kode_pos" value="{{ old('kode_pos') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent hover:border-violet-700 transition outline-none">
                        @error('kode_pos')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="address_id" id="address_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Depan *</label>
                        <input type="text" name="nama_depan" value="{{ old('nama_depan', $user->nama_depan) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent hover:border-violet-700 transition outline-none">
                        @error('nama_depan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang (Opsional)</label>
                        <input type="text" name="nama_belakang" value="{{ old('nama_belakang') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent hover:border-violet-700 transition outline-none">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Apartemen, lantai, dll. (Opsional)</label>
                    <input type="text" name="alamat_tambahan" value="{{ old('alamat_tambahan') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent hover:border-violet-700 transition outline-none">
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent hover:border-violet-700 transition outline-none">
                    @error('no_telepon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent hover:border-violet-700 transition outline-none">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </form>
            </div>
        </div>

        {{-- Right: Order Summary --}}
        <div class="lg:w-96">
            <div class="bg-white rounded-4xl shadow-xl shadow-gray-200/50 p-8 border border-gray-50 sticky top-24">
                <h3 class="text-xl font-black text-gray-900 tracking-tighter uppercase mb-6 border-b border-gray-100 pb-4">Ringkasan Pesanan</h3>

                <div class="space-y-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                    @foreach ($carts as $item)
                        <div class="flex gap-4">
                            <img src="{{ $item->product->gambar_array[0] ? asset('storage/' . $item->product->gambar_array[0]) : asset('images/no-image.png') }}"
                                class="w-14 h-14 object-cover rounded-lg">
                            <div class="flex-1">
                                <p class="text-sm font-medium">{{ $item->product->nama_produk }}</p>
                                <p class="text-xs text-gray-500">Jumlah: {{ $item->qty }}</p>
                            </div>
                            <span class="text-sm font-medium">Rp
                                {{ number_format($item->product->harga * $item->qty, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 my-4"></div>

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Pengiriman</span>
                            <span id="shipping-cost-display">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>PPN ({{ \App\Models\SystemSetting::get('tax_percentage', 11) }}%)</span>
                            <span id="tax-display">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-base font-bold pt-2 border-t border-gray-200">
                            <span>Total</span>
                            <span id="total-display" class="text-violet-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                <div class="mt-8">
                    <h4 id="ekspedisi-header" class="font-black text-sm text-gray-900 tracking-widest uppercase mb-4">Ekspedisi (Jabodetabek)</h4>
                    <div class="space-y-3">
                        {{-- JNE --}}
                        <div class="border border-violet-100 bg-violet-50/30 rounded-2xl p-4 hover:border-violet-300 transition-colors cursor-pointer" onclick="document.getElementById('jne_reguler').click()">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="shipping" id="jne_reguler" value="jne_reguler" form="checkout-form" class="w-4 h-4 text-violet-700 bg-gray-100 border-gray-300 focus:ring-violet-500">
                                    <span class="font-bold text-gray-900 text-sm">JNE Reguler (REG)</span>
                                </div>
                                <div class="text-right">
                                    <span id="jne_reg_price" class="text-sm font-black text-violet-700">Rp 10.000</span>
                                    <p id="jne_reg_est" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">2-3 hari</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-violet-100/50" onclick="event.stopPropagation(); document.getElementById('jne_express').click()">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="shipping" id="jne_express" value="jne_express" form="checkout-form" class="w-4 h-4 text-violet-700 bg-gray-100 border-gray-300 focus:ring-violet-500">
                                    <span class="font-bold text-gray-900 text-sm">JNE Express (YES)</span>
                                </div>
                                <div class="text-right">
                                    <span id="jne_express_price" class="text-sm font-black text-violet-700">Rp 15.000</span>
                                    <p id="jne_express_est" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">1 hari</p>
                                </div>
                            </div>
                        </div>

                        {{-- J&T --}}
                        <div class="border border-violet-100 bg-violet-50/30 rounded-2xl p-4 hover:border-violet-300 transition-colors cursor-pointer" onclick="document.getElementById('jnt_reguler').click()">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="shipping" id="jnt_reguler" value="jnt_reguler" form="checkout-form" class="w-4 h-4 text-violet-700 bg-gray-100 border-gray-300 focus:ring-violet-500">
                                    <span class="font-bold text-gray-900 text-sm">J&T Reguler (EZ)</span>
                                </div>
                                <div class="text-right">
                                    <span id="jnt_reg_price" class="text-sm font-black text-violet-700">Rp 10.000</span>
                                    <p id="jnt_reg_est" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">2-5 hari</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-violet-100/50" onclick="event.stopPropagation(); document.getElementById('jnt_express').click()">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="shipping" id="jnt_express" value="jnt_express" form="checkout-form" class="w-4 h-4 text-violet-700 bg-gray-100 border-gray-300 focus:ring-violet-500">
                                    <span class="font-bold text-gray-900 text-sm">J&T Express (Super)</span>
                                </div>
                                <div class="text-right">
                                    <span id="jnt_express_price" class="text-sm font-black text-violet-700">Rp 15.000</span>
                                    <p id="jnt_express_est" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">1-2 hari</p>
                                </div>
                            </div>
                        </div>

                        <div id="shipping-warning" class="{{ $errors->has('shipping') ? 'flex' : 'hidden' }} items-center gap-2 mt-2 text-violet-700 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Bagian ekspedisi tidak boleh kosong</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Metode Pembayaran</h4>
                    <div class="space-y-2">
                        @foreach (['bank' => 'Bank Transfer', 'cod' => 'Cash on Delivery', 'qris' => 'QRIS'] as $value => $label)
                            <label class="flex items-center gap-2">
                                <input type="radio" name="payment" value="{{ $value }}" form="checkout-form" class="accent-violet-700">
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                        <div id="payment-warning" class="{{ $errors->has('payment') ? 'flex' : 'hidden' }} items-center gap-2 mt-2 text-violet-700 text-sm font-medium" style="font-family: 'Poppins', sans-serif;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Metode pembayaran tidak boleh kosong</span>
                        </div>
                    </div>

                    <div id="bank-transfer-details" class="mt-4 p-4 border border-gray-200 rounded-lg hidden">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="font-medium text-gray-800">{{ \App\Models\SystemSetting::get('bank_name', 'Bank Central Asia (BCA)') }}</span>
                        </div>
                        <div class="flex items-center gap-2 mb-1">
                            <p class="text-sm text-gray-600">Nomor Rekening: <strong id="bank-acc-number" class="font-semibold">{{ \App\Models\SystemSetting::get('bank_account_number', '1234 5678 9012 3456') }}</strong></p>
                            <button type="button" onclick="copyToClipboard('bank-acc-number', 'Nomor Rekening')" class="p-1 text-gray-400 hover:text-violet-700 transition-colors bg-gray-50 rounded-md hover:bg-violet-50 group relative cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">a.n. <strong>{{ \App\Models\SystemSetting::get('bank_account_name', 'TechPed Indonesia') }}</strong></p>
                        <div class="mt-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Transfer <span class="text-red-500">*</span></label>
                            <input type="file" form="checkout-form" name="proof_image_bank" id="proof_image_bank" accept="image/*" class="proof-input w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                            <p class="text-xs text-gray-500 mt-1">Format JPG, PNG, maks 2MB. Upload bukti transfer untuk menyelesaikan pesanan.</p>
                        </div>
                    </div>

                    <div id="qris-details" class="mt-4 p-4 border border-gray-200 rounded-lg hidden relative overflow-hidden bg-white">
                        <div id="qris-main-content">
                            <div class="flex flex-col items-center gap-3 mb-4 text-center">
                                <span class="font-medium text-gray-800 text-sm">Scan QRIS untuk Pembayaran</span>
                                <div id="qris-trigger" class="relative group cursor-zoom-in overflow-hidden rounded-xl border border-violet-100 p-2 hover:border-violet-400 transition-all duration-300 bg-gray-50">
                                    <img src="{{ asset('images/qris_payment.png') }}" alt="QRIS" class="w-40 h-auto rounded-lg shadow-sm group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                        <span class="bg-white/90 text-violet-700 text-[10px] font-bold px-2 py-1 rounded-full shadow-md">Klik Zoom</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Pembayaran QRIS <span class="text-red-500">*</span></label>
                                <input type="file" form="checkout-form" name="proof_image_qris" id="proof_image_qris" accept="image/*" class="proof-input w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                                <p class="text-[10px] text-gray-400 mt-1 italic leading-tight">* Simpan bukti pembayaran untuk verifikasi cepat oleh admin.</p>
                            </div>
                        </div>

                        <div id="qris-local-zoom" class="absolute inset-0 bg-white z-20 hidden flex-col items-center justify-center p-4 transition-all duration-300">
                            <button id="close-local-zoom" type="button" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 transition-colors p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <img src="{{ asset('images/qris_payment.png') }}" class="w-full h-auto max-w-[280px] rounded-xl shadow-lg border border-gray-100 mb-3">
                            <p class="text-[10px] text-center text-gray-500 font-medium px-4">Pastikan nominal sesuai dengan total pesanan Anda.</p>
                        </div>
                    </div>

                    <input type="hidden" form="checkout-form" name="proof_image_placeholder" id="proof_image_placeholder">
                    
                    <div id="proof-warning" class="hidden items-center gap-2 mt-3 p-3 bg-violet-50 rounded-lg text-violet-700 text-sm font-medium border border-violet-100 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Bukti pembayaran harus diupload sebelum melanjutkan.</span>
                    </div>

                </div>
                
                <button type="submit" form="checkout-form"
                    class="mt-8 w-full bg-violet-700 hover:shadow-2xl hover:shadow-violet-200 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-violet-100 active:scale-[0.98] uppercase tracking-widest text-sm cursor-pointer border border-violet-500">
                    Selesaikan Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(elementId, label) {
        const text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(() => {
            if(typeof Swal !== 'undefined') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    iconColor: '#7c3aed',
                    title: label + ' berhasil disalin!',
                    text: text,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    showCloseButton: true,
                    customClass: {
                        popup: '!bg-white !rounded-2xl !shadow-2xl border border-gray-100',
                        title: '!text-violet-700 !font-bold !text-sm',
                        htmlContainer: '!text-gray-500 !text-xs !font-medium'
                    }
                });
            } else {
                alert(label + ' disalin!');
            }
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->any())
            const errors = {!! json_encode($errors->getMessages()) !!};
            showValidationAlert(errors);
        @endif

        const addressSelect = document.getElementById('address-select');
        const newAddressFields = document.getElementById('new-address-fields');
        const alamatInput = document.getElementById('alamat');
        const kotaInput = document.getElementById('kota');
        const provinsiInput = document.getElementById('provinsi');
        const kodePosInput = document.getElementById('kode_pos');
        const addressIdInput = document.getElementById('address_id');

        function updateForm() {
            const selected = addressSelect.value;
            if (selected === 'new') {
                newAddressFields.style.display = 'block';
                addressIdInput.value = '';
                alamatInput.required = true;
                kotaInput.required = true;
                provinsiInput.required = true;
                kodePosInput.required = true;
            } else {
                newAddressFields.style.display = 'none';
                addressIdInput.value = selected;
                alamatInput.required = false;
                kotaInput.required = false;
                provinsiInput.required = false;
                kodePosInput.required = false;
                const option = addressSelect.options[addressSelect.selectedIndex];
                alamatInput.value = option.dataset.alamat || '';
                kotaInput.value = option.dataset.kota || '';
                provinsiInput.value = option.dataset.provinsi || '';
                kodePosInput.value = option.dataset.kode_pos || '';
            }
        }

        addressSelect.addEventListener('change', updateForm);
        updateForm();

        const checkoutForm = document.getElementById('checkout-form');
        const shippingWarning = document.getElementById('shipping-warning');
        const paymentWarning = document.getElementById('payment-warning');

        document.querySelectorAll('input[name="shipping"]').forEach(el => {
            el.addEventListener('change', () => {
                if (shippingWarning) {
                    shippingWarning.classList.add('hidden');
                    shippingWarning.classList.remove('flex');
                }
            });
        });

        document.querySelectorAll('input[name="payment"]').forEach(el => {
            el.addEventListener('change', () => {
                if (paymentWarning) {
                    paymentWarning.classList.add('hidden');
                    paymentWarning.classList.remove('flex');
                }
                // Hide proof warning when payment changes
                if (proofWarning) {
                    proofWarning.classList.add('hidden');
                    proofWarning.classList.remove('flex');
                }
            });
        });

        let shippingCosts = {
            'jne_reguler': 10000,
            'jne_express': 15000,
            'jnt_reguler': 10000,
            'jnt_express': 15000
        };

        function updateShippingZone(kota, prov) {
            const locStr = ((kota || '') + ' ' + (prov || '')).toLowerCase();
            let zona = 3; // Luar Jawa

            const zone1 = ['jakarta', 'dki', 'banten', 'jawa barat', 'jabar', 'depok', 'bogor', 'tangerang', 'bekasi', 'cilegon', 'serang'];
            const zone2 = ['jawa tengah', 'jateng', 'yogyakarta', 'jogja', 'diy', 'jawa timur', 'jatim', 'surabaya', 'semarang', 'malang', 'solo', 'sleman', 'bantul'];

            if (zone1.some(keyword => locStr.includes(keyword))) {
                zona = 1;
            } else if (zone2.some(keyword => locStr.includes(keyword))) {
                zona = 2;
            }

            const headerExp = document.getElementById('ekspedisi-header');
            if(headerExp) {
                 if(zona === 1) headerExp.innerText = 'Ekspedisi (Jabodetabek & Jabar)';
                 else if(zona === 2) headerExp.innerText = 'Ekspedisi (Jawa Lainnya)';
                 else headerExp.innerText = 'Ekspedisi (Luar Pulau Jawa)';
            }

            if (zona === 1) {
                shippingCosts = {'jne_reguler': 10000, 'jne_express': 15000, 'jnt_reguler': 10000, 'jnt_express': 15000};
                document.getElementById('jne_reg_price').innerText = 'Rp 10.000';
                document.getElementById('jne_express_price').innerText = 'Rp 15.000';
                document.getElementById('jnt_reg_price').innerText = 'Rp 10.000';
                document.getElementById('jnt_express_price').innerText = 'Rp 15.000';
                
                document.getElementById('jne_reg_est').innerText = '2-3 hari';
                document.getElementById('jne_express_est').innerText = '1 hari';
                document.getElementById('jnt_reg_est').innerText = '2-5 hari';
                document.getElementById('jnt_express_est').innerText = '1-2 hari';
            } else if (zona === 2) {
                shippingCosts = {'jne_reguler': 20000, 'jne_express': 30000, 'jnt_reguler': 20000, 'jnt_express': 30000};
                document.getElementById('jne_reg_price').innerText = 'Rp 20.000';
                document.getElementById('jne_express_price').innerText = 'Rp 30.000';
                document.getElementById('jnt_reg_price').innerText = 'Rp 20.000';
                document.getElementById('jnt_express_price').innerText = 'Rp 30.000';

                document.getElementById('jne_reg_est').innerText = '2-4 hari';
                document.getElementById('jne_express_est').innerText = '1-2 hari';
                document.getElementById('jnt_reg_est').innerText = '3-5 hari';
                document.getElementById('jnt_express_est').innerText = '1-3 hari';
            } else {
                shippingCosts = {'jne_reguler': 40000, 'jne_express': 60000, 'jnt_reguler': 40000, 'jnt_express': 60000};
                document.getElementById('jne_reg_price').innerText = 'Rp 40.000';
                document.getElementById('jne_express_price').innerText = 'Rp 60.000';
                document.getElementById('jnt_reg_price').innerText = 'Rp 40.000';
                document.getElementById('jnt_express_price').innerText = 'Rp 60.000';

                document.getElementById('jne_reg_est').innerText = '3-7 hari';
                document.getElementById('jne_express_est').innerText = '2-4 hari';
                document.getElementById('jnt_reg_est').innerText = '4-7 hari';
                document.getElementById('jnt_express_est').innerText = '2-5 hari';
            }
            updateShippingAndTotal();
        }

        kotaInput.addEventListener('input', function() {
             updateShippingZone(kotaInput.value, provinsiInput.value);
        });

        provinsiInput.addEventListener('input', function() {
             updateShippingZone(kotaInput.value, provinsiInput.value);
        });
        
        // Listen to address select changes too
        addressSelect.addEventListener('change', function() {
            setTimeout(() => {
                updateShippingZone(kotaInput.value, provinsiInput.value);
            }, 50);
        });
        const subtotalValue = {{ $subtotal }};
        const shippingCostSpan = document.getElementById('shipping-cost-display');
        const totalSpan = document.getElementById('total-display');

        function updateShippingAndTotal() {
            const selectedShipping = document.querySelector('input[name="shipping"]:checked');
            let shippingCost = 0;
            if (selectedShipping) {
                shippingCost = shippingCosts[selectedShipping.value] || 0;
            }
            const taxPercentage = {{ \App\Models\SystemSetting::get('tax_percentage', 11) / 100 }};
            const tax = subtotalValue * taxPercentage;
            const total = subtotalValue + shippingCost + tax;

            if (shippingCostSpan) shippingCostSpan.textContent = 'Rp ' + shippingCost.toLocaleString('id');
            if (totalSpan) totalSpan.textContent = 'Rp ' + Math.round(total).toLocaleString('id');
            const taxDisplay = document.getElementById('tax-display');
            if (taxDisplay) taxDisplay.textContent = 'Rp ' + Math.round(tax).toLocaleString('id');
        }

        document.querySelectorAll('input[name="shipping"]').forEach(radio => {
            radio.addEventListener('change', updateShippingAndTotal);
        });
        updateShippingAndTotal();
        
        // Initial zone load (placed here to avoid ReferenceError with const variables)
        updateShippingZone(kotaInput.value, provinsiInput.value);

        const paymentRadios = document.querySelectorAll('input[name="payment"]');
        const bankDetails = document.getElementById('bank-transfer-details');
        const qrisDetails = document.getElementById('qris-details');
        const proofInputBank = document.getElementById('proof_image_bank');
        const proofInputQris = document.getElementById('proof_image_qris');
        const proofWarning = document.getElementById('proof-warning');
        
        // Modal logic (Local Zoom)
        const qrisTrigger = document.getElementById('qris-trigger');
        const qrisLocalZoom = document.getElementById('qris-local-zoom');
        const closeLocalZoom = document.getElementById('close-local-zoom');

        if (qrisTrigger && qrisLocalZoom) {
            qrisTrigger.addEventListener('click', () => {
                qrisLocalZoom.classList.remove('hidden');
                qrisLocalZoom.classList.add('flex');
            });

            closeLocalZoom.addEventListener('click', () => {
                qrisLocalZoom.classList.add('hidden');
                qrisLocalZoom.classList.remove('flex');
            });
        }

        if (paymentRadios.length) {
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Reset all details first
                    if (bankDetails) bankDetails.classList.add('hidden');
                    if (qrisDetails) qrisDetails.classList.add('hidden');
                    if (proofWarning) {
                        proofWarning.classList.add('hidden');
                        proofWarning.classList.remove('flex');
                    }

                    if (this.value === 'bank' && bankDetails) {
                        bankDetails.classList.remove('hidden');
                    } else if (this.value === 'qris' && qrisDetails) {
                        qrisDetails.classList.remove('hidden');
                    }
                });
            });

            // Initial state
            const checkedPayment = document.querySelector('input[name="payment"]:checked');
            if (checkedPayment) {
                if (checkedPayment.value === 'bank' && bankDetails) bankDetails.classList.remove('hidden');
                if (checkedPayment.value === 'qris' && qrisDetails) qrisDetails.classList.remove('hidden');
            }
        }

        document.querySelectorAll('.proof-input').forEach(input => {
            input.addEventListener('change', function() {
                if (proofWarning) {
                    proofWarning.classList.add('hidden');
                    proofWarning.classList.remove('flex');
                }
            });
        });

        checkoutForm.addEventListener('submit', function(e) {
            const shipping = document.querySelector('input[name="shipping"]:checked');
            const payment = document.querySelector('input[name="payment"]:checked');
            let hasError = false;

            if (!shipping) {
                if (shippingWarning) {
                    shippingWarning.classList.remove('hidden');
                    shippingWarning.classList.add('flex');
                }
                hasError = true;
            }

            if (!payment) {
                if (paymentWarning) {
                    paymentWarning.classList.remove('hidden');
                    paymentWarning.classList.add('flex');
                }
                hasError = true;
            }

            if (payment) {
                if (payment.value === 'bank') {
                    if (!proofInputBank || proofInputBank.files.length === 0) {
                        if (proofWarning) {
                            proofWarning.classList.remove('hidden');
                            proofWarning.classList.add('flex');
                        }
                        hasError = true;
                    }
                } else if (payment.value === 'qris') {
                    if (!proofInputQris || proofInputQris.files.length === 0) {
                        if (proofWarning) {
                            proofWarning.classList.remove('hidden');
                            proofWarning.classList.add('flex');
                        }
                        hasError = true;
                    }
                }
            }


            if (hasError) {
                e.preventDefault();
            }
        });
    });

    function showValidationAlert(errors) {
        let errorList = '';
        for (let field in errors) {
            errorList += `<li class="text-sm">• ${errors[field][0]}</li>`;
        }
        let overlay = document.createElement('div');
        overlay.className = 'fixed inset-0 bg-black/50 flex items-center justify-center z-50';
        let alertBox = document.createElement('div');
        alertBox.className = 'bg-red-50 border border-red-200 rounded-xl shadow-2xl p-8 max-w-md w-full mx-4';
        alertBox.innerHTML = `
            <div class="flex items-start gap-4">
                <div class="shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <span class="text-red-900 text-xl font-bold">✕</span>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-red-900 text-lg font-bold">Data Belum Lengkap!</h3>
                    <div class="text-red-800 mt-3">
                        <ul class="space-y-1">${errorList}</ul>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button onclick="this.closest('.fixed').remove()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">OK</button>
            </div>
        `;
        overlay.appendChild(alertBox);
        document.body.appendChild(overlay);
    }
</script>
@endsection
