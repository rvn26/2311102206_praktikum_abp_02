import 'package:equatable/equatable.dart';

class Product extends Equatable {
  final String id;
  final String name;
  final double price;

  const Product({
    required this.id,
    required this.name,
    required this.price,
  });

  @override
  List<Object?> get props => [id, name, price];
}

// Dummy data for products
final List<Product> dummyProducts = [
  const Product(id: '1', name: 'Laptop Gaming', price: 15000000),
  const Product(id: '2', name: 'Smartphone', price: 5000000),
  const Product(id: '3', name: 'Smartwatch', price: 1500000),
  const Product(id: '4', name: 'Headphone Bluetooth', price: 800000),
  const Product(id: '5', name: 'Keyboard Mekanikal', price: 600000),
];
