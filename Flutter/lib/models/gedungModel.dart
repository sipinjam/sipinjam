// To parse this JSON data, do
//
//     final gedungModel = gedungModelFromJson(jsonString);

import 'dart:convert';

GedungModel gedungModelFromJson(String str) =>
    GedungModel.fromJson(json.decode(str));

String gedungModelToJson(GedungModel data) => json.encode(data.toJson());

class GedungModel {
  int idGedung;
  String namaGedung;
  String fotoGedung;

  GedungModel({
    required this.idGedung,
    required this.namaGedung,
    required this.fotoGedung,
  });

  factory GedungModel.fromJson(Map<String, dynamic> json) => GedungModel(
        idGedung: json["id_gedung"],
        namaGedung: json["nama_gedung"],
        fotoGedung: json["foto_gedung"],
      );

  Map<String, dynamic> toJson() => {
        "id_gedung": idGedung,
        "nama_gedung": namaGedung,
        "foto_gedung": fotoGedung,
      };
}
