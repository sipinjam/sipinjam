import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:sipit_app/models/peminjamModel.dart';
import '../config/failure.dart';

class PeminjamDatasource {
  final String baseUrl =
      'http://localhost/sipinjamfix/sipinjam/api'; // Sesuaikan dengan API kamu

  Future<PeminjamModel?> login(String namaPeminjam, String password) async {
    final url = Uri.parse('$baseUrl/authentications');
    final headers = {'Content-Type': 'application/json'};
    final body = jsonEncode({
      'nama_peminjam': namaPeminjam,
      'password': password,
    });

    try {
      final response = await http.post(url, headers: headers, body: body);

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        return PeminjamModel.fromJson(data);
      } else {
        throw Failure('Login failed: ${response.statusCode}');
      }
    } catch (e) {
      throw Failure('Login error: $e');
    }
  }
}
