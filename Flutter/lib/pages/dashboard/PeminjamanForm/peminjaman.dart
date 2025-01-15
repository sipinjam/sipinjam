import 'package:d_button/d_button.dart';
import 'package:d_input/d_input.dart';
import 'package:flutter/material.dart';
import 'package:quickalert/quickalert.dart';
import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/datasources/kegiatan_datasource.dart';
import 'package:sipit_app/datasources/peminjaman_datasource.dart';
import 'package:sipit_app/models/kegiatan_model.dart';
import 'package:intl/intl.dart';
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
  bool sesi1Available = true;
  bool sesi2Available = true;
  bool sesi3Available = true;
  Color borderColorButton1 = Colors.grey;
  Color borderColorButton2 = Colors.grey;
  Color borderColorButton3 = Colors.grey;
  Color mainColorButton1 = Colors.white;
  Color mainColorButton2 = Colors.white;
  Color mainColorButton3 = Colors.white;
  String sesiPeminjaman = '';
  final bool _peminjamanStatus = false;
  final FocusNode _focusnodeKeterangan = FocusNode();

  void _removeFocus() {
    FocusScope.of(context).unfocus();
  }

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
        List<Map<String, dynamic>> peminjamanList = [
          {
            'id_ruangan': idRuangan,
            'id_kegiatan': idKegiatan,
            'id_status': idStatus,
            'tgl_peminjaman': tanggalPeminjaman.toIso8601String(),
            'sesi_peminjaman': sesi,
            'keterangan': keterangan,
          }
        ];
        print('data yang dikirim: $peminjamanList');

        final peminjaman =
            await PeminjamanDatasource().postPeminjaman(peminjamanList);
        print(peminjaman);
      } catch (e) {
        print(e);
      }
    } else {
      print('data yang diperlukan tidak lengkap');
      _PeminjamanGagal();
    }
  }

  void validateSessionAvailableability(DateTime tanggal, int idRuangan) async {
    sesi1Available = await PeminjamanDatasource()
        .checkRuanganAvailability(tanggal, '1', idRuangan);
    sesi2Available = await PeminjamanDatasource()
        .checkRuanganAvailability(tanggal, '2', idRuangan);
    sesi3Available = await PeminjamanDatasource()
        .checkRuanganAvailability(tanggal, '3', idRuangan);
    if (sesi1Available == false || sesi2Available == false) {
      sesi3Available = false;
    } else if (sesi3Available == false) {
      sesi1Available = false;
      sesi2Available = false;
    }

    setState(() {
      borderColorButton1 = sesi1Available ? Colors.grey : Colors.transparent;
      borderColorButton2 = sesi2Available ? Colors.grey : Colors.transparent;
      borderColorButton3 = sesi3Available ? Colors.grey : Colors.transparent;
    });

    if (!sesi3Available) {
      print('Sesi 1 dan 2 tidak tersedia karena sesi 3 penuh');
    }
  }

  void _confirmPeminjaman() {
    QuickAlert.show(
      context: context,
      type: QuickAlertType.warning,
      showCancelBtn: true,
      text: 'apakah anda sudah yakin dengan pilihan anda?',
      confirmBtnText: 'Ya',
      cancelBtnText: 'Kembali',
      onConfirmBtnTap: () {
        Navigator.of(context).pop();
        postDataToDatabase();
        _PeminjamanSuccess();
      },
    );
  }

  void _PeminjamanSuccess() {
    QuickAlert.show(
        context: context,
        type: QuickAlertType.success,
        text: 'Peminjaman berhasil');
  }

  void _PeminjamanGagal() {
    QuickAlert.show(
        context: context,
        type: QuickAlertType.error,
        text: 'Peminjaman Gagal \n periksa kembali form peminjaman');
  }

  @override
  void dispose() {
    _keteranganController.dispose();
    _focusnodeKeterangan.dispose();
    super.dispose();
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
        padding: const EdgeInsets.symmetric(vertical: 30, horizontal: 10),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
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
                    const Text(
                      'Kegiatan',
                      style: TextStyle(
                        fontSize: 17,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    Container(
                      margin: const EdgeInsets.only(top: 10),
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
                    const Text(
                      'Ruangan',
                      style: TextStyle(
                        fontSize: 17,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(
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
                            if (_datePickerController.text.isNotEmpty &&
                                ruangan != null) {
                              final DateTime tanggalPeminjaman =
                                  DateTime.parse(_datePickerController.text);
                              validateSessionAvailableability(
                                  tanggalPeminjaman, ruangan);
                            }
                          });
                        },
                        dropdownMenuEntries: _filteredRuangans.map((ruangan) {
                          return DropdownMenuEntry(
                            value: ruangan.idRuangan,
                            label: ruangan.namaRuangan,
                          );
                        }).toList()),
                    const SizedBox(
                      height: 10,
                    ),
                    DInputMix(
                      boxColor: Colors.white,
                      controller: _datePickerController,
                      title: 'Tanggal Peminjaman',
                      titleStyle: const TextStyle(
                        fontSize: 17,
                        fontWeight: FontWeight.bold,
                      ),
                      crossAxisAlignmentTitle: CrossAxisAlignment.start,
                      titleGap: 10,
                      hint: 'Pilih Tanggal Pinjam',
                      hintStyle: const TextStyle(fontSize: 16),
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
                            setState(() {
                              _datePickerController.text = formattedDate;
                              DateTime selectedDate =
                                  DateTime.parse(formattedDate);
                              if (_selectedRuangan != null) {
                                validateSessionAvailableability(
                                    selectedDate, _selectedRuangan!);
                              }
                            });
                          }
                        },
                      ),
                    ),
                    SizedBox(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const SizedBox(
                            height: 10,
                          ),
                          const Text(
                            'Sesi',
                            style: TextStyle(
                                fontSize: 17, fontWeight: FontWeight.bold),
                          ),
                          const SizedBox(
                            height: 10,
                          ),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              DButtonBorder(
                                  borderColor: borderColorButton1,
                                  borderWidth: 1,
                                  splashColor: biruTua,
                                  height: 50,
                                  mainColor: mainColorButton1,
                                  width:
                                      MediaQuery.sizeOf(context).width * 0.42,
                                  onClick: sesi1Available
                                      ? () {
                                          setState(() {
                                            borderColorButton1 = biruTua;
                                            mainColorButton1 = biruTua;
                                            borderColorButton2 = Colors.grey;
                                            mainColorButton2 = Colors.white;
                                            borderColorButton3 = Colors.grey;
                                            mainColorButton3 = Colors.white;
                                            sesiPeminjaman = '1';
                                          });
                                        }
                                      : null,
                                  radius: 8,
                                  child: const Text(
                                    'Sesi Pagi',
                                  )),
                              DButtonBorder(
                                  borderColor: borderColorButton2,
                                  borderWidth: 1,
                                  splashColor: biruTua,
                                  mainColor: mainColorButton2,
                                  height: 50,
                                  width:
                                      MediaQuery.sizeOf(context).width * 0.42,
                                  onClick: sesi2Available
                                      ? () {
                                          setState(() {
                                            borderColorButton1 = Colors.grey;
                                            mainColorButton1 = Colors.white;
                                            borderColorButton2 = biruTua;
                                            mainColorButton2 = biruTua;
                                            borderColorButton3 = Colors.grey;
                                            mainColorButton3 = Colors.white;
                                            sesiPeminjaman = '2';
                                          });
                                        }
                                      : null,
                                  radius: 8,
                                  child: const Text(
                                    'Sesi Siang',
                                  )),
                            ],
                          ),
                          const SizedBox(
                            height: 8,
                          ),
                          Container(
                            child: DButtonBorder(
                                borderColor: borderColorButton3,
                                mainColor: mainColorButton3,
                                borderWidth: 1,
                                splashColor: biruTua,
                                height: 50,
                                onClick: sesi3Available
                                    ? () {
                                        setState(() {
                                          borderColorButton1 = Colors.grey;
                                          mainColorButton1 = Colors.white;
                                          borderColorButton2 = Colors.grey;
                                          mainColorButton2 = Colors.white;
                                          borderColorButton3 = biruTua;
                                          mainColorButton3 = biruTua;
                                          sesiPeminjaman = '3';
                                        });
                                      }
                                    : null,
                                radius: 8,
                                child: const Text(
                                  'Full Day',
                                )),
                          ),
                          const SizedBox(
                            height: 10,
                          )
                        ],
                      ),
                    ),
                    DInputMix(
                      boxColor: Colors.white,
                      boxBorder: Border.all(color: Colors.grey),
                      controller: _keteranganController,
                      title: 'Keterangan',
                      // inputFocusNode: _focusnodeKeterangan,
                      titleGap: 10,
                      titleStyle: const TextStyle(
                          fontSize: 17, fontWeight: FontWeight.bold),
                      hint: 'Tulis Keterangan',
                      minLine: 3,
                      maxLine: 5,
                    ),
                  ],
                ),
              ),
            ),
            const SizedBox(
              height: 6,
            ),
            DButtonElevation(
                height: 50,
                width: MediaQuery.sizeOf(context).width,
                onClick: () {
                  _confirmPeminjaman();
                },
                radius: 16,
                mainColor: const Color(0xff22C55E),
                child: const Text(
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
