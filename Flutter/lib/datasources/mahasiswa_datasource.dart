import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/mahasiswaModel.dart';
import 'package:http/http.dart' as http;

class MahasiswaDatasource {
  String urlMahasiswa = '${AppConstants.baseUrl}/mahasiswa.php';

  Future<List<MahasiswanModel>> getAllMahasiswa() async {
    final response = await http.get(Uri.parse(urlMahasiswa));
    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final List<dynamic> mahasiswaData = data['data'];
      return mahasiswaData
          .map((mahasiswa) => MahasiswanModel.fromJson(mahasiswa))
          .toList();
    } else {
      throw Exception('failed to load data Mahasiswa');
    }
  }
}
