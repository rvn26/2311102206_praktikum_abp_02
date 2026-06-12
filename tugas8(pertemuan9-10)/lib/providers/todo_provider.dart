import 'package:flutter/foundation.dart';

/// Model class representing a single to-do task.
class TodoItem {
  final String id;
  final String title;
  final DateTime createdAt;

  TodoItem({
    required this.id,
    required this.title,
    required this.createdAt,
  });
}

/// Provider class for managing the to-do list state.
/// Uses ChangeNotifier to notify listeners when the state changes.
class TodoProvider extends ChangeNotifier {
  final List<TodoItem> _todos = [];

  /// Returns an unmodifiable view of the to-do list.
  List<TodoItem> get todos => List.unmodifiable(_todos);

  /// Returns the number of tasks in the list.
  int get todoCount => _todos.length;

  /// Adds a new task to the list.
  void addTodo(String title) {
    final newTodo = TodoItem(
      id: DateTime.now().millisecondsSinceEpoch.toString(),
      title: title,
      createdAt: DateTime.now(),
    );
    _todos.add(newTodo);
    notifyListeners();
  }

  /// Removes a specific task by its ID.
  void removeTodo(String id) {
    _todos.removeWhere((todo) => todo.id == id);
    notifyListeners();
  }

  /// Clears all tasks from the list.
  void clearAll() {
    _todos.clear();
    notifyListeners();
  }
}
