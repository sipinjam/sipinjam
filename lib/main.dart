import 'package:flutter/material.dart';
import 'package:sipit_app/pages/detailRuangan.dart';
import 'package:sipit_app/pages/history.dart';
import 'package:sipit_app/pages/homePage.dart';
import 'package:sipit_app/pages/loginPage.dart';
import 'package:sipit_app/pages/peminjaman.dart';
import 'package:sipit_app/pages/profile.dart';
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
        '/home': (context) => const HomePage(),
        '/peminjaman': (context) => const peminjamanPage(),
        '/profile': (context) => const profilePage(),
        '/history': (context) => const historyPage(),
        '/detailRuangan': (context) => const detailRuanganPage(),
      },
    );
  }
}
