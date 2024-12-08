import 'package:d_button/d_button.dart';
import 'package:d_input/d_input.dart';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/datasources/mahasiswa_datasource.dart';
import 'package:sipit_app/datasources/ruangan_datasource.dart';
import 'package:sipit_app/models/mahasiswaModel.dart';
import 'package:sipit_app/models/peminjamModel.dart';
import 'package:sipit_app/pages/dashboardPage.dart';
import 'package:sipit_app/theme.dart';

import '../../../models/daftarRuanganModel.dart';

class peminjamanPage extends StatefulWidget {
  peminjamanPage({super.key});

  @override
  _peminjamanPageState createState() => _peminjamanPageState();
}

class _peminjamanPageState extends State<peminjamanPage> {
  final TextEditingController _dateController = TextEditingController();
  final TextEditingController _searchRuanganController =
      TextEditingController();
  final MahasiswaDatasource _mahasiswaDatasource = MahasiswaDatasource();
  List<MahasiswanModel> _mahasiswas = [];
  String? _selectedOrmawa;
  final RuanganDatasource _ruanganDatasource = RuanganDatasource();
  List<DaftarRuanganModel> _ruangans = [];
  String? _selectedRuangan;

  bool _isLoadingMahasiswa = false;
  bool _isLoadingRuangan = false;

  Future<void> fetchApi() async {
    setState(() {
      _isLoadingMahasiswa = true;
      _isLoadingRuangan = true;
    });

    try {
      final results = await Future.wait([
        _mahasiswaDatasource.getAllMahasiswa(),
        _ruanganDatasource.fetchRuanganNonRequired(),
      ]);

      setState(() {
        _mahasiswas = results[0] as List<MahasiswanModel>;
        _ruangans = results[1] as List<DaftarRuanganModel>;
      });
    } catch (e) {
      print('Error: $e');
    } finally {
      setState(() {
        _isLoadingRuangan = false;
        _isLoadingMahasiswa = false;
      });
    }
  }

