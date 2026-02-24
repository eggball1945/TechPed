<div class="flex justify-center mt-10">
    <div class="w-full max-w-6xl px-4">
        <div class="bg-white rounded p-6 space-y-4 md:w-1/3 ml-auto">

            <div class="flex justify-between text-sm">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
            </div>

            <div class="flex justify-between text-sm text-violet-700">
                <span>Diskon</span>
                <span>10%</span>
            </div>

            <hr>

            <div class="flex justify-between font-semibold">
                <span>Total</span>
                <span>Rp {{ number_format($total,0,',','.') }}</span>
            </div>

            <form method="POST" action="/checkout">
                @csrf
                <button class="w-full bg-violet-700 text-white py-3 rounded">
                    Checkout
                </button>
            </form>

        </div>
    </div>
</div>`