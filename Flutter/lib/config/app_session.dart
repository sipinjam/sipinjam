import 'dart:convert';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sipit_app/models/peminjamModel.dart';

class AppSession {
  static Future<int> getUserId() async {
    // Mengambil data peminjam dari SharedPreferences
    final pref = await SharedPreferences.getInstance();
    String? peminjamString = pref.getString('peminjamData');
    
    // Jika data peminjam tidak ditemukan, kembalikan id default
    if (peminjamString == null) {
      return -1; // Menandakan tidak ada pengguna yang login
    }

    // Decode data peminjam dan ambil idPeminjam
    var peminjamMap = jsonDecode(peminjamString);
    PeminjamModel peminjam = PeminjamModel.fromJson(peminjamMap);

    // Mengembalikan idPeminjam dari model
    return peminjam.idPeminjam ?? -1; // Default -1 jika null
  }

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
