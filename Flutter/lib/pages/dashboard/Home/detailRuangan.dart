import 'package:d_info/d_info.dart';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/config/nav.dart';
import 'package:sipit_app/datasources/ruangan_datasource.dart';
import 'package:sipit_app/models/daftarRuanganModel.dart';
import 'package:sipit_app/pages/dashboardPage.dart';
import 'package:sipit_app/pages/dashboard/PeminjamanForm/peminjaman.dart';
import 'package:sipit_app/config/widget.dart';
import 'package:http/http.dart' as http;
import 'package:sipit_app/models/ruanganModel.dart';
import 'dart:convert';

import 'package:sipit_app/theme.dart';

class detailRuanganPage extends StatefulWidget {
  final int ruanganId;

  const detailRuanganPage({super.key, required this.ruanganId});

  @override
  _detailRuanganPageState createState() => _detailRuanganPageState();
}

class _detailRuanganPageState extends State<detailRuanganPage> {
  final RuanganDatasource _ruanganDatasource = RuanganDatasource();
  List<DaftarRuanganModel?> _ruangans = [];
  String? selectedImage;
  bool isLoading = true;

  final Map<String, IconData> fasilitasIcons = {
    "Ac": Icons.ac_unit_rounded,
    "Proyektor": Icons.videocam_rounded,
    "Wifi": Icons.wifi,
    "Seat": Icons.chair,
  };

  Future<void> fetchRuangans() async {
    try {
      final ruangans = await _ruanganDatasource.fetchRuangan(widget.ruanganId);
      setState(() {
        _ruangans = ruangans;
        selectedImage = _ruangans.first!.fotoRuangan!.isNotEmpty == true
            ? "${AppConstants.apiUrl}${_ruangans.first!.fotoRuangan!.first.replaceAll("../../../api/", "/")}"
            : null;
        print(_ruangans);
        isLoading = false;
      });
    } catch (e) {
      setState(() {
        isLoading = false;
      });
      print('Error: $e');
    }
  }

  @override
  void initState() {
    super.initState();
    fetchRuangans();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: ListView(children: [
        Column(
          children: [
            Padding(
              padding: const EdgeInsets.symmetric(vertical: 8),
              child: Row(
                children: [
                  IconButton(
                      onPressed: () {
                        Navigator.pop(context);
                      },
                      icon: const Icon(
                        Icons.keyboard_arrow_left_rounded,
                        size: 25,
                      )),
                  const SizedBox(width: 8),
                  const Text(
                    'Detail Ruangan',
                    style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                  ),
                ],
              ),
            ),
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 10),
              child: isLoading
                  ? const Center(
                      child: CircularProgressIndicator(),
                    )
                  : Container(
                      width: MediaQuery.sizeOf(context).width,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          if (selectedImage != null)
                            Container(
                              width: double.infinity,
                              height: 400,
                              decoration: BoxDecoration(
                                borderRadius:
                                    BorderRadius.all(Radius.circular(14)),
                                image: DecorationImage(
                                    image: NetworkImage(selectedImage!),
                                    fit: BoxFit.cover),
                              ),
                              child: Stack(
                                  alignment: Alignment.bottomCenter,
                                  children: [
                                    Container(
                                      padding: EdgeInsets.only(left: 16),
                                      width: MediaQuery.sizeOf(context).width,
                                      height: 100,
                                      decoration: BoxDecoration(
                                        borderRadius: BorderRadius.vertical(
                                            bottom: Radius.circular(14)),
                                        color: const Color.fromARGB(
                                            87, 158, 158, 158),
                                      ),
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        mainAxisAlignment:
                                            MainAxisAlignment.spaceEvenly,
                                        children: [
                                          Text(
                                            _ruangans.first!.namaGedung,
                                            style: TextStyle(
                                                fontSize: 24,
                                                fontWeight: FontWeight.w600,
                                                color: putih),
                                          ),
                                          Text(
                                            _ruangans.first!.namaRuangan,
                                            style: TextStyle(
                                                fontSize: 20,
                                                fontWeight: FontWeight.w400,
                                                color: putih),
                                          ),
                                          SizedBox(
                                            child: Row(
                                              children: [
                                                Icon(
                                                  Icons.groups_rounded,
                                                  size: 16,
                                                  color: putih,
                                                ),
                                                Text(
                                                  '${_ruangans.first!.kapasitas}',
                                                  style: TextStyle(
                                                      fontSize: 16,
                                                      fontWeight:
                                                          FontWeight.w400,
                                                      color: putih),
                                                )
                                              ],
                                            ),
                                          )
                                        ],
                                      ),
                                    ),
                                  ]),
                            )
                          else
                            Container(
                              width: double.infinity,
                              height: 300,
                              color: Colors.grey,
                              child: const Center(
                                child: Text('Tidak ada foto'),
                              ),
                            ),
                          const SizedBox(
                            height: 8,
                          ),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: _ruangans.first!.namaFasilitas
                                .split(',')
                                .map((fasilitas) {
                              final icon = fasilitasIcons[fasilitas.trim()] ??
                                  Icons.device_unknown;
                              return Padding(
                                padding: const EdgeInsets.only(left: 8),
                                child: Column(
                                  children: [
                                    Icon(
                                      icon,
                                      size: 40,
                                    ),
                                    const SizedBox(
                                        height:
                                            4), // Perbaikan: gunakan `height` untuk spacing vertikal
                                    Text(
                                      fasilitas.trim(),
                                      style: const TextStyle(fontSize: 16),
                                    ),
                                  ],
                                ),
                              );
                            }).toList(), // Perbaikan: tambahkan `.toList()` untuk mengubah iterable menjadi `List<Widget>`
                          ),
                          const SizedBox(
                            height: 8,
                          ),
                          SizedBox(
                              height: 120,
                              child: ListView.builder(
                                scrollDirection: Axis.horizontal,
                                itemCount:
                                    _ruangans.first!.fotoRuangan!.length ?? 0,
                                itemBuilder: (context, index) {
                                  final foto =
                                      "${AppConstants.apiUrl}${_ruangans.first!.fotoRuangan![index].replaceAll("../../../api/", "/")}";
                                  return GestureDetector(
                                    onTap: () {
                                      setState(() {
                                        selectedImage = foto;
                                      });
                                    },
                                    child: Container(
                                      margin: const EdgeInsets.symmetric(
                                          horizontal: 5),
                                      width: 100,
                                      height: 100,
                                      decoration: BoxDecoration(
                                          border: Border.all(
                                            color: foto == selectedImage
                                                ? Colors.blue
                                                : Colors.grey,
                                            width:
                                                foto == selectedImage ? 2 : 0,
                                          ),
                                          borderRadius: BorderRadius.all(
                                              Radius.circular(10)),
                                          image: DecorationImage(
                                              image: NetworkImage(foto),
                                              fit: BoxFit.cover)),
                                    ),
                                  );
                                },
                              ))
                        ],
                      ),
                    ),
            )
          ],
        ),
      ]),
    );
  }
}
