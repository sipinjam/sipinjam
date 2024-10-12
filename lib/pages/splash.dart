import 'dart:async';

import 'package:flutter/material.dart';

class SplashPage extends StatefulWidget {
  const SplashPage({super.key});

  @override
  State<SplashPage> createState() => _SplashPageState();
}

class _SplashPageState extends State<SplashPage> {
  @override
  void initState() {
    super.initState();
    Timer(const Duration(seconds: 3), () {
      Navigator.of(context).pushReplacementNamed('/login');
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Stack(
      // fit: StackFit.expand,
      alignment: Alignment.center,
      children: [
        Container(
          decoration: const BoxDecoration(
              image: DecorationImage(
                  image: AssetImage('assets/images/splashBackground.png'),
                  fit: BoxFit.cover)),
        ),
        Align(
          alignment: Alignment.bottomCenter,
          child: Image.asset(
            'assets/images/gedungkuliah-terpadu.png',
            // width: MediaQuery.of(context).size.width,
            // height: MediaQuery.of(context).size.height / 2,
            fit: BoxFit.cover,
          ),
        ),
        Column(
          children: [
            Container(
              margin: const EdgeInsets.only(top: 70),
              width: 100,
              height: 100,
              decoration: const BoxDecoration(
                  image: DecorationImage(
                      image: AssetImage('assets/images/LogoPolines.png'),
                      fit: BoxFit.cover)),
            ),
            const SizedBox(
              height: 10,
            ),
            const Text(
              'SIPINJAM',
              style: TextStyle(
                  fontSize: 50,
                  fontWeight: FontWeight.w500,
                  shadows: [Shadow(offset: Offset(3, 3), color: Colors.black)],
                  color: Color(0xffEEEEEE)),
            ),
            const SizedBox(
              height: 10,
            ),
            const Text(
              'Sistem Peminjaman Tempat',
              style: TextStyle(
                  fontSize: 18,
                  color: Color(0xffEEEEEE),
                  fontWeight: FontWeight.w400),
            ),
            const Text(
              'POLITEKNIK NEGERI SEMARANG',
              style: TextStyle(
                  fontSize: 22,
                  color: Color(0xffEEEEEE),
                  fontWeight: FontWeight.w400),
            ),
          ],
        )
      ],
    ));
  }
}
