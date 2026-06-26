import 'package:equatable/equatable.dart';
import '../models/product.dart';

class CartState extends Equatable {
  final List<Product> items;

  const CartState({this.items = const []});

  CartState copyWith({List<Product>? items}) {
    return CartState(
      items: items ?? this.items,
    );
  }

  @override
  List<Object?> get props => [items];
}
