import 'package:flutter/material.dart';

class peminjamanPage extends StatelessWidget {
  const peminjamanPage({super.key});

  @override
  @override
  Widget build(BuildContext context) {
    final screenWidth = MediaQuery.of(context).size.width;
    return Scaffold(
      appBar: AppBar(
        title: Text("Form Peminjaman"),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Bagian Peminjam
              Text(
                'Peminjam',
                style:
                    TextStyle(color: Colors.blue, fontWeight: FontWeight.bold),
              ),
              SizedBox(height: 8),
              TextFormField(
                initialValue: 'PENGGUNA SIPIT',
                readOnly: true,
                decoration: InputDecoration(
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

              // Bagian Kegiatan
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
                  errorText: 'Silahkan isi nama kegiatan',
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
                decoration: InputDecoration(
                  labelText: 'Tanggal',
                  border: OutlineInputBorder(),
                  suffixIcon: Icon(Icons.calendar_today),
                ),
              ),
              SizedBox(height: 8),

              // Bagian Waktu
              Text('Waktu', style: TextStyle(fontWeight: FontWeight.bold)),
              SizedBox(height: 8),
              Row(
                children: [
                  ChoiceChip(
                    label: Text("08.00 - 12.00"),
                    selected: false,
                  ),
                  SizedBox(width: 8),
                  ChoiceChip(
                    label: Text("12.00 - 16.00"),
                    selected: true,
                  ),
                  SizedBox(width: 8),
                  ChoiceChip(
                    label: Text("16.00 - 20.00"),
                    selected: false,
                  ),
                ],
              ),
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
                  labelText: 'NIM ',
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
                  labelText: 'NIP ',
                  border: OutlineInputBorder(),
                ),
              ),
              Card(
                color: Colors.grey[300], // Warna abu-abu
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
                color: Colors.grey[300], // Warna abu-abu
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
                      SizedBox(height: 8),
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
                          backgroundColor:
                              Colors.blue[300], // Warna latar belakang biru
                          padding: EdgeInsets.symmetric(
                              vertical: 20), // Tinggi tombol
                          minimumSize: Size(screenWidth * 1, 50),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(10),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
              SizedBox(height: 40),

              // Tombol Cancel dan Submit
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                children: [
                  // Tombol Cancel
                  ElevatedButton(
                    onPressed: () {
                      // Tambahkan aksi untuk cancel
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.red, // Warna latar belakang merah
                      padding: EdgeInsets.symmetric(
                          vertical: 15, horizontal: 30), // Ukuran tombol
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(10),
                      ),
                    ),
                    child: Text(
                      'CANCEL',
                      style: TextStyle(
                          color: Colors.white, fontWeight: FontWeight.bold),
                    ),
                  ),

                  // Tombol Submit
                  ElevatedButton(
                    onPressed: () {
                      // Tambahkan aksi untuk submit
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor:
                          Colors.green, // Warna latar belakang hijau
                      padding: EdgeInsets.symmetric(
                          vertical: 15, horizontal: 30), // Ukuran tombol
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(10),
                      ),
                    ),
                    child: Text(
                      'SUBMIT',
                      style: TextStyle(
                          color: Colors.white, fontWeight: FontWeight.bold),
                    ),
                  ),
                ],
              )
            ],
          ),
        ),
      ),
    );
  }
}
