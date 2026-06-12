import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'firebase_options.dart';
import 'providers/todo_provider.dart';
import 'services/fcm_service.dart';
import 'screens/todo_screen.dart';

/// Entry point of the application.
/// Initializes Firebase and sets up the background message handler.
void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await Firebase.initializeApp(options: DefaultFirebaseOptions.currentPlatform);

  // Register background message handler
  FirebaseMessaging.onBackgroundMessage(firebaseMessagingBackgroundHandler);

  runApp(const MyApp());
}

/// Root widget that sets up Provider and MaterialApp.
class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) => TodoProvider(),
      child: MaterialApp(
        title: 'To-Do List FCM',
        debugShowCheckedModeBanner: false,
        theme: ThemeData(
          useMaterial3: true,
          brightness: Brightness.dark,
          colorSchemeSeed: const Color(0xffffffff),
          fontFamily: 'Roboto',
        ),
        home: const AppInitializer(),
      ),
    );
  }
}

/// Widget that initializes FCM after the first frame is built.
/// Separates Firebase initialization from the widget tree to ensure
/// context is available for showing notification dialogs.
class AppInitializer extends StatefulWidget {
  const AppInitializer({super.key});

  @override
  State<AppInitializer> createState() => _AppInitializerState();
}

class _AppInitializerState extends State<AppInitializer> {
  final FCMService _fcmService = FCMService();

  @override
  void initState() {
    super.initState();
    // Initialize FCM after the widget tree is built
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _fcmService.initialize(context);
    });
  }

  @override
  Widget build(BuildContext context) {
    return const TodoScreen();
  }
}
