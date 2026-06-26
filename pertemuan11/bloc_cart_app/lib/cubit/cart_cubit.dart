import 'package:flutter_bloc/flutter_bloc.dart';
import '../models/product.dart';
import 'cart_state.dart';

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
