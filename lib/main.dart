import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:sipit_app/pages/authentication/loginPage.dart';
import 'package:sipit_app/pages/detailRuangan.dart';
import 'package:sipit_app/pages/history.dart';
import 'package:sipit_app/pages/homePage.dart';
import 'package:sipit_app/pages/peminjaman.dart';
import 'package:sipit_app/pages/profile.dart';
import 'package:sipit_app/pages/splash.dart';
import 'package:sipit_app/pages/daftarRuangan.dart';
import 'package:sipit_app/pages/faq.dart';


void main() {
  runApp(const ProviderScope(child: MyApp()));
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
        '/profile': (context) => const ProfilePage(),
        '/history': (context) => const HistoryPage(),
        '/detailRuangan': (context) => const detailRuanganPage(),
        '/daftarRuangan': (context) => const daftarRuanganPage(),
        '/faq': (context) => FaqPage(),
      },
    );
  }
}