  // Fungsi untuk memilih tanggal
  Future<void> _selectDate() async {
    DateTime? _picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2000),
      lastDate: DateTime(2100),
    );
    if (_picked != null) {
      setState(() {
        _dateController.text =
            _picked.toString().split(" ")[0]; // Hanya tanggalnya saja
      });
    }
  }

  @override
  void initState() {
    fetchApi();
    super.initState();
  }

  void _addEvent() {
    final TextEditingController eventBaruController = TextEditingController();

    showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Tambah Event'),
            content: TextField(
              controller: eventBaruController,
              decoration: InputDecoration(
                labelText: 'Event Baru',
                border: OutlineInputBorder(),
              ),
            ),
            actions: [
              TextButton(
                  onPressed: () {
                    Navigator.of(context).pop();
                  },
                  child: Text('Batal')),
              TextButton(onPressed: () {}, child: Text('Tambah'))
            ],
          );
        });
  }

  @override
  Widget build(BuildContext context) {
    final screenWidth = MediaQuery.of(context).size.width;
    return Scaffold(
      // appBar: AppBar(
      //   title: const Text("Form Peminjaman"),
      // ),
      backgroundColor: putih,
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(10.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  IconButton(
                      onPressed: () {
                        Navigator.of(context).pop();
                      },
                      icon: const Icon(
                        Icons.keyboard_arrow_left_rounded,
                        size: 25,
                      )),
                  const SizedBox(
                    width: 8,
                  ),
                  const Text(
                    'Peminjaman',
                    style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                  )
                ],
              ),
              // Bagian Peminjam
              Card(
                color: Colors.white, // Warna abu-abu
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10), // Sudut membulat
                ),
                elevation: 4, // Efek bayangan
                child: Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Text(
                        'Peminjam',
                        style: TextStyle(
                            color: Colors.blue, fontWeight: FontWeight.bold),
                      ),
                      const SizedBox(height: 8),
                      FutureBuilder(
                          future: AppSession.getPeminjam(),
                          builder: (context, snapshot) {
                            if (!snapshot.hasData || snapshot.data == null) {
                              return const Center(
                                  child: Text("No profile data available."));
                            }

                            PeminjamModel peminjam = snapshot.data!;
                            return TextFormField(
                              initialValue: peminjam.namaPeminjam,
                              readOnly: true,
                              decoration: const InputDecoration(
                                labelText: 'Username',
                                border: OutlineInputBorder(),
                              ),
                            );
                          }),
                      const SizedBox(height: 8),
                      _isLoadingMahasiswa
                          ? const Center(
                              child: CircularProgressIndicator(),
                            )
                          : Container(
                              padding: EdgeInsets.symmetric(horizontal: 6),
                              decoration: BoxDecoration(
                                  border: Border.all(color: Colors.grey),
                                  borderRadius: BorderRadius.circular(6)),
                              child: DropdownMenu<MahasiswanModel?>(
                                width: MediaQuery.of(context).size.width,
                                // controller: _searchRuanganController,
                                hintText: "Ormawa",
                                inputDecorationTheme: InputDecorationTheme(
                                    border: InputBorder.none),
                                dropdownMenuEntries: _mahasiswas.map((ormawa) {
                                  return DropdownMenuEntry(
                                      value: ormawa, label: ormawa.namaOrmawa!);
                                }).toList(),
                                onSelected: (ormawa) {
                                  setState(() {
                                    _selectedOrmawa = ormawa.toString();
                                  });
                                },
                              ),
                            ),
                      const SizedBox(height: 16),
                    ],
                  ),
                ),
              ),
              // Bagian Kegiatan
              Card(
                color: Colors.white, // Warna abu-abu
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10), // Sudut membulat
                ),
                elevation: 4, // Efek bayangan
                child: Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Text(
                        'Kegiatan',
                        style: TextStyle(
                            color: Colors.purple, fontWeight: FontWeight.bold),
                      ),
                      const SizedBox(height: 8),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Container(
                            width: MediaQuery.of(context).size.width * 0.75,
                            padding: EdgeInsets.symmetric(horizontal: 6),
                            decoration: BoxDecoration(
                                border: Border.all(color: Colors.grey),
                                borderRadius: BorderRadius.circular(6)),
                            child: DropdownMenu<MahasiswanModel?>(
                              width: MediaQuery.of(context).size.width,
                              // controller: _searchRuanganController,
                              hintText: "Kegiatan",
                              inputDecorationTheme: InputDecorationTheme(
                                  border: InputBorder.none),
                              dropdownMenuEntries: _mahasiswas.map((ormawa) {
                                return DropdownMenuEntry(
                                    value: ormawa, label: ormawa.namaOrmawa!);
                              }).toList(),
                              onSelected: (ormawa) {
                                setState(() {
                                  _selectedOrmawa = ormawa.toString();
                                });
                              },
                            ),
                          ),
                          DButtonFlat(
                            padding: EdgeInsets.all(12),
                            radius: 6,
                            onClick: () => _addEvent(),
                            mainColor: biruTua,
                            child: Center(
                              child: Icon(
                                Icons.add,
                                size: 25,
                                color: Colors.white,
                              ),
                            ),
                          )
                        ],
                      ),
                      const SizedBox(height: 8),
                      TextFormField(
                        decoration: const InputDecoration(
                          labelText: 'Tema Kegiatan',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      const SizedBox(height: 8),
                      TextFormField(
                        controller: _dateController,
                        decoration: const InputDecoration(
                            labelText: 'Tanggal',
                            border: OutlineInputBorder(),
                            prefixIcon: Icon(Icons.calendar_today),
                            focusedBorder: OutlineInputBorder(
                                borderSide: BorderSide(color: Colors.blue))),
                        readOnly: true,
                        onTap: () {
                          _selectDate();
                        },
                      ),
                      const SizedBox(height: 8),

                      // Bagian Waktu
                      const Text('Waktu',
                          style: TextStyle(fontWeight: FontWeight.bold)),
                      const SizedBox(height: 8),
                      const WaktuToggleButton(),
                      const SizedBox(height: 16),

                      // Bagian Ruangan
                      Container(
                        padding: EdgeInsets.symmetric(horizontal: 6),
                        decoration: BoxDecoration(
                            border: Border.all(color: Colors.grey),
                            borderRadius: BorderRadius.circular(6)),
                        child: _isLoadingRuangan
                            ? const Center(
                                child: CircularProgressIndicator(),
                              )
                            : DropdownMenu<DaftarRuanganModel?>(
                                width: MediaQuery.of(context).size.width,
                                controller: _searchRuanganController,
                                hintText: "Cari Ruangan",
                                inputDecorationTheme: InputDecorationTheme(
                                    border: InputBorder.none),
                                dropdownMenuEntries: _ruangans.map((ruangan) {
                                  return DropdownMenuEntry(
                                      value: ruangan,
                                      label: ruangan.namaRuangan);
                                }).toList(),
                                onSelected: (ruangan) {
                                  setState(() {
                                    _selectedRuangan = ruangan.toString();
                                  });
                                },
                              ),
                      ),
                    ],
                  ),
                ),
              ),
              // Bagian Ormawa
              Card(
                color: Colors.white, // Warna abu-abu
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10), // Sudut membulat
                ),
                elevation: 4, // Efek bayangan
                child: Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Text(
                        'Ormawa',
                        style: TextStyle(
                            color: Colors.purple, fontWeight: FontWeight.bold),
                      ),
                      const SizedBox(height: 8),
                      TextFormField(
                        initialValue: 'Miftachussurur',
                        readOnly: true,
                        decoration: const InputDecoration(
                          labelText: 'Ketua ormawa',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      const SizedBox(height: 8),
                      TextFormField(
                        initialValue: '4.33.23.1.15',
                        readOnly: true,
                        decoration: const InputDecoration(
                          labelText: 'NIM',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      const SizedBox(height: 8),
                      TextFormField(
                        decoration: const InputDecoration(
                          labelText: 'Nama Ketua Pelaksana',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      const SizedBox(height: 8),
                      TextFormField(
                        initialValue: 'Miftachussurur',
                        readOnly: true,
                        decoration: const InputDecoration(
                          labelText: 'Pembina ormawa',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      const SizedBox(height: 8),
                      TextFormField(
                        initialValue: '4.33.23.1.15',
                        readOnly: true,
                        decoration: const InputDecoration(
                          labelText: 'NIP',
                          border: OutlineInputBorder(),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
              // Bagian Panitia
              Card(
                color: Colors.white, // Warna abu-abu
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10), // Sudut membulat
                ),
                elevation: 4, // Efek bayangan
                child: Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Text(
                        'Panitia',
                        style: TextStyle(
                            color: Colors.blue,
                            fontWeight: FontWeight.bold,
                            fontSize: 18),
                      ),
                      const SizedBox(height: 10),
                      ElevatedButton.icon(
                        onPressed: () {
                          // Tambahkan aksi untuk daftar panitia
                        },
                        icon: const Icon(Icons.add,
                            size: 24, color: Colors.black),
                        label: const Text(
                          'DAFTAR PANITIA',
                          style: TextStyle(
                              color: Colors.black, fontWeight: FontWeight.bold),
                        ),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.blue[300],
                          padding: const EdgeInsets.symmetric(
                              vertical: 20), // Tinggi tombol
                          minimumSize: Size(screenWidth * 1,
                              50), // Lebar menyesuaikan layar, tinggi minimum 50
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(10),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ),

              // Submit Button
              const SizedBox(height: 16),
              ElevatedButton(
                onPressed: () {
                  Nav.replace(context, const Dashboardpage());
                },
                style: ElevatedButton.styleFrom(
                    minimumSize: Size(screenWidth * 1, 50),
                    backgroundColor: Colors.white),
                child: const Text('Ajukan Peminjaman'),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class WaktuToggleButton extends StatefulWidget {
  const WaktuToggleButton({Key? key}) : super(key: key);

  @override
  _WaktuToggleButtonState createState() => _WaktuToggleButtonState();
}

class _WaktuToggleButtonState extends State<WaktuToggleButton> {
  List<bool> isSelected = [false, false, false]; // Pilihan awal untuk waktu

  @override
  Widget build(BuildContext context) {
    return ToggleButtons(
      isSelected: isSelected,
      onPressed: (int index) {
        setState(() {
          // Mengizinkan hanya satu pilihan waktu yang aktif dalam satu waktu
          for (int i = 0; i < isSelected.length; i++) {
            isSelected[i] = i == index;
          }
        });
      },
      borderRadius: BorderRadius.circular(8),
      selectedColor: Colors.white,
      fillColor: Colors.blue,
      color: Colors.black,
      borderWidth: 2,
      borderColor: Colors.blue,
      selectedBorderColor: Colors.blueAccent,
      children: const <Widget>[
        Padding(
          padding: EdgeInsets.symmetric(horizontal: 16.0),
          child: Text("08.00 - 12.00"),
        ),
        Padding(
          padding: EdgeInsets.symmetric(horizontal: 16.0),
          child: Text("12.00 - 16.00"),
        ),
        Padding(
          padding: EdgeInsets.symmetric(horizontal: 16.0),
          child: Text("08.00 - 16.00"),
        ),
      ],
    );
  }
}
