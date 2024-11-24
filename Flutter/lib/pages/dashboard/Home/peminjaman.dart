import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/pages/dashboardPage.dart';
import 'package:sipit_app/theme.dart';

class peminjamanPage extends StatefulWidget {
  peminjamanPage({super.key});

  @override
  _peminjamanPageState createState() => _peminjamanPageState();
}

class _peminjamanPageState extends State<peminjamanPage> {
  final TextEditingController _dateController = TextEditingController();

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
  void dispose() {
    _dateController
        .dispose(); // Pastikan untuk membuang controller setelah selesai
    super.dispose();
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
                    'Detail Ruangan',
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
                      TextFormField(
                        initialValue: 'PENGGUNA SIPIT',
                        readOnly: true,
                        decoration: const InputDecoration(
                          labelText: 'Username',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      const SizedBox(height: 8),
                      TextFormField(
                        initialValue: 'Rohani Kristiani Polines',
                        readOnly: true,
                        decoration: const InputDecoration(
                          labelText: 'Ormawa',
                          border: OutlineInputBorder(),
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
                      TextFormField(
                        decoration: const InputDecoration(
                          labelText: 'Nama Kegiatan',
                          border: OutlineInputBorder(),
                        ),
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
                      TextFormField(
                        initialValue: 'Ruang Seminar MST',
                        readOnly: true,
                        decoration: const InputDecoration(
                          labelText: 'Ruangan',
                          border: OutlineInputBorder(),
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
