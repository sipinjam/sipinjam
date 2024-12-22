import 'package:d_button/d_button.dart';
import 'package:d_input/d_input.dart';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/datasources/peminjam_datasource.dart';
import 'package:sipit_app/models/peminjamModel.dart';
import 'package:sipit_app/pages/dashboardPage.dart';
import 'package:sipit_app/theme.dart';
import 'package:shared_preferences/shared_preferences.dart';

void _checkLoginStatus(BuildContext context) async {
  final prefs = await SharedPreferences.getInstance();
  final isLoggedIn = prefs.getBool('is_logged_in') ?? false;

  if (isLoggedIn) {
    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (context) => const Dashboardpage()),
    );
  }
}

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _namaPeminjamController = TextEditingController();
  final _passwordController = TextEditingController();
  final _datasource = PeminjamDatasource();
  PeminjamModel? _peminjamModel;

  @override
  void initState() {
    super.initState();
    _checkLoginStatus(context); // Cek status login saat pertama kali dibuka
  }

  void _login() async {
    print('tertekan');
    try {
      final peminjamData = await _datasource.login(
        _namaPeminjamController.text,
        _passwordController.text,
      );

      if (peminjamData != null) {
        setState(() {
          _peminjamModel = peminjamData;
        });

        // Simpan status login
        final prefs = await SharedPreferences.getInstance();
        await prefs.setBool('is_logged_in', true);

        // Simpan data peminjam ke SharedPreferences
        await AppSession.savePeminjam(peminjamData);

        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text("Login successful")),
        );

        // Pindah ke halaman HomePage setelah login berhasil
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (context) => const Dashboardpage()),
        );
      }
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text("Username atau Password tidak cocok")),
      );
      print(e);
    }
  }

  // Fungsi untuk memuat data profil dari SharedPreferences
  void loadProfileData() async {
    final peminjam = await AppSession.getPeminjam();
    if (peminjam != null) {
      setState(() {
        _peminjamModel = peminjam;
      });
    } else {
      print("Data peminjam tidak ditemukan di profil.");
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: putih,
      body: Stack(
        fit: StackFit.expand,
        children: [
          Positioned(
            top: 0,
            child: Container(
              width: MediaQuery.of(context).size.width,
              height: MediaQuery.of(context).size.height * (3 / 4),
              decoration: BoxDecoration(
                borderRadius: BorderRadius.only(
                  bottomLeft:
                      Radius.circular(MediaQuery.of(context).size.width) *
                          (3 / 4),
                ),
                color: const Color(0xffCECECE),
              ),
            ),
          ),
          Align(
            alignment: Alignment.bottomLeft,
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.4,
              child: AspectRatio(
                aspectRatio: 1,
                child: Container(
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.only(
                      topRight: Radius.circular(
                          MediaQuery.of(context).size.width * 0.4),
                    ),
                    color: const Color(0xff7E8EF1),
                  ),
                ),
              ),
            ),
          ),
          Align(
            alignment: Alignment.center,
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.7,
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Text(
                    'SIPINJAM',
                    style: TextStyle(
                      fontSize: 40,
                    ),
                  ),
                  const SizedBox(
                    height: 55,
                  ),
                  Align(
                    alignment: Alignment.bottomLeft,
                    child: Text(
                      "Let's get you signed in!",
                      style: TextStyle(fontSize: 15, color: biruTua),
                    ),
                  ),
                  const SizedBox(
                    height: 55,
                  ),
                  IntrinsicHeight(
                    child: Row(
                      children: [
                        Expanded(
                          child: DInput(
                            controller: _namaPeminjamController,
                            validator: (input) =>
                                input == '' ? "Don't leave this empty" : null,
                            maxLine: 1,
                            hint: 'nama_peminjam',
                            label: 'Nama Peminjam',
                            radius: BorderRadius.circular(10),
                          ),
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(
                    height: 12,
                  ),
                  IntrinsicHeight(
                    child: Row(
                      children: [
                        Expanded(
                          child: DInputPassword(
                            controller: _passwordController,
                            validator: (input) =>
                                input == '' ? "Don't leave this empty" : null,
                            maxLine: 1,
                            hint: 'password',
                            label: 'Password',
                            radius: BorderRadius.circular(10),
                          ),
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(
                    height: 70,
                  ),
                  DButtonBorder(
                    borderColor: Colors.white,
                    mainColor: const Color.fromRGBO(246, 195, 0, 5),
                    radius: 10,
                    onClick: _login,
                    child: const Text(
                      'SIGN IN',
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
