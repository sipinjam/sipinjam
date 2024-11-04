import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/peminjamModel.dart';
import 'package:http/http.dart' as http;

class PeminjamDatasource {
  Uri loginUrl = Uri.parse('${AppConstants.baseUrl}/authentications.php');

  Future<PeminjamModel> login(
    String namaPeminjam,
    String password,
  ) async {
    final response = await http.post(
      loginUrl,
      headers: {"Content-Type": "application/json"},
      body: jsonEncode({
        "nama_peminjam": namaPeminjam,
        "password": password,
      }),
    );

    if (response.statusCode == 200) {
      final Map<String, dynamic> jsonResponse = json.decode(response.body);

      if (jsonResponse.containsKey("peminjam")) {
        return PeminjamModel.fromJson(jsonResponse["peminjam"]);
      } else {
        return PeminjamModel.fromJson(jsonResponse);
      }
    } else {
      throw Exception("Login Failed");
    }
  }
}
