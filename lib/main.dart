import 'package:flutter/material.dart';
import 'package:sipit_app/pages/homePage.dart';
import 'package:sipit_app/pages/loginPage.dart';
import 'package:sipit_app/pages/splash.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: const SplashPage(),
      routes: {
        '/login': (context) => const LoginPage(),
      },
    );
  }
}
