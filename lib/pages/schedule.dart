import 'package:flutter/material.dart';

class SchedulePage extends StatelessWidget {
  const SchedulePage({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        appBar: AppBar(
          title: Text('SCHEDULE'),
          centerTitle: false,
        ),
        body: ScheduleGrid(),
        bottomNavigationBar: BottomNavigationBar(
          items: const <BottomNavigationBarItem>[
            BottomNavigationBarItem(
              icon: Icon(Icons.home),
              label: '',
            ),
            BottomNavigationBarItem(
              icon: Icon(Icons.schedule),
              label: '',
            ),
            BottomNavigationBarItem(
              icon: Icon(Icons.person),
              label: '',
            ),
          ],
        ),
      ),
    );
  }
}

class ScheduleGrid extends StatelessWidget {
  final List<String> rooms = [
    "GKT Lantai 1",
    "GKT Lantai 2",
    "UPT Bahasa Lantai 1",
    "Ruang Seminar MST",
    "Auditorium AB",
    "Workshop Sipil",
  ];

  @override
  Widget build(BuildContext context) {
    return GridView.builder(
      padding: EdgeInsets.all(10),
      gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
        crossAxisCount: 2, // Menampilkan dua kolom
        childAspectRatio: 1, // Membuat gambar kotak
        crossAxisSpacing: 10, // Jarak antar kolom
        mainAxisSpacing: 10, // Jarak antar baris
      ),
      itemCount: rooms.length,
      itemBuilder: (context, index) {
        return Column(
          children: [
            Expanded(
              child: Image.asset(
                'assets/images/gedungkuliah-terpadu.png', // Gambar yang sama untuk semua item
                fit: BoxFit.cover,
              ),
            ),
            SizedBox(height: 8),
            Text(
              rooms[index],
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
            ),
          ],
        );
      },
    );
  }
}