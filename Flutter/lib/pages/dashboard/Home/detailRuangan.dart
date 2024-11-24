import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/pages/dashboardPage.dart';
import 'package:sipit_app/pages/dashboard/Home/peminjaman.dart';
import 'package:sipit_app/config/widget.dart';
import 'package:http/http.dart' as http;
import 'package:sipit_app/models/ruanganModel.dart';
import 'dart:convert';

class detailRuanganPage extends StatefulWidget {
  final int ruanganId;

  const detailRuanganPage({super.key, required this.ruanganId});

  @override
  _detailRuanganPageState createState() => _detailRuanganPageState();
}

class _detailRuanganPageState extends State<detailRuanganPage> {
  late Future<Ruangan> futureRuangan;
  String? selectedImage;

  @override
  void initState() {
    super.initState();
    futureRuangan = fetchRuangan();
  }

  Future<Ruangan> fetchRuangan() async {
    final response = await http.get(Uri.parse(
        'http://localhost/sipinjamfix/sipinjam/api/ruangan/${widget.ruanganId}'));

    if (response.statusCode == 200) {
      final ruanganModel = ruanganModelFromJson(response.body);
      return ruanganModel.data; // Return the Ruangan object directly
    } else {
      throw Exception('Failed to load ruangan');
    }
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
              const SizedBox(width: 8),
              const Text(
                'Detail Ruangan',
                style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
              ),
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
                  selectedImage ??= ruangan.fotoRuangan[0]; // Set default image
                  return SingleChildScrollView(
                    child: Padding(
                      padding: const EdgeInsets.fromLTRB(10, 5, 10, 10),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          // Card for main image and building description
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
                                    selectedImage!,
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
                                          Icon(Icons.people, color: Colors.white, size: 16),
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

                          // Section for facilities
                          Padding(
                            padding: EdgeInsets.symmetric(vertical: 16.0),
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                              children: (ruangan.namaFasilitas?.split(', ') ?? []).map((fasilitas) {
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
                              }).toList(),
                            ),
                          ),

                          // GridView for other building images
                          SizedBox(
                            height: 125,
                            child: ListView.builder(
                              scrollDirection: Axis.horizontal,
                              itemCount: ruangan.fotoRuangan.length,
                              itemBuilder: (context, index) {
                                final foto = ruangan.fotoRuangan[index];
                                return GestureDetector(
                                  onTap: () {
                                    setState(() {
                                      selectedImage = foto;
                                    });
                                  },
                                  child: Padding(
                                    padding: const EdgeInsets.symmetric(horizontal: 8.0),
                                    child: ClipRRect(
                                      borderRadius: BorderRadius.circular(10),
                                      child: Image.network(
                                        foto,
                                        width: 135,
                                        fit: BoxFit.cover,
                                      ),
                                    ),
                                  ),
                                );
                              },
                            ),
                          ),

                          const SizedBox(height: 20),

                          // Book Now button
                          SizedBox(
                            width: MediaQuery.of(context).size.width,
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