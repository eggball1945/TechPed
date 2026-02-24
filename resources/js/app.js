import './bootstrap';
import '../css/app.css';

// LOCK ZOOM
document.addEventListener('wheel', function (e) {
    if (e.ctrlKey) {
        e.preventDefault();
    }
    }, { passive: false });

    document.addEventListener('keydown', function (e) {
    if (e.ctrlKey && ['_', '=', '+', '-', '0'].includes(e.key)) {
        e.preventDefault();
    }
});

// DROPDOWN PROFILE & NOTIF
function setupDropdown(btnId, dropdownId) {
    const btn = document.getElementById(btnId);
    const dropdown = document.getElementById(dropdownId);
    if (!btn || !dropdown) return;

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isClosed = dropdown.classList.contains('opacity-0');
        if (isClosed) {
            dropdown.classList.remove('opacity-0', 'scale-95', 'pointer-events-none', 'invisible');
            dropdown.classList.add('opacity-100', 'scale-100');
        } else {
            dropdown.classList.remove('opacity-100', 'scale-100');
            dropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none', 'invisible');
        }
    });

    document.addEventListener('click', () => {
        dropdown.classList.remove('opacity-100', 'scale-100');
        dropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none', 'invisible');
    });
}

setupDropdown('profileBtn', 'profileDropdown');
setupDropdown('notifBtn', 'notifDropdown');

// TAMBAH PRODUK
const btnTambah = document.getElementById('btnTambahProduk');
const cardTambah = document.getElementById('cardTambahProduk');
const btnClose = document.getElementById('btnCloseCard');

if (btnTambah) btnTambah.addEventListener('click', () => { cardTambah.style.display = 'flex'; });
if (btnClose) btnClose.addEventListener('click', () => { cardTambah.style.display = 'none'; });

// EDIT
window.openEditModal = function (product) {
    const cardEdit = document.getElementById('cardEditProduk');
    const form = document.getElementById('formEditProduk');

    cardEdit.classList.remove('hidden');
    cardEdit.style.display = 'flex';

    form.action = `/admin/products/${product.id}`;

    document.getElementById('edit_product_id').value = product.id;
    document.getElementById('edit_nama_produk').value = product.nama_produk;
    document.getElementById('edit_sku').value = product.sku;
    document.getElementById('edit_deskripsi').value = product.deskripsi;
    document.getElementById('edit_kategori').value = product.kategori;
    document.getElementById('edit_harga').value = product.harga;
    document.getElementById('edit_stok').value = product.stok;
    document.getElementById('edit_stok_min').value = product.stok_min ?? '';
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn-edit-produk').forEach(button => {
        button.addEventListener('click', function () {
            const product = JSON.parse(this.dataset.product);
            openEditModal(product);
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const cardEdit = document.getElementById('cardEditProduk');
    const btnClose = document.getElementById('btnCloseEdit');

    if (btnClose) {
        btnClose.addEventListener('click', () => {
            cardEdit.classList.add('hidden');
            cardEdit.style.display = 'none';
        });
    }
});

function closeEditModal() {
    document.getElementById('cardEditProduk').classList.add('hidden');
}

// PREVIEW GAMBAR TAMBAH
const gambarInput = document.getElementById('gambarInput');
if (gambarInput) {
    gambarInput.addEventListener('change', function () {
        const previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = '';
        Array.from(this.files).slice(0, 5).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-12 h-12 object-cover rounded';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
}

// SORT & FILTER PRODUK + ORDER
const sortButton = document.getElementById('sortButton');
const sortMenu = document.getElementById('sortMenu');

if (sortButton) {
    sortButton.addEventListener('click', () => sortMenu.classList.toggle('hidden'));
    sortMenu.querySelectorAll('li').forEach(item => {
        item.addEventListener('click', () => {
            sortInput.value = item.getAttribute('data-value');
            sortButton.textContent = item.textContent;
            sortMenu.classList.add('hidden');
        });
    });
}

if (filterButton) {
    filterButton.addEventListener('click', () => filterMenu.classList.toggle('hidden'));
    filterMenu.querySelectorAll('li').forEach(item => {
        item.addEventListener('click', () => {
            filterInput.value = item.getAttribute('data-value');
            filterButton.textContent = item.textContent;
            filterMenu.classList.add('hidden');
        });
    });
}

document.addEventListener('click', function (e) {
    if (sortButton && sortMenu && !sortButton.contains(e.target) && !sortMenu.contains(e.target)) sortMenu.classList.add('hidden');
    if (filterButton && filterMenu && !filterButton.contains(e.target) && !filterMenu.contains(e.target)) filterMenu.classList.add('hidden');
});

// PREVIEW GAMBAR EDIT
// const gambarInputEdit = document.getElementById('gambarInputEdit');
// if (gambarInputEdit) {
//     gambarInputEdit.addEventListener('change', function () {
//         const container = document.getElementById('previewContainerEdit');
//         container.innerHTML = '';
//         Array.from(this.files).slice(0, 5).forEach(file => {
//             const reader = new FileReader();
//             reader.onload = e => {
//                 const img = document.createElement('img');
//                 img.src = e.target.result;
//                 img.className = 'w-12 h-12 object-cover rounded';
//                 container.appendChild(img);
//             };
//             reader.readAsDataURL(file);
//         });
//     });
// }



document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btnShowOrder').forEach(button => {
        button.addEventListener('click', function () {
            const order = JSON.parse(this.dataset.order);
            openDetailOrderModal(order);
        });
    });
});

