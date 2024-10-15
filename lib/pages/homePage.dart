import 'package:flutter/material.dart';

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false, // Menonaktifkan ikon back otomatis
        title: Card(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(30), // Membulatkan sisi card
          ),
          elevation: 2, // Memberi efek bayangan
          margin: const EdgeInsets.symmetric(
              vertical: 20), // Menambahkan margin atas
          child: Padding(
            padding: const EdgeInsets.symmetric(horizontal: 10),
            child: TextField(
              decoration: InputDecoration(
                hintText: 'Cari ruangan',
                border: InputBorder.none,
                icon: Icon(Icons.search, color: Colors.grey.shade600),
              ),
            ),
          ),
        ),
        leading:
            null, // Tidak ada ikon search di leading, karena sudah di dalam TextField
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            const SizedBox(height: 20),
            // Bagian daftar gedung dengan horizontal scroll
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 8),
              child: SizedBox(
                height: 200, // Tinggi container yang memuat gedung
                child: ListView(
                  scrollDirection: Axis.horizontal,
                  shrinkWrap: true,
                  children: const [
                    GedungCard('Administrasi Bisnis'),
                    GedungCard('Gedung Kuliah Terpadu'),
                    GedungCard('Magister Terapan'),
                    GedungCard('Sekolah A'),
                    GedungCard('Sekolah B'),
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
                  const SizedBox(height: 14),
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
            width: 150,
            height: 150,
            color: Colors.grey.shade300,
            child: Image.asset(
              'assets/images/gkt-bg.jpeg',
              fit: BoxFit.cover,
            ),
          ),
          const SizedBox(height: 5),
          Text(title, style: const TextStyle(fontSize: 15)),
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
    return SizedBox(
      height: 150, // Menambah tinggi RoomCard
      child: Card(
        child: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Mengatur tinggi gambar lebih fleksibel
              Container(
                width: 150, // Menambah lebar gambar
                height: 120, // Menambah tinggi gambar
                decoration: BoxDecoration(
                  color: Colors.grey.shade300,
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Image.asset(
                  'assets/images/gkt-bg.jpeg',
                  fit: BoxFit.cover, // Gambar memenuhi seluruh container
                ),
              ),
              const SizedBox(width: 20),
              // Bagian teks dan ikon
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      title,
                      style: const TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(height: 10),
                    Row(
                      children: [
                        const Icon(Icons.people,
                            size: 20), // Ukuran ikon lebih besar
                        const SizedBox(width: 4),
                        Text('$capacity'),
                        const SizedBox(width: 10),
                        const Icon(Icons.wifi, size: 20),
                        const SizedBox(width: 10),
                        const Icon(Icons.chair, size: 20),
                        const SizedBox(width: 10),
                        const Icon(Icons.desktop_windows, size: 20),
                      ],
                    ),
                  ],
                ),
              ),
            ],
          ),
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
