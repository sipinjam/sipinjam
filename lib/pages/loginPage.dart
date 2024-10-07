import 'package:flutter/material.dart';

class Loginpage extends StatelessWidget {
  const Loginpage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        backgroundColor: Color(0xffEEEEEE),
        body: Expanded(
          child: Stack(
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
                  decoration: const BoxDecoration(
                    borderRadius:
                        BorderRadius.only(topRight: Radius.circular(140)),
                    color: Color(0xff7E8EF1),
                  ),
                ),
              ),
              Align(
                alignment: Alignment.center,
                child: Container(
                  width: 295,
                  height: 459,
                  color: Colors.blue,
                  child: const Column(
                    children: [
                      Text(
                        'SIPINJAM',
                        style: TextStyle(fontSize: 40),
                      ),
                      SizedBox(
                        height: 62,
                      ),
                      Positioned(left: 0, child: Text("Let's get you sign in!"))
                    ],
                  ),
                ),
              )
            ],
          ),
        ));
  }
}
