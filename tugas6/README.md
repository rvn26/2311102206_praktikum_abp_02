# Flutter Widgets Demo

Aplikasi Flutter yang menampilkan berbagai widget UI penting dengan contoh penggunaan praktis.

## Deskripsi Widget

### 1. **Container**

Widget dasar yang berfungsi sebagai kotak/box dengan properti styling.

- **Kegunaan**: Membuat kotak berwarna, memberikan padding, margin, dan dekorasi
- **Dalam Project**: Menampilkan kotak biru dengan border dan text center
- **Properti Utama**: `color`, `width`, `height`, `decoration`, `borderRadius`

```dart
Container(
  width: 100,
  height: 100,
  decoration: BoxDecoration(color: Colors.blue),
  child: Center(child: Text('Hello')),
)
```

### 2. **GridView**

Widget untuk menampilkan item dalam bentuk grid (baris dan kolom).

- **Kegunaan**: Menampilkan koleksi item dalam tata letak grid
- **Dalam Project**: Grid 3 kolom dengan 6 item berwarna-warni
- **Properti Utama**: `crossAxisCount`, `mainAxisSpacing`, `crossAxisSpacing`
- **Cocok untuk**: Gallery foto, product listing, dashboard dengan banyak item

```dart
GridView.count(
  crossAxisCount: 3,
  children: List.generate(6, (index) => Container())
)
```

### 3. **ListView**

Widget untuk menampilkan list item yang bisa di-scroll.

- **Kegunaan**: Menampilkan daftar item yang dapat discroll
- **Dalam Project**: 3 item horizontal (A, B, C) dengan warna berbeda
- **Properti Utama**: `scrollDirection`, `children`
- **Cocok untuk**: Menu, daftar pilihan, galeri horizontal

```dart
ListView(
  scrollDirection: Axis.horizontal,
  children: [Item1(), Item2(), Item3()]
)
```

### 4. **ListView.builder**

Widget untuk menampilkan list dinamis dari data array.

- **Kegunaan**: Membuat list dari data yang berasal dari array atau database
- **Dalam Project**: List 5 item dengan avatar, title, dan subtitle
- **Properti Utama**: `itemCount`, `itemBuilder`
- **Keuntungan**: Efisien karena hanya render item yang terlihat (lazy loading)
- **Cocok untuk**: Chat messages, social feed, notification list

```dart
ListView.builder(
  itemCount: dataList.length,
  itemBuilder: (context, index) => ListTile(title: Text(dataList[index]))
)
```

### 5. **ListView.separated**

Widget untuk menampilkan list dengan garis pembatas di antara item.

- **Kegunaan**: Membuat list dengan separator/divider yang jelas
- **Dalam Project**: 5 item dengan divider dan chip di setiap baris
- **Properti Utama**: `itemCount`, `itemBuilder`, `separatorBuilder`
- **Perbedaan dengan builder**: Memiliki separator builder terpisah
- **Cocok untuk**: Daftar kontak, menu dengan pembatas, structured list

```dart
ListView.separated(
  itemCount: 5,
  itemBuilder: (context, index) => ListTile(),
  separatorBuilder: (context, index) => Divider()
)
```

### 6. **Stack**

Widget untuk menampilkan multiple widget yang bertumpuk/overlay.

- **Kegunaan**: Menempatkan widget di atas widget lain
- **Dalam Project**: 3 kotak bertumpuk (red, orange, yellow) dengan positioning
- **Properti Utama**: `children`, `alignment`, `fit`
- **Positioning**: Menggunakan `Positioned` untuk kontrol posisi
- **Cocok untuk**: Badge overlay, floating buttons, image overlay dengan text

```dart
Stack(
  children: [
    Container(color: Colors.red),
    Positioned(top: 20, left: 20, child: Container())
  ]
)
```

## Cara Menjalankan

```bash
# Clone atau buka project
cd tugas

# Jalankan aplikasi
flutter run

# Untuk rebuild dengan clean
flutter clean
flutter pub get
flutter run
```

## Struktur Folder

```
lib/
  ├── main.dart          # File utama dengan semua widget
android/                 # Konfigurasi untuk platform Android
ios/                     # Konfigurasi untuk platform iOS
web/                     # Konfigurasi untuk platform Web
windows/                 # Konfigurasi untuk platform Windows
linux/                   # Konfigurasi untuk platform Linux
macos/                   # Konfigurasi untuk platform macOS
pubspec.yaml            # File konfigurasi dependency
```

## Tips Penggunaan

- **Container**: Gunakan untuk styling dan layout dasar
- **GridView**: Ideal untuk tampilan thumbnail atau product grid
- **ListView**: Gunakan untuk data yang fixed atau jumlah kecil
- **ListView.builder**: Lebih efficient untuk data besar (lazy loading)
- **ListView.separated**: Gunakan ketika perlu separator visual
- **Stack**: Untuk efek overlay atau floating elements

## Resources

- [Flutter Documentation](https://docs.flutter.dev/)
- [Flutter Widgets Catalog](https://docs.flutter.dev/development/ui/widgets)
- [Flutter Layout Guide](https://docs.flutter.dev/development/ui/layout/tutorial)

---

**Created for Flutter UI Widget Learning**
