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
}
