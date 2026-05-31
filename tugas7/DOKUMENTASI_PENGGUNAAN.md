# DOKUMENTASI PENGGUNAAN - TUGAS 7: Notifikasi & API Perangkat Keras

## 📱 Deskripsi Singkat

Aplikasi Flutter yang menampilkan:

1. **2 Tombol Utama**: Kamera dan Galeri
2. **Tampilan Foto**: Preview foto yang diambil/dipilih
3. **Notifikasi**: Alert saat foto berhasil diambil/dipilih

---

## 🎯 Tujuan Pembelajaran

- Menggunakan Camera API melalui `image_picker`
- Mengakses Galeri/Photo Library perangkat
- Menampilkan notifikasi lokal dengan `flutter_local_notifications`
- Setup permissions untuk Android dan iOS

---

## 🚀 Cara Menjalankan Aplikasi

### Langkah 1: Setup Project

```bash
cd C:\cek123\Aplikasi\ Berbasis\ Platform\praktikum5\tugas7\photo_notification_app
flutter pub get
```

### Langkah 2: Jalankan di Emulator/Device

```bash
# Untuk Android Emulator
flutter run

# Untuk iOS Simulator
flutter run -d "iPhone 15"

# Untuk Device Fisik
flutter run
```

### Langkah 3: Uji Aplikasi

1. **Tombol "Buka Kamera"**
   - Klik tombol blue "Buka Kamera"
   - Aplikasi kamera akan terbuka
   - Ambil foto atau batalkan
   - Jika berhasil, foto akan ditampilkan dan notifikasi muncul

2. **Tombol "Pilih dari Galeri"**
   - Klik tombol green "Pilih dari Galeri"
   - Gallery picker akan terbuka
   - Pilih foto dari galeri
   - Jika berhasil, foto akan ditampilkan dan notifikasi muncul

---

## 📋 Fitur yang Diimplementasikan

### ✅ Fitur 1: Ambil Foto

#### A. Dari Kamera

```dart
Future<void> _pickFromCamera() async {
  final XFile? pickedFile = await _imagePicker.pickImage(source: ImageSource.camera);
  // Set foto ke state dan tampilkan notifikasi
}
```

- Tombol berwarna **BIRU**
- Icon: 📷 Camera
- Menggunakan `ImageSource.camera` dari `image_picker`
- Membuka native camera app

#### B. Dari Galeri

```dart
Future<void> _pickFromGallery() async {
  final XFile? pickedFile = await _imagePicker.pickImage(source: ImageSource.gallery);
  // Set foto ke state dan tampilkan notifikasi
}
```

- Tombol berwarna **HIJAU**
- Icon: 🖼️ Photo Library
- Menggunakan `ImageSource.gallery` dari `image_picker`
- Membuka native gallery picker

### ✅ Fitur 2: Tampilan Foto

- Foto ditampilkan dalam kontainer berukuran 300x300px
- Foto akan di-crop dengan `BoxFit.cover`
- Jika belum ada foto, menampilkan placeholder "Tidak ada foto dipilih"

### ✅ Fitur 3: Notifikasi Lokal

```dart
Future<void> _showNotification(String message) async {
  // Setup Android notification channel
  const AndroidNotificationDetails androidDetails = AndroidNotificationDetails(
    'com.example.photo_notification_app',
    'Notifikasi Foto',
    channelDescription: 'Notifikasi untuk pengambilan foto',
  );

  // Tampilkan notifikasi
  await flutterLocalNotificationsPlugin.show(...);
}
```

#### Pesan Notifikasi:

- **Dari Kamera**: `"Foto berhasil diambil dari kamera!"`
- **Dari Galeri**: `"Foto berhasil dipilih dari galeri!"`

---

## 🔧 Konfigurasi

### Android Configuration

**File**: `android/app/src/main/AndroidManifest.xml`

Permissions yang ditambahkan:

