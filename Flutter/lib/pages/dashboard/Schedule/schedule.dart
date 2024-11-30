import 'package:d_button/d_button.dart';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/datasources/gedung_datasource.dart';
import 'package:sipit_app/datasources/peminjaman_datasource.dart';
import 'package:sipit_app/models/gedungModel.dart';
import 'package:sipit_app/pages/dashboard/Home/peminjaman.dart';
import 'package:sipit_app/theme.dart';
import 'package:table_calendar/table_calendar.dart';

class SchedulePage extends StatefulWidget {
  const SchedulePage({super.key});

  @override
  State<SchedulePage> createState() => _SchedulePageState();
}

class _SchedulePageState extends State<SchedulePage> {
  DateTime _focusedDay = DateTime.now();
  Map<DateTime, List<Map<String, dynamic>>> _markedDates = {};
  final TextEditingController _searchController = TextEditingController();
  final PeminjamanDatasource _peminjamanDatasource = PeminjamanDatasource();
  bool _isLoading = false;
  final GedungDatasource _gedungDatasource = GedungDatasource();
  List<GedungModel> _gedungs = [];
  GedungModel? _selectedGedung;

  Future<void> fetchGedungs() async {
    try {
      final gedungs = await _gedungDatasource.fetchGedungList();
      setState(() {
        _gedungs = gedungs;
      });
    } catch (e) {
      print('Error: $e');
    }
  }

  Future<void> fetchAndSetMarkedDates(String roomName) async {
    setState(() {
      _isLoading = true;
    });
    try {
      final dates = await _peminjamanDatasource.fetchMarkedDates(roomName);
      setState(() {
        _markedDates = dates;
      });
    } catch (e) {
      print('Error fetching marked dates: $e');
    } finally {
      setState(() {
        _isLoading = false;
      });
    }
  }

  @override
  void initState() {
    super.initState();
    fetchAndSetMarkedDates('defaultRoom');
    fetchGedungs();
  }

  void _showEventDetails(
      DateTime date, List<Map<String, dynamic>> eventDetails) {
    showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Detail Kegiatan'),
            content: Container(
              width: 200,
              height: 100,
              child: PageView.builder(
                  itemCount: eventDetails.length,
                  itemBuilder: (context, index) {
                    final event = eventDetails[index];
                    return Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('Nama Kegiatan: ${event['nama_kegiatan']}'),
                        Text('Waktu: ${event['waktu']}'),
                        Text('Nama Ormawa: ${event['nama_ormawa']}'),
                        Text('Status: ${event['status']}'),
                      ],
                    );
                  }),
            ),
            actions: [
              TextButton(
                  onPressed: () {
                    Navigator.of(context).pop();
                  },
                  child: const Text('Tutup'))
            ],
          );
        });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Schedule',
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.bold,
              ),
            ),
            Container(
              decoration: BoxDecoration(
                borderRadius: BorderRadius.all(Radius.circular(12)),
                boxShadow: [
                  BoxShadow(
                    color: Colors.grey.shade500,
                    offset: Offset(4, 4),
                  )
                ],
                color: Colors.amber,
              ),
              child: DropdownButton<GedungModel>(
                  // padding: EdgeInsets.symmetric(horizontal: 16),
                  value: _selectedGedung,
                  hint: const Text('Pilih Gedung'),
                  isExpanded: true,
                  items: _gedungs.map((gedung) {
                    return DropdownMenuItem(
                      value: gedung,
                      child: Text(gedung.namaGedung),
                    );
                  }).toList(),
                  onChanged: (value) {
                    setState(() {
                      _selectedGedung = value;
                    });
                    print('Selected Gedung: ${value?.namaGedung}');
                  }),
            ),
            Card(
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(30),
              ),
              elevation: 2,
              margin: const EdgeInsets.only(top: 6),
              child: Padding(
                padding: const EdgeInsets.all(10),
                child: Column(
                  children: [
                    _isLoading
                        ? const CircularProgressIndicator()
                        : TableCalendar(
                            headerStyle: const HeaderStyle(
                              formatButtonVisible: false,
                              titleCentered: true,
                            ),
                            focusedDay: _focusedDay,
                            firstDay: DateTime.utc(1978),
                            lastDay: DateTime.utc(9999),
                            calendarBuilders: CalendarBuilders(
                              defaultBuilder: (context, day, focusedDay) {
                                final dayKey =
                                    DateTime(day.year, day.month, day.day);
                                if (_markedDates.containsKey(dayKey)) {
                                  final eventDetails = _markedDates[dayKey]!;
                                  final color =
                                      eventDetails[0]['color'] as Color;
                                  return GestureDetector(
                                    onTap: () =>
                                        _showEventDetails(day, eventDetails),
                                    child: Container(
                                      margin: const EdgeInsets.all(4),
                                      decoration: BoxDecoration(
                                        color: color,
                                        shape: BoxShape.circle,
                                      ),
                                      child: Center(
                                        child: Text(
                                          '${day.day}',
                                          style: const TextStyle(
                                              color: Colors.white),
                                        ),
                                      ),
                                    ),
                                  );
                                }
                                return null;
                              },
                            ),
                            onDaySelected: (selectedDay, focusedDay) {
                              setState(() {
                                _focusedDay = focusedDay;
                              });
                            },
                          ),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 20), //spacing

            // keterangan
            Card(
              elevation: 2,
              child: Padding(
                padding: const EdgeInsets.all(10.0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Text(
                      'Keterangan Tersedia',
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(height: 10),
                    Container(
                      width: double.infinity,
                      padding: const EdgeInsets.symmetric(vertical: 10),
                      alignment: Alignment.center,
                      decoration: BoxDecoration(
                        color: Color.fromRGBO(239, 68, 68, 1),
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Text(
                        'Sesi sudah penuh',
                        style: TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                    const SizedBox(height: 5),
                    Container(
                      width: double.infinity,
                      padding: const EdgeInsets.symmetric(vertical: 10),
                      alignment: Alignment.center,
                      decoration: BoxDecoration(
                        color: Color.fromRGBO(241, 207, 77, 1),
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Text(
                        'Sesi 1',
                        style: TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                    const SizedBox(height: 5),
                    Container(
                      width: double.infinity,
                      padding: const EdgeInsets.symmetric(vertical: 10),
                      alignment: Alignment.center,
                      decoration: BoxDecoration(
                        color: Color.fromRGBO(74, 222, 128, 1),
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Text(
                        'Sesi 2',
                        style: TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ),

            // button ke form peminjaman
            const SizedBox(
              height: 10,
            ),
            DButtonElevation(
              radius: 10,
              padding: const EdgeInsets.symmetric(vertical: 10),
              mainColor: biruTua,
              onClick: () => {Nav.push(context, peminjamanPage())},
              child: const Text(
                'Pinjam',
                style:
                    TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
              ),
            )
          ],
        ),
      ),
    );
  }
}
