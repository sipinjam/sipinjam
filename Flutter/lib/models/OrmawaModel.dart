// To parse this JSON data, do
//
//     final ormawaModel = ormawaModelFromJson(jsonString);

import 'dart:convert';

OrmawaModel ormawaModelFromJson(String str) =>
    OrmawaModel.fromJson(json.decode(str));

String ormawaModelToJson(OrmawaModel data) => json.encode(data.toJson());

class OrmawaModel {
  int idOrmawa;
  String namaOrmawa;
  int idMahasiswa;

  OrmawaModel({
    required this.idOrmawa,
    required this.namaOrmawa,
    required this.idMahasiswa,
  });

  factory OrmawaModel.fromJson(Map<String, dynamic> json) => OrmawaModel(
        idOrmawa: json["id_ormawa"],
        namaOrmawa: json["nama_ormawa"],
        idMahasiswa: json["id_mahasiswa"],
      );

  Map<String, dynamic> toJson() => {
        "id_ormawa": idOrmawa,
        "nama_ormawa": namaOrmawa,
        "id_mahasiswa": idMahasiswa,
      };
}
