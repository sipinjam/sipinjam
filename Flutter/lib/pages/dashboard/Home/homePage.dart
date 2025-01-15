import 'dart:async';

import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/datasources/gedung_datasource.dart';
import 'package:sipit_app/datasources/peminjaman_datasource.dart';
import 'package:sipit_app/datasources/ruangan_datasource.dart';
import 'package:sipit_app/models/daftarRuanganModel.dart';
import 'package:sipit_app/models/gedungModel.dart';
import 'package:sipit_app/pages/dashboard/Home/daftarRuangan.dart';
import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/models/peminjamanModel.dart';
import 'package:intl/intl.dart';
import 'package:sipit_app/pages/dashboard/Home/detailRuangan.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  final GedungDatasource _gedungDatasource = GedungDatasource();
  final RuanganDatasource _ruanganDatasource = RuanganDatasource();
  final PeminjamanDatasource _peminjamanDatasource = PeminjamanDatasource();

  List<GedungModel> _gedungs = [];
  List<DaftarRuanganModel> _ruangans = [];
  Future<List<PeminjamanModel>>? bookingsFuture;
  String? selectedRuangan;

  bool _isDisposed = false;

  @override
  void initState() {
    super.initState();
    fetchGedungs();
    fetchRuanganAPI();
    bookingsFuture = _fetchBookings();
  }

  @override
  void dispose() {
    _isDisposed = true;
    super.dispose();
  }

  Future<void> fetchGedungs() async {
    try {
      final gedungs = await _gedungDatasource.fetchGedungList();
      if (!_isDisposed) {
        setState(() {
          _gedungs = gedungs;
        });
      }
    } catch (e) {
      debugPrint('Error fetching gedungs: $e');
    }
  }

  Future<void> fetchRuanganAPI() async {
    try {
      final ruangans = await _ruanganDatasource.fetchRuanganNonRequired();
      if (!_isDisposed) {
        setState(() {
          _ruangans = ruangans;
        });
      }
    } catch (e) {
      debugPrint('Error fetching ruangans: $e');
    }
  }

  Future<List<PeminjamanModel>> _fetchBookings() async {
    try {
      final user = await AppSession.getPeminjam();
      if (user == null) throw Exception('User not found');

      final bookings =
          await _peminjamanDatasource.getPeminjamanByIdOrmawa(user.idOrmawa);
      final today = DateTime.now();

      return bookings.where((booking) {
        final tglPeminjaman = DateTime.tryParse('${booking.tglPeminjaman}');
        return booking.namaStatus != 'ditolak' &&
            tglPeminjaman != null &&
            tglPeminjaman.isAfter(today);
      })
          // .map((json) => PeminjamanModel.fromJson(json))
          .toList();
    } catch (e) {
      debugPrint('Error fetching bookings: $e');
      return [];
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Column(
          children: [
            Padding(
              padding: const EdgeInsets.fromLTRB(10, 40, 10, 10),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Search bar
                  SearchAnchor.bar(
                    barHintText: 'Cari Ruangan',
                    suggestionsBuilder: (context, controller) {
                      final String input = controller.value.text.toLowerCase();
                      final suggestions = _ruangans.where((ruangan) {
                        return ruangan.namaRuangan
                            .toLowerCase()
                            .contains(input);
                      }).toList();
                      return suggestions.map((filteredItem) {
                        return ListTile(
                          title: Text(filteredItem.namaRuangan),
                          onTap: () {
                            setState(() {
                              selectedRuangan = filteredItem.namaRuangan;
                              Nav.push(
                                  context,
                                  detailRuanganPage(
                                      ruanganId: filteredItem.idRuangan));
                            });
                          },
                        );
                      }).toList();
                    },
                  ),
                  const SizedBox(height: 10),

                  // Daftar gedung
                  SizedBox(
                    height: 220,
                    child: ListView.builder(
                      scrollDirection: Axis.horizontal,
                      itemCount: _gedungs.length,
                      itemBuilder: (context, index) {
                        final gedung = _gedungs[index];
                        String imageUrl =
                            '${AppConstants.apiUrl}${gedung.fotoGedung.replaceAll("../../../api/", "/")}';
                        return GedungCard(
                          imageUrl: imageUrl,
                          buildingName: gedung.namaGedung,
                          buildingId: gedung.idGedung,
                        );
                      },
                    ),
                  ),
                  const SizedBox(height: 10),

                  const Text(
                    'Ruangan Yang Dipinjam',
                    style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                  ),

                  const SizedBox(height: 10),

                  // Daftar ruangan
                  FutureBuilder<List<PeminjamanModel>?>(
                    future: bookingsFuture,
                    builder: (context, snapshot) {
                      if (snapshot.connectionState == ConnectionState.waiting) {
                        return const Center(child: CircularProgressIndicator());
                      } else if (snapshot.hasError) {
                        return Center(child: Text('Error: ${snapshot.error}'));
                      } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                        return const Center(
                            child: Text('Tidak ada peminjaman yang tersedia.'));
                      } else {
                        final bookings = snapshot.data!;
                        print(bookings);
                        return ListView.builder(
                          padding: const EdgeInsets.all(0),
                          shrinkWrap: true,
                          physics: const NeverScrollableScrollPhysics(),
                          itemCount: bookings.length,
                          itemBuilder: (context, index) {
                            final booking = bookings[index];
                            return BookingCard(
                              buildingName: booking.namaRuangan,
                              activityName: booking.namaKegiatan,
                              date: DateFormat('yyyy-MM-dd')
                                  .format(booking.tglPeminjaman),
                              status: booking.namaStatus,
                              sesi: booking.sesiPeminjaman,
                            );
                          },
                        );
                      }
                    },
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
      margin: const EdgeInsets.only(bottom: 8),
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
                  borderRadius:
                      const BorderRadius.vertical(top: Radius.circular(8)),
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
