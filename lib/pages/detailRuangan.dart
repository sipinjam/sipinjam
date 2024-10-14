import 'package:flutter/material.dart';

class detailRuanganPage extends StatelessWidget {
  const detailRuanganPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false,
        ),
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            // Card untuk gambar utama dan deskripsi gedung
            Card(
              elevation: 4,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(10),
              ),
              child: Stack(
                alignment: Alignment.bottomCenter,
                children: [
                  ClipRRect(
                    borderRadius: BorderRadius.circular(10),
                    child: Image.asset(
                      'assets/images/gedungkuliah-terpadu.png', // Gambar ruangan
                      height: 400,
                      width: double.infinity,
                      fit: BoxFit.cover,
                    ),
                  ),
                  Container(
                    width: double.infinity,
                    padding: const EdgeInsets.all(8.0),
                    decoration: BoxDecoration(
                      color: Colors.black.withOpacity(0.5),
                      borderRadius: const BorderRadius.only(
                        bottomLeft: Radius.circular(10),
                        bottomRight: Radius.circular(10),
                      ),
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: const [
                        Text(
                          'Gedung Kuliah Terpadu',
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        Text(
                          'Lantai 1',
                          style: TextStyle(
                            color: Colors.white70,
                            fontSize: 14,
                          ),
                        ),
                        Row(
                          children: [
                            Icon(Icons.people, color: Colors.white, size: 16),
                            SizedBox(width: 4),
                            Text(
                              '300',
                              style: TextStyle(color: Colors.white),
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),

            // Bagian untuk fasilitas
            Padding(
              padding: const EdgeInsets.symmetric(vertical: 16.0),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                children: const [
                  FacilityIcon(icon: Icons.wifi, label: 'WIFI'),
                  FacilityIcon(icon: Icons.ac_unit, label: 'AC'),
                  FacilityIcon(icon: Icons.chair, label: 'SEAT'),
                  FacilityIcon(icon: Icons.tv, label: 'LCD'),
                ],
              ),
            ),

            // GridView gambar gedung lainnya
            SizedBox(
              height: 125, // Ukuran lebih besar
              child: ListView.builder(
                scrollDirection: Axis.horizontal,
                itemCount: rooms.length,
                itemBuilder: (context, index) {
                  final room = rooms[index];
                  return Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 8.0),
                    child: ClipRRect(
                      borderRadius: BorderRadius.circular(10),
                      child: Image.asset(
                        room['image'], // Path gambar
                        width: 135, // Ukuran lebih besar
                        fit: BoxFit.cover,
                      ),
                    ),
                  );
                },
              ),
            ),

            const Spacer(),

            // Tombol Book Now
            ElevatedButton(
              onPressed: () {
                // Aksi ketika tombol ditekan
              },
              style: ElevatedButton.styleFrom(
                padding: const EdgeInsets.symmetric(horizontal: 50, vertical: 16),
                backgroundColor: Colors.blueAccent,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(20),
                ),
              ),
              child: const Text(
                'Book Now',
                style: TextStyle(
                  fontSize: 18,
                  color: Colors.white,
                  ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class FacilityIcon extends StatelessWidget {
  final IconData icon;
  final String label;

  const FacilityIcon({super.key, required this.icon, required this.label});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Icon(icon, size: 32),
        const SizedBox(height: 4),
        Text(label),
      ],
    );
  }
}

const List<Map<String, dynamic>> rooms = [
  {
    'image': 'assets/images/gedungkuliah-terpadu.png', // Ganti dengan gambar gedung 1
  },
  {
    'image': 'assets/images/gedungkuliah-terpadu.png', // Ganti dengan gambar gedung 2
  },
  {
    'image': 'assets/images/gedungkuliah-terpadu.png', // Ganti dengan gambar gedung 3
  },
];
