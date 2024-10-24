import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/pages/dashboardPage.dart';
import 'package:sipit_app/pages/dashboard/Home/detailRuangan.dart';

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
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: Column(
          children: [
            Row(
              children: [
                IconButton(
                  icon: const Icon(Icons.keyboard_arrow_left_rounded),
                  onPressed: () {
                    Nav.replace(context, const Dashboardpage());
                  },
                ),
                SizedBox(
                  width: 8,
                ),
                Text(
                  'Daftar Ruangan',
                  style: TextStyle(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ],
            ),
            SizedBox(
              height: 10,
            ),
            Expanded(
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
          ],
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
