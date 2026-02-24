{{-- HEADER --}}
<div class="flex justify-center mb-10">
    <div class="w-full max-w-6xl px-4">
        <div class="flex items-center gap-2 text-sm">
            <a href="/landing" class="text-black/50 hover:text-violet-700">Home</a>
            <span>/</span>
            <span class="font-medium">Keranjang</span>
        </div>
    </div>
</div>

<div class="flex justify-center">
    <div class="w-full max-w-6xl px-4 space-y-4">

        {{-- HEADER --}}
        <div class="hidden md:grid grid-cols-5 bg-white p-4 rounded font-medium text-sm">
            <span>Produk</span>
            <span>Harga</span>
            <span>Jumlah</span>
            <span>Subtotal</span>
            <span>Aksi</span>
        </div>

        {{-- ITEMS --}}
        @foreach ($carts as $item)
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center bg-white p-4 rounded shadow-sm">

            {{-- PRODUCT --}}
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/'.$item->product->gambar) }}"
                     class="w-16 h-16 object-contain">
                <span class="font-medium">{{ $item->product->nama }}</span>
            </div>

            {{-- PRICE --}}
            <span class="text-sm md:text-center">
                Rp {{ number_format($item->product->harga,0,',','.') }}
            </span>

            {{-- QTY --}}
            <div class="flex items-center gap-2">
                <form method="POST" action="/cart/{{ $item->id }}/minus">
                    @csrf @method('PATCH')
                    <button class="w-8 h-8 border rounded">−</button>
                </form>

                <span class="w-8 text-center">{{ $item->qty }}</span>

                <form method="POST" action="/cart/{{ $item->id }}/plus">
                    @csrf @method('PATCH')
                    <button class="w-8 h-8 border rounded">+</button>
                </form>
            </div>

            {{-- SUBTOTAL --}}
            <span class="text-sm font-medium md:text-center">
                Rp {{ number_format($item->product->harga * $item->qty,0,',','.') }}
            </span>

            {{-- ACTION --}}
            <form method="POST" action="/cart/{{ $item->id }}">
                @csrf @method('DELETE')
                <button class="text-red-500 text-sm">Hapus</button>
            </form>
        </div>
        @endforeach

    </div>
</div>

