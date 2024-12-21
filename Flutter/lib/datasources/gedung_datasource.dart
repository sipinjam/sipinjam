import 'dart:convert';

import 'package:http/http.dart' as http;
import 'package:sipit_app/config/app_constant.dart';
import 'package:sipit_app/models/gedungModel.dart';

class GedungDatasource {
  Future<List<GedungModel>> fetchGedungList() async {
    final url = Uri.parse('${AppConstants.baseUrl}/gedung.php');
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final List<dynamic> gedungData = data['data'];
      return gedungData.map((json) => GedungModel.fromJson(json)).toList();
    } else {
      throw Exception('failed to load gedung list');
    }
  }
}
