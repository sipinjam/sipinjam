import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/datasources/kegiatan_datasource.dart';
import 'package:sipit_app/models/kegiatan_model.dart';
import 'package:sipit_app/models/peminjamModel.dart';
import 'package:sipit_app/theme.dart';

class PeminjamanPage extends StatefulWidget {
  const PeminjamanPage({super.key});

  @override
  State<PeminjamanPage> createState() => _PeminjamanPageState();
}

class _PeminjamanPageState extends State<PeminjamanPage> {
  // Future<PeminjamModel?> peminjam = AppSession.getPeminjam();
  final KegiatanDatasource _kegiatanDatasource = KegiatanDatasource();
  List<KegiatanModel?> _kegiatan = [];
  String? _selectedKegiatan;

  Future<void> getKegiatan(int? idOrmawa) async {
    try {
      final kegiatans =
          await _kegiatanDatasource.getKegiatanByIdOrmawa(idOrmawa);
      print(kegiatans);
      setState(() {
        _kegiatan = kegiatans;
      });
    } catch (e) {
      print('Error: $e');
    }
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

  @override
  void initState() {
    super.initState();
    loadPeminjamAndKegiatan();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        padding: EdgeInsets.symmetric(vertical: 30, horizontal: 10),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Container(
              width: MediaQuery.sizeOf(context).width,
              child: Text(
                'Peminjaman',
                style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
              ),
            ),
            Card(
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
                          color: biruTua),
                    ),
                    Container(
                      margin: EdgeInsets.only(top: 10),
                      width: MediaQuery.sizeOf(context).width,
                      child: DropdownMenu<KegiatanModel?>(
                        width: MediaQuery.sizeOf(context).width,
                        hintText: 'Pilih Kegiatan',
                        dropdownMenuEntries: _kegiatan.map((kegiatanName) {
                          return DropdownMenuEntry(
                              value: kegiatanName,
                              label: kegiatanName!.namaKegiatan);
                        }).toList(),
                        onSelected: (kegiatan) {
                          setState(() {
                            _selectedKegiatan = kegiatan.toString();
                          });
                        },
                      ),
                    )
                  ],
                ),
              ),
            )
          ],
        ),
      ),
    );
  }
}
