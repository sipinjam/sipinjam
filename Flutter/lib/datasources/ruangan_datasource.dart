import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:sipit_app/models/ruanganModel.dart';

class RuanganService {
  final String baseUrl = 'http://localhost/sipinjamfix/sipinjam/api/ruangan';

  Future<Ruangan> getRuanganById(int idRuangan) async {
    final response = await http.get(Uri.parse('$baseUrl/$idRuangan'));

    if (response.statusCode == 200) {
      final Map<String, dynamic> jsonResponse = json.decode(response.body);
      final ruanganModel = RuanganModel.fromJson(jsonResponse);
      return ruanganModel.data.first;
    } else {
      throw Exception('Failed to load ruangan');
    }
  }
}