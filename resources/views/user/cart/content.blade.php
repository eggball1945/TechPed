{{-- HEADER --}}
<div class="flex justify-center mb-10">
    <div class="w-full max-w-6xl px-4">
        <div class="flex items-center gap-2 text-sm">
            <a href="/landing" class="text-black/50 hover:text-violet-700 transition">Home</a>
            <span class="text-black/30">/</span>
            <span class="text-black font-medium">Keranjang</span>
        </div>
    </div>
</div>

<div class="flex justify-center">
    <div class="w-full max-w-6xl px-4 space-y-6">

        {{-- HEADER --}}
        <div class="hidden md:grid grid-cols-5 bg-white p-4 rounded font-medium text-sm">
            <span>Produk</span>
            <span>Harga</span>
            <span>Jumlah</span>
            <span>Subtotal</span>
            <span>Aksi</span>
        </div>

        {{-- ITEM --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center bg-white p-4 rounded shadow-sm">

            {{-- PRODUCT --}}
            <div class="flex items-center gap-4">
                <img src="/img/monitor.png" class="w-16 h-16 object-contain" alt="">
                <span class="font-medium">LCD Monitor</span>
            </div>

            {{-- PRICE --}}
            <span class="text-sm text-black md:text-center">
                Rp. 5.500.000
            </span>

            {{-- QTY --}}
            <div class="flex items-center gap-2">
                <button class="w-8 h-8 border rounded text-violet-700">−</button>
                <span class="w-8 text-center">1</span>
                <button class="w-8 h-8 border rounded text-violet-700">+</button>
            </div>

            {{-- SUBTOTAL --}}
            <span class="text-sm font-medium md:text-center">
                Rp. 5.500.000
            </span>

            {{-- ACTION --}}
            <button class="text-red-500 text-sm hover:underline">
                Hapus
            </button>
        </div>

        {{-- ITEM 2 --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center bg-white p-4 rounded shadow-sm">
            <div class="flex items-center gap-4">
                <img src="/img/gamepad.png" class="w-16 h-16 object-contain" alt="">
                <span class="font-medium">HAVIT HV-G92 Gamepad</span>
            </div>

            <span class="text-sm md:text-center">Rp. 500.000</span>

            <div class="flex items-center gap-2">
                <button class="w-8 h-8 border rounded text-violet-700">−</button>
                <span class="w-8 text-center">1</span>
                <button class="w-8 h-8 border rounded text-violet-700">+</button>
            </div>

            <span class="text-sm font-medium md:text-center">Rp. 500.000</span>

            <button class="text-red-500 text-sm hover:underline">
                Hapus
            </button>
        </div>

    </div>
</div>

<div class="flex justify-center mt-10">
    <div class="w-full max-w-6xl px-4">
        <div class="bg-white rounded p-6 space-y-4 md:w-1/3 ml-auto">

            <div class="flex justify-between text-sm">
                <span>Subtotal</span>
                <span>Rp. 6.000.000</span>
            </div>

            <div class="flex justify-between text-sm text-violet-700">
                <span>Diskon</span>
                <span>-10%</span>
            </div>

            <hr>

            <div class="flex justify-between font-semibold">
                <span>Total</span>
                <span>Rp. 5.400.000</span>
            </div>

            <button class="w-full bg-violet-700 text-white py-3 rounded hover:bg-violet-800 transition">
                Checkout
            </button>

        </div>
    </div>
</div>
