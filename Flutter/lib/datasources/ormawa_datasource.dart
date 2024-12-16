import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/OrmawaModel.dart';
import 'package:http/http.dart' as http;

class OrmawaDatasource {
  final ormawaUrl = '${AppConstants.baseUrl}/ormawa';
  Future<List<OrmawaModel>> getAllOrmawa() async {
    final url = Uri.parse(ormawaUrl);
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final List<dynamic> ormawaData = data['data'];
      return ormawaData.map((json) => OrmawaModel.fromJson(json)).toList();
    } else {
      throw Exception('failed to load gedung list');
    }
  }

  Future<OrmawaModel> getOrmawaById(int idOrmawa) async {
    final url = Uri.parse('$ormawaUrl?id_ormawa=$idOrmawa');
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final Map<String, dynamic> jsonResponse = json.decode(response.body);

      if (jsonResponse['data'] != null) {
        return OrmawaModel.fromJson(jsonResponse['data']);
      } else {
        throw Exception("Data ormawa tidak ditemukan.");
      }
    } else {
      throw Exception("Failed to fetch ormawa data.");
    }
  }
}