window.openDetailOrderModal = function(order) {
    const card = document.getElementById('cardDetailOrder');
    card.classList.remove('hidden');
    card.style.display = 'flex';

    // INFORMASI CUSTOMER
    document.getElementById('order_id').textContent = order.id;
    document.getElementById('order_tanggal').textContent = order.tanggal;
    document.getElementById('order_customer').textContent = order.user?.nama_depan ?? order.nama;
    document.getElementById('order_email').textContent = order.user?.email ?? '-';
    document.getElementById('order_telepon').textContent = order.user?.no_telepon ?? '-';

    // STATUS BADGE
    const statusBadge = document.getElementById('order_status_badge');
    statusBadge.textContent = order.status.charAt(0).toUpperCase() + order.status.slice(1);
    statusBadge.className = "px-2 py-1 rounded-md text-[8px] font-medium w-[45px] h-[20px] flex items-center justify-center";

    switch(order.status) {
        case 'terkirim':
            statusBadge.classList.add('bg-green-100', 'text-green-700');
            break;
        case 'dikirim':
            statusBadge.classList.add('bg-blue-100', 'text-blue-700');
            break;
        case 'diproses':
            statusBadge.classList.add('bg-yellow-100', 'text-yellow-700');
            break;
        default:
            statusBadge.classList.add('bg-red-100', 'text-red-700');
            break;
    }


    // PRODUK
    const productsContainer = document.getElementById('order_products');
    productsContainer.innerHTML = '';

    order.products.forEach(prod => {
    const div = document.createElement('div');
    div.className = 'flex flex-row items-center gap-2 py-1';

    order.products.forEach(prod => {
    const div = document.createElement('div');
    div.className = 'flex flex-row items-center gap-2 py-1';

        const img = document.createElement('img');
            img.className = 'w-7 h-7 object-cover rounded flex-shrink-0';
            img.alt = prod.nama_produk ?? 'Produk';
            img.src = (prod.gambar_array && prod.gambar_array.length > 0) 
                ? `/storage/${prod.gambar_array[0]}` 
                : '/images/default.png';

            const textDiv = document.createElement('div');
            textDiv.className = 'flex flex-col';

            const nameSpan = document.createElement('span');
            nameSpan.className = 'font-medium text-[12px] text-black';
            nameSpan.textContent = prod.nama_produk;

            const qtySpan = document.createElement('span');
            qtySpan.className = 'font-medium text-[8px] text-black/50';
            qtySpan.textContent = `Jumlah: ${prod.pivot.jumlah}`;

            textDiv.appendChild(nameSpan);
            textDiv.appendChild(qtySpan);

            div.appendChild(img);
            div.appendChild(textDiv);

            productsContainer.appendChild(div);
        });
    });

    // TOTAL
    document.getElementById('order_subtotal').textContent = `Rp ${Number(order.total_harga ?? 0).toLocaleString('id')}`;
    document.getElementById('order_ongkir').textContent = `Rp ${Number(order.ongkir ?? 0).toLocaleString('id')}`;
    document.getElementById('order_tax').textContent = `Rp ${Number(order.tax ?? 0).toLocaleString('id')}`;
    document.getElementById('order_discount').textContent = `Rp ${Number(order.discount ?? 0).toLocaleString('id')}`;
    document.getElementById('order_total').textContent = `Rp ${Number(order.total_harga).toLocaleString('id')}`;

    // EKSPEDISI & ALAMAT
    document.getElementById('order_ekspedisi').textContent = order.ekspedisi ?? '-';
    document.getElementById('order_alamat').textContent = order.alamat ?? '-';
    document.getElementById('order_tracking').textContent = order.tracking_number ?? '-';

    order.products.forEach(prod => {
        console.log('raw gambar:', prod.gambar);
        console.log('gambar_array:', prod.gambar_array);
    });
}

window.closeDetailOrderModal = function() {
    const card = document.getElementById('cardDetailOrder');
    card.classList.add('hidden');
    card.style.display = 'none';
}

