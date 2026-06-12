# Laporan Tugas: Aplikasi To-Do List dengan Provider & Firebase Cloud Messaging

**Nama Aplikasi:** To-Do FCM App  
**Platform:** Flutter (Android)  
**NIM/Nama:** 2311102206

---

## 1. Deskripsi Singkat

Aplikasi ini adalah sebuah **To-Do List sederhana** yang dibangun menggunakan framework Flutter dengan dua fitur utama:

1. **State Management Provider** — Mengelola state daftar tugas (tambah tugas, hapus tugas individu, dan hapus seluruh tugas) secara reaktif menggunakan package `provider`.
2. **Firebase Cloud Messaging (FCM)** — Menerima notifikasi push dari Firebase Console. Notifikasi dapat diterima baik saat aplikasi dalam keadaan foreground, background, maupun terminated.

---

## 2. Struktur Proyek

```
lib/
├── main.dart                      # Entry point, inisialisasi Firebase & Provider
├── providers/
│   └── todo_provider.dart         # State management menggunakan ChangeNotifier
├── screens/
│   └── todo_screen.dart           # UI halaman daftar tugas (To-Do List)
└── services/
    └── fcm_service.dart           # Service untuk Firebase Cloud Messaging
```

---

## 3. Penjelasan Implementasi

### 3.1 State Management dengan Provider

- **`TodoProvider`** menggunakan `ChangeNotifier` untuk mengelola daftar tugas.
- Method yang tersedia:
  - `addTodo(String title)` — Menambahkan tugas baru ke daftar.
  - `removeTodo(String id)` — Menghapus tugas tertentu berdasarkan ID.
  - `clearAll()` — Menghapus seluruh tugas dari daftar.
- Provider di-register di `main.dart` menggunakan `ChangeNotifierProvider` sehingga seluruh widget tree dapat mengakses state.
- Widget `Consumer<TodoProvider>` digunakan untuk mendengarkan perubahan state dan membangun ulang UI secara otomatis.

### 3.2 Firebase Cloud Messaging (FCM)

- **Inisialisasi Firebase** dilakukan di `main.dart` sebelum `runApp()`.
- **`FCMService`** menangani:
  - Request permission notifikasi (khusus Android 13+ / API 33).
  - Mendapatkan dan mencetak FCM Token ke console (untuk digunakan saat mengirim notifikasi).
  - Listener untuk pesan foreground (`onMessage`) — menggunakan package `flutter_local_notifications` untuk menampilkan heads-up system notification di bagian atas layar secara reaktif walau user sedang membuka aplikasi.
  - Listener untuk pesan background (`onMessageOpenedApp`) — menangani saat user tap notifikasi.
  - Background handler (`firebaseMessagingBackgroundHandler`) — top-level function untuk memproses pesan saat app terminated.

### 3.3 Konfigurasi Android

- **`AndroidManifest.xml`**: Ditambahkan permission `INTERNET` dan `POST_NOTIFICATIONS`, serta metadata default notification channel FCM.
- **`build.gradle.kts` (app)**: Ditambahkan plugin `com.google.gms.google-services`.
- **`build.gradle.kts` (project)**: Ditambahkan dependency Google Services plugin.
- **`google-services.json`**: File konfigurasi Firebase yang perlu diganti dengan file asli dari Firebase Console.

---

## 4. Cara Menjalankan

### Prasyarat:
1. Flutter SDK terinstall
2. Proyek Firebase sudah dibuat di [Firebase Console](https://console.firebase.google.com/)
3. File `google-services.json` yang asli sudah diunduh dari Firebase Console dan ditempatkan di `android/app/`

### Langkah-langkah:
```bash
# 1. Install dependencies
flutter pub get

# 2. Jalankan aplikasi
flutter run
```

### Mengirim Notifikasi via Firebase Console:
1. Buka **Firebase Console** → **Cloud Messaging** → **Send your first message**
2. Isi judul dan isi pesan notifikasi
3. Pilih target: Aplikasi Android `com.example.todo_fcm_app`
4. Klik **Send Message**

---

## 5. Screenshot Hasil

### 5.1 Tampilan Daftar Tugas (Kosong)
![Tampilan Daftar Tugas Kosong](dokumentasi%20ss/tampilankosong.jpeg)
> *Screenshot halaman utama saat belum ada tugas ditambahkan.*
> Menampilkan pesan "Belum Ada Tugas" dengan ikon dan instruksi.

### 5.2 Proses Penambahan Tugas
![Proses Penambahan Tugas](dokumentasi%20ss/tampilantambah.jpeg)
> *Screenshot bottom sheet dialog untuk menambah tugas baru.*
> User memasukkan nama tugas dan menekan tombol "Tambah Tugas".

### 5.3 Tampilan Daftar Tugas (Terisi)
![Tampilan Daftar Tugas Terisi](dokumentasi%20ss/tampilanlisttodo.jpeg)
> *Screenshot halaman utama setelah beberapa tugas ditambahkan.*
> Menampilkan daftar tugas dengan nomor urut, nama, dan tanggal pembuatan.
> Badge jumlah tugas terlihat di AppBar.

### 5.4 Notifikasi yang Diterima
![Notifikasi yang Diterima](dokumentasi%20ss/tampilanterimanotfikasi.jpeg)
> *Screenshot notifikasi push dari Firebase yang muncul di aplikasi.*
> Notifikasi berhasil diterima dan langsung muncul sebagai heads-up system notification di bagian paling atas layar (bukan dialog) baik saat aplikasi berada di foreground (aktif terbuka) maupun background.

---

## 6. Kesimpulan

Aplikasi To-Do List berhasil diimplementasikan dengan:
- **Provider** sebagai state management untuk mengelola data tugas secara reaktif.
- **Firebase Cloud Messaging** untuk menerima notifikasi push.
- Fitur **tambah tugas** melalui bottom sheet dialog.
- Fitur **hapus tugas** secara individual (swipe) dan **hapus semua** tugas.
- **Dark mode UI** yang modern dan responsif.

Aplikasi ini mendemonstrasikan penerapan pattern arsitektural yang baik dengan memisahkan logic (Provider), service (FCM), dan UI (Screen) ke dalam file/folder yang terpisah.
