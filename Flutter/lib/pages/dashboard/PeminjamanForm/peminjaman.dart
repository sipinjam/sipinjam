import 'package:d_button/d_button.dart';
import 'package:d_info/d_info.dart';
import 'package:d_input/d_input.dart';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/datasources/kegiatan_datasource.dart';
import 'package:sipit_app/datasources/peminjaman_datasource.dart';
import 'package:sipit_app/models/kegiatan_model.dart';
import 'package:sipit_app/models/peminjamModel.dart';
import 'package:intl/intl.dart';
import 'package:sipit_app/models/ruanganModel.dart';
import 'package:sipit_app/theme.dart';

import '../../../datasources/ruangan_datasource.dart';
import '../../../models/daftarRuanganModel.dart';

class PeminjamanPage extends StatefulWidget {
  const PeminjamanPage({super.key});

  @override
  State<PeminjamanPage> createState() => _PeminjamanPageState();
}

typedef ruanganEntry = DropdownMenuEntry<String>;

class _PeminjamanPageState extends State<PeminjamanPage> {
  final TextEditingController _datePickerController = TextEditingController();
  final KegiatanDatasource _kegiatanDatasource = KegiatanDatasource();
  List<KegiatanModel?> _kegiatan = [];
  Map<String, int> kegiatanMap = {};
  int? _selectedKegiatan;
  final TextEditingController _ruanganController = TextEditingController();
  final RuanganDatasource _ruanganDatasource = RuanganDatasource();
  List<DaftarRuanganModel> _ruangans = [];
  Map<String, int> ruanganMap = {};
  List<DaftarRuanganModel> _filteredRuangans = [];
  int? _selectedRuangan;
  final TextEditingController _keteranganController = TextEditingController();
  // Color backgroundColorButton = Colors.white;
  Color borderColorButton1 = Colors.grey;
  Color borderColorButton2 = Colors.grey;
  Color borderColorButton3 = Colors.grey;
  String sesiPeminjaman = '';

  Future<void> getKegiatan(int? idOrmawa) async {
    try {
      final kegiatans =
          await _kegiatanDatasource.getKegiatanByIdOrmawa(idOrmawa);
      setState(() {
        _kegiatan = kegiatans;
      });
    } catch (e) {
      print('Error: $e');
    }
  }

  Future<void> fetchRuangans() async {
    try {
      final List<DaftarRuanganModel> ruangans =
          await _ruanganDatasource.fetchRuanganNonRequired();
      setState(() {
        _ruangans = ruangans;
        _filteredRuangans = List.from(_ruangans);
      });
    } catch (e) {
      print('Error: $e');
    }
  }

  void filteredRuangans(String input) {
    setState(() {
      _filteredRuangans = _ruangans
          .where((ruangan) =>
              ruangan.namaRuangan.toLowerCase().contains(input.toLowerCase()))
          .toList();
    });
  }

  Future<void> loadPeminjamAndKegiatan() async {
    try {
      final peminjamData = await AppSession.getPeminjam();
      if (peminjamData != null) {
        print('idOrmawa: ${peminjamData.idOrmawa}');
        await getKegiatan(peminjamData.idOrmawa);
      } else {
        print("Peminjam data is null");
      }
    } catch (e) {
      print("Error loading peminjam: $e");
    }
  }

  Future<void> postDataToDatabase() async {
    final int? idKegiatan = _selectedKegiatan;
    final int? idRuangan = _selectedRuangan;
    final DateTime tanggalPeminjaman =
        DateTime.parse(_datePickerController.text);
    final String keterangan = _keteranganController.text;
    final String sesi = sesiPeminjaman;
    const int idStatus = 1;

    if (idKegiatan != null && idRuangan != null) {
      try {
        final peminjaman = await PeminjamanDatasource().postPeminjaman(
            idKegiatan,
            idRuangan,
            tanggalPeminjaman,
            keterangan,
            sesi,
            idStatus);
        print(peminjaman);
        if (peminjaman != null) {
          print('peminjaman berhasil ditambahkan');
        } else {
          print('gagal menambahkan peminjaman');
        }
      } catch (e) {
        print(e);
      }
    } else {
      print('data yang diperlukan tidak lengkap');
    }
  }

