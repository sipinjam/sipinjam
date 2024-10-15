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
      body: ListView(children: const [
        Padding(
          padding: EdgeInsets.symmetric(horizontal: 10),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              SizedBox(height: 12),
              // Menambahkan horizontal scroll pada daftar gedung
              SizedBox(
                height: 200, // Tinggi kontainer untuk daftar gedung
                child: SingleChildScrollView(
                  scrollDirection:
                      Axis.horizontal, // Mengaktifkan scroll horizontal
                  child: Row(
                    children: const [
                      GedungCard(
                        imageUrl: 'assets/images/AB.jpg',
                        buildingName: 'Administrasi Bisnis',
                      ),
                      GedungCard(
                        imageUrl: 'assets/images/gkt-bg.jpeg',
                        buildingName: 'Gedung Kuliah Terpadu',
                      ),
                      GedungCard(
                        imageUrl: 'assets/images/mst.jpg',
                        buildingName: 'Magister Terapan',
                      ),
                    ],
                  ),
                ),
              ),
              SizedBox(height: 20),
              // Contoh untuk RoomCard, bisa di-scroll vertikal jika dibutuhkan
              Text(
                "DAFTAR RUANGAN",
                style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
              ),
              RoomCard(
                  imageUrl: 'assets/images/gkt-bg.jpeg',
                  buildingName: 'GKT Lantai 1',
                  capacity: '300'),
              RoomCard(
                  imageUrl: 'assets/images/gkt-bg.jpeg',
                  buildingName: 'GKT Lantai 2',
                  capacity: '300'),
              RoomCard(
                  imageUrl: 'assets/images/mst.jpg',
                  buildingName: 'Ruang Seminar MST',
                  capacity: '30'),
              RoomCard(
                  imageUrl: 'assets/images/mst.jpg',
                  buildingName: 'MST III/303',
                  capacity: '30'),
              RoomCard(
                  imageUrl: 'assets/images/mst.jpg',
                  buildingName: 'MST III/304',
                  capacity: '30'),
              RoomCard(
                  imageUrl: 'assets/images/mst.jpg',
                  buildingName: 'MST III/305',
                  capacity: '30'),
              RoomCard(
                  imageUrl: 'assets/images/mst.jpg',
                  buildingName: 'MST III/306',
                  capacity: '30'),
            ],
          ),
        ),
      ]),
    );
  }
}

class GedungCard extends StatelessWidget {
  final String imageUrl;
  final String buildingName;

  const GedungCard({
    required this.imageUrl,
    required this.buildingName,
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      width: 200,
      height: 200,
      child: Card(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            Container(
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(8),
              ),
            ),
            Container(
              width: 200,
              height: 150,
              decoration: BoxDecoration(
                borderRadius:
                    BorderRadius.circular(8), // Menentukan radius lengkungan
                image: DecorationImage(
                  image: AssetImage(imageUrl),
                  fit: BoxFit.cover,
                ),
              ),
            ),
            const SizedBox(height: 10),
            Text(buildingName, style: const TextStyle(fontSize: 16)),
          ],
        ),
      ),
    );
  }
}

class RoomCard extends StatelessWidget {
  final String imageUrl;
  final String buildingName;
  final String capacity;

  const RoomCard({
    required this.imageUrl,
    required this.buildingName,
    required this.capacity,
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      height: 170, // Menambah tinggi RoomCard
      child: Card(
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Mengatur tinggi gambar lebih fleksibel
            Container(
              decoration: BoxDecoration(
                color: Colors.grey.shade300,
                borderRadius: BorderRadius.circular(8),
              ),
            ),
            Container(
              width: 150,
              height: 170,
              decoration: BoxDecoration(
                borderRadius:
                    BorderRadius.circular(8), // Menentukan radius lengkungan
                image: DecorationImage(
                  image: AssetImage(imageUrl),
                  fit: BoxFit.cover,
                ),
              ),
            ),
            const SizedBox(width: 20),
            // Bagian teks dan ikon
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const SizedBox(height: 10),
                  Text(
                    buildingName,
                    style: const TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 10),
                  Row(children: [
                    const SizedBox(width: 10),
                    const Icon(Icons.people,
                        size: 20), // Ukuran ikon lebih besar
                    const SizedBox(width: 10),
                    Text('$capacity'),
                  ]),
                  Row(
                    children: [
                      const SizedBox(width: 10),
                      const Icon(Icons.wifi, size: 20),
                      const SizedBox(width: 10),
                      Text('WIFI')
                    ],
                  ),
                  Row(
                    children: [
                      const SizedBox(width: 10),
                      const Icon(Icons.chair, size: 20),
                      const SizedBox(width: 10),
                      Text('SEAT')
                    ],
                  ),
                  Row(
                    children: [
                      const SizedBox(width: 10),
                      const Icon(Icons.ac_unit, size: 20),
                      const SizedBox(width: 10),
                      Text('AC')
                    ],
                  ),
                  Row(
                    children: [
                      const SizedBox(width: 10),
                      const Icon(Icons.tv, size: 20),
                      const SizedBox(width: 10),
                      Text('LCD')
                    ],
                  ),
                ],
              ),
            ),
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
