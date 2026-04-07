import './bootstrap';
import '../css/app.css';

// Global Scope Definitions (exposed to window)
window.openDetailOrderModal = function(order) {
    console.log('openDetailOrderModal called with:', order);
    try {
        const card = document.getElementById('cardDetailOrder');
        if (!card) return;

        card.classList.remove('hidden');
        card.classList.add('flex');

        const setDetail = (id, value) => {
            const el = document.getElementById(id);
            if (el) el.textContent = value;
        };

        setDetail('order_id', order.id);
        setDetail('order_tanggal', order.tanggal);
        setDetail('order_customer', order.user?.nama_depan ?? order.username ?? '-');
        setDetail('order_email', order.email ?? order.user?.email ?? '-');
        setDetail('order_telepon', order.no_telepon ?? order.user?.no_telepon ?? '-');

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
        if (productsContainer && order.products) {
            productsContainer.innerHTML = '';
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

        setDetail('order_subtotal', `Rp ${Number(order.subtotal ?? 0).toLocaleString('id')}`);
        setDetail('order_ongkir', `Rp ${Number(order.shipping_cost ?? 0).toLocaleString('id')}`);
        setDetail('order_tax', `Rp ${Number(order.pajak ?? 0).toLocaleString('id')}`);
        setDetail('order_discount', `- Rp ${Number(order.diskon ?? 0).toLocaleString('id')}`);
        setDetail('order_total', `Rp ${Number(order.total_harga ?? 0).toLocaleString('id')}`);

        setDetail('order_ekspedisi', order.shipping ?? '-');
        const fullAddress = [order.alamat, order.kota, order.provinsi, order.kode_pos].filter(Boolean).join(', ');
        setDetail('order_alamat', fullAddress || '-');
        setDetail('order_tracking', order.resi ?? '-');

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

        const btnStruk = document.getElementById('btnMasukkanStruk');
        if (btnStruk) {
            if (order.status === 'diproses' || order.status === 'tertunda') {
                btnStruk.disabled = false;
                btnStruk.classList.remove('opacity-50', 'cursor-not-allowed');
                btnStruk.classList.add('hover:bg-violet-800', 'cursor-pointer');
                btnStruk.onclick = () => {
                    sessionStorage.setItem('selectedOrder', JSON.stringify(order));
                    const role = window.location.pathname.split('/')[1] || 'admin';
                    window.location.href = `/${role}/struk`;
                };
            } else {
                btnStruk.disabled = true;
                btnStruk.classList.add('opacity-50', 'cursor-not-allowed');
                btnStruk.classList.remove('hover:bg-violet-800', 'cursor-pointer');
                btnStruk.onclick = null;
            }
        }
    } catch (e) { console.error('Error detail order modal:', e); }
};

window.closeDetailOrderModal = function() {
    const card = document.getElementById('cardDetailOrder');
    if (card) { card.classList.add('hidden'); card.classList.remove('flex'); }
};

window.openEditModal = function (product) {
    const cardEdit = document.getElementById('cardEditProduk');
    const form = document.getElementById('formEditProduk');
    if (!cardEdit || !form) return;

    cardEdit.classList.remove('hidden');
    cardEdit.classList.add('flex');
    const role = window.location.pathname.split('/')[1] || 'admin';
    form.action = `/${role}/products/${product.id}`;

    const setVal = (id, val) => { const el = document.getElementById(id); if (el) el.value = val; };
    setVal('edit_product_id', product.id);
    setVal('edit_nama_produk', product.nama_produk);
    setVal('edit_sku', product.sku);
    setVal('edit_deskripsi', product.deskripsi);
    setVal('edit_kategori', product.kategori);
    setVal('edit_harga', product.harga);
    setVal('edit_stok', product.stok);
    setVal('edit_stok_min', product.stok_min ?? '');
}

function setupDropdown(btnId, dropdownId) {
    const btn = document.getElementById(btnId);
    const dropdown = document.getElementById(dropdownId);
    if (!btn || !dropdown) return;

    btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        // Close all other dropdowns
        document.querySelectorAll('[id$="Dropdown"]').forEach((d) => {
            if (d.id !== dropdownId) {
                d.classList.add('invisible', 'opacity-0', 'scale-95');
                d.classList.remove('visible', 'opacity-100', 'scale-100');
                // If this dropdown had 'flex-col', it also had 'flex' – remove it
                if (d.classList.contains('flex-col')) d.classList.remove('flex');
            }
        });

        // Toggle this dropdown
        const isOpen = dropdown.classList.contains('visible');
        if (!isOpen) {
            // Open
            dropdown.classList.remove('invisible', 'opacity-0', 'scale-95');
            dropdown.classList.add('visible', 'opacity-100', 'scale-100');
            // Add 'flex' only if the dropdown is designed as a flex container
            if (dropdown.classList.contains('flex-col')) {
                dropdown.classList.add('flex');
            }
        } else {
            // Close
            dropdown.classList.add('invisible', 'opacity-0', 'scale-95');
            dropdown.classList.remove('visible', 'opacity-100', 'scale-100');
            // Remove 'flex' if it was added
            if (dropdown.classList.contains('flex-col')) {
                dropdown.classList.remove('flex');
            }
        }
    });

    dropdown.addEventListener('click', (e) => e.stopPropagation());
}

