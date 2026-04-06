<div class="lg:w-80 lg:sticky lg:top-[150px] self-start ml-4 mr-8">
    @auth
        @if (($product->stok ?? 0) > 0)
            <div class="bg-white rounded-xl shadow-md p-6 space-y-4">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <span class="text-xs text-gray-600">Stok tersedia:</span>
                        <span class="font-medium {{ ($product->stok ?? 0) > 0 ? 'text-violet-700' : 'text-red-600' }}">
                            {{ $product->stok ?? 0 }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 rounded-lg p-1">
                        <button onclick="decrementQty()"
                            class="w-8 h-8 rounded-lg bg-white border border-gray-200 hover:bg-violet-50 hover:border-violet-700 flex items-center justify-center text-violet-700 transition">
                            -
                        </button>
                        <input type="number" id="qty" value="1" min="1"
                            max="{{ $product->stok }}"
                            class="w-12 text-center rounded-sm bg-transparent border-0 focus:outline-none focus:ring-2 focus:ring-violet-500 text-violet-700 font-medium no-spinner">
                        <button onclick="incrementQty()"
                            class="w-8 h-8 rounded-lg bg-white border border-gray-200 hover:bg-violet-50 hover:border-violet-700 flex items-center justify-center text-violet-700 transition">
                            +
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-gray-100 pt-3">
                    <span class="text-sm text-gray-600">Subtotal</span>
                    <div id="subtotal-display" class="text-lg font-bold text-violet-700">
                        Rp {{ number_format($product->harga_diskon ?? $product->harga, 0, ',', '.') }}
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button onclick="addToCart({{ $product->id }})"
                        class="w-full bg-violet-700 hover:bg-violet-800 text-white font-medium py-2.5 px-4 rounded-lg shadow-sm transition cursor-pointer">
                        Tambah ke Keranjang
                    </button>
                    <button onclick="quickCheckout({{ $product->id }})"
                        class="w-full bg-white border border-violet-700 text-violet-700 hover:bg-violet-50 font-medium py-2.5 px-4 rounded-lg shadow-sm transition cursor-pointer">
                        Beli Langsung
                    </button>
                </div>

                <button onclick="openShareModal()" class="w-full flex items-center justify-center gap-2 text-gray-500 hover:text-violet-700 border border-gray-200 rounded-lg py-2 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    Bagikan
                </button>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <button disabled class="w-full bg-gray-300 text-gray-500 font-medium py-2.5 px-6 rounded-lg cursor-not-allowed">
                    Stok Habis
                </button>
            </div>
        @endif
    @else
        <div class="bg-white rounded-xl shadow-md p-6 space-y-3 text-center">
            <a href="{{ route('user.login') }}" class="inline-block w-full bg-violet-700 hover:bg-violet-800 text-white font-medium py-2 px-6 rounded-lg transition">
                Login untuk Membeli
            </a>

            <button onclick="openShareModal()" class="w-full flex items-center justify-center gap-2 text-gray-500 hover:text-violet-700 border border-gray-200 rounded-lg py-2 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
                Bagikan
            </button>
        </div>

    @endauth
</div>

<script>
    function changeImage(src, element) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.flex.gap-3 .border-2').forEach(el => el.classList.remove('border-violet-700', 'border-2'));
        element.classList.add('border-violet-700');
    }

    function updateSubtotal() {
        let qtyInput = document.getElementById('qty');
        if (!qtyInput) return;
        let qty = parseInt(qtyInput.value);
        let price = {{ $product->harga_diskon ?? $product->harga }};
        let subtotal = price * qty;
        let subtotalDisplay = document.getElementById('subtotal-display');
        if (subtotalDisplay) {
            subtotalDisplay.innerHTML = 'Rp ' + subtotal.toLocaleString('id');
        }
    }

    function incrementQty() {
        let qty = document.getElementById('qty');
        let max = parseInt(qty.getAttribute('max'));
        let newVal = parseInt(qty.value) + 1;
        if (newVal <= max) {
            qty.value = newVal;
            updateSubtotal();
        }
    }

    function decrementQty() {
        let qty = document.getElementById('qty');
        let newVal = parseInt(qty.value) - 1;
        if (newVal >= 1) {
            qty.value = newVal;
            updateSubtotal();
        }
    }

    function addToCart(productId) {
        let qty = document.getElementById('qty').value;
        fetch('{{ route('cart.add') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ product_id: productId, quantity: qty })
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showCustomAlert('Sukses', 'Produk berhasil ditambahkan ke keranjang!', 'success');
                if (document.getElementById('cartCount')) {
                    document.getElementById('cartCount').innerText = data.cart_count;
                }
            } else {
                showCustomAlert('Gagal', 'Gagal menambahkan: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showCustomAlert('Error', 'Terjadi kesalahan, coba lagi.', 'error');
        });
    }

    function quickCheckout(productId) {
        let qty = document.getElementById('qty').value;
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('cart.quick-checkout') }}';

        let csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';

        let productInput = document.createElement('input');
        productInput.type = 'hidden';
        productInput.name = 'product_id';
        productInput.value = productId;

        let qtyInput = document.createElement('input');
        qtyInput.type = 'hidden';
        qtyInput.name = 'quantity';
        qtyInput.value = qty;

        form.appendChild(csrfToken);
        form.appendChild(productInput);
        form.appendChild(qtyInput);
        document.body.appendChild(form);
        form.submit();
    }

    function showCustomAlert(title, message, type) {
        let overlay = document.createElement('div');
        overlay.className = 'fixed inset-0 bg-black/50 flex items-center justify-center z-50';

        let bgColor = 'bg-violet-50';
        let borderColor = 'border-violet-200';
        let titleColor = 'text-violet-900';
        let textColor = 'text-violet-800';
        let buttonBg = 'bg-violet-600 hover:bg-violet-700';
        let icon = '✓';

        if (type === 'error') {
            icon = '✕';
        } else if (type === 'warning') {
            icon = '⚠';
        }

        let alertBox = document.createElement('div');
        alertBox.className = `${bgColor} border ${borderColor} rounded-xl shadow-2xl p-8 max-w-md w-full mx-4 transform transition-all`;
        alertBox.innerHTML = `
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-violet-100">
                        <span class="${titleColor} text-xl font-bold">${icon}</span>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="${titleColor} text-lg font-bold">${title}</h3>
                    <p class="${textColor} mt-2 text-sm">${message}</p>
                </div>
            </div>
            <div class="mt-6 flex gap-3 justify-end">
                <button onclick="this.closest('.fixed').remove()" class="px-4 py-2 text-gray-600 hover:text-gray-800 text-sm font-medium">Tutup</button>
                <button onclick="this.closest('.fixed').remove()" class="${buttonBg} text-white px-4 py-2 rounded-lg text-sm font-medium transition">OK</button>
            </div>
        `;
        overlay.appendChild(alertBox);
        document.body.appendChild(overlay);

        if (type === 'success') {
            setTimeout(() => { if (overlay.parentNode) overlay.remove(); }, 3000);
        }
    }

    function openShareModal() {
        document.getElementById('shareModal').classList.remove('hidden');
    }

    function closeShareModal() {
        document.getElementById('shareModal').classList.add('hidden');
    }

    function copyLink() {
        const linkInput = document.getElementById('shareLink');
        linkInput.select();
        document.execCommand('copy');
        showCustomAlert('Sukses', 'Tautan berhasil disalin!', 'success');
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateSubtotal();
    });
</script>