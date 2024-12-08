// To parse this JSON data, do
//
//     final mahasiswanModel = mahasiswanModelFromJson(jsonString);

import 'dart:convert';

MahasiswanModel mahasiswanModelFromJson(String str) =>
    MahasiswanModel.fromJson(json.decode(str));

String mahasiswanModelToJson(MahasiswanModel data) =>
    json.encode(data.toJson());

class MahasiswanModel {
  int idMahasiswa;
  String namaMahasiswa;
  String nimMahasiswa;
  int idJenisPeminjam;
  int? idOrmawa;
  String? namaOrmawa;
  String? namaJenisPeminjam;
  String? namaStruktur;
  int? idPembina;
  String? namaPembina;
  String? nipPembina;

  MahasiswanModel({
    required this.idMahasiswa,
    required this.namaMahasiswa,
    required this.nimMahasiswa,
    required this.idJenisPeminjam,
    required this.idOrmawa,
    required this.namaOrmawa,
    required this.namaJenisPeminjam,
    required this.namaStruktur,
    required this.idPembina,
    required this.namaPembina,
    required this.nipPembina,
  });

  factory MahasiswanModel.fromJson(Map<String, dynamic> json) =>
      MahasiswanModel(
        idMahasiswa: json["id_mahasiswa"],
        namaMahasiswa: json["nama_mahasiswa"],
        nimMahasiswa: json["nim_mahasiswa"],
        idJenisPeminjam: json["id_jenis_peminjam"],
        idOrmawa: json["id_ormawa"] ?? 0,
        namaOrmawa: json["nama_ormawa"] ?? 'Individu',
        namaJenisPeminjam: json["nama_jenis_peminjam"] ?? '',
        namaStruktur: json["nama_struktur"] ?? '',
        idPembina: json["id_pembina"] ?? 0,
        namaPembina: json["nama_pembina"] ?? "",
        nipPembina: json["nip_pembina"] ?? '',
      );

  Map<String, dynamic> toJson() => {
        "id_mahasiswa": idMahasiswa,
        "nama_mahasiswa": namaMahasiswa,
        "nim_mahasiswa": nimMahasiswa,
        "id_jenis_peminjam": idJenisPeminjam,
        "id_ormawa": idOrmawa ?? 0,
        "nama_ormawa": namaOrmawa ?? 'Individu',
        "nama_jenis_peminjam": namaJenisPeminjam ?? '',
        "nama_struktur": namaStruktur ?? '',
        "id_pembina": idPembina ?? 0,
        "nama_pembina": namaPembina ?? '',
        "nip_pembina": nipPembina ?? '',
      };

  @override
  String toString() {
    return namaOrmawa != null
        ? namaOrmawa.toString()
        : 'individu'; // Mengembalikan nama gedung sebagai representasi
  }
}
