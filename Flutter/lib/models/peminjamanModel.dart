// To parse this JSON data, do
//
//     final peminjamanModel = peminjamanModelFromJson(jsonString);

import 'dart:convert';

PeminjamanModel peminjamanModelFromJson(String str) =>
    PeminjamanModel.fromJson(json.decode(str));

String peminjamanModelToJson(PeminjamanModel data) =>
    json.encode(data.toJson());

class PeminjamanModel {
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

  PeminjamanModel({
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

  factory PeminjamanModel.fromJson(Map<String, dynamic> json) =>
      PeminjamanModel(
        idPeminjaman: json["id_peminjaman"],
        namaKegiatan: json["nama_kegiatan"],
        temaKegiatan: json["tema_kegiatan"],
        idPeminjam: json["id_peminjam"],
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
        "id_peminjam": idPeminjam,
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
