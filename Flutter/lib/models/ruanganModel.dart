import 'dart:convert';

import 'package:sipit_app/config/app_constant.dart';

// Function to parse JSON string into RuanganModel
RuanganModel ruanganModelFromJson(String str) =>
    RuanganModel.fromJson(json.decode(str));

// Function to convert RuanganModel to JSON string
String ruanganModelToJson(RuanganModel data) => json.encode(data.toJson());

class RuanganModel {
  String status;
  String message;
  Ruangan data; // Contains a single Ruangan object
  int code;

  RuanganModel({
    required this.status,
    required this.message,
    required this.data,
    required this.code,
  });

  factory RuanganModel.fromJson(Map<String, dynamic> json) => RuanganModel(
        status: json["status"],
        message: json["message"],
        data: Ruangan.fromJson(json["data"]), // Parse the single Ruangan object
        code: json["code"],
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "message": message,
        "data": data.toJson(),
        "code": code,
      };
}

class Ruangan {
  String namaRuangan;
  String namaGedung;
  String deskripsiRuangan;
  int kapasitas;
  String namaPeminjam;
  String? namaFasilitas; // This can be null
  List<String> fotoRuangan;

  Ruangan({
    required this.namaRuangan,
    required this.namaGedung,
    required this.deskripsiRuangan,
    required this.kapasitas,
    required this.namaPeminjam,
    this.namaFasilitas,
    required this.fotoRuangan,
  });

  factory Ruangan.fromJson(Map<String, dynamic> json) => Ruangan(
        namaRuangan: json["nama_ruangan"],
        namaGedung: json["nama_gedung"],
        deskripsiRuangan: json["deskripsi_ruangan"],
        kapasitas: json["kapasitas"],
        namaPeminjam: json["nama_peminjam"],
        namaFasilitas: json["nama_fasilitas"],
        fotoRuangan: List<String>.from(json["foto_ruangan"].map((x) {
          // Prepend the base URL to each photo path
          return 'http://${AppConstants.apiUrl}/assets/ruangan/$x';
        })), // Ensure correct type
      );

  Map<String, dynamic> toJson() => {
        "nama_ruangan": namaRuangan,
        "nama_gedung": namaGedung,
        "deskripsi_ruangan": deskripsiRuangan,
        "kapasitas": kapasitas,
        "nama_peminjam": namaPeminjam,
        "nama_fasilitas": namaFasilitas,
        "foto_ruangan": List<dynamic>.from(fotoRuangan.map((x) => x)),
      };
}
