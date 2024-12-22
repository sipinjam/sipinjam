import 'package:d_button/d_button.dart';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/datasources/gedung_datasource.dart';
import 'package:sipit_app/datasources/peminjaman_datasource.dart';
import 'package:sipit_app/datasources/ruangan_datasource.dart';
import 'package:sipit_app/models/daftarRuanganModel.dart';
import 'package:sipit_app/models/gedungModel.dart';
import 'package:sipit_app/pages/dashboard/PeminjamanForm/peminjaman.dart';
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
  final TextEditingController _searchGedungController = TextEditingController();
  final TextEditingController _searchRuanganController =
      TextEditingController();
  final PeminjamanDatasource _peminjamanDatasource = PeminjamanDatasource();
  bool _isLoading = false;
  final GedungDatasource _gedungDatasource = GedungDatasource();
  List<GedungModel> _gedungs = [];
  GedungModel? _selectedGedung;
  final RuanganDatasource _ruanganDatasource = RuanganDatasource();
  List<DaftarRuanganModel> _ruangans = [];
  String? _selectedRuangan;

  Future<void> fetchGedungs() async {
    if (_gedungs.isNotEmpty) return;
    try {
      final gedungs = await _gedungDatasource.fetchGedungList();
      setState(() {
        _gedungs = gedungs;
      });
    } catch (e) {
      print('Error: $e');
    }
  }

  Future<void> fetchRuangans(int gedungId) async {
    try {
      final ruangans = await _ruanganDatasource.fetchRuanganList(gedungId);
      setState(() {
        _ruangans = ruangans;
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
      print(roomName);
      final dates = await _peminjamanDatasource.fetchMarkedDates(roomName);
      print(dates);
      setState(() {
        _markedDates = dates;
        print(_markedDates);
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
    fetchGedungs();
  }

  void _showEventDetails(
      DateTime date, List<Map<String, dynamic>> eventDetails) {
    showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Detail Kegiatan'),
            content: SizedBox(
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
                        Text('Sesi: ${event['sesi']}'),
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
        padding: const EdgeInsets.symmetric(horizontal: 10),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Container(
              padding: EdgeInsets.fromLTRB(0, 30, 0, 10),
              child: const Text(
                'Schedule',
                style: TextStyle(
                  fontSize: 20,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 6),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(8),
              ),
              child: DropdownMenu<GedungModel?>(
                width: MediaQuery.of(context).size.width,
                controller: _searchGedungController,
                hintText: "Cari Gedung",
                inputDecorationTheme:
                    const InputDecorationTheme(border: InputBorder.none),
                dropdownMenuEntries: _gedungs.map((gedungName) {
                  return DropdownMenuEntry(
                    value: gedungName,
                    label: gedungName.namaGedung,
                  );
                }).toList(),
                onSelected: (gedungName) {
                  setState(() {
                    _selectedGedung = gedungName;
                    _selectedRuangan = null;
                  });
                  fetchRuangans(_selectedGedung!.idGedung);
                },
              ),
            ),
            const SizedBox(
              height: 4,
            ),
            if (_selectedGedung != null)
              Container(
                padding: const EdgeInsets.symmetric(horizontal: 6),
                decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(8)),
                child: DropdownMenu<DaftarRuanganModel?>(
                  width: MediaQuery.of(context).size.width,
                  controller: _searchRuanganController,
                  hintText: "Cari Ruangan",
                  inputDecorationTheme:
                      const InputDecorationTheme(border: InputBorder.none),
                  dropdownMenuEntries: _ruangans
                      .where((ruangan) =>
                          ruangan.namaGedung == _selectedGedung!.namaGedung)
                      .map((ruangan) {
                    return DropdownMenuEntry(
                        value: ruangan, label: ruangan.namaRuangan);
                  }).toList(),
                  onSelected: (ruangan) {
                    setState(() {
                      _selectedRuangan = ruangan.toString();
                    });
                  },
                ),
              ),
            const SizedBox(
              height: 4,
            ),
            DButtonElevation(
              onClick: () async {
                if (_selectedGedung == null || _selectedRuangan == null) {
                  ScaffoldMessenger.of(context).showSnackBar(
                    const SnackBar(
                      content:
                          Text("Pilih gedung dan ruangan terlebih dahulu."),
                      backgroundColor: Colors.red,
                    ),
                  );
                  return;
                }

                await fetchAndSetMarkedDates(_selectedRuangan!);

                ScaffoldMessenger.of(context).showSnackBar(
                  SnackBar(
                    content: Text(
                      "Peminjaman ruangan $_selectedRuangan berhasil diambil.",
                    ),
                    backgroundColor: Colors.green,
                  ),
                );
              },
              mainColor: const Color(0xff615EFC),
              radius: 8,
              child: const Text(
                'Cek Ketersediaan',
                style: TextStyle(color: Colors.white),
              ),
            ),
            // DButtonElevation(
            //     onClick: () async {
            //       await fetchAndSetMarkedDates(_selectedRuangan!);
            //     },
            //     mainColor: Color(0xff615EFC),
            //     radius: 8,
            //     child: Text(
            //       'Cek Ketersedian',
            //       style: TextStyle(color: Colors.white),
            //     )),
            Card(
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(30),
              ),
              elevation: 2,
              // margin: const EdgeInsets.only(top: 6),
              child: Padding(
                padding: const EdgeInsets.all(10),
                child: Column(
                  children: [
                    Center(
                      child: _isLoading
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
                    ),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 10), //spacing

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
                        color: const Color.fromRGBO(239, 68, 68, 1),
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Text(
                        'Full Sesi',
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
                        color: const Color.fromRGBO(241, 207, 77, 1),
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Text(
                        'Sesi Pagi',
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
                        color: const Color.fromRGBO(74, 222, 128, 1),
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Text(
                        'Sesi Siang',
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
          ],
        ),
      ),
    );
  }
}
