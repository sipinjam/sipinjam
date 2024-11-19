import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/peminjamanModel.dart';
import 'package:http/http.dart' as http;

class PeminjamanDatasource {
  Future<Map<DateTime, Map<String, dynamic>>> fetchMarkedDates(
      String roomName) async {
    final response =
        await http.get(Uri.parse('${AppConstants.baseUrl}/peminjaman'));

    if (response.statusCode == 200) {
      final Map<String, dynamic> jsonData = json.decode(response.body);
      final List<dynamic> data = jsonData['data'];

      final List<PeminjamanModel> peminjamanList =
          data.map((item) => PeminjamanModel.fromJson(item)).toList();

      final markedDates = <DateTime, Map<String, dynamic>>{};

      for (var peminjaman in peminjamanList) {
        if (peminjaman.namaRuangan
                .toLowerCase()
                .contains(roomName.toLowerCase()) &&
            peminjaman.namaStatus != 'ditolak') {
          final date = DateTime.parse(peminjaman.tanggalKegiatan.toString());
          final startTime = peminjaman.waktuMulai;
          final endTime = peminjaman.waktuSelesai;
          final color = (startTime == '08:00:00' && endTime == '12:00:00')
              ? Color.fromRGBO(241, 207, 77, 1)
              : (startTime == '12:00:00' && endTime == '16:00:00')
                  ? Color.fromRGBO(74, 222, 128, 1)
                  : (startTime == '08:00:00' && endTime == '16:00:00')
                      ? Color.fromRGBO(239, 68, 68, 1)
                      : null;

          if (color != null) {
            markedDates[date] = {
              'color': color,
              'nama_kegiatan': peminjaman.namaKegiatan,
              'waktu': '$startTime - $endTime',
              'nama_ormawa': peminjaman.namaOrmawa,
              'status': peminjaman.namaStatus,
            };
          }
        }
      }

      return markedDates;
    } else {
      throw Exception('Gagal memuat data');
    }
  }
}
