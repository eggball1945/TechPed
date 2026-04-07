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

<div id="shareModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-[1000] p-4 animate-fade-in">
    <div class="bg-white rounded-[2rem] max-w-md w-full shadow-2xl transform transition-all animate-scale-up">
        <div class="p-8 border-b border-gray-100 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-violet-50 flex items-center justify-center text-violet-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-black text-gray-900">Bagikan Produk</h3>
                    <p class="text-xs text-gray-500 mt-1">Salin tautan untuk membagikan</p>
                </div>
            </div>
            <button onclick="closeShareModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 rounded-full hover:bg-gray-100 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <div class="p-8">
            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" id="shareLink" value="{{ url()->current() }}" class="flex-1 min-w-0 w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-violet-500" readonly>
                <button onclick="copyLink()" class="w-full sm:w-auto shrink-0 px-6 py-3 bg-violet-700 hover:bg-violet-800 text-white font-bold rounded-xl transition-colors flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    Salin
                </button>
            </div>
        </div>
    </div>
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
        overlay.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[1100] p-4 transition-all duration-300 animate-fade-in';

        let iconSvg = '';
        let blurClass = '';
        let iconContainerClass = '';
        let pingClass = '';
        let iconColorClass = '';
        let buttonClass = '';

        if (type === 'success') {
            blurClass = 'bg-violet-500 opacity-20';
            iconContainerClass = 'border-violet-100 bg-violet-50';
            pingClass = 'bg-violet-400 opacity-20';
            iconColorClass = 'text-violet-600';
            buttonClass = 'bg-violet-600 hover:bg-violet-700 shadow-violet-200 text-white';
            iconSvg = '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>';
        } else if (type === 'error') {
            blurClass = 'bg-rose-500 opacity-20';
            iconContainerClass = 'border-rose-100 bg-rose-50';
            pingClass = 'bg-rose-400 opacity-20';
            iconColorClass = 'text-rose-600';
            buttonClass = 'bg-rose-600 hover:bg-rose-700 shadow-rose-200 text-white';
            iconSvg = '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>';
        } else {
            blurClass = 'bg-amber-500 opacity-20';
            iconContainerClass = 'border-amber-100 bg-amber-50';
            pingClass = 'bg-amber-400 opacity-20';
            iconColorClass = 'text-amber-600';
            buttonClass = 'bg-amber-500 hover:bg-amber-600 shadow-amber-200 text-white';
            iconSvg = '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>';
        }

        let alertBox = document.createElement('div');
        alertBox.className = 'bg-white rounded-[2.5rem] shadow-2xl max-w-sm w-full p-10 text-center transform transition-all duration-300 animate-scale-up relative overflow-hidden';
        
        alertBox.innerHTML = `
            <div class="absolute -top-10 -right-10 w-32 h-32 ${blurClass} rounded-full blur-[50px]"></div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 relative border ${iconContainerClass}">
                    <div class="absolute inset-0 ${pingClass} rounded-full animate-ping"></div>
                    <div class="relative z-10 ${iconColorClass}">
                        ${iconSvg}
                    </div>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-2 tracking-tight">${title}</h3>
                <p class="text-sm text-gray-500 font-medium leading-relaxed mb-8 px-2">${message}</p>
                <div class="w-full">
                    <button onclick="this.closest('.fixed').remove()" class="w-full inline-flex justify-center items-center gap-2 ${buttonClass} font-black py-4 rounded-2xl transition-all shadow-xl active:scale-[0.98] uppercase text-xs tracking-widest cursor-pointer">
                        Oke, Mengerti
                    </button>
                    ${type === 'success' ? `<a href="{{ route('cart') }}" class="w-full inline-flex justify-center items-center gap-2 bg-white hover:bg-gray-50 text-gray-600 font-black mt-3 py-4 rounded-2xl transition-all active:scale-[0.98] uppercase text-xs tracking-widest cursor-pointer border border-gray-100">Lihat Keranjang</a>` : ''}
                </div>
            </div>
        `;
        overlay.appendChild(alertBox);
        document.body.appendChild(overlay);

        if (type === 'success') {
            setTimeout(() => { if (overlay.parentNode) overlay.remove(); }, 3500);
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

        // Close modal when clicking outside
        const shareModal = document.getElementById('shareModal');
        if (shareModal) {
            shareModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeShareModal();
                }
            });
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('shareModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeShareModal();
            }
        }
    });
</script>