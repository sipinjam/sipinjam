import 'package:flutter/material.dart';

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        title: const TextField(
          decoration: InputDecoration(
            hintText: 'Cari ruangan',
            border: InputBorder.none,
          ),
        ),
        leading: const Icon(Icons.search, color: Colors.black),
        actions: [
          const Icon(Icons.notifications, color: Colors.black),
          const SizedBox(width: 10),
        ],
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            const SizedBox(height: 10),
            // Bagian daftar gedung dengan horizontal scroll
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 10),
              child: SizedBox(
                height: 130, // Tinggi container yang memuat gedung
                child: ListView(
                  scrollDirection: Axis.horizontal,
                  children: const [
                    GedungCard('Administrasi Bisnis'),
                    GedungCard('Gedung Kuliah Terpadu'),
                    GedungCard('Magister Terapan'),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 20),
            // Bagian daftar ruangan
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 10),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const Text(
                    'DAFTAR RUANGAN',
                    style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                  ),
                  const SizedBox(height: 10),
                  const RoomCard('GKT Lantai 1', 300),
                  const RoomCard('GKT Lantai 2', 300),
                  const RoomCard('GKT IV/401', 30),
                  const RoomCard('GKT IV/402', 30),
                  const RoomCard('GKT IV/403', 30),
                ],
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: ''),
          BottomNavigationBarItem(icon: Icon(Icons.search), label: ''),
          BottomNavigationBarItem(icon: Icon(Icons.school), label: ''),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: ''),
        ],
      ),
    );
  }
}

class GedungCard extends StatelessWidget {
  final String title;
  const GedungCard(this.title, {super.key});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(right: 10),
      child: Column(
        children: [
          Container(
            width: 100,
            height: 100,
            color: Colors.grey.shade300,
            child: Image.asset(
              'assets/images/gkt-bg.jpeg',
              fit: BoxFit.cover,
            ),
          ),
          const SizedBox(height: 5),
          Text(title, style: const TextStyle(fontSize: 12)),
        ],
      ),
    );
  }
}

class RoomCard extends StatelessWidget {
  final String title;
  final int capacity;
  const RoomCard(this.title, this.capacity, {super.key});

  @override
  Widget build(BuildContext context) {
    return Card(
      child: ListTile(
        leading: Image.asset('assets/images/gkt-bg.jpeg', width: 50, height: 50),
        title: Text(title),
        subtitle: Row(
          children: [
            const Icon(Icons.people, size: 16),
            const SizedBox(width: 4),
            Text('$capacity'),
            const SizedBox(width: 10),
            const Icon(Icons.wifi, size: 16),
            const SizedBox(width: 10),
            const Icon(Icons.chair, size: 16),
            const SizedBox(width: 10),
            const Icon(Icons.desktop_windows, size: 16),
          ],
        ),
      ),
    );
  }
}

void main() {
  runApp(const MaterialApp(
    home: HomePage(),
  ));
}
