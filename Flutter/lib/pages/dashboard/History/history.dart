import 'package:flutter/material.dart';

import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/datasources/peminjaman_datasource.dart';
import 'package:sipit_app/models/peminjamanModel.dart';

void main() {
  runApp(const MaterialApp(
    debugShowCheckedModeBanner: false,
    home: HistoryPage(),
  ));
}

class HistoryPage extends StatelessWidget {
  const HistoryPage({super.key});

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
      body: History(),
    );
  }
}

class History extends StatefulWidget {
  const History({super.key});

  @override
  State<History> createState() => _HistoryState();
}

class _HistoryState extends State<History> {
  int _page = 1;
  // List<HistoryModel> _allHistoryData = [];
  final int _pageSize = 10;
  final PeminjamanDatasource _peminjamanDatasource = PeminjamanDatasource();
  List<PeminjamanModel?> _peminjamanData = [];

  @override
  void initState() {
    super.initState();
    _fetchHistoryData();
  }

  Future<void> _fetchHistoryData() async {
    try {
      final user = await AppSession.getPeminjam();
      final history =
          await _peminjamanDatasource.getPeminjamanByIdOrmawa(user!.idOrmawa);
      setState(() {
        _peminjamanData = history;
      });
    } catch (e) {
      print(e);
    }
  }

  @override
  Widget build(BuildContext context) {
    final totalPages = (_peminjamanData.length / _pageSize).ceil();
    final displayedData =
        _peminjamanData.skip((_page - 1) * _pageSize).take(_pageSize).toList();
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
      body: _peminjamanData.isEmpty
          ? const Center(child: Text('tidak ada kegiatan peminjaman'))
          : Column(
              children: [
                Expanded(
                  child: ListView.builder(
                    padding: const EdgeInsets.all(10),
                    itemCount: displayedData.length,
                    itemBuilder: (context, index) {
                      final item = displayedData[index];
                      return _buildHistoryCard(
                        item!.namaStatus,
                        _getStatusColor(item.namaStatus),
                        item.tglPeminjaman.toLocal().toString().split(' ')[0],
                        item.namaKegiatan,
                        item.namaRuangan,
                        _displaySesi(item.sesiPeminjaman),
                      );
                    },
                  ),
                ),
                _buildPaginationControls(totalPages),
              ],
            ),
    );
  }

  Widget _buildPaginationControls(int totalPages) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 10),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          IconButton(
            onPressed: _page > 1
                ? () {
                    setState(() {
                      _page--;
                    });
                  }
                : null,
            icon: const Icon(Icons.arrow_back),
          ),
          Text('Halaman $_page dari $totalPages'),
          IconButton(
            onPressed: _page < totalPages
                ? () {
                    setState(() {
                      _page++;
                    });
                  }
                : null,
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

  Widget _buildHistoryCard(String status, Color statusColor, String date,
      String name, String location, String sesi) {
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
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  date,
                  style: const TextStyle(fontSize: 16, color: Colors.grey),
                ),
                Text(sesi),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
