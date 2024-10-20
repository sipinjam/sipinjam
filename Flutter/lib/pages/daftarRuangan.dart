import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/pages/detailRuangan.dart';

class daftarRuanganPage extends StatelessWidget {
  const daftarRuanganPage({super.key});

  final List<Map<String, dynamic>> items = const [
    {"title": "Lantai 1", "capacity": 300},
    {"title": "Lantai 2", "capacity": 300},
    {"title": "IV/401", "capacity": 30},
    {"title": "IV/402", "capacity": 30},
    {"title": "IV/403", "capacity": 30},
    {"title": "IV/404", "capacity": 30},
    {"title": "IV/405", "capacity": 30},
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        automaticallyImplyLeading: false, // Menonaktifkan ikon back otomatis
        title: Card(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(30), // Membulatkan sisi card
          ),
          elevation: 2, // Memberi efek bayangan
          margin: const EdgeInsets.only(top: 6), // Menambahkan margin atas
          // child: Padding(
          //   padding: const EdgeInsets.symmetric(horizontal: 10),
          //   child: TextField(
          //     decoration: InputDecoration(
          //       hintText: 'Cari ruangan',
          //       border: InputBorder.none,
          //       icon: Icon(Icons.search, color: Colors.grey.shade600),
          //     ),
          //   ),
          // ),
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: GridView.builder(
          itemCount: items.length,
          gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
            crossAxisCount: 2, // Jumlah kolom dalam grid
            childAspectRatio: 0.75, // Rasio aspek item
          ),
          itemBuilder: (context, index) {
            final item = items[index];
            return InkWell(
              onTap: () {
                Nav.push(context, const detailRuanganPage());
              },
              child: Card(
                elevation: 2,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10),
                ),
                child: Column(
                  children: [
                    Expanded(
                      child: Image.asset(
                        'assets/images/gedungkuliah-terpadu.png', // Ganti dengan path gambar Anda
                        fit: BoxFit.cover,
                      ),
                    ),
                    Padding(
                      padding: const EdgeInsets.all(8.0),
                      child: Column(
                        children: [
                          Text(
                            item['title'],
                            style: const TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 12,
                            ),
                          ),
                          const SizedBox(height: 3),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              const Icon(Icons.people, size: 18),
                              const SizedBox(width: 3),
                              Text(
                                '${item['capacity']}',
                                style: const TextStyle(fontSize: 10),
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            );
          },
        ),
      ),
    );
  }
}

void main() {
  runApp(const MaterialApp(
    home: daftarRuanganPage(),
  ));
}
