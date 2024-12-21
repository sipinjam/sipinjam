import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/pages/dashboard/Home/detailRuangan.dart';
import 'dart:convert';
import '../../../models/daftarRuanganModel.dart';

void main() {
  runApp(const MaterialApp(debugShowCheckedModeBanner: false));
}

class DaftarRuanganPage extends StatefulWidget {
  final dynamic buildingId; // Tambahkan parameter ini

  const DaftarRuanganPage({super.key, required this.buildingId});

  @override
  State<DaftarRuanganPage> createState() => _DaftarRuanganPageState();
}

class _DaftarRuanganPageState extends State<DaftarRuanganPage> {
  List<DaftarRuanganModel> _allRuanganData = [];
  List<DaftarRuanganModel> _filteredRuanganData = [];
  bool _isLoading = true;
  int _page = 1;
  final int _pageSize = 10;
  TextEditingController _searchController = TextEditingController();

  @override
  void initState() {
    super.initState();
    _fetchRuanganData();
    _searchController.addListener(_filterRuanganData);
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

  Future<void> _fetchRuanganData() async {
    const url = '${AppConstants.baseUrl}/ruangan.php/';
    try {
      final response = await http.get(
        Uri.parse(url),
        headers: {"Content-Type": "application/json"},
      );
      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        setState(() {
          _allRuanganData = (data['data'] as List<dynamic>).map((item) {
            if (item['foto_ruangan'] != null) {
              item['foto_ruangan'] = item['foto_ruangan']
                  .map((photo) =>
                      '${AppConstants.apiUrl}/assets/ruangan/${photo.split('/').last}')
                  .toList();
            }
            return DaftarRuanganModel.fromJson(item);
          }).toList();

          _filteredRuanganData = _allRuanganData
              .where((ruangan) => ruangan.idGedung == widget.buildingId)
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

  void _filterRuanganData() {
    String searchQuery = _searchController.text.toLowerCase();
    setState(() {
      _filteredRuanganData = _allRuanganData.where((ruangan) {
        bool matchesKeyword = searchQuery.isNotEmpty;
        if (matchesKeyword) {
          if (searchQuery.contains(' ')) {
            List<String> keywords = searchQuery.split(' ');
            return keywords.any((keyword) =>
                ruangan.namaRuangan.toLowerCase().contains(keyword) ||
                ruangan.namaGedung.toLowerCase().contains(keyword));
          } else {
            return ruangan.namaRuangan.toLowerCase().contains(searchQuery) ||
                ruangan.namaGedung.toLowerCase().contains(searchQuery);
          }
        }
        return false;
      }).toList();
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
            // Search bar
            TextField(
              controller: _searchController,
              decoration: InputDecoration(
                hintText: 'Cari ruangan...',
                prefixIcon: Icon(Icons.search),
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.circular(8),
                ),
              ),
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
                            crossAxisCount: 2,
                            childAspectRatio: 0.75,
                          ),
                          itemBuilder: (context, index) {
                            final ruangan = _filteredRuanganData[index];
                            return InkWell(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => detailRuanganPage(
                                        ruanganId: ruangan.idRuangan),
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
                                        '${ruangan.fotoRuangan!.isNotEmpty ? ruangan.fotoRuangan!.first : 'default_image.png'}',
                                        fit: BoxFit.cover,
                                      ),
                                    ),
                                    Padding(
                                      padding: const EdgeInsets.all(8.0),
                                      child: Column(
                                        children: [
                                          Text(
                                            ruangan.namaRuangan,
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
                                                '${ruangan.kapasitas}',
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


// class DetailRuanganPage extends StatelessWidget {
//   final daftarRuanganModel ruangan;

//   const DetailRuanganPage({super.key, required this.ruangan});

//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       appBar: AppBar(
//         title: Text(ruangan.namaRuangan),
//       ),
//       body: Center(
//         child: Column(
//           mainAxisAlignment: MainAxisAlignment.center,
//           children: [
//             Text('Nama Ruangan: ${ruangan.namaRuangan}'),
//             Text('Kapasitas: ${ruangan.kapasitas}'),
//             if (ruangan.fotoRuangan!.isNotEmpty)
//               Image.network(
//                 '${ruangan.fotoRuangan!.first}',
//                 fit: BoxFit.cover,
//               ),
//           ],
//         ),
//       ),
//     );
//   }
// }
