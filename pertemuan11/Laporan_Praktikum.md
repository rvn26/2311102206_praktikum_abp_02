# Laporan Praktikum: Aplikasi Flutter dengan BLoC / Cubit

## 1. Pendahuluan
Pada praktikum ini, telah dibuat sebuah aplikasi Flutter sederhana yang menerapkan arsitektur state management menggunakan package `flutter_bloc` (Cubit). Aplikasi ini memiliki fungsi sebagai daftar produk dengan fitur menambahkan dan menghapus produk dari keranjang, serta menampilkan jumlah item pada keranjang secara real-time.

## 2. Implementasi BLoC / Cubit

Pendekatan state management yang digunakan adalah **Cubit**, yaitu versi ringan dari BLoC yang tidak memerlukan pemetaan event secara eksplisit (hanya menggunakan method untuk mengubah state).

### a. State (CartState)
File `cart_state.dart` mendefinisikan state yang direpresentasikan oleh kelas `CartState`.
```dart
class CartState extends Equatable {
  final List<Product> items;
  const CartState({this.items = const []});
  // ... fungsi copyWith dan props untuk Equatable
}
```
State ini menyimpan daftar `items` yang saat ini berada di keranjang. Penggunaan package `equatable` bertujuan untuk mempermudah perbandingan objek state sehingga UI hanya akan rebuild jika benar-benar ada perubahan pada isi list.

### b. Cubit (CartCubit)
File `cart_cubit.dart` mengelola logika bisnis aplikasi keranjang.
```dart
class CartCubit extends Cubit<CartState> {
  CartCubit() : super(const CartState());

  void addToCart(Product product) {
    final updatedItems = List<Product>.from(state.items)..add(product);
    emit(state.copyWith(items: updatedItems));
  }

  void removeFromCart(Product product) {
    final updatedItems = List<Product>.from(state.items)..remove(product);
    emit(state.copyWith(items: updatedItems));
  }
}
```
Cubit ini memiliki dua fungsi utama:
- `addToCart(Product product)`: Membuat salinan dari state item yang ada, menambahkan produk baru, kemudian memancarkan (`emit`) state yang baru.
- `removeFromCart(Product product)`: Menghapus produk spesifik dari list dan memancarkan state terbarunya.

### c. Integrasi BlocProvider dan BlocBuilder
- **`BlocProvider`**: Diterapkan pada level teratas di `main.dart` agar instance `CartCubit` bisa diakses dari seluruh halaman (`ProductListPage` dan `CartPage`).
- **`BlocBuilder`**: Digunakan untuk me-rebuild UI secara real-time.
  1. Pada icon keranjang di AppBar (untuk menampilkan badge jumlah item).
  2. Pada halaman keranjang (`CartPage`) untuk me-render daftar ListView berdasarkan `state.items.length`.

## 3. Hasil Aplikasi

### a. Tampilan Daftar Produk & Proses Tambah
Terdapat 5 produk dummy. Ketika tombol "Add" ditekan, fungsi `addToCart` dipanggil, memicu perubahan state dan otomatis memperbarui angka indikator keranjang di sudut kanan atas.
*(Silakan lampirkan screenshot tampilan Product List di sini)*
> `![Screenshot Daftar Produk](...)`

### b. Tampilan Keranjang (Cart Page) & Proses Hapus
Pada halaman keranjang, pengguna dapat melihat daftar item yang telah ditambahkan. Ketika tombol ikon remove/merah ditekan, memanggil fungsi `removeFromCart`. ListView dan State otomatis diperbarui sehingga item menghilang dari tampilan keranjang.
*(Silakan lampirkan screenshot tampilan Keranjang di sini)*
> `![Screenshot Cart Page](...)`
