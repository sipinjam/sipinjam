// To parse this JSON data, do
//
//     final daftarRuanganModel = daftarRuanganModelFromJson(jsonString);

import 'dart:convert';

DaftarRuanganModel daftarRuanganModelFromJson(String str) =>
    DaftarRuanganModel.fromJson(json.decode(str));

String daftarRuanganModelToJson(DaftarRuanganModel data) =>
    json.encode(data.toJson());

class DaftarRuanganModel {
  final int idRuangan;
  final String namaRuangan;
  final String namaGedung;
  final int idGedung;
  final String deskripsiRuangan;
  final int kapasitas;
  final String namaPeminjam;
  final String namaFasilitas;
  final List<String>? fotoRuangan;

  DaftarRuanganModel({
    required this.idRuangan,
    required this.namaRuangan,
    required this.namaGedung,
    required this.idGedung,
    required this.deskripsiRuangan,
    required this.kapasitas,
    required this.namaPeminjam,
    required this.namaFasilitas,
    required this.fotoRuangan,
  });

  factory DaftarRuanganModel.fromJson(Map<String, dynamic> json) {
    return DaftarRuanganModel(
      idRuangan: json['id_ruangan'] ?? 0,
      namaRuangan: json['nama_ruangan'] ?? '',
      namaGedung: json['nama_gedung'] ?? '',
      idGedung: json['id_gedung'] ?? 0,
      deskripsiRuangan: json['deskripsi_ruangan'] ?? '',
      kapasitas: json['kapasitas'] ?? 0,
      namaPeminjam: json['nama_peminjam'] ?? '',
      namaFasilitas: json['nama_fasilitas'] ?? '',
      fotoRuangan: List<String>.from(json['foto_ruangan'] ?? []),
    );
  }

  Map<String, dynamic> toJson() => {
        "id_ruangan": idRuangan,
        "nama_ruangan": namaRuangan,
        "nama_gedung": namaGedung,
        "id_gedung": idGedung,
        "deskripsi_ruangan": deskripsiRuangan ?? "",
        "kapasitas": kapasitas ?? 0,
        "nama_peminjam": namaPeminjam ?? "",
        "nama_fasilitas": namaFasilitas ?? "",
        "foto_ruangan": fotoRuangan ?? [],
      };

  @override
  String toString() {
    return namaRuangan; // Mengembalikan nama gedung sebagai representasi
  }
}
