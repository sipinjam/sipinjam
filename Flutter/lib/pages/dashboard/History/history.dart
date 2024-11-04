import 'package:flutter/material.dart';

import '../../../config/widget.dart';

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
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(
          title: const Text(
            'Riwayat Aktivitas',
            style: TextStyle(fontWeight: FontWeight.bold),
          ),
        ),
        body: ListView(
          padding: const EdgeInsets.all(6),
          children: [
            // Each of these cards represents one booking item
            BookingCard(
              imageUrl: 'assets/images/gedungkuliah-terpadu.png',
              buildingName: 'Gedung Kuliah Terpadu',
              borrower: 'UKM ROHKRIS',
              date: '20 September 2024',
              status: 'Disetujui',
              statusColor: Colors.green,
            ),
            BookingCard(
              imageUrl: 'assets/images/gedungkuliah-terpadu.png',
              buildingName: 'Gedung Kuliah Terpadu',
              borrower: 'UKM ROHKRIS',
              date: '20 September 2024',
              status: 'Ditolak',
              statusColor: Colors.red,
            ),
            BookingCard(
              imageUrl: 'assets/images/gedungkuliah-terpadu.png',
              buildingName: 'Gedung Kuliah Terpadu',
              borrower: 'UKM ROHKRIS',
              date: '20 September 2024',
              status: 'Proses',
              statusColor: Colors.blue,
            ),
            BookingCard(
              imageUrl: 'assets/images/gedungkuliah-terpadu.png',
              buildingName: 'Gedung Kuliah Terpadu',
              borrower: 'UKM ROHKRIS',
              date: '20 September 2024',
              status: 'Disetujui',
              statusColor: Colors.green,
            ),
            BookingCard(
              imageUrl: 'assets/images/gedungkuliah-terpadu.png',
              buildingName: 'Gedung Kuliah Terpadu',
              borrower: 'UKM ROHKRIS',
              date: '20 September 2024',
              status: 'Disetujui',
              statusColor: Colors.green,
            ),
            BookingCard(
              imageUrl: 'assets/images/gedungkuliah-terpadu.png',
              buildingName: 'Gedung Kuliah Terpadu',
              borrower: 'UKM ROHKRIS',
              date: '20 September 2024',
              status: 'Disetujui',
              statusColor: Colors.green,
            ),
          ],
        ),
      ),
    );
  }
}
