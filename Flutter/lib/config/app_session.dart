import 'dart:convert';

import 'package:shared_preferences/shared_preferences.dart';
import 'package:sipit_app/models/peminjamModel.dart';

class AppSession {
  static Future<PeminjamModel?> getPeminjam() async {
    final pref = await SharedPreferences.getInstance();
    String? peminjamString = pref.getString('namaPeminjam');
    if (peminjamString == null) {
      return null;
    }

    var peminjamMap = jsonDecode(peminjamString);
    return PeminjamModel.fromJson(peminjamMap);
  }

  static Future<bool> removePeminjam() async {
    final pref = await SharedPreferences.getInstance();
    bool success = await pref.remove('namaPeminjam');
    return success;
  }
}
