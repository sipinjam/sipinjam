import 'package:d_button/d_button.dart';
import 'package:d_input/d_input.dart';
import 'package:flutter/material.dart';
import 'package:sipit_app/pages/homePage.dart';
import 'package:sipit_app/theme.dart';

class LoginPage extends StatelessWidget {
  const LoginPage({super.key});

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
                child: Container(
                  width: MediaQuery.of(context).size.width * 0.7,
                  height: 400,
                  child: Column(
                    children: [
                      const Text(
                        'SIPERA',
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
                              controller: TextEditingController(),
                              maxLine: 1,
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
                              controller: TextEditingController(),
                              maxLine: 1,
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
                          onClick: () {
                            Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) => const HomePage()));
                          },
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
