import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/peminjamanModel.dart';
import 'package:http/http.dart' as http;

class PeminjamanDatasource {
  Future<Set<DateTime>> fetchMarkedDates(String roomName) async {
    final response =
        await http.get(Uri.parse('${AppConstants.baseUrl}/peminjaman'));

    if (response.statusCode == 200) {
      final Map<String, dynamic> jsonData = json.decode(response.body);
      final List<dynamic> data = jsonData['data'];

      final List<PeminjamanModel> peminjamanList =
          data.map((item) => PeminjamanModel.fromJson(item)).toList();

      return peminjamanList
          .where((peminjaman) => peminjaman.namaRuangan
              .toLowerCase()
              .contains(roomName.toLowerCase()))
          .map((peminjaman) => peminjaman.tanggalKegiatan)
          .toSet();
    } else {
      throw Exception('Gagal memuat data');
    }
  }
}
