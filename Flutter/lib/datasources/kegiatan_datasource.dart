import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/kegiatan_model.dart';
import 'package:http/http.dart' as http;

class KegiatanDatasource {
  final String urlKegiatan = '${AppConstants.baseUrl}/kegiatan.php';

  Future<List<KegiatanModel>> getAllKegiatan() async {
    final url = Uri.parse(urlKegiatan);
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final List<dynamic> ormawaData = data['data'];
      return ormawaData.map((json) => KegiatanModel.fromJson(json)).toList();
    } else {
      throw Exception('failed to load gedung list');
    }
  }

  Future<List<KegiatanModel>> getKegiatanByIdOrmawa(int? idOrmawa) async {
    if (idOrmawa == null) {
      return []; // Kembalikan daftar kosong jika idOrmawa null
    }

    try {
      final response = await http.get(Uri.parse(urlKegiatan));

      if (response.statusCode == 200) {
        final Map<String, dynamic> jsonResponse = json.decode(response.body);
        final List<dynamic> data = jsonResponse['data'];
        final List<KegiatanModel> kegiatanList =
            data.map((json) => KegiatanModel.fromJson(json)).toList();
        final kegiatanById = kegiatanList
            .where((kegiatan) => kegiatan.idOrmawa == idOrmawa)
            .toList();
        return kegiatanById;
      } else {
        throw Exception(
            'Failed to load data. Status code: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Error: $e');
    }
  }
}
