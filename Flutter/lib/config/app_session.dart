import 'dart:convert';

import 'package:shared_preferences/shared_preferences.dart';
import 'package:sipit_app/models/peminjamModel.dart';

class AppSession {
  static Future<void> savePeminjam(PeminjamModel peminjam) async {
    final pref = await SharedPreferences.getInstance();
    String peminjamString = jsonEncode(peminjam.toJson());
    await pref.setString('peminjamData', peminjamString);
  }

  static Future<bool> removePeminjam() async {
    final pref = await SharedPreferences.getInstance();
    bool success = await pref.remove('peminjamData');
    return success;
  }

  static Future<PeminjamModel?> getPeminjam() async {
    final pref = await SharedPreferences.getInstance();
    String? peminjamString = pref.getString('peminjamData');
    if (peminjamString == null) {
      return null;
    }

    var peminjamMap = jsonDecode(peminjamString);
    return PeminjamModel.fromJson(peminjamMap);
  }
}
