import 'package:flutter/material.dart';

class SchedulePage extends StatelessWidget {
  const SchedulePage({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        appBar: AppBar(
          title: Text('SCHEDULE'),
        ),
        body: ScheduleGrid(),
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
        childAspectRatio: 0.75, // Menyesuaikan proporsi gambar dan teks
        crossAxisSpacing: 10, // Jarak antar kolom
        mainAxisSpacing: 10, // Jarak antar baris
      ),
      itemCount: rooms.length,
      itemBuilder: (context, index) {
        return Column(
          children: [
            Container(
              height: 120, // Mengatur tinggi gambar agar tidak kebesaran
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(8), // Membuat sudut gambar melengkung
                image: DecorationImage(
                  image: AssetImage('assets/images/gedungkuliah-terpadu.png'),
                  fit: BoxFit.cover, // Menyesuaikan gambar ke ukuran container
                ),
              ),
            ),
            SizedBox(height: 8),
            Text(
              rooms[index],
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
              textAlign: TextAlign.center,
            ),
          ],
        );
      },
    );
  }
}