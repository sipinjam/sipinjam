import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:http/http.dart' as http;
import 'package:sipit_app/models/peminjamModel.dart';

class PeminjamDatasource {
  Uri url = Uri.parse('${AppConstants.baseUrl}/users.php');

  Future<PeminjamModel?> login(
    String username,
    String password,
  ) async {
    final response = await http.post(url,
        headers: {"Content-Type": "application/json"},
        body: jsonEncode({
          "username": username,
          "password": password,
        }));

    if (response.statusCode == 200) {
      return peminjamModelFromJson(response.body);
    } else {
      throw Exception("Login Failed");
    }
  }
}
