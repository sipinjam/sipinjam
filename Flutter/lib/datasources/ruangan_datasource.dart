import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/daftarRuanganModel.dart';
import 'package:http/http.dart' as http;

class RuanganDatasource {
  Future<List<daftarRuanganModel>> fetchRuanganList(int gedungId) async {
    final queryParams = gedungId != null ? '?idGedung=$gedungId' : '';
    final url = Uri.parse('${AppConstants.baseUrl}/ruangan$queryParams');
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final List<dynamic> gedungData = data['data'];
      return gedungData
          .map((json) => daftarRuanganModel.fromJson(json))
          .toList();
    } else {
      throw Exception('failed to load ruangan list');
    }
  }
}
