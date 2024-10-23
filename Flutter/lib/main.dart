import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:sipit_app/pages/authentication/loginPage.dart';
import 'package:sipit_app/pages/dashboard/Home/detailRuangan.dart';
import 'package:sipit_app/pages/dashboard/Profile/editProfile.dart';
import 'package:sipit_app/pages/dashboard/History/history.dart';
import 'package:sipit_app/pages/dashboard/Home/homePage.dart';
import 'package:sipit_app/pages/dashboard/Home/peminjaman.dart';
import 'package:sipit_app/pages/dashboard/Profile/profile.dart';
import 'package:sipit_app/pages/dashboard/Profile/splash.dart';
import 'package:sipit_app/pages/dashboard/Home/daftarRuangan.dart';
import 'package:sipit_app/pages/dashboard/Profile/faq.dart';
import 'package:sipit_app/pages/dashboard/Profile/updatePassword.dart';
import 'package:sipit_app/theme.dart';

void main() {
  runApp(const ProviderScope(child: MyApp()));
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      theme: ThemeData(
        scaffoldBackgroundColor: putih,
      ),
      debugShowCheckedModeBanner: false,
      home: const SplashPage(),
      routes: {
        '/login': (context) => const LoginPage(),
        '/home': (context) => const HomePage(),
        '/peminjaman': (context) => peminjamanPage(),
        '/profile': (context) => const ProfilePage(),
        '/history': (context) => const HistoryPage(),
        '/detailRuangan': (context) => const detailRuanganPage(),
        '/daftarRuangan': (context) => const daftarRuanganPage(),
        '/faq': (context) => FaqPage(),
        '/editProfile': (context) => EditProfileApp(),
        '/updatePass': (context) => UpdatePass(),
      },
    );
  }
}
