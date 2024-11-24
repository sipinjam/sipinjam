import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:sipit_app/pages/dashboard/Home/detailRuangan.dart';
import 'dart:convert';
import '../../../models/daftarRuanganModel.dart';

void main() {
  runApp(const MaterialApp(debugShowCheckedModeBanner: false));
}

class DaftarRuanganPage extends StatefulWidget {
  final int buildingId; // Tambahkan parameter ini

  const DaftarRuanganPage({super.key, required this.buildingId});

  @override
  State<DaftarRuanganPage> createState() => _DaftarRuanganPageState();
}

class _DaftarRuanganPageState extends State<DaftarRuanganPage> {
  List<daftarRuanganModel> _allRuanganData = [];
  List<daftarRuanganModel> _filteredRuanganData = [];
  bool _isLoading = true;
  int _page = 1;
  final int _pageSize = 10;

  @override
  void initState() {
    super.initState();
    _fetchRuanganData();
  }

  Future<void> _fetchRuanganData() async {
    // Ambil semua data ruangan
    const url = 'http://localhost/sipinjamfix/sipinjam/api/ruangan/';
    try {
      final response = await http.get(Uri.parse(url));
      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        setState(() {
          _allRuanganData = (data['data'] as List<dynamic>).map((item) {
            // Ubah URL gambar di sini
            if (item['foto_ruangan'] != null) {
              item['foto_ruangan'] = item['foto_ruangan']
                  .map((photo) =>
                      'http://localhost/sipinjamfix/sipinjam/api/assets/ruangan/${photo.split('/').last}')
                  .toList();
            }
            return daftarRuanganModel.fromJson(item);
          }).toList();

          // Filter ruangan berdasarkan buildingId
          _filteredRuanganData = _allRuanganData
              .where((ruangan) => ruangan.buildingId == widget.buildingId)
              .toList();

          _loadPage();
          _isLoading = false;
        });
      } else {
        throw Exception('Failed to load ruangan data');
      }
    } catch (e) {
      setState(() {
        _isLoading = false;
      });
      print('Error: $e');
    }
  }

  void _loadPage() {
    int startIndex = (_page - 1) * _pageSize;
    int endIndex = startIndex + _pageSize;
    setState(() {
      _filteredRuanganData = _filteredRuanganData.sublist(
        startIndex,
        endIndex > _filteredRuanganData.length
            ? _filteredRuanganData.length
            : endIndex,
      );
    });
  }

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
                    Navigator.pop(context);
                  },
                ),
                const SizedBox(width: 8),
                const Text(
                  'Daftar Ruangan',
                  style: TextStyle(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ],
            ),
            const SizedBox(height: 10),
            Expanded(
              child: _isLoading
                  ? const Center(child: CircularProgressIndicator())
                  : _filteredRuanganData.isEmpty
                      ? const Center(
                          child: Text(
                            'No data available',
                            style: TextStyle(fontSize: 18, color: Colors.grey),
                          ),
                        )
                      : GridView.builder(
                          itemCount: _filteredRuanganData.length,
                          gridDelegate:
                              const SliverGridDelegateWithFixedCrossAxisCount(
                            crossAxisCount: 2, // Jumlah kolom dalam grid
                            childAspectRatio: 0.75, // Rasio aspek item
                          ),
                          itemBuilder: (context, index) {
                            final ruangan = _filteredRuanganData[index];
                            return InkWell(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => detailRuanganPage(
                                        ruanganId:
                                            ruangan.id), // Kirim ID ruangan
                                  ),
                                );
                              },
                              child: Card(
                                elevation: 2,
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(10),
                                ),
                                child: Column(
                                  children: [
                                    Expanded(
                                      child: Image.network(
                                        '${ruangan.photos.isNotEmpty ? ruangan.photos.first : 'default_image.png'}',
                                        fit: BoxFit.cover,
                                      ),
                                    ),
                                    Padding(
                                      padding: const EdgeInsets.all(8.0),
                                      child: Column(
                                        children: [
                                          Text(
                                            ruangan.name,
                                            style: const TextStyle(
                                              fontWeight: FontWeight.bold,
                                              fontSize: 12,
                                            ),
                                          ),
                                          const SizedBox(height: 3),
                                          Row(
                                            mainAxisAlignment:
                                                MainAxisAlignment.center,
                                            children: [
                                              const Icon(Icons.people,
                                                  size: 18),
                                              const SizedBox(width: 3),
                                              Text(
                                                '${ruangan.capacity}',
                                                style: const TextStyle(
                                                    fontSize: 10),
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

class DetailRuanganPage extends StatelessWidget {
  final daftarRuanganModel ruangan;

  const DetailRuanganPage({super.key, required this.ruangan});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(ruangan.name),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text('Nama Ruangan: ${ruangan.name}'),
            Text('Kapasitas: ${ruangan.capacity}'),
            if (ruangan.photos.isNotEmpty)
              Image.network(
                '${ruangan.photos.first}',
                fit: BoxFit.cover,
              ),
          ],
        ),
      ),
    );
  }
}
