import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/pages/dashboardPage.dart';
import 'package:sipit_app/pages/dashboard/Home/peminjaman.dart';
import 'package:sipit_app/config/widget.dart';
import 'package:sipit_app/datasources/ruangan_datasource.dart';
import 'package:sipit_app/models/ruanganModel.dart';

class detailRuanganPage extends StatefulWidget {
  const detailRuanganPage({super.key});

  @override
  _detailRuanganPageState createState() => _detailRuanganPageState();
}

class _detailRuanganPageState extends State<detailRuanganPage> {
  late Future<Ruangan> futureRuangan;

  @override
  void initState() {
    super.initState();
    futureRuangan = fetchRuangan();
  }

  Future<Ruangan> fetchRuangan() async {
    final ruanganService = RuanganService();
    return await ruanganService.getRuanganById(1);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        children: [
          Row(
            children: [
              IconButton(
                  onPressed: () {
                    Nav.replace(context, const Dashboardpage());
                  },
                  icon: const Icon(
                    Icons.keyboard_arrow_left_rounded,
                    size: 25,
                  )),
              const SizedBox(
                width: 8,
              ),
              const Text(
                'Detail Ruangan',
                style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
              )
            ],
          ),
          Expanded(
            child: FutureBuilder<Ruangan>(
              future: futureRuangan,
              builder: (context, snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return Center(child: CircularProgressIndicator());
                } else if (snapshot.hasError) {
                  return Center(child: Text('Error: ${snapshot.error}'));
                } else if (snapshot.hasData) {
                  final ruangan = snapshot.data!;
                  return SingleChildScrollView(
                    child: Padding(
                      padding: const EdgeInsets.fromLTRB(10, 5, 10, 10),
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
                                  child: Image.network(
                                    ruangan.fotoRuangan[0], // Gambar ruangan
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
                                    children: [
                                      Text(
                                        ruangan.namaGedung,
                                        style: TextStyle(
                                          color: Colors.white,
                                          fontSize: 18,
                                          fontWeight: FontWeight.bold,
                                        ),
                                      ),
                                      Text(
                                        ruangan.namaRuangan,
                                        style: TextStyle(
                                          color: Colors.white70,
                                          fontSize: 14,
                                        ),
                                      ),
                                      Row(
                                        children: [
                                          Icon(Icons.people,
                                              color: Colors.white, size: 16),
                                          SizedBox(width: 4),
                                          Text(
                                            '${ruangan.kapasitas}',
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
                            padding: EdgeInsets.symmetric(vertical: 16.0),
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                              children: ruangan.namaFasilitas?.split(', ').map((fasilitas) {
                                IconData icon;
                                switch (fasilitas.toLowerCase()) {
                                  case 'wifi':
                                    icon = Icons.wifi;
                                    break;
                                  case 'ac':
                                    icon = Icons.ac_unit;
                                    break;
                                  case 'seat':
                                    icon = Icons.chair;
                                    break;
                                  case 'lcd':
                                    icon = Icons.tv;
                                    break;
                                  default:
                                    icon = Icons.device_unknown;
                                }
                                return FacilityIcon(icon: icon, label: fasilitas.toUpperCase());
                              }).toList() ?? [],
                            ),
                          ),

                          // GridView gambar gedung lainnya
                          SizedBox(
                            height: 125, // Ukuran lebih besar
                            child: ListView.builder(
                              scrollDirection: Axis.horizontal,
                              itemCount: ruangan.fotoRuangan.length,
                              itemBuilder: (context, index) {
                                final foto = ruangan.fotoRuangan[index];
                                return Padding(
                                  padding: const EdgeInsets.symmetric(horizontal: 8.0),
                                  child: ClipRRect(
                                    borderRadius: BorderRadius.circular(10),
                                    child: Image.network(
                                      foto, // Path gambar
                                      width: 135, // Ukuran lebih besar
                                      fit: BoxFit.cover,
                                    ),
                                  ),
                                );
                              },
                            ),
                          ),

                          const SizedBox(height: 20), // Spacer untuk memberi jarak

                          // Tombol Book Now
                          SizedBox(
                            width: MediaQuery.sizeOf(context).width,
                            height: 50,
                            child: ElevatedButton(
                              onPressed: () {
                                Nav.push(context, peminjamanPage());
                              },
                              style: ElevatedButton.styleFrom(
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
                          ),
                        ],
                      ),
                    ),
                  );
                } else {
                  return Center(child: Text('No data found'));
                }
              },
            ),
          ),
        ],
      ),
    );
  }
}