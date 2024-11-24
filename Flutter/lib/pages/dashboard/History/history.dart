import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

void main() {
  runApp(const HistoryPage());
}

class HistoryPage extends StatelessWidget {
  const HistoryPage({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      debugShowCheckedModeBanner: false,
      home: History(),
    );
  }
}

class History extends StatefulWidget {
  const History({super.key});

  @override
  State<History> createState() => _HistoryState();
}

class _HistoryState extends State<History> {
  List<dynamic> _allHistoryData = [];
  List<dynamic> _pagedHistoryData = [];
  bool _isLoading = true;
  int _page = 1;
  final int _pageSize = 10;
  int _totalPages = 1;

  @override
  void initState() {
    super.initState();
    _fetchHistoryData();
  }

  Future<void> _fetchHistoryData() async {
    const url = 'http://localhost/sipinjamfix/sipinjam/api/peminjaman/';
    try {
      final response = await http.get(Uri.parse(url));
      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        setState(() {
          _allHistoryData = data['data'] ?? [];
          _totalPages = (_allHistoryData.length / _pageSize).ceil();
          _loadPage();
          _isLoading = false;
        });
      } else {
        throw Exception('Failed to load data');
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
      _pagedHistoryData = _allHistoryData.sublist(
          startIndex,
          endIndex > _allHistoryData.length
              ? _allHistoryData.length
              : endIndex);
    });
  }

  void _goToPreviousPage() {
    if (_page > 1) {
      setState(() {
        _page--;
        _loadPage();
      });
    }
  }

  void _goToNextPage() {
    if (_page < _totalPages) {
      setState(() {
        _page++;
        _loadPage();
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          'History',
          style: TextStyle(fontWeight: FontWeight.bold),
        ),
        backgroundColor: Colors.transparent,
        elevation: 0,
      ),
      backgroundColor: Colors.grey[200],
      body: _isLoading
          ? const Center(child: CircularProgressIndicator())
          : _pagedHistoryData.isEmpty
              ? const Center(
                  child: Text(
                    'No data available',
                    style: TextStyle(fontSize: 18, color: Colors.grey),
                  ),
                )
              : Column(
                  children: [
                    Expanded(
                      child: ListView.builder(
                        padding: const EdgeInsets.all(10),
                        itemCount: _pagedHistoryData.length,
                        itemBuilder: (context, index) {
                          final item = _pagedHistoryData[index];
                          return _buildHistoryCard(
                            item['nama_status'] ?? 'Unknown',
                            _getStatusColor(item['nama_status'] ?? 'Unknown'),
                            item['tanggal_kegiatan'] ?? 'Unknown',
                            item['nama_kegiatan'] ?? 'Unknown',
                            item['nama_ruangan'] ?? 'Unknown',
                          );
                        },
                      ),
                    ),
                    _buildPaginationControls(),
                  ],
                ),
    );
  }

  Widget _buildPaginationControls() {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 10),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          IconButton(
            onPressed: _page > 1 ? _goToPreviousPage : null,
            icon: const Icon(Icons.arrow_back),
          ),
          Text('Halaman $_page dari $_totalPages'),
          IconButton(
            onPressed: _page < _totalPages ? _goToNextPage : null,
            icon: const Icon(Icons.arrow_forward),
          ),
        ],
      ),
    );
  }

  Color _getStatusColor(String status) {
    switch (status.toLowerCase()) {
      case 'disetujui':
        return Colors.green;
      case 'ditolak':
        return Colors.red;
      case 'proses':
        return Colors.yellow[700]!;
      default:
        return Colors.grey;
    }
  }

  Widget _buildHistoryCard(String status, Color statusColor, String date,
      String name, String location) {
    return Card(
      margin: const EdgeInsets.only(bottom: 10),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
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
                      color: statusColor),
                ),
              ],
            ),
            const SizedBox(height: 8),
            Text(
              name,
              style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 4),
            Text(
              location,
              style: const TextStyle(fontSize: 16, color: Colors.grey),
            ),
            const SizedBox(height: 12),
            Divider(color: Colors.grey[300]),
            const SizedBox(height: 8),
            Text(
              date,
              style: const TextStyle(fontSize: 16, color: Colors.grey),
            ),
          ],
        ),
      ),
    );
  }
}
