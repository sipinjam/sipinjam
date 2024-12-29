import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/pages/dashboard/Home/detailRuangan.dart';
import 'dart:convert';
import '../../../config/nav.dart';
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
  String? _selectedRuangan;
  bool _isLoading = true;
  final int _page = 1;
  final int _pageSize = 10;
  final TextEditingController _searchController = TextEditingController();

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
        padding: const EdgeInsets.only(top: 25),
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
            const SizedBox(height: 4),
            // Search bar
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 10),
              child: SearchAnchor.bar(
                  barHintText: 'Cari Ruangan',
                  suggestionsBuilder: (context, controller) {
                    final String input = controller.value.text.toLowerCase();
                    final suggestions = _filteredRuanganData.where((ruangan) {
                      final label = ruangan.namaRuangan.toLowerCase();
                      return label.contains(input);
                    }).toList();
                    return suggestions.map((filteredItem) {
                      return ListTile(
                        title: Text(filteredItem.namaRuangan),
                        onTap: () {
                          setState(() {
                            _selectedRuangan = filteredItem.namaRuangan;
                            print(_selectedRuangan);
                            Nav.push(
                                context,
                                detailRuanganPage(
                                    ruanganId: filteredItem.idRuangan));
                          });
                        },
                      );
                    }).toList();
                  }),
            ),
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
                      : Container(
                          padding: const EdgeInsets.symmetric(horizontal: 10),
                          child: GridView.builder(
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
                                        child: ClipRRect(
                                          borderRadius:
                                              const BorderRadius.vertical(
                                                  top: Radius.circular(10)),
                                          child: Image.network(
                                            ruangan.fotoRuangan!.isNotEmpty
                                                ? ruangan.fotoRuangan!.first
                                                : 'default_image.png',
                                            fit: BoxFit.cover,
                                          ),
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
            ),
          ],
        ),
      ),
    );
  }
}
