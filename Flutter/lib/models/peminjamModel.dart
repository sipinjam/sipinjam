// To parse this JSON data, do
//
//     final peminjamModel = peminjamModelFromJson(jsonString);

import 'dart:convert';

PeminjamModel peminjamModelFromJson(String str) =>
    PeminjamModel.fromJson(json.decode(str));

String peminjamModelToJson(PeminjamModel data) => json.encode(data.toJson());

// Menghapus List dari konstruktor utama
class PeminjamModel {
  Peminjam peminjam;

  PeminjamModel({
    required this.peminjam,
  });

  factory PeminjamModel.fromJson(Map<String, dynamic> json) => PeminjamModel(
        peminjam: Peminjam.fromJson(json["peminjam"]),
      );

  Map<String, dynamic> toJson() => {
        "peminjam": peminjam.toJson(),
      };
}


class Peminjam {
  int idPeminjam;
  String namaPeminjam;
  String email;

  Peminjam({
    required this.idPeminjam,
    required this.namaPeminjam,
    required this.email,
  });

  factory Peminjam.fromJson(Map<String, dynamic> json) => Peminjam(
        idPeminjam: json["id_peminjam"],
        namaPeminjam: json["nama_peminjam"],
        email: json["email"],
      );

  Map<String, dynamic> toJson() => {
        "id_peminjam": idPeminjam,
        "nama_peminjam": namaPeminjam,
        "email": email,
      };
}
