import 'package:flutter/material.dart';
import 'package:sipit_app/datasources/peminjaman_datasource.dart';
import 'package:table_calendar/table_calendar.dart';

class SchedulePage extends StatefulWidget {
  const SchedulePage({super.key});

  @override
  State<SchedulePage> createState() => _SchedulePageState();
}

class _SchedulePageState extends State<SchedulePage> {
  DateTime _focusedDay = DateTime.now();
  Set<DateTime> _markedDates = {};
  final TextEditingController _searchController = TextEditingController();
  final PeminjamanDatasource _peminjamanDatasource = PeminjamanDatasource();

  Future<void> fetchAndSetMarkedDates(String roomName) async {
    try {
      final dates = await _peminjamanDatasource.fetchMarkedDates(roomName);
      setState(() {
        _markedDates = dates;
      });
      print(_markedDates);
    } catch (e) {
      print('Error fetching marked dates: $e');
    }
  }

  @override
  void initState() {
    super.initState();
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
            Card(
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(30),
              ),
              elevation: 2,
              margin: const EdgeInsets.only(top: 6),
              child: Padding(
                padding: const EdgeInsets.symmetric(horizontal: 10),
                child: Column(
                  children: [
                    TextField(
                      controller: _searchController,
                      decoration: InputDecoration(
                        hintText: 'Cari ruangan',
                        border: InputBorder.none,
                        prefixIcon:
                            Icon(Icons.search, color: Colors.grey.shade600),
                        suffixIcon: IconButton(
                          icon: Icon(Icons.search, color: Colors.blue),
                          onPressed: () async {
                            final roomName = _searchController.text;
                            final dates = await _peminjamanDatasource
                                .fetchMarkedDates(roomName);
                            setState(() {
                              _markedDates = dates
                                  .map((date) =>
                                      DateTime(date.year, date.month, date.day))
                                  .toSet();
                            });
                          },
                        ),
                      ),
                      onSubmitted: (value) async {
                        final dates =
                            await _peminjamanDatasource.fetchMarkedDates(value);
                        setState(() {
                          _markedDates = dates
                              .map((date) =>
                                  DateTime(date.year, date.month, date.day))
                              .toSet();
                        });
                      },
                    ),
                    TableCalendar(
                      headerStyle: const HeaderStyle(
                        formatButtonVisible: false,
                        titleCentered: true,
                      ),
                      focusedDay: _focusedDay,
                      firstDay: DateTime.utc(1978),
                      lastDay: DateTime.utc(9999),
                      calendarBuilders: CalendarBuilders(
                          defaultBuilder: (context, day, focusedDay) {
                        if (_markedDates.contains(day)) {
                          return Container(
                            margin: const EdgeInsets.all(4),
                            decoration: const BoxDecoration(
                              color: Colors.redAccent,
                              shape: BoxShape.circle,
                            ),
                            child: Center(
                              child: Text(
                                '${day.day}',
                                style: const TextStyle(color: Colors.white),
                              ),
                            ),
                          );
                        }
                        return null;
                      }),
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
                        color: Colors.red,
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
                        color: Colors.yellow,
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Text(
                        'Sesi 1',
                        style: TextStyle(
                          color: Colors.black,
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
                        color: Colors.orange,
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Text(
                        'Sesi 2',
                        style: TextStyle(
                          color: Colors.black,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
