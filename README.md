# 🍔 E-Kantin SMKN 1 Cirebon

Sistem pemesanan makanan digital yang dirancang khusus untuk memfasilitasi transaksi antara pembeli dan penjual di lingkungan kantin SMKN 1 Cirebon. Aplikasi ini dibangun dengan arsitektur *multi-tenant* yang memungkinkan setiap stand kantin memiliki *dashboard* pengelolaannya sendiri, memotong antrean fisik, dan memaksimalkan waktu istirahat siswa.

## 🚀 Fitur Utama

Aplikasi ini memiliki sistem otorisasi multi-peran dengan fitur spesifik untuk masing-masing pengguna:

**👨‍🎓 Pembeli**
*   **Eksplorasi Menu:** Melihat daftar menu yang tersedia dari berbagai stand kantin yang sedang buka.
*   **Fast Checkout:** Sistem keranjang belanja berbasis *session* yang ringan dan cepat.
*   **Pilihan Pembayaran:** Mendukung pembayaran Tunai (bayar saat ambil) atau transfer QR personal langsung ke penjual.
*   **Live Tracking:** Memantau status pesanan (Menunggu Pembayaran -> Diproses -> Siap Diambil).

**🧑‍🍳 Penjual**
*   **Manajemen Stand:** Mengatur profil stand, informasi pembayaran (QR), dan status operasional (Buka/Tutup).
*   **Kelola Menu & Stok:** CRUD produk, mematikan menu yang habis, dan manajemen ketersediaan stok.
*   **Order Dashboard:** Antarmuka kasir untuk memantau pesanan masuk, memverifikasi bukti transfer QR, dan memperbarui status pesanan siswa.

**👨‍💻 Admin**
*   **Manajemen Pengguna:** Menambah akun penjual baru atau memblokir akun yang melanggar aturan.
*   **Master Data:** Mengelola kategori menu secara global.
*   **Laporan Transaksi:** Memantau rekapitulasi perputaran transaksi dari seluruh kantin.

## 🛠️ Tech Stack

*   **Backend:** Laravel 13
*   **Frontend:** Tailwind CSS v4, Blade Templating
*   **Database:** MySQL

## 🗄️ Database Schema

Tabel utama meliputi:
1.  `users`: Manajemen kredensial dan hak akses (Role: admin, penjual, pembeli).
2.  `shops`: Entitas stand kantin yang berelasi 1:1 dengan akun penjual.
3.  `shop_bills`: Manajemen keuangan atau tagihan sewa kantin kepada admin.
4.  `categories`: Master data pengelompokan menu.
5.  `products`: Katalog menu dengan pelacakan stok.
6.  `orders`: *Header* transaksi, metode pembayaran, dan *state machine* status pesanan.
7.  `order_items`: Tabel pivot detail barang yang dibeli pada setiap transaksi.

## 💻 Cara Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin lokal Anda:

1.  **Clone repository**
    ```bash
    git clone [https://github.com/ninoell55/e-kantin.git](https://github.com/ninoell55/e-kantin.git)
    cd e-kantin
    ```

2.  **Install dependensi PHP dan Node.js**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Duplikat file `.env.example` menjadi `.env` dan sesuaikan konfigurasi *database* Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Migrasi Database**
    Jalankan migrasi untuk membangun struktur tabel di database MySQL.
    ```bash
    php artisan migrate
    ```

5.  **Jalankan Server Development**
    Jalankan *server backend* dan *build tools frontend* secara bersamaan.
    ```bash
    php artisan serve
    npm run dev
    ```

## 👤 Author

**Nino Adityo Nugroho**
*   GitHub: [@ninoell55](https://github.com/ninoell55)
*   Role: Backend Developer & System Architecture

---
*Dibuat untuk meningkatkan efisiensi ekosistem digital di SMKN 1 Cirebon.*