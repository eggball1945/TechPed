@extends('user.layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        @if(session('success'))
        <div class="mb-8 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm animate-fade-in-down">
            <div class="flex items-center">
                <div class="flex-shrink-0 text-violet-500">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <div id="receipt-content" class="bg-white rounded-[2.5rem] overflow-hidden ring-1 ring-black/5 animate-fade-in">
            <div class="bg-violet-700 px-6 sm:px-8 py-8 sm:py-10 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-32 h-32 bg-indigo-400/20 rounded-full blur-2xl"></div>
                
                <div class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center gap-4">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">TechPed Indonesia</h1>
                            <p class="text-violet-100 text-xs sm:text-sm font-medium opacity-90 mt-1">Tanda Terima Transaksi Resmi</p>
                        </div>
                    </div>
                    <div class="w-full md:w-auto text-left md:text-right flex flex-col items-start md:items-end">
                        <span class="bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-widest border border-white/30">
                            {{ strtoupper($order->status) }}
                        </span>
                        <p class="mt-3 text-violet-100 text-xs sm:text-sm opacity-80 italic">#{{ $order->id }} / {{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
                    <div class="space-y-4">
                        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-violet-500"></div>
                            Informasi Toko
                        </h3>
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 space-y-2">
                            <p class="font-bold text-gray-900">TechPed Store</p>
                            <p class="text-sm text-gray-600 leading-relaxed">Jl. Kemiri Jaya Rt 01 Rw 06, Tanah Baru, Beji, Depok, Jawa Barat 16426</p>
                            <div class="pt-2 space-y-1">
                                <p class="text-sm text-gray-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    techped@gmail.com
                                </p>
                                <p class="text-sm text-gray-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    +88015-88888-9999
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-violet-700"></div>
                            Tujuan Pengiriman
                        </h3>
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 space-y-2">
                            <p class="font-bold text-gray-900">{{ $order->username }}</p>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $order->alamat }}, {{ $order->kota }}</p>
                            <p class="text-sm text-gray-600">{{ $order->provinsi }}, {{ $order->kode_pos }}</p>
                            <div class="pt-2 space-y-1 border-t border-gray-200 mt-2">
                                <p class="text-sm text-gray-600 flex items-center gap-2">
                                    <span class="font-semibold text-gray-400 w-16">Telp:</span> {{ $order->no_telepon }}
                                </p>
                                <p class="text-sm text-gray-600 flex items-center gap-2">
                                    <span class="font-semibold text-gray-400 w-16">Email:</span> {{ $order->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Product Table --}}
                <div class="mb-12">
                    <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-4 flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-violet-700"></div>
                        Rincian Pesanan
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b border-gray-100">
                                    <th class="pb-4 font-bold text-gray-400 text-xs uppercase tracking-wider">Produk</th>
                                    <th class="pb-4 font-bold text-gray-400 text-xs uppercase tracking-wider text-center">SKU</th>
                                    <th class="pb-4 font-bold text-gray-400 text-xs uppercase tracking-wider text-center">Qty</th>
                                    <th class="pb-4 font-bold text-gray-400 text-xs uppercase tracking-wider text-right">Harga</th>
                                    <th class="pb-4 font-bold text-gray-400 text-xs uppercase tracking-wider text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($order->products as $product)
                                <tr class="text-sm text-gray-600">
                                    <td class="py-6 min-w-[300px]">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 rounded-xl overflow-hidden border border-gray-100 shadow-sm flex-shrink-0">
                                                <img src="{{ asset('storage/' . ($product->gambar_array[0] ?? '')) }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="max-w-[200px]">
                                                <p class="font-bold text-gray-900 truncate" title="{{ $product->nama_produk }}">{{ $product->nama_produk }}</p>
                                                <p class="text-[10px] text-gray-400 mt-0.5">{{ $product->kategori }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-6 text-center">
                                        <span class="bg-gray-100 text-gray-600 text-[10px] font-mono font-bold px-2 py-1 rounded">
                                            {{ $product->sku ?? 'TP-'.str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="py-6 text-center font-medium">{{ $product->pivot->jumlah }}</td>
                                    <td class="py-6 text-right font-medium text-gray-500 italic">Rp {{ number_format($product->pivot->harga, 0, ',', '.') }}</td>
                                    <td class="py-6 text-right font-bold text-gray-900">Rp {{ number_format($product->pivot->harga * $product->pivot->jumlah, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <div class="lg:col-span-7 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">Metode Pengiriman</p>
                                <p class="font-bold text-gray-900">{{ $order->shipping }}</p>
                                <p class="text-xs text-gray-500 mt-1">Estimasi tiba: <span class="font-semibold text-violet-600">{{ $order->estimasi_hari ?? '-' }}</span></p>
                            </div>
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">Metode Pembayaran</p>
                                <p class="font-bold text-gray-900">{{ $order->payment }}</p>
                                <p class="text-xs text-gray-500 mt-1">Status: <span class="font-semibold text-violet-700 uppercase">{{ $order->status }}</span></p>
                            </div>
                        </div>

                        <div class="bg-violet-50 rounded-2xl p-6 border border-violet-100 flex items-start gap-4">
                            <div class="bg-violet-600 p-2.5 rounded-xl shadow-lg shadow-violet-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-violet-900">Informasi Penting</h4>
                                <p class="text-xs text-violet-700 leading-relaxed mt-1 opacity-80">
                                    Simpan struk ini sebagai bukti transaksi yang sah. Untuk retur atau garansi, sertakan nomor pesanan <strong>#{{ $order->id }}</strong>. Kebijakan retur berlaku 7 hari setelah barang diterima.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Totals --}}
                    <div class="lg:col-span-5 space-y-4">
                        <div class="space-y-3 pb-4 border-b border-gray-100">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 font-medium">Subtotal Produk</span>
                                <span class="text-gray-900 font-bold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 font-medium">Biaya Pengiriman</span>
                                <span class="text-gray-900 font-bold">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 font-medium font-bold text-violet-600">Diskon</span>
                                <span class="text-violet-600 font-bold">- Rp {{ number_format($order->diskon, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 font-medium">Pajak (PPN {{ \App\Models\SystemSetting::get('tax_percentage', 11) }}%)</span>
                                <span class="text-gray-900 font-bold">Rp {{ number_format($order->pajak ?: $order->subtotal * (\App\Models\SystemSetting::get('tax_percentage', 11) / 100), 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            {{-- Placeholder for moved section --}}
                        </div>
                    </div>
                </div>

                {{-- Centered Total & QR Section --}}
                <div class="mt-12 sm:mt-16 flex flex-col items-center px-4 sm:px-0">
                    <div class="w-full sm:w-auto bg-gray-900 px-8 sm:px-12 py-8 sm:py-10 rounded-[2.5rem] sm:rounded-[3rem] text-white shadow-2xl shadow-violet-100 flex flex-col items-center text-center transform transition hover:scale-[1.02] duration-300">
                        <div class="mb-2">
                            <p class="text-[10px] sm:text-[11px] font-bold uppercase tracking-widest text-gray-400">Total Terbayar</p>
                            <p class="text-3xl sm:text-4xl font-black mt-2 text-white italic">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                        </div>
                        
                        <div class="mt-6 sm:mt-8 bg-white p-3 rounded-[1.5rem] sm:rounded-[2rem] shadow-2xl ring-4 sm:ring-8 ring-white/5">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(route('orders')) }}" alt="QR Code" class="h-24 w-24 sm:h-28 sm:w-28">
                        </div>
                        
                        <div class="mt-4 sm:mt-6">
                            <p class="text-[9px] sm:text-[10px] text-gray-500 font-bold uppercase tracking-widest opacity-60">Scan untuk Detail Pesanan</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 text-center pt-12 border-t border-gray-100">
                    <p class="text-gray-400 text-sm italic italic">"Terima kasih telah berbelanja di TechPed Indonesia!"</p>
                </div>
            </div>
        </div>

        <div class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-6 print:hidden">
            <a href="{{ route('landing') }}" class="flex items-center gap-2 text-gray-400 hover:text-violet-700 font-bold text-sm transition group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>
            <div class="flex items-center gap-4">
                <button onclick="window.print()" class="bg-white text-gray-700 border border-gray-200 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-gray-50 transition flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2H9a2 2 0 00-2 2v4"/></svg>
                    Cetak Struk
                </button>
                <a href="{{ route('orders') }}" class="bg-violet-700 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:bg-violet-800 transition shadow-lg shadow-violet-200 flex items-center gap-2">
                    Riwayat Pesanan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        /* High-level reset */
        @page {
            margin: 0;
            size: auto;
        }

        html, body {
            margin: 0 !important;
            padding: 0 !important;
            height: auto !important;
            background: #fff !important;
        }

        /* Hide EVERY top-level element first */
        body > * {
            display: none !important;
        }

        /* Re-show the path to the receipt content */
        /* Path: body -> div.flex-col -> main -> div.flex -> div.flex-1 -> @yield('content') -> #receipt-content */
        body > div.flex.flex-col.min-h-screen,
        body > div.flex.flex-col.min-h-screen > main,
        body > div.flex.flex-col.min-h-screen > main > div.flex.flex-1,
        body > div.flex.flex-col.min-h-screen > main > div.flex.flex-1 > div.flex-1,
        #receipt-content {
            display: block !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border: none !important;
            position: static !important;
        }

        /* Specifically hide children that are not needed inside the path */
        header, nav, footer, aside, .print-hidden, button {
            display: none !important;
        }

        /* Ensure the receipt actually shows up at the top */
        main {
            padding-top: 0 !important;
        }

        /* Style tweaks for print quality */
        .bg-violet-700, .bg-gray-900 {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        #receipt-content {
            border-radius: 0 !important;
        }
    }
    
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down { animation: fade-in-down 0.5s ease-out; }
    
    @keyframes fade-in {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    .animate-fade-in { animation: fade-in 0.8s ease-out; }
</style>
@endsection
