import 'package:flutter/material.dart';
import 'package:sipit_app/theme.dart';

class LoginPage extends StatelessWidget {
  const LoginPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        backgroundColor: const Color(0xffEEEEEE),
        body: Stack(
          children: [
            Align(
              alignment:
                  Alignment.topLeft, // Sesuaikan agar berada di tengah atas
              child: Container(
                width: 360,
                height: 500,
                decoration: const BoxDecoration(
                  color: Color(0xffCECECE),
                  borderRadius: BorderRadius.only(
                    bottomLeft: Radius.circular(360),
                  ),
                ),
              ),
            ),
            Align(
              alignment: Alignment.bottomLeft,
              child: Container(
                width: 140,
                height: 140,
                decoration: BoxDecoration(
                  borderRadius:
                      const BorderRadius.only(topRight: Radius.circular(140)),
                  color: biruTua,
                ),
              ),
            ),
            Container(
              width: 295,
              height: 459,
              color: Colors.blue,
              child: Column(
                children: [
                  const Text(
                    'SIPINJAM',
                    style: TextStyle(fontSize: 40),
                  ),
                  const SizedBox(
                    height: 62,
                  ),
                  Align(
                    alignment: Alignment.centerLeft,
                    child: Text(
                      "Let's get you sign in!",
                      style: TextStyle(color: biruTua),
                    ),
                  )
                ],
              ),
            )
          ],
        ));
  }
}