```xml
<uses-permission android:name="android.permission.CAMERA" />
<uses-permission android:name="android.permission.READ_EXTERNAL_STORAGE" />
<uses-permission android:name="android.permission.WRITE_EXTERNAL_STORAGE" />
<uses-permission android:name="android.permission.POST_NOTIFICATIONS" />
```

### iOS Configuration

**File**: `ios/Runner/Info.plist`

Keys yang ditambahkan:

```xml
<key>NSCameraUsageDescription</key>
<string>Aplikasi memerlukan akses kamera untuk mengambil foto.</string>

<key>NSPhotoLibraryUsageDescription</key>
<string>Aplikasi memerlukan akses galeri untuk memilih foto.</string>

<key>NSPhotoLibraryAddUsageDescription</key>
<string>Aplikasi memerlukan akses untuk menyimpan foto ke galeri.</string>
```

---

## 📦 Dependencies yang Digunakan

| Package                       | Versi   | Fungsi                                         |
| ----------------------------- | ------- | ---------------------------------------------- |
| `image_picker`                | ^1.0.0  | Mengambil/memilih foto dari kamera atau galeri |
| `flutter_local_notifications` | ^14.0.0 | Menampilkan notifikasi lokal                   |
| `flutter`                     | SDK     | Framework utama                                |
| `cupertino_icons`             | ^1.0.8  | iOS-style icons                                |

---

## 🎨 UI Layout

```
┌─────────────────────────────────┐
│  Notifikasi & API Perangkat     │ ← AppBar
│  Keras                           │
├─────────────────────────────────┤
│                                 │
│    Aplikasi Pengambilan Foto    │ ← Judul
│                                 │
│    ┌─────────────────────────┐  │
│    │                         │  │
│    │   Foto/Placeholder      │  │ ← Photo Display (300x300)
│    │   (300x300)             │  │
│    │                         │  │
│    └─────────────────────────┘  │
│                                 │
│    ┌────────────────────────┐   │
│    │ 📷 Buka Kamera        │   │ ← Camera Button (Blue)
│    └────────────────────────┘   │
│                                 │
│    ┌────────────────────────┐   │
│    │ 🖼️ Pilih dari Galeri  │   │ ← Gallery Button (Green)
│    └────────────────────────┘   │
│                                 │
│    ┌────────────────────────┐   │
│    │ Fitur Aplikasi:        │   │
│    │ • Buka Kamera...       │   │ ← Info Box
│    │ • Pilih dari Galeri... │   │
│    │ • Foto ditampilkan... │   │
│    │ • Notifikasi muncul... │   │
│    └────────────────────────┘   │
│                                 │
└─────────────────────────────────┘
```

---

## 🔍 Penjelasan Flow Aplikasi

### Flow 1: Ambil Foto dari Kamera

```
User Tap "Buka Kamera"
        ↓
_pickFromCamera() dipanggil
        ↓
ImagePicker membuka Camera App
        ↓
User ambil foto dan konfirmasi
        ↓
Foto disimpan ke File
        ↓
setState() dipanggil, Photo ditampilkan
        ↓
_showNotification() dipanggil
        ↓
Notifikasi "Foto berhasil diambil dari kamera!" muncul
```

### Flow 2: Pilih Foto dari Galeri

```
User Tap "Pilih dari Galeri"
        ↓
_pickFromGallery() dipanggil
        ↓
ImagePicker membuka Gallery Picker
        ↓
User pilih foto dari galeri
        ↓
Foto dipilih dan dikembalikan ke app
        ↓
setState() dipanggil, Photo ditampilkan
        ↓
_showNotification() dipanggil
        ↓
Notifikasi "Foto berhasil dipilih dari galeri!" muncul
```

---

## ⚙️ Requirement Runtime

| Platform    | Minimum           |
| ----------- | ----------------- |
| Android     | API 21 (Lollipop) |
| iOS         | 11.0              |
| Flutter SDK | 3.11.5+           |

---

## 🐛 Troubleshooting

### ❌ Notifikasi tidak muncul

**Solusi:**

