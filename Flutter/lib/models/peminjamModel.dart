// To parse this JSON data, do
//
//     final peminjamModel = peminjamModelFromJson(jsonString);

import 'dart:convert';

PeminjamModel peminjamModelFromJson(String str) =>
    PeminjamModel.fromJson(json.decode(str));

String peminjamModelToJson(PeminjamModel data) => json.encode(data.toJson());

class PeminjamModel {
  List<Peminjam> peminjams;

  PeminjamModel({
    required this.peminjams,
  });

  factory PeminjamModel.fromJson(Map<String, dynamic> json) => PeminjamModel(
        peminjams: List<Peminjam>.from(
            json["peminjams"].map((x) => Peminjam.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "peminjams": List<dynamic>.from(peminjams.map((x) => x.toJson())),
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
