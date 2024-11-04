import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/config/widget.dart';
import 'package:sipit_app/pages/dashboard/Home/daftarRuangan.dart';
import 'package:sipit_app/theme.dart';

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: ListView(children: [
        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Padding(
              padding: const EdgeInsets.all(10.0),
              child: Card(
                shape: RoundedRectangleBorder(
                  borderRadius:
                      BorderRadius.circular(30), // Membulatkan sisi card
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
            ),
            // Menambahkan horizontal scroll pada daftar gedung
            const SizedBox(
              height: 200, // Tinggi kontainer untuk daftar gedung
              child: SingleChildScrollView(
                scrollDirection:
                    Axis.horizontal, // Mengaktifkan scroll horizontal
                child: Row(
                  children: [
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
            // Contoh untuk RoomCard, bisa di-scroll vertikal jika dibutuhkan
            Padding(
              padding: const EdgeInsets.all(10),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const Text(
                    "DAFTAR RUANGAN",
                    style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                  ),
                  BookingCard(
                    imageUrl: 'assets/images/gedungkuliah-terpadu.png',
                    buildingName: 'Gedung Kuliah Terpadu',
                    borrower: 'UKM ROHKRIS',
                    date: '20 September 2024',
                    status: 'Berlangsung',
                    statusColor: biruTua,
                  ),
                  BookingCard(
                    imageUrl: 'assets/images/gedungkuliah-terpadu.png',
                    buildingName: 'Gedung Kuliah Terpadu',
                    borrower: 'UKM ROHKRIS',
                    date: '20 September 2024',
                    status: 'Berlangsung',
                    statusColor: biruTua,
                  ),
                  BookingCard(
                    imageUrl: 'assets/images/gedungkuliah-terpadu.png',
                    buildingName: 'Gedung Kuliah Terpadu',
                    borrower: 'UKM ROHKRIS',
                    date: '20 September 2024',
                    status: 'Berlangsung',
                    statusColor: biruTua,
                  ),
                  BookingCard(
                    imageUrl: 'assets/images/gedungkuliah-terpadu.png',
                    buildingName: 'Gedung Kuliah Terpadu',
                    borrower: 'UKM ROHKRIS',
                    date: '20 September 2024',
                    status: 'Berlangsung',
                    statusColor: biruTua,
                  ),
                ],
              ),
            ),
          ],
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
      child: InkWell(
        onTap: () {
          Nav.push(context, const daftarRuanganPage());
        },
        child: Padding(
          padding: const EdgeInsets.only(left: 10),
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
                    borderRadius: BorderRadius.circular(
                        8), // Menentukan radius lengkungan
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
