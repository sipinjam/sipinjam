import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/daftarRuanganModel.dart';
import 'package:http/http.dart' as http;

class RuanganDatasource {
  String ruanganUrl = '${AppConstants.baseUrl}/ruangan';

  Future<List<DaftarRuanganModel>> fetchRuanganList(int gedungId) async {
    final queryParams = gedungId != null ? '?idGedung=$gedungId' : '';
    final url = Uri.parse('$ruanganUrl$queryParams');
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final List<dynamic> gedungData = data['data'];
      return gedungData
          .map((json) => DaftarRuanganModel.fromJson(json))
          .toList();
    } else {
      throw Exception('failed to load ruangan list');
    }
  }

  Future<DaftarRuanganModel?> fetchRuangan(int ruanganId) async {
    final response = await http.get(Uri.parse('$ruanganUrl/$ruanganId'));

    if (response == 200) {
      final jsonResponse = jsonDecode(response.body);
      print(jsonResponse);
      if (jsonResponse['status'] == 'success') {
        return DaftarRuanganModel.fromJson(jsonResponse['data']);
      }
    }
    return null;
  }

  Future<List<DaftarRuanganModel>> fetchRuanganNonRequired() async {
    final response = await http.get(Uri.parse('$ruanganUrl'));
    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final List<dynamic> ruanganData = data['data'];
      return ruanganData
          .map((json) => DaftarRuanganModel.fromJson(json))
          .toList();
    } else {
      throw Exception('failed to load data ruangan');
    }
  }
}