  @override
  void initState() {
    super.initState();
    loadPeminjamAndKegiatan();
    fetchRuangans();
    _ruanganController.addListener(() {
      filteredRuangans(_ruanganController.text);
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        padding: EdgeInsets.symmetric(vertical: 30, horizontal: 10),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'Peminjaman',
              style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
            ),
            Card(
              color: Colors.white,
              elevation: 4,
              child: Padding(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      'Kegiatan',
                      style: TextStyle(
                        fontSize: 17,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    Container(
                      margin: EdgeInsets.only(top: 10),
                      width: MediaQuery.sizeOf(context).width,
                      child: DropdownMenu<int>(
                        width: MediaQuery.sizeOf(context).width,
                        hintText: 'Pilih Kegiatan',
                        dropdownMenuEntries: _kegiatan.map((kegiatanName) {
                          return DropdownMenuEntry(
                            value: kegiatanName!.idKegiatan,
                            label: kegiatanName.namaKegiatan,
                          );
                        }).toList(),
                        onSelected: (kegiatan) {
                          setState(() {
                            _selectedKegiatan = kegiatan;
                          });
                        },
                      ),
                    )
                  ],
                ),
              ),
            ),
            Card(
              color: Colors.white,
              elevation: 4,
              child: Padding(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      'Ruangan',
                      style: TextStyle(
                        fontSize: 17,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    DropdownMenu<int>(
                        width: MediaQuery.sizeOf(context).width,
                        controller: _ruanganController,
                        hintText: 'Pilih Ruangan',
                        enableFilter: true,
                        requestFocusOnTap: true,
                        onSelected: (ruangan) {
                          setState(() {
                            _selectedRuangan = ruangan;
                          });
                        },
                        dropdownMenuEntries: _filteredRuangans.map((ruangan) {
                          return DropdownMenuEntry(
                            value: ruangan.idRuangan,
                            label: ruangan.namaRuangan,
                          );
                        }).toList()),
                    SizedBox(
                      height: 10,
                    ),
                    DInputMix(
                      boxColor: Colors.white,
                      controller: _datePickerController,
                      title: 'Tanggal Peminjaman',
                      titleStyle: TextStyle(
                        fontSize: 17,
                        fontWeight: FontWeight.bold,
                      ),
                      crossAxisAlignmentTitle: CrossAxisAlignment.start,
                      titleGap: 10,
                      hint: 'Pilih Tanggal Pinjam',
                      hintStyle: TextStyle(fontSize: 16),
                      inputPadding: const EdgeInsets.fromLTRB(20, 16, 0, 16),
                      boxRadius: 4,
                      boxBorder: Border.all(color: Colors.grey, width: 1),
                      suffixIcon: IconSpec(
                        icon: Icons.event,
                        splashColor: Colors.green.shade300,
                        margin: const EdgeInsets.all(2),
                        radius: 20 - 2,
                        onTap: () async {
                          DateTime? pickedDate = await showDatePicker(
                            context: context,
                            initialDate: DateTime.now(),
                            firstDate: DateTime(2000),
                            lastDate: DateTime(2100),
                          );
                          if (pickedDate != null) {
                            String formattedDate =
                                DateFormat('yyyy-MM-dd').format(pickedDate);
                            _datePickerController.text = formattedDate;
                          }
                        },
                      ),
                    ),
                    SizedBox(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          SizedBox(
                            height: 10,
                          ),
                          Text(
                            'Sesi',
                            style: TextStyle(
                                fontSize: 17, fontWeight: FontWeight.bold),
                          ),
                          SizedBox(
                            height: 10,
                          ),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              DButtonBorder(
                                  borderColor: borderColorButton1,
                                  borderWidth: 1,
                                  height: 50,
                                  // mainColor: backgroundColorButton,
                                  width:
                                      MediaQuery.sizeOf(context).width * 0.42,
                                  onClick: () {
                                    setState(() {
                                      borderColorButton1 = biruTua;
                                      borderColorButton2 = Colors.grey;
                                      borderColorButton3 = Colors.grey;
                                      sesiPeminjaman = '1';
                                    });
                                  },
                                  radius: 8,
                                  child: Text(
                                    'Sesi Pagi',
                                  )),
                              DButtonBorder(
                                  borderColor: borderColorButton2,
                                  borderWidth: 1,
                                  height: 50,
                                  width:
                                      MediaQuery.sizeOf(context).width * 0.42,
                                  onClick: () {
                                    setState(() {
                                      borderColorButton1 = Colors.grey;
                                      borderColorButton2 = biruTua;
                                      borderColorButton3 = Colors.grey;
                                      sesiPeminjaman = '2';
                                    });
                                  },
                                  radius: 8,
                                  child: Text(
                                    'Sesi Siang',
                                  )),
                            ],
                          ),
                          SizedBox(
                            height: 8,
                          ),
                          Container(
                            child: DButtonBorder(
                                borderColor: borderColorButton3,
                                borderWidth: 1,
                                height: 50,
                                onClick: () {
                                  setState(() {
                                    borderColorButton1 = Colors.grey;
                                    borderColorButton2 = Colors.grey;
                                    borderColorButton3 = biruTua;
                                    sesiPeminjaman = '3';
                                  });
                                },
                                radius: 8,
                                child: Text(
                                  'Full Day',
                                )),
                          ),
                          SizedBox(
                            height: 10,
                          )
                        ],
                      ),
                    ),
                    DInputMix(
                      boxColor: Colors.white,
                      controller: _keteranganController,
                      title: 'Keterangan',
                      titleGap: 10,
                      titleStyle:
                          TextStyle(fontSize: 17, fontWeight: FontWeight.bold),
                      hint: 'Tulis Keterangan',
                      minLine: 3,
                      maxLine: 5,
                    ),
                  ],
                ),
              ),
            ),
            SizedBox(
              height: 6,
            ),
            DButtonElevation(
                height: 50,
                width: MediaQuery.sizeOf(context).width,
                onClick: () {
                  postDataToDatabase();
                },
                radius: 16,
                mainColor: Color(0xff22C55E),
                child: Text(
                  'Submit',
                  style: TextStyle(
                      fontSize: 17,
                      fontWeight: FontWeight.bold,
                      color: Colors.white),
                )),
          ],
        ),
      ),
    );
  }
}
