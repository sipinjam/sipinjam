// To parse this JSON data, do
//
//     final peminjamanModel = peminjamanModelFromJson(jsonString);

import 'dart:convert';

HistoryModel peminjamanModelFromJson(String str) =>
    HistoryModel.fromJson(json.decode(str));

String peminjamanModelToJson(HistoryModel data) =>
    json.encode(data.toJson());

class HistoryModel {
  int idPeminjaman;
  String namaKegiatan;
  String temaKegiatan;
  int idPeminjam;
  DateTime tglPeminjaman;
  String sesiPeminjaman;
  String daftarPanitia;
  String namaRuangan;
  String namaKetuaOrmawa;
  String namaKetuaPelaksana;
  String namaStatus;

  HistoryModel({
    required this.idPeminjaman,
    required this.namaKegiatan,
    required this.temaKegiatan,
    required this.idPeminjam,
    required this.tglPeminjaman,
    required this.sesiPeminjaman,
    required this.daftarPanitia,
    required this.namaRuangan,
    required this.namaKetuaOrmawa,
    required this.namaKetuaPelaksana,
    required this.namaStatus,
  });

  factory HistoryModel.fromJson(Map<String, dynamic> json) =>
      HistoryModel(
        idPeminjaman: json["id_peminjaman"],
        namaKegiatan: json["nama_kegiatan"],
        temaKegiatan: json["tema_kegiatan"],
        idPeminjam: json["id_ormawa"],
        tglPeminjaman: DateTime.parse(json["tgl_peminjaman"]),
        sesiPeminjaman: json["sesi_peminjaman"],
        daftarPanitia: json["daftar_panitia"],
        namaRuangan: json["nama_ruangan"],
        namaKetuaOrmawa: json["nama_ketua_ormawa"],
        namaKetuaPelaksana: json["nama_ketua_pelaksana"],
        namaStatus: json["nama_status"],
      );

  Map<String, dynamic> toJson() => {
        "id_peminjaman": idPeminjaman,
        "nama_kegiatan": namaKegiatan,
        "tema_kegiatan": temaKegiatan,
        "id_ormawa": idPeminjam,
        "tgl_peminjaman":
            "${tglPeminjaman.year.toString().padLeft(4, '0')}-${tglPeminjaman.month.toString().padLeft(2, '0')}-${tglPeminjaman.day.toString().padLeft(2, '0')}",
        "sesi_peminjaman": sesiPeminjaman,
        "daftar_panitia": daftarPanitia,
        "nama_ruangan": namaRuangan,
        "nama_ketua_ormawa": namaKetuaOrmawa,
        "nama_ketua_pelaksana": namaKetuaPelaksana,
        "nama_status": namaStatus,
      };
}
