import 'package:flutter/material.dart';

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Container(
      color: Colors.amber,
      padding: EdgeInsets.fromLTRB(20, 20, 20, 0),
      child: Container(
        color: Colors.black,
      ),
    ));
  }
}
