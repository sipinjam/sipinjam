import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/peminjamanModel.dart';
import 'package:http/http.dart' as http;

class PeminjamanDatasource {
  Future<Map<DateTime, List<Map<String, dynamic>>>> fetchMarkedDates(
      String roomName) async {
    final response =
        await http.get(Uri.parse('${AppConstants.baseUrl}/peminjaman'));

    if (response.statusCode == 200) {
      final Map<String, dynamic> jsonData = json.decode(response.body);
      final List<dynamic> data = jsonData['data'];

      final List<PeminjamanModel> peminjamanList =
          data.map((item) => PeminjamanModel.fromJson(item)).toList();

      final markedDates = <DateTime, List<Map<String, dynamic>>>{};

      for (var peminjaman in peminjamanList) {
        if (peminjaman.namaRuangan
                .toLowerCase()
                .contains(roomName.toLowerCase()) &&
            peminjaman.namaStatus != 'ditolak') {
          final date = DateTime.parse(peminjaman.tanggalKegiatan.toString());
          final startTime = peminjaman.waktuMulai;
          final endTime = peminjaman.waktuSelesai;
          Color? color;

          if (date.isBefore(DateTime.now())) {
            color = const Color(0xff615EFC);
          } else if (startTime == '08:00:00' && endTime == '12:00:00') {
            color = const Color.fromRGBO(241, 207, 77, 1);
          } else if (startTime == '08:00:00' && endTime == '12:00:00') {
            color = const Color.fromRGBO(74, 222, 128, 1);
          } else if (startTime == '08:00:00' && endTime == '12:00:00') {
            color = const Color.fromRGBO(239, 68, 68, 1);
          } else {
            null;
          }

          if (markedDates.containsKey(date)) {
            for (var existingEvent in markedDates[date]!) {
              if ((startTime == '08:00:00' && endTime == '16:00:00') ||
                  (existingEvent['start_time'] == '08:00:00' &&
                      endTime == '16:00:00') ||
                  (startTime == '08:00:00' &&
                      existingEvent['end_time'] == '16:00:00')) {
                existingEvent['start_time'] = '08:00:00';
                existingEvent['end_time'] = '16:00:00';
                existingEvent['color'] = const Color.fromRGBO(239, 68, 68, 1);
              }
            }
            markedDates[date]!.add({
              'color': color,
              'nama_kegiatan': peminjaman.namaKegiatan,
              'waktu': '$startTime - $endTime',
              'nama_ormawa': peminjaman.namaOrmawa,
              'status': peminjaman.namaStatus,
              'start_time': startTime,
              'end_time': endTime,
            });
          } else {
            markedDates[date] = [
              {
                'color': color,
                'nama_kegiatan': peminjaman.namaKegiatan,
                'waktu': '$startTime - $endTime',
                'nama_ormawa': peminjaman.namaOrmawa,
                'status': peminjaman.namaStatus,
                'start_time': startTime,
                'end_time': endTime,
              }
            ];
          }
        }
      }

      return markedDates;
    } else {
      throw Exception('Gagal memuat data');
    }
  }
}
