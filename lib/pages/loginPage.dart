import 'package:flutter/material.dart';

class Loginpage extends StatelessWidget {
  const Loginpage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xffEEEEEE),
      body: Stack(
        children: [
          Container(
            width: 360,
            height: 500,
            decoration: const BoxDecoration(
                color: Color(0xffCECECE),
                borderRadius:
                    BorderRadius.only(bottomLeft: Radius.circular(360))),
          ),
          Container(
            alignment: Alignment.bottomLeft,
            width: 100,
            height: 100,
            color: Colors.amber,
          )
        ],
      ),
    );
  }
}
