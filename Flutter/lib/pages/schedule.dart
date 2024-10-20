import 'package:flutter/material.dart';
import 'package:table_calendar/table_calendar.dart';

class SchedulePage extends StatelessWidget {
  const SchedulePage({super.key});

  final List<Map<String, dynamic>> items = const [
    {"title": "GKT Lantai 1"},
    {"title": "GKT Lantai 2"},
    {"title": "UPT Bahasa Lantai 1"},
    {"title": "Ruang Seminar MST"},
    {"title": "Auditorium AB"},
    {"title": "Workshop Sipil"},
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Schedule',
          style: TextStyle(fontWeight: FontWeight.bold),
        ),
      ),
      body: Padding(
        padding:
            const EdgeInsets.all(16.0), // Memberi padding di seluruh sisi body
        child: Column(
          children: [
            Card(
              shape: RoundedRectangleBorder(
                borderRadius:
                    BorderRadius.circular(30), // Membulatkan sisi card
              ),
              elevation: 2, // Memberi efek bayangan
              margin: const EdgeInsets.only(top: 6), // Menambahkan margin atas
              child: Padding(
                padding: const EdgeInsets.symmetric(horizontal: 10),
                child: Column(
                  children: [
                    TextField(
                      decoration: InputDecoration(
                        hintText: 'Cari ruangan',
                        border: InputBorder.none,
                        icon: Icon(Icons.search, color: Colors.grey.shade600),
                      ),
                    ),
                    TableCalendar(
                        headerStyle: const HeaderStyle(
                            formatButtonVisible: false, titleCentered: true),
                        focusedDay: DateTime.now(),
                        firstDay: DateTime.utc(1978),
                        lastDay: DateTime.utc(9999)),
                  ],
                ),
              ),
            ),
            // Tambahkan konten body lainnya di sini, misalnya daftar ruangan, kalender, dll.
          ],
        ),
      ),
    );
  }
}