// Close all dropdowns when clicking outside
document.addEventListener('click', () => {
    document.querySelectorAll('[id$="Dropdown"]').forEach((d) => {
        d.classList.add('invisible', 'opacity-0', 'scale-95');
        d.classList.remove('visible', 'opacity-100', 'scale-100');
        if (d.classList.contains('flex-col')) d.classList.remove('flex');
    });
});

// Initialize dropdowns when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    setupDropdown('profileBtn', 'profileDropdown');
    setupDropdown('notifBtn', 'notifDropdown');
});

// Main Execution
document.addEventListener('DOMContentLoaded', () => {
    // LOCK ZOOM
    document.addEventListener('wheel', e => { if (e.ctrlKey) e.preventDefault(); }, { passive: false });
    document.addEventListener('keydown', e => { if (e.ctrlKey && ['_', '=', '+', '-', '0'].includes(e.key)) e.preventDefault(); });

    // TAMBAH PRODUK
    const btnTambah = document.getElementById('btnTambahProduk');
    const cardTambah = document.getElementById('cardTambahProduk');
    const btnClose = document.getElementById('btnCloseCard');
    if (btnTambah && cardTambah) btnTambah.addEventListener('click', () => { cardTambah.classList.remove('hidden'); cardTambah.classList.add('flex'); });
    if (btnClose && cardTambah) btnClose.addEventListener('click', () => { cardTambah.classList.add('hidden'); cardTambah.classList.remove('flex'); });

    // EDIT MODAL CLOSE
    const btnCloseEdit = document.getElementById('btnCloseEdit');
    const cardEdit = document.getElementById('cardEditProduk');
    if (btnCloseEdit && cardEdit) {
        btnCloseEdit.addEventListener('click', () => {
            cardEdit.classList.add('hidden');
            cardEdit.classList.remove('flex');
        });
    }

    // PREVIEW GAMBAR
    const setupPreview = (inputId, containerId) => {
        const input = document.getElementById(inputId);
        const container = document.getElementById(containerId);
        if (!input || !container) return;
        input.addEventListener('change', function() {
            container.innerHTML = '';
            Array.from(this.files).slice(0, 5).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-12 h-12 object-cover rounded';
                    container.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    };
    setupPreview('gambarInput', 'previewContainer');

    // SORT & FILTER
    const sBtn = document.getElementById('sortButton');
    const sMenu = document.getElementById('sortMenu');
    const sInp = document.getElementById('sortInput');
    if (sBtn && sMenu) {
        sBtn.addEventListener('click', e => { e.stopPropagation(); sMenu.classList.toggle('hidden'); });
        sMenu.querySelectorAll('li').forEach(item => {
            item.addEventListener('click', () => {
                if (sInp) sInp.value = item.getAttribute('data-value');
                sBtn.textContent = item.textContent;
                sMenu.classList.add('hidden');
            });
        });
    }

    const fBtn = document.getElementById('filterButton');
    const fMenu = document.getElementById('filterMenu');
    const fInp = document.getElementById('filterInput');
    if (fBtn && fMenu) {
        fBtn.addEventListener('click', e => { e.stopPropagation(); fMenu.classList.toggle('hidden'); });
        fMenu.querySelectorAll('li').forEach(item => {
            item.addEventListener('click', () => {
                if (fInp) fInp.value = item.getAttribute('data-value');
                fBtn.textContent = item.textContent;
                fMenu.classList.add('hidden');
            });
        });
    }

    window.addEventListener('click', () => {
        if (sMenu) sMenu.classList.add('hidden');
        if (fMenu) fMenu.classList.add('hidden');
    });

    // ORDER DETAIL LISTENER
    document.querySelectorAll('.btnShowOrder').forEach(button => {
        button.addEventListener('click', e => {
            e.preventDefault(); e.stopPropagation();
            try {
                const order = JSON.parse(button.dataset.order);
                openDetailOrderModal(order);
            } catch (err) { console.error('Error parse order:', err); }
        });
    });

    // LINT FIX: btn-edit-produk listeners
    document.querySelectorAll('.btn-edit-produk').forEach(button => {
        button.addEventListener('click', function () {
            try {
                const product = JSON.parse(this.dataset.product);
                openEditModal(product);
            } catch (err) { console.error('Error parse product:', err); }
        });
    });
});