- Pastikan notification permission sudah diberikan di device settings
- Cek Android 13+ memiliki POST_NOTIFICATIONS permission
- Verifikasi notification channel sudah didefinisikan dengan benar

### ❌ Kamera tidak membuka

**Solusi:**

- Pastikan CAMERA permission sudah diberikan
- Cek device memiliki kamera yang berfungsi
- Restart aplikasi dan coba lagi

### ❌ Galeri tidak terbuka

**Solusi:**

- Pastikan READ_EXTERNAL_STORAGE permission sudah diberikan
- Untuk Android 13+, cek READ_MEDIA_IMAGES permission
- Pastikan ada foto di device gallery

### ❌ Crash saat membuka kamera/galeri

**Solusi:**

- Lakukan `flutter clean` dan rebuild
- Update dependencies: `flutter pub upgrade`
- Bersihkan build cache: `flutter clean`

---

## 📁 Struktur File Project

```
tugas7/
├── photo_notification_app/
│   ├── lib/
│   │   └── main.dart                    # Kode aplikasi utama
│   ├── android/
│   │   ├── app/src/main/
│   │   │   └── AndroidManifest.xml     # Android permissions
│   │   └── build.gradle
│   ├── ios/
│   │   ├── Runner/
│   │   │   ├── Info.plist              # iOS permissions
│   │   │   └── Runner.xcodeproj/
│   │   └── Podfile
│   ├── pubspec.yaml                    # Dependencies
│   ├── pubspec.lock                    # Lock file
│   └── test/
│       └── widget_test.dart
├── README.md                            # General documentation
└── DOKUMENTASI_PENGGUNAAN.md           # Usage guide (this file)
```

---

## ✨ Output yang Diharapkan

### Saat Aplikasi Berjalan

1. ✅ Halaman utama dengan judul "Aplikasi Pengambilan Foto"
2. ✅ Placeholder foto berwarna abu-abu dengan text "Tidak ada foto dipilih"
3. ✅ Tombol "Buka Kamera" berwarna biru dengan icon kamera
4. ✅ Tombol "Pilih dari Galeri" berwarna hijau dengan icon galeri
5. ✅ Info box berisi penjelasan fitur

### Saat User Klik "Buka Kamera"

1. ✅ Native camera app terbuka
2. ✅ User bisa mengambil foto atau batalkan
3. ✅ Jika berhasil, foto ditampilkan di placeholder
4. ✅ Notifikasi muncul dengan pesan "Foto berhasil diambil dari kamera!"

### Saat User Klik "Pilih dari Galeri"

1. ✅ Native gallery picker terbuka
2. ✅ User bisa memilih foto atau batalkan
3. ✅ Jika berhasil, foto ditampilkan di placeholder
4. ✅ Notifikasi muncul dengan pesan "Foto berhasil dipilih dari galeri!"

---

## 📝 Catatan Penting

- Pastikan device/emulator memiliki permission yang sudah diberikan
- Notifikasi hanya full-featured di Android, iOS memerlukan setup tambahan
- Aplikasi memerlukan device yang support camera untuk fitur kamera
- Foto disimpan secara temporary di app cache

---

## 🎓 Konsep yang Dipelajari

### 1. **Hardware Access (Camera API)**

- Mengakses hardware kamera melalui `image_picker`
- Handling user permissions untuk hardware access

### 2. **File System Integration**

- Membaca file dari gallery
- Menampilkan file image ke UI

### 3. **Local Notifications**

- Inisialisasi notification plugin
- Membuat notification channel
- Menampilkan notification ke user

### 4. **Platform-Specific Configuration**

- Setup permissions untuk Android
- Setup privacy descriptions untuk iOS
- Handling platform differences

---

## 📞 Support

Jika ada pertanyaan atau masalah, silakan:

1. Check troubleshooting section di atas
2. Baca dokumentasi resmi Flutter
3. Buka Flutter documentation di https://flutter.dev/docs

---

**Created**: 30 Mei 2026  
**Last Updated**: 30 Mei 2026  
**Status**: ✅ Complete
