import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/config/widget.dart';
import 'package:sipit_app/pages/dashboard/Home/daftarRuangan.dart';
import 'package:sipit_app/theme.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/models/peminjamanModel.dart';
import 'package:intl/intl.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List<Map<String, dynamic>> gedungList = [];
  List<PeminjamanModel> bookingList = [];
  TextEditingController searchController = TextEditingController();

  @override
  void initState() {
    super.initState();
    fetchGedungs();
    fetchBookings();
  }

  Future<void> fetchGedungs() async {
    final response =
        await http.get(Uri.parse('${AppConstants.baseUrl}/gedung.php'));
    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      if (data['status'] == 'success') {
        setState(() {
          gedungList = List<Map<String, dynamic>>.from(data['data']);
        });
      }
    }
  }

  Future<void> fetchBookings() async {
    const baseUrl = '${AppConstants.baseUrl}/peminjaman.php/';
    try {
      final peminjamData = await AppSession.getPeminjam();
      if (peminjamData == null || peminjamData.namaPeminjam.isEmpty) {
        throw Exception('Data peminjam tidak ditemukan.');
      }

      final idPeminjamLogin =
          peminjamData.idPeminjam; // Nama peminjam yang login
      final url =
          '$baseUrl?id_peminjam=$idPeminjamLogin'; // Filter berdasarkan nama

      final response = await http.get(Uri.parse(url));

      if (response.statusCode == 200) {
        final data = json.decode(response.body);

        // Filter data yang sesuai dengan nama peminjam yang login
        final filteredData = (data['data'] as List)
            .map((json) => PeminjamanModel.fromJson(json))
            .where((item) => item.idPeminjam == idPeminjamLogin)
            .toList();

        setState(() {
          bookingList = filteredData;
        });
      } else {
        throw Exception(
            'Gagal memuat data. Kode status: ${response.statusCode}');
      }
    } catch (e) {
      print('Error fetching data: $e');
      setState(() {
        bookingList = [];
      });
    }
  }

  List<PeminjamanModel> getFilteredBookings() {
    DateTime now = DateTime.now();
    return bookingList.where((PeminjamanModel booking) {
      return (booking.namaStatus == 'proses' ||
              booking.namaStatus == 'disetujui') &&
          now.isBefore(booking.tglPeminjaman.add(const Duration(days: 1)));
    }).toList();
  }

  Future<void> searchRooms(String keyword) async {
    final response =
        await http.get(Uri.parse('${AppConstants.baseUrl}/ruangan.php'));
    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      if (data['status'] == 'success') {
        List<Map<String, dynamic>> ruanganList =
            List<Map<String, dynamic>>.from(data['data']);

        // Filter berdasarkan nama gedung atau nama ruangan
        List<Map<String, dynamic>> filteredRooms = ruanganList.where((room) {
          return room['nama_gedung']
                  .toLowerCase()
                  .contains(keyword.toLowerCase()) ||
              room['nama_ruangan']
                  .toLowerCase()
                  .contains(keyword.toLowerCase());
        }).toList();

        if (filteredRooms.isNotEmpty) {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) =>
                  DaftarRuanganPage(buildingId: filteredRooms),
            ),
          );
        } else {
          // Jika tidak ada hasil
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(content: Text('Tidak ditemukan hasil')),
          );
        }
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: ListView(
        children: [
          Padding(
            padding: const EdgeInsets.all(10),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                //Search Bar
                Card(
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(30),
                  ),
                  elevation: 2,
                  child: Row(
                    children: [
                      Expanded(
                        child: Padding(
                          padding: const EdgeInsets.symmetric(horizontal: 10),
                          child: TextField(
                            controller: searchController,
                            decoration: const InputDecoration(
                              hintText: 'Cari ruangan',
                              border: InputBorder.none,
                            ),
                            onSubmitted: (keyword) {
                              // Ketika pengguna menekan Enter
                              keyword = keyword.trim();
                              if (keyword.isNotEmpty) {
                                searchRooms(
                                    keyword); // Memanggil fungsi searchRooms
                                searchController
                                    .clear(); // Menghapus teks setelah pencarian
                              } else {
                                ScaffoldMessenger.of(context).showSnackBar(
                                  const SnackBar(
                                      content: Text(
                                          'Masukkan kata kunci pencarian')),
                                );
                              }
                            },
                          ),
                        ),
                      ),
                      IconButton(
                        icon: Icon(Icons.search, color: Colors.grey.shade600),
                        onPressed: () {
                          String keyword = searchController.text.trim();
                          if (keyword.isNotEmpty) {
                            searchRooms(
                                keyword); // Memanggil fungsi searchRooms
                            searchController
                                .clear(); // Menghapus teks setelah pencarian
                          } else {
                            ScaffoldMessenger.of(context).showSnackBar(
                              const SnackBar(
                                  content:
                                      Text('Masukkan kata kunci pencarian')),
                            );
                          }
                        },
                      ),
                    ],
                  ),
                ),

                // DAFTAR GEDUNG
                SizedBox(
                  height: 220, // Tinggi kontainer untuk daftar gedung
                  child: ListView.builder(
                    scrollDirection: Axis.horizontal,
                    itemCount: gedungList.length,
                    itemBuilder: (context, index) {
                      final gedung = gedungList[index];
                      String imageUrl =
                          '${AppConstants.apiUrl}/assets/gedung/${gedung['foto_gedung'].split('/').last}';
                      return GedungCard(
                        imageUrl: imageUrl,
                        buildingName: gedung['nama_gedung'],
                        buildingId: gedung['id_gedung'],
                      );
                    },
                  ),
                ),
                const SizedBox(height: 10),

                // DAFTAR RUANGAN
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Text(
                      "RUANGAN YANG DIPINJAM",
                      style:
                          TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                    ),
                    const SizedBox(height: 10),
                    // Kondisi untuk memeriksa apakah daftar peminjaman kosong
                    if (getFilteredBookings().isEmpty)
                      const Center(
                        child: Text(
                          "Tidak ada data peminjaman",
                          style: TextStyle(fontSize: 14),
                        ),
                      )
                    else
                      for (final booking in getFilteredBookings())
                        BookingCard(
                          buildingName: booking.namaRuangan,
                          activityName: booking.namaKegiatan,
                          date: DateFormat('yyyy-MM-dd')
                              .format(booking.tglPeminjaman),
                          status: booking.namaStatus,
                          sesi: booking.sesiPeminjaman,
                        ),
                  ],
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class BookingCard extends StatelessWidget {
  final String buildingName;
  final String activityName;
  final String date;
  final String status;
  final String sesi;

  const BookingCard({
    required this.buildingName,
    required this.activityName,
    required this.date,
    required this.status,
    required this.sesi,
    super.key,
  });

  Color _getStatusColor(String status) {
    switch (status.toLowerCase()) {
      case 'proses':
        return Colors.orange;
      case 'disetujui':
        return Colors.green;
      default:
        return Colors.grey;
    }
  }

  String _displaySesi(String sesi) {
    switch (sesi) {
      case '1':
        return 'Pagi';
      case '2':
        return 'Siang';
      case '3':
        return 'Full Sesi';
      default:
        return '';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: const EdgeInsets.symmetric(vertical: 8),
      elevation: 4,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12),
      ),
      child: Padding(
        padding: const EdgeInsets.all(12),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                const Text(
                  'Peminjaman',
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                ),
                Text(
                  status,
                  style: TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                      color: _getStatusColor(status)),
                ),
              ],
            ),
            const SizedBox(height: 8),
            Text(
              buildingName,
              style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 4),
            Text(
              activityName,
              style: const TextStyle(fontSize: 16, color: Colors.grey),
            ),
            const SizedBox(height: 12),
            Divider(color: Colors.grey[300]),
            const SizedBox(height: 8),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  date,
                  style: const TextStyle(fontSize: 16, color: Colors.grey),
                ),
                Text(_displaySesi(sesi)),
              ],
            ),
          ],
        ),
      ),
    );
  }
}

class GedungCard extends StatelessWidget {
  final String imageUrl;
  final String buildingName;
  final int buildingId; // Tambahkan ID gedung

  const GedungCard({
    required this.imageUrl,
    required this.buildingName,
    required this.buildingId, // Tambahkan parameter ini
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      width: 200,
      height: 200,
      child: InkWell(
        onTap: () {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => DaftarRuanganPage(
                buildingId: buildingId,
              ),
            ),
          );
        },
        child: Card(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Container(
                width: 200,
                height: 170,
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(8),
                  image: DecorationImage(
                    image: NetworkImage(imageUrl),
                    fit: BoxFit.cover,
                  ),
                ),
              ),
              const SizedBox(height: 10),
              Text(
                buildingName,
                textAlign: TextAlign.center,
                style: const TextStyle(fontSize: 15),
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
