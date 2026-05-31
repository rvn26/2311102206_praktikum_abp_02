# Tugas 7: Notifikasi & API Perangkat Keras

## Deskripsi Aplikasi

Aplikasi Flutter sederhana yang mendemonstrasikan penggunaan Camera API, Image Picker, dan Local Notifications untuk mengambil foto dan menampilkan notifikasi.

## Fitur Utama

### 1. Ambil Foto

Aplikasi memiliki 2 tombol untuk pengambilan foto:

- **Tombol "Buka Kamera"**: Membuka kamera perangkat untuk mengambil foto secara langsung
- **Tombol "Pilih dari Galeri"**: Membuka galeri untuk memilih foto yang sudah ada

Foto yang diambil atau dipilih akan langsung ditampilkan di layar aplikasi.

### 2. Notifikasi Lokal

Setelah foto berhasil diambil atau dipilih, sistem akan menampilkan notifikasi lokal dengan pesan:

- **Dari Kamera**: "Foto berhasil diambil dari kamera!"
- **Dari Galeri**: "Foto berhasil dipilih dari galeri!"

Notifikasi menggunakan plugin `flutter_local_notifications` untuk menampilkan pesan di device drawer.

## Dependencies

```yaml
dependencies:
  flutter:
    sdk: flutter
  image_picker: ^1.0.0 # Untuk mengambil/memilih foto
  flutter_local_notifications: ^14.0.0 # Untuk menampilkan notifikasi lokal
  cupertino_icons: ^1.0.8
```

## Struktur Project

```
photo_notification_app/
├── lib/
│   └── main.dart              # Kode aplikasi utama
├── android/
│   └── app/src/main/
│       └── AndroidManifest.xml  # Konfigurasi Android
├── ios/
│   └── Runner/
│       └── Info.plist         # Konfigurasi iOS
├── pubspec.yaml               # File dependencies
└── README.md                  # Dokumentasi
```

## Permissions

### Android Permissions

Berikut permissions yang digunakan di `AndroidManifest.xml`:

```xml
<uses-permission android:name="android.permission.CAMERA" />
<uses-permission android:name="android.permission.READ_EXTERNAL_STORAGE" />
<uses-permission android:name="android.permission.WRITE_EXTERNAL_STORAGE" />
<uses-permission android:name="android.permission.POST_NOTIFICATIONS" />
```

### iOS Permissions

Berikut permissions yang digunakan di `Info.plist`:

```xml
<key>NSCameraUsageDescription</key>
<string>Aplikasi memerlukan akses kamera untuk mengambil foto.</string>
<key>NSPhotoLibraryUsageDescription</key>
<string>Aplikasi memerlukan akses galeri untuk memilih foto.</string>
<key>NSPhotoLibraryAddUsageDescription</key>
<string>Aplikasi memerlukan akses untuk menyimpan foto ke galeri.</string>
```

## Cara Menggunakan

### 1. Setup Project

```bash
cd photo_notification_app
flutter pub get
```

### 2. Jalankan Aplikasi

#### Untuk Android:

```bash
flutter run
```

#### Untuk iOS:

```bash
flutter run
```

### 3. Menggunakan Aplikasi

1. **Buka Kamera**: Tekan tombol "Buka Kamera" untuk membuka aplikasi kamera
2. **Ambil Foto**: Arahkan kamera dan ambil foto
3. **Lihat Notifikasi**: Notifikasi akan muncul saat foto berhasil diambil
4. **Pilih dari Galeri**: Tekan tombol "Pilih dari Galeri" untuk membuka galeri
5. **Lihat Foto**: Foto yang dipilih akan ditampilkan di layar
6. **Notifikasi Lagi**: Notifikasi baru akan muncul saat foto dipilih dari galeri

## Penjelasan Kode Utama

### Inisialisasi Notifikasi

```dart
final FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin =
    FlutterLocalNotificationsPlugin();

const AndroidInitializationSettings initializationSettingsAndroid =
    AndroidInitializationSettings('@mipmap/ic_launcher');

const DarwinInitializationSettings initializationSettingsIOS =
    DarwinInitializationSettings();

await flutterLocalNotificationsPlugin.initialize(initializationSettings);
```

### Mengambil Foto dari Kamera

```dart
Future<void> _pickFromCamera() async {
  try {
    final XFile? pickedFile =
        await _imagePicker.pickImage(source: ImageSource.camera);

    if (pickedFile != null) {
      setState(() {
        _selectedImage = File(pickedFile.path);
      });

      await _showNotification('Foto berhasil diambil dari kamera!');
    }
  } catch (e) {
    // Handle error
  }
}
```

### Memilih Foto dari Galeri

```dart
Future<void> _pickFromGallery() async {
  try {
    final XFile? pickedFile =
        await _imagePicker.pickImage(source: ImageSource.gallery);

    if (pickedFile != null) {
      setState(() {
        _selectedImage = File(pickedFile.path);
      });

      await _showNotification('Foto berhasil dipilih dari galeri!');
    }
  } catch (e) {
    // Handle error
  }
}
```

### Menampilkan Notifikasi

```dart
Future<void> _showNotification(String message) async {
  const AndroidNotificationDetails androidPlatformChannelSpecifics =
      AndroidNotificationDetails(
    'com.example.photo_notification_app',
    'Notifikasi Foto',
    channelDescription: 'Notifikasi untuk pengambilan foto',
    importance: Importance.max,
    priority: Priority.high,
    showWhen: true,
  );

  const NotificationDetails platformChannelSpecifics =
      NotificationDetails(android: androidPlatformChannelSpecifics);

  await flutterLocalNotificationsPlugin.show(
    0,
    'Foto Berhasil!',
    message,
    platformChannelSpecifics,
    payload: 'item id 2',
  );
}
```

## Kebutuhan Minimum

- **Flutter SDK**: >= 3.11.5
- **Android**: API 21 atau lebih tinggi
- **iOS**: 11.0 atau lebih tinggi

## Plugin yang Digunakan

1. **image_picker**: ^1.0.0 - Untuk mengambil/memilih foto dari kamera atau galeri
2. **flutter_local_notifications**: ^14.0.0 - Untuk menampilkan notifikasi lokal

## Catatan

- Pastikan device memiliki kamera untuk fitur pengambilan foto
- Notifikasi hanya ditampilkan pada channel Android, untuk iOS perlu konfigurasi tambahan
- Aplikasi memerlukan permission dari pengguna untuk mengakses kamera dan galeri

## Troubleshooting

### Notifikasi Tidak Muncul

- Pastikan permissions sudah diberikan di device settings
- Cek bahwa channel notification sudah dikonfigurasi dengan benar
- Untuk Android 13+, pastikan POST_NOTIFICATIONS permission sudah diberikan

### Kamera Tidak Membuka

- Pastikan CAMERA permission sudah diberikan
- Cek bahwa device memiliki kamera yang berfungsi

### Galeri Tidak Terbuka

- Pastikan READ_EXTERNAL_STORAGE permission sudah diberikan
- Untuk Android 13+, gunakan READ_MEDIA_IMAGES permission

## Created Date

30 Mei 2026

## Author

Praktikum Flutter - Tugas 7
