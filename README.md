# TechPed - Marketplace Elektronik Modern

TechPed adalah platform e-commerce premium yang dibangun menggunakan Laravel dan Tailwind CSS, dirancang khusus untuk produk teknologi dan elektronik. Platform ini menawarkan pengalaman belanja yang mulus bagi pelanggan serta ruang manajemen yang lengkap bagi admin dan petugas.

## 🚀 Fitur Utama

### 🛒 Pengalaman Pelanggan
- **Antarmuka Responsif**: Dioptimalkan untuk tampilan mobile, tablet, dan desktop.
- **Flash Sale & Kategori**: Hitung mundur flash sale interaktif dan kategori produk yang terorganisir.
- **Pengurutan Lanjutan**: Urutkan produk berdasarkan Terpopuler (Penjualan), Terbaru, atau Harga.
- **Pencarian Pintar**: Pencarian produk secara real-time.
- **Detail Produk Lengkap**: Galeri multi-gambar, spesifikasi detail, dan saran produk terkait.
- **Ulasan Foto**: Berikan dan lihat ulasan produk lengkap dengan foto dan penampil gambar layar penuh (full-screen viewer).
- **Alur Checkout Lengkap**: Keranjang belanja, manajemen alamat, pilihan kurir, dan unggah bukti pembayaran.
- **Pelacakan Pesanan**: Riwayat pesanan detail dengan status real-time dan unduh struk/invoice.

### 📊 Manajemen (Admin & Petugas)
- **Dashboard Pendapatan**: Grafik pendapatan bulanan dan metrik performa utama (Total Pendapatan, Order, Rata-rata Rating).
- **Manajemen Inventaris**: Pelacakan stok real-time dengan peringatan stok menipis.
- **Pemrosesan Pesanan**: Update status pesanan, kelola nomor resi, dan verifikasi pembayaran.
- **Moderasi Ulasan**: Lihat foto dari pembeli dan kelola umpan balik produk.
- **Sistem Promo**: Kelola banner promosi dan kode diskon.
- **Laporan Lanjutan**: Ekspor data penjualan dan inventaris ke format PDF atau Excel.

---

## 🛠️ Teknologi yang Digunakan

- **Framework**: [Laravel 12](https://laravel.com)
- **Styling**: [Tailwind CSS](https://tailwindcss.com)
- **Database**: MySQL / SQLite
- **Icons**: Lucide Icons / Font Awesome
- **Reporting**: DomPDF & Laravel Excel
- **Notifications**: SweetAlert2

---

## 📦 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan lokal:

### 1. Prasyarat
Pastikan Anda telah menginstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL atau SQLite

### 2. Clone Repositori
```bash
git clone https://github.com/username-anda/techped.git
cd techped
```

### 3. Instal Dependensi
```bash
composer install
npm install
```

### 4. Konfigurasi Lingkungan
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Generate application key:
```bash
php artisan key:generate
```
Konfigurasikan koneksi database Anda di dalam file `.env`.

### 5. Setup Database
Jalankan migrasi dan isi database dengan data awal:
```bash
php artisan migrate --seed
```

### 6. Storage Link
Buat link simbolik dari `public/storage` ke `storage/app/public` agar gambar yang diunggah dapat diakses:
```bash
php artisan storage:link
```

### 7. Kompilasi Aset
Untuk pengembangan:
```bash
npm run dev
```
Untuk produksi:
```bash
npm run build
```

### 8. Jalankan Server
```bash
php artisan serve
```
Aplikasi akan dapat diakses di `http://localhost:8000`. atau `127.0.0.1:8000`.

---

## 🔑 Akses Akun
*Jika menggunakan seeder bawaan:*
- **Pelanggan**: Buat akun baru melalui halaman Registrasi.
- **Admin**: Login melalui `/admin/login`.
- **Petugas**: Login melalui `/petugas/login`.

---

## 📝 Lisensi
Proyek ini adalah software open-source yang dilisensikan di bawah [lisensi MIT](https://opensource.org/licenses/MIT).
