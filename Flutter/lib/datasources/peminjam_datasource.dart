import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/config/app_session.dart';
// import 'package:sipit_app/datasources/ormawa_datasource.dart';
import 'package:sipit_app/models/peminjamModel.dart';
import 'package:http/http.dart' as http;

class PeminjamDatasource {
  Uri loginUrl = Uri.parse('${AppConstants.baseUrl}/authentications.php');
  // OrmawaDatasource ormawaDatasource = OrmawaDatasource();

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

      // Ambil data dari objek `data`
      final data = jsonResponse['data'];

      // Cek apakah `data` tidak null dan berisi `id_peminjam`
      if (data != null &&
          data.containsKey('id_peminjam') &&
          data['id_peminjam'] != null) {
        final int idPeminjam = data['id_peminjam'];
        print(idPeminjam);

        // Panggil fetchPeminjam menggunakan `id_peminjam`
        return await fetchPeminjam(idPeminjam);
      } else {
        throw Exception("id_peminjam tidak ditemukan dalam respons");
      }
    } else {
      throw Exception("Login Failed");
    }
  }

  Future<PeminjamModel> fetchPeminjam(int idPeminjam) async {
    final response = await http.get(
      Uri.parse('${AppConstants.baseUrl}/users.php?id=$idPeminjam'),
    );

    if (response.statusCode == 200) {
      final Map<String, dynamic> jsonResponse = json.decode(response.body);

      if (jsonResponse['data'] != null) {
        final peminjam = PeminjamModel.fromJson(jsonResponse['data']);

        await AppSession.savePeminjam(peminjam); // Pastikan ini dijalankan
        return peminjam;
      } else {
        throw Exception("Data peminjam tidak ditemukan dalam respons");
      }
    } else {
      throw Exception("Failed to fetch profile data");
    }
  }
}
