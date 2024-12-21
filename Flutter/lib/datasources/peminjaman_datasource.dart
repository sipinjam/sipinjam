import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/peminjamanModel.dart';
import 'package:http/http.dart' as http;

class PeminjamanDatasource {
  Future<Map<DateTime, List<Map<String, dynamic>>>> fetchMarkedDates(
      String roomName) async {
    final response =
        await http.get(Uri.parse('${AppConstants.baseUrl}/peminjaman.php'));

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
          final date = DateTime.parse(peminjaman.tglPeminjaman.toString());
          final sesiPeminjaman = peminjaman.sesiPeminjaman;
          var sesiDisplay = '';
          Color? color;

          if (date.isBefore(DateTime.now())) {
            color = const Color(0xff615EFC);
          } else if (sesiPeminjaman == '1') {
            color = const Color.fromRGBO(241, 207, 77, 1);
            sesiDisplay = 'Pagi';
          } else if (sesiPeminjaman == '2') {
            color = const Color.fromRGBO(74, 222, 128, 1);
            sesiDisplay = 'Siang';
          } else if (sesiPeminjaman == '3') {
            color = const Color.fromRGBO(239, 68, 68, 1);
            sesiDisplay = 'Full Sesi';
          }

          if (markedDates.containsKey(date)) {
            for (var existingEvent in markedDates[date]!) {
              if ((sesiPeminjaman == '3') ||
                  (existingEvent['sesiPeminjaman'] == '1') ||
                  (existingEvent['sesiPeminjaman'] == '2')) {
                existingEvent['color'] = const Color.fromRGBO(239, 68, 68, 1);
                existingEvent['sesiDisplay'] = 'Full Sesi';
              }
            }
            markedDates[date]!.add({
              'color': color,
              'nama_kegiatan': peminjaman.namaKegiatan,
              'sesi': sesiDisplay,
              'status': peminjaman.namaStatus,
            });
          } else {
            markedDates[date] = [
              {
                'color': color,
                'nama_kegiatan': peminjaman.namaKegiatan,
                'sesi': sesiDisplay,
                'status': peminjaman.namaStatus,
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
