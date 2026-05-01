
# Sistem Inventaris Toko - Pak Cokomi & Mas Wowo

## Daftar Isi

- [Deskripsi Project](#deskripsi-project)
- [Fitur Utama](#fitur-utama)
- [Struktur Database](#struktur-database)
- [Instalasi dan Setup](#instalasi-dan-setup)
- [Cara Penggunaan](#cara-penggunaan)
- [API Endpoints](#api-endpoints)
- [Struktur File](#struktur-file)
- [Troubleshooting](#troubleshooting)

## Deskripsi Project

Sistem Inventaris Toko adalah aplikasi web yang dirancang untuk membantu Pak Cokomi dan Mas Wowo mengelola inventaris produk toko mereka. Aplikasi ini dibangun menggunakan **Laravel** dengan interface yang user-friendly menggunakan **Blade Template** dan styling **Tailwind CSS**.

**Kebutuhan:**

- Mengelola data produk (tambah, edit, hapus, lihat)
- Melacak stok produk
- Menyimpan data ke database
- Interface yang intuitif untuk kemudahan penggunaan

## Fitur Utama

### 1. **Dashboard Inventaris**

- Menampilkan daftar semua produk dalam format table
- Informasi lengkap: nama, kategori, SKU, harga, dan stok
- Status stok dengan visual indicator (hijau = stok banyak, kuning = stok terbatas, merah = kosong)
- Tombol aksi untuk edit dan hapus produk

### 2. **Tambah Produk Baru**

- Form lengkap dengan validasi
- Input fields: Nama, Deskripsi, Harga, Stok, SKU, Kategori
- Validasi SKU unik
- Error message yang jelas

### 3. **Edit Produk**

- Form pre-filled dengan data produk yang ada
- Validasi dan error handling yang sama seperti create
- Update data produk dengan mudah

### 4. **Hapus Produk**

- Modal konfirmasi sebelum menghapus
- Mencegah kesalahan dengan konfirmasi user
- Flash message setelah berhasil dihapus

### 5. **Data Seeder**

- 20 produk sample dengan data yang realistis
- Kategori beragam: Elektronik, Pakaian, Makanan, Peralatan, Lainnya
- Data otomatis ter-generate dengan Faker

## Struktur Database

### Tabel: `products`

```
id              INTEGER (Primary Key)
name            VARCHAR(255) - Nama produk
description     TEXT - Deskripsi produk
price           DECIMAL(10,2) - Harga produk dalam Rupiah
quantity        INTEGER - Jumlah stok
sku             VARCHAR(255) - Kode produk (UNIQUE)
category        VARCHAR(255) - Kategori produk
created_at      TIMESTAMP - Waktu pembuatan
updated_at      TIMESTAMP - Waktu update terakhir
```

**Contoh Data:**

```
| id | name        | category   | sku         | price   | quantity |
|----+-------------+------------+-------------+---------+----------|
| 1  | Laptop Dell | Elektronik | SKU-0001-AB | 5000000 | 5        |
| 2  | Kaos Oblong | Pakaian    | SKU-0002-CD | 50000   | 50       |
```

## Instalasi dan Setup

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & npm (untuk asset compilation)

### Langkah-Langkah Instalasi

#### 1. Clone Repository / Buka Project

```bash
cd "c:\cek123\Aplikasi Berbasis Platform\praktikum5\praktikum5"
```

#### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

#### 3. Setup Environment

```bash
# Copy .env.example ke .env (jika belum ada)
cp .env.example .env

# Generate APP_KEY
php artisan key:generate
```

#### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan database configuration:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventaris_toko
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Jalankan Migration dan Seeder

```bash
# Buat tabel di database
php artisan migrate

# Populate data sample
php artisan db:seed
```

#### 6. Build Assets (jika diperlukan)

```bash
npm run build
```

#### 7. Jalankan Development Server

```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

#### 8. Login ke Aplikasi

- Default user sudah di-create oleh seeder
- Email: `test@example.com`
- Password: `password`

## Cara Penggunaan

### Akses Sistem Inventaris

1. Login ke aplikasi dengan credential yang tersedia
2. Arahkan ke menu **Inventaris Produk** atau buka `http://localhost:8000/dashboard`

### Menambah Produk

1. Klik tombol **"+ Tambah Produk"** di halaman utama
2. Isi form dengan data produk:
    - **Nama Produk**: Nama lengkap produk (wajib diisi)
    - **Deskripsi**: Detail produk (opsional)
    - **Harga**: Dalam Rupiah (wajib diisi)
    - **Jumlah Stok**: Jumlah unit (wajib diisi)
    - **SKU**: Kode unik produk (wajib diisi, tidak boleh sama)
    - **Kategori**: Pilih dari dropdown (opsional)
3. Klik **"Simpan Produk"**
4. Produk akan ditambahkan ke database dan tampil di halaman utama

### Mengedit Produk

1. Di halaman utama, klik tombol **"Edit"** pada baris produk yang ingin diubah
2. Ubah data sesuai kebutuhan
3. Klik **"Perbarui Produk"**
4. Perubahan tersimpan ke database

### Menghapus Produk

1. Di halaman utama, klik tombol **"Hapus"** pada baris produk
2. Modal konfirmasi akan muncul
3. Klik **"Hapus Produk"** untuk konfirmasi atau **"Batal"** untuk membatalkan
4. Produk akan dihapus dari database

### Melihat Informasi Produk

Di tabel utama, Anda dapat melihat:

- **Nomor urut** - Nomor item
- **Nama Produk** - Nama dengan preview deskripsi
- **Kategori** - Badge warna biru
- **SKU** - Kode produk
- **Harga** - Dalam format Rupiah
- **Stok** - Dengan indicator warna:
    - Hijau (>10) = Stok tersedia banyak
    - Kuning (1-10) = Stok terbatas
    - Merah (0) = Kosong

## API Endpoints

| Method | Endpoint              | Deskripsi                       |
| ------ | --------------------- | ------------------------------- |
| GET    | `/dashboard`          | Menampilkan daftar semua produk |
| GET    | `/products/create`    | Menampilkan form tambah produk  |
| POST   | `/products`           | Menyimpan produk baru           |
| GET    | `/products/{id}/edit` | Menampilkan form edit produk    |
| PUT    | `/products/{id}`      | Update produk                   |
| DELETE | `/products/{id}`      | Menghapus produk                |

## Struktur File

```
app/
├── Models/
│   └── Product.php                 # Model produk
└── Http/Controllers/
    └── ProductController.php       # Controller CRUD

database/
├── migrations/
│   └── 2025_05_01_000000_create_products_table.php
├── factories/
│   └── ProductFactory.php          # Factory untuk generate data
└── seeders/
    ├── ProductSeeder.php           # Seeder produk
    └── DatabaseSeeder.php          # Main seeder

resources/views/products/
├── index.blade.php                 # Halaman daftar produk
├── create.blade.php                # Form tambah produk
└── edit.blade.php                  # Form edit produk

routes/
└── web.php                         # Route definition
```

## Troubleshooting

### Database Connection Error

**Masalah:** `SQLSTATE[HY000] [1045] Access denied`

**Solusi:**

1. Pastikan MySQL/MariaDB berjalan
2. Cek konfigurasi di `.env` (DB_HOST, DB_USERNAME, DB_PASSWORD)
3. Buat database baru: `CREATE DATABASE inventaris_toko;`

### Migration Failed

**Masalah:** Table sudah ada atau error saat migrasi

**Solusi:**

```bash
# Reset migration (hati-hati: menghapus semua data)
php artisan migrate:refresh

# Atau jika ingin dengan seeder:
php artisan migrate:refresh --seed
```

### Assets tidak dimuat

**Masalah:** CSS/JS tidak muncul dengan baik

**Solusi:**

```bash
npm run build
php artisan cache:clear
```

### Composer Autoload Error

**Masalah:** Class tidak ditemukan

**Solusi:**

```bash
composer dump-autoload
```

## Tips & Trik

1. **Backup Data Sebelum Reset**: Selalu backup database sebelum menjalankan `migrate:refresh`

2. **Tambah Produk Dengan Cepat**: Gunakan fitur duplicate dengan copy SKU produk yang sudah ada

3. **Export Data**: Untuk export data, bisa menggunakan `php artisan tinker` atau implementasikan fitur export

4. **Validasi SKU**: SKU harus unik, gunakan format yang konsisten misalnya: `SKU-YYYY-XX`

## Support & Developer

Untuk pertanyaan atau saran, silahkan hubungi:

- **Pak Cokomi** - Pemilik toko
- **Mas Wowo** - Co-owner

---

**Dibuat dengan menggunakan Laravel**

_Last Updated: 1 Mei 2025_
