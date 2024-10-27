import 'package:d_button/d_button.dart';
import 'package:d_info/d_info.dart';
import 'package:d_input/d_input.dart';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:sipit_app/config/failure.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/datasources/peminjam_datasource.dart';
import 'package:sipit_app/models/peminjamModel.dart';
import 'package:sipit_app/pages/dashboardPage.dart';
import 'package:sipit_app/theme.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _username = TextEditingController();
  final _password = TextEditingController();
  final _datasource = PeminjamDatasource();
  PeminjamModel? _peminjamModel;

  void _login() async {
    try {
      final peminjamData =
          await _datasource.login(_username.text, _password.text);

      if (peminjamData != null) {
        setState(() {
          _peminjamModel = peminjamData;
        });

        ScaffoldMessenger.of(context)
            .showSnackBar(SnackBar(content: Text("Login successful")));
        Nav.push(context, const Dashboardpage());
      }
    } catch (e) {
      ScaffoldMessenger.of(context)
          .showSnackBar(SnackBar(content: Text("Login failed")));
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
                              (3 / 4)),
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
                                MediaQuery.of(context).size.width * 0.4)),
                        color: const Color(0xff7E8EF1)),
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
                          "Let's get you sign in!",
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
                              controller: _username,
                              validator: (input) =>
                                  input == '' ? "Don't Empty" : null,
                              maxLine: 1,
                              hint: 'username',
                              label: 'Username',
                              radius: BorderRadius.circular(10),
                            ))
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
                              controller: _password,
                              validator: (input) =>
                                  input == '' ? "Don't Empty" : null,
                              maxLine: 1,
                              hint: 'password',
                              label: 'Password',
                              radius: BorderRadius.circular(10),
                            ))
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
                                color: Colors.white),
                          ))
                    ],
                  ),
                ))
          ],
        ));
  }
}
