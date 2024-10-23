import 'package:flutter/material.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/pages/dashboard/Home/homePage.dart';
import 'package:sipit_app/pages/dashboardPage.dart';
import 'package:sipit_app/theme.dart';

class peminjamanPage extends StatefulWidget {
  peminjamanPage({super.key});

  @override
  _peminjamanPageState createState() => _peminjamanPageState();
}

class _peminjamanPageState extends State<peminjamanPage> {
  TextEditingController _dateController = TextEditingController();

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
      appBar: AppBar(
        title: const Text("Form Peminjaman"),
      ),
      backgroundColor: const Color.fromARGB(255, 212, 209, 209),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Bagian Peminjam
              Card(
                color: putih, // Warna abu-abu
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
                      SizedBox(height: 8),
                      TextFormField(
                        initialValue: 'Rohani Kristiani Polines',
                        readOnly: true,
                        decoration: InputDecoration(
                          labelText: 'Ormawa',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      SizedBox(height: 16),
                    ],
                  ),
                ),
              ),
              // Bagian Kegiatan
              Card(
                color: putih, // Warna abu-abu
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10), // Sudut membulat
                ),
                elevation: 4, // Efek bayangan
                child: Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Kegiatan',
                        style: TextStyle(
                            color: Colors.purple, fontWeight: FontWeight.bold),
                      ),
                      SizedBox(height: 8),
                      TextFormField(
                        decoration: InputDecoration(
                          labelText: 'Nama Kegiatan',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      SizedBox(height: 8),
                      TextFormField(
                        decoration: InputDecoration(
                          labelText: 'Tema Kegiatan',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      SizedBox(height: 8),
                      TextFormField(
                        controller: _dateController,
                        decoration: InputDecoration(
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
                      SizedBox(height: 8),

                      // Bagian Waktu
                      Text('Waktu',
                          style: TextStyle(fontWeight: FontWeight.bold)),
                      SizedBox(height: 8),
                      WaktuToggleButton(),
                      SizedBox(height: 16),

                      // Bagian Ruangan
                      TextFormField(
                        initialValue: 'Ruang Seminar MST',
                        readOnly: true,
                        decoration: InputDecoration(
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
                color: putih, // Warna abu-abu
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10), // Sudut membulat
                ),
                elevation: 4, // Efek bayangan
                child: Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Ormawa',
                        style: TextStyle(
                            color: Colors.purple, fontWeight: FontWeight.bold),
                      ),
                      SizedBox(height: 8),
                      TextFormField(
                        initialValue: 'Miftachussurur',
                        readOnly: true,
                        decoration: InputDecoration(
                          labelText: 'Ketua ormawa',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      SizedBox(height: 8),
                      TextFormField(
                        initialValue: '4.33.23.1.15',
                        readOnly: true,
                        decoration: InputDecoration(
                          labelText: 'NIM',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      SizedBox(height: 8),
                      TextFormField(
                        decoration: InputDecoration(
                          labelText: 'Nama Ketua Pelaksana',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      SizedBox(height: 8),
                      TextFormField(
                        initialValue: 'Miftachussurur',
                        readOnly: true,
                        decoration: InputDecoration(
                          labelText: 'Pembina ormawa',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      SizedBox(height: 8),
                      TextFormField(
                        initialValue: '4.33.23.1.15',
                        readOnly: true,
                        decoration: InputDecoration(
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
                color: putih, // Warna abu-abu
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10), // Sudut membulat
                ),
                elevation: 4, // Efek bayangan
                child: Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Panitia',
                        style: TextStyle(
                            color: Colors.blue,
                            fontWeight: FontWeight.bold,
                            fontSize: 18),
                      ),
                      SizedBox(height: 10),
                      ElevatedButton.icon(
                        onPressed: () {
                          // Tambahkan aksi untuk daftar panitia
                        },
                        icon: Icon(Icons.add, size: 24, color: Colors.black),
                        label: Text(
                          'DAFTAR PANITIA',
                          style: TextStyle(
                              color: Colors.black, fontWeight: FontWeight.bold),
                        ),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.blue[300],
                          padding: EdgeInsets.symmetric(
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

              SizedBox(height: 20),

              // Daftar Peserta
              Card(
                color: putih, // Warna abu-abu
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10), // Sudut membulat
                ),
                elevation: 4, // Efek bayangan
                child: Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Peserta',
                        style: TextStyle(
                            color: Colors.blue,
                            fontWeight: FontWeight.bold,
                            fontSize: 18),
                      ),
                      SizedBox(height: 10),
                      ElevatedButton.icon(
                        onPressed: () {
                          // Tambahkan aksi untuk daftar peserta
                        },
                        icon: Icon(Icons.add, size: 24, color: Colors.black),
                        label: Text(
                          'DAFTAR PESERTA',
                          style: TextStyle(
                              color: Colors.black, fontWeight: FontWeight.bold),
                        ),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.blue[300],
                          padding: EdgeInsets.symmetric(
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
              SizedBox(height: 16),
              ElevatedButton(
                onPressed: () {
                  Nav.replace(context, const Dashboardpage());
                },
                style: ElevatedButton.styleFrom(
                  minimumSize:
                      Size(screenWidth * 1, 50), // Lebar mengikuti layar
                ),
                child: Text('Ajukan Peminjaman'),
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
      children: <Widget>[
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16.0),
          child: Text("08.00 - 12.00"),
        ),
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16.0),
          child: Text("12.00 - 16.00"),
        ),
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16.0),
          child: Text("08.00 - 16.00"),
        ),
      ],
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
    );
  }
}
