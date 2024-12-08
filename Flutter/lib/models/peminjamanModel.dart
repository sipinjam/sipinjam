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
  DateTime tanggalKegiatan;
  String waktuMulai;
  String waktuSelesai;
  String daftarPanitia;
  String namaRuangan;
  String namaKetuaOrmawa;
  String namaKetuaPelaksana;
  String namaPeminjam;
  String namaStatus;

  PeminjamanModel({
    required this.idPeminjaman,
    required this.namaKegiatan,
    required this.temaKegiatan,
    required this.tanggalKegiatan,
    required this.waktuMulai,
    required this.waktuSelesai,
    required this.daftarPanitia,
    required this.namaRuangan,
    required this.namaKetuaOrmawa,
    required this.namaKetuaPelaksana,
    required this.namaPeminjam,
    required this.namaStatus,
  });

  factory PeminjamanModel.fromJson(Map<String, dynamic> json) =>
      PeminjamanModel(
        idPeminjaman: json["id_peminjaman"],
        namaKegiatan: json["nama_kegiatan"],
        temaKegiatan: json["tema_kegiatan"],
        tanggalKegiatan: DateTime.parse(json["tanggal_kegiatan"]),
        waktuMulai: json["waktu_mulai"],
        waktuSelesai: json["waktu_selesai"],
        daftarPanitia: json["daftar_panitia"],
        namaRuangan: json["nama_ruangan"],
        namaKetuaOrmawa: json["nama_ketua_ormawa"],
        namaKetuaPelaksana: json["nama_ketua_pelaksana"],
        namaPeminjam: json["nama_peminjam"],
        namaStatus: json["nama_status"],
      );

  Map<String, dynamic> toJson() => {
        "id_peminjaman": idPeminjaman,
        "nama_kegiatan": namaKegiatan,
        "tema_kegiatan": temaKegiatan,
        "tanggal_kegiatan":
            "${tanggalKegiatan.year.toString().padLeft(4, '0')}-${tanggalKegiatan.month.toString().padLeft(2, '0')}-${tanggalKegiatan.day.toString().padLeft(2, '0')}",
        "waktu_mulai": waktuMulai,
        "waktu_selesai": waktuSelesai,
        "daftar_panitia": daftarPanitia,
        "nama_ruangan": namaRuangan,
        "nama_ketua_ormawa": namaKetuaOrmawa,
        "nama_ketua_pelaksana": namaKetuaPelaksana,
        "nama_peminjam": namaPeminjam,
        "nama_status": namaStatus,
      };
}
