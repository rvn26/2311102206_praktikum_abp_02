# 📋 Lapor Pak! - Sistem Manajemen Laporan

**Lapor Pak!** adalah aplikasi berbasis platform sederhana yang dirancang untuk mengelola laporan secara digital. Aplikasi ini dibangun menggunakan arsitektur **Full-stack JavaScript** dengan fokus pada antarmuka yang modern, responsif, dan interaktif.

---

## 🚀 Fitur Utama
* **Dashboard Statistik Dinamis:** Menampilkan jumlah total laporan secara real-time menggunakan jQuery.
* **Manajemen Data (CRUD):** Fitur lengkap untuk Menambah, Melihat, Memperbarui, dan Menghapus laporan.
* **Operasi Asinkron (AJAX):** Pengiriman dan pengambilan data tanpa memuat ulang halaman (*No Page Reload*).
* **Validasi Client-side:** Validasi input formulir menggunakan *jQuery Validation Plugin* untuk menjamin integritas data.
* **Datatables Integration:** Tabel interaktif dengan fitur pencarian, pengurutan, dan paginasi.

---

## 🛠️ Teknologi yang Digunakan
### Backend
* **Node.js**: Runtime environment.
* **Express.js**: Framework web untuk pembuatan RESTful API.
* **FS Module**: Untuk persistensi data menggunakan file fisik `data.json`.

### Frontend
* **Bootstrap 5**: Framework CSS untuk desain UI modern dan responsif.
* **jQuery**: Library untuk manipulasi DOM dan penanganan AJAX.
* **Font Awesome**: Untuk ikonografi sistem.
* **Google Fonts (Inter)**: Untuk tipografi yang bersih dan profesional.

---

## 📂 Struktur Folder
```text
.
├── public/              # File statis (HTML, CSS, Image)
│   ├── index.html       # Dashboard Utama
│   ├── tambah.html      # Form Tambah Data
│   └── edit.html        # Form Edit Data
├── routes/              # Logika Routing Express
│   └── laporan.js       # API Endpoints
├── data.json            # Database lokal (Format JSON)
├── app.js               # Entry point server
└── package.json         # Dependensi proyek


##vidio persentasi
