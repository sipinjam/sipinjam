import 'package:flutter/material.dart';

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
          title: Text(
            'Riwayat Aktivitas',
            style: TextStyle(fontWeight: FontWeight.bold),
          ),
          elevation: 8,
          shadowColor: Colors.black,
        ),
        body: ListView(
          padding: EdgeInsets.all(6),
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

class BookingCard extends StatelessWidget {
  final String imageUrl;
  final String buildingName;
  final String borrower;
  final String date;
  final String status;
  final Color statusColor;

  BookingCard({
    required this.imageUrl,
    required this.buildingName,
    required this.borrower,
    required this.date,
    required this.status,
    required this.statusColor,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 5,
      shadowColor: Colors.black,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(16),
      ),
      margin: EdgeInsets.only(bottom: 5),
      child: Row(
        children: [
          ClipRRect(
            borderRadius: BorderRadius.circular(8),
            child: Image.network(
              imageUrl,
              width: 100,
              height: 120,
              fit: BoxFit.cover,
            ),
          ),
          Expanded(
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    buildingName,
                    style: TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  SizedBox(height: 8),
                  Text('Peminjam:'),
                  SizedBox(height: 3),
                  Text(
                    '$borrower',
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          SizedBox(height: 10),
                          Text('Tanggal Pinjam:'),
                          SizedBox(height: 3),
                          Text(
                            '$date',
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          SizedBox(height: 8),
                        ],
                      ),
                      Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            SizedBox(height: 10),
                            Text(
                              'Status: ',
                              style: TextStyle(fontWeight: FontWeight.bold),
                            ),
                            SizedBox(height: 3),
                            Text(
                              status,
                              style: TextStyle(
                                color: statusColor,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          ]),
                    ],
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
