import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/daftarRuanganModel.dart';
import 'package:http/http.dart' as http;

class RuanganDatasource {
  String ruanganUrl = '${AppConstants.baseUrl}/ruangan.php';

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

  Future<List<DaftarRuanganModel?>> fetchRuangan(int ruanganId) async {
    final response = await http.get(Uri.parse('$ruanganUrl?id=$ruanganId'));

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);

      if (data is Map<String, dynamic> &&
          data['data'] is Map<String, dynamic>) {
        final ruanganData = data['data'] as Map<String, dynamic>;
        print(ruanganData);

        // Bungkus objek ke dalam list
        return [DaftarRuanganModel.fromJson(ruanganData)];
      } else {
        throw Exception('Unexpected JSON structure');
      }
    } else {
      throw Exception('Failed to load data');
    }
  }

  Future<List<DaftarRuanganModel>> fetchRuanganNonRequired() async {
    final response = await http.get(Uri.parse(ruanganUrl));
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
