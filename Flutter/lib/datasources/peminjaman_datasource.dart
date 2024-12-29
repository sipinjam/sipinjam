import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/config/app_session.dart';
import 'package:sipit_app/models/peminjamanModel.dart';
import 'package:http/http.dart' as http;

class PeminjamanDatasource {
  final String url = '${AppConstants.baseUrl}/peminjaman.php';

  Future<Map<DateTime, List<Map<String, dynamic>>>> fetchMarkedDates(
      String roomName) async {
    final response = await http.get(Uri.parse(url));

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
          DateTime dayNow = DateTime.now();
          Color? color;

          print(dayNow);

          if (date.isBefore(dayNow)) {
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
            print('Events for date $date: ${markedDates[date]}');

            bool hasSesi1 = markedDates[date]!
                    .any((event) => event['sesi']?.trim() == 'Pagi') ||
                sesiPeminjaman == '1';
            bool hasSesi2 = markedDates[date]!
                    .any((event) => event['sesi']?.trim() == 'Siang') ||
                sesiPeminjaman == '2';

            print('date: $date, hasSesi1: $hasSesi1, hasSesi2: $hasSesi2');

            if (date.isBefore(dayNow)) {
              color = const Color(0xff615EFC);
            } else if ((sesiPeminjaman == '3') || (hasSesi1 && hasSesi2)) {
              for (var existingEvent in markedDates[date]!) {
                existingEvent['color'] = const Color.fromRGBO(239, 68, 68, 1);
                existingEvent['sesi'] = 'Full Sesi';
              }
              color = const Color.fromRGBO(239, 68, 68, 1);
              sesiDisplay = 'Full Sesi';
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

  // Future<PeminjamanModel?> postPeminjaman(
  //   int? idKegiatan,
  //   int? idRuangan,
  //   DateTime tglPeminjaman,
  //   String keterangan,
  //   String sesi,
  //   int idStatus,
  // ) async {
  //   try {
  //     final response = await http.post(Uri.parse(url),
  //         headers: {
  //           "Content-Type": "application/json",
  //         },
  //         body: jsonEncode({
  //           "id_ruangan": idRuangan,
  //           "id_kegiatan": idKegiatan,
  //           "id_status": idStatus,
  //           "tgl_peminjaman": tglPeminjaman.toIso8601String(),
  //           "sesi_peminjaman": sesi,
  //           "keterangan": keterangan
  //         }));

  //     print('Response Status: ${response.statusCode}');
  //     print(
  //         'Response Body: ${response.body}'); // Log the response body for debugging

  //     if (response.statusCode == 200) {
  //       final responseData = jsonDecode(response.body);
  //       return PeminjamanModel.fromJson(responseData);
  //     } else {
  //       print('Error: ${response.statusCode}');
  //       print('Response: ${response.body}'); // Detailed error response
  //     }
  //   } catch (e) {
  //     print('Error: $e');
  //   }
  //   return null;
  // }

  Future<PeminjamanModel?> postPeminjaman(
      List<Map<String, dynamic>> peminjaman) async {
    try {
      final response = await http.post(
        Uri.parse(url),
        headers: {
          "Content-Type": "application/json",
        },
        body: jsonEncode(peminjaman),
      );

      print('response status: ${response.statusCode}');
      print('response body: ${response.body}');

      if (response.statusCode == 201) {
        final responseData = jsonDecode(response.body);
        return PeminjamanModel.fromJson(responseData);
      } else {
        print('Error: ${response.statusCode}');
        print('response: ${response.body}');
      }
    } catch (e) {
      print(e);
    }
    return null;
  }

  Future<bool> checkRuanganAvailability(
    DateTime tanggal,
    String sesi,
    int? idRuangan,
  ) async {
    try {
      final response = await http
          .get(Uri.parse('$url?date=$tanggal&sesi=$sesi&ruangan=$idRuangan'));
      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        return data['data']['available'] as bool;
      } else {
        throw Exception('failed to fetch data');
      }
    } catch (e) {
      print('Error: $e');
      return false;
    }
  }

  Future<List<PeminjamanModel>> getPeminjamanByIdOrmawa(int? idOrmawa) async {
    final response = await http.get(Uri.parse(url));

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final List ruanganData = data['data'];

      // Filter data berdasarkan ID ormawa
      final List<PeminjamanModel> filteredByIdOrmawa = ruanganData
          .where((peminjaman) => peminjaman['id_ormawa'] == idOrmawa)
          .map<PeminjamanModel>((json) => PeminjamanModel.fromJson(json))
          .toList();

      return filteredByIdOrmawa; // Kembalikan hasil filter
    } else {
      throw Exception('Failed to load data ruangan');
    }
  }
}
