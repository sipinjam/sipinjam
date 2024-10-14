import 'package:flutter/material.dart';

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
        title: const Text('Daftar Ruangan'),
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
            return Card(
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
                            fontSize: 16,
                          ),
                        ),
                        const SizedBox(height: 5),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            const Icon(Icons.people, size: 18),
                            const SizedBox(width: 5),
                            Text(
                              '${item['capacity']}',
                              style: const TextStyle(fontSize: 14),
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                ],
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
