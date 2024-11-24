import 'dart:convert';

RuanganModel ruanganModelFromJson(String str) => RuanganModel.fromJson(json.decode(str));

String ruanganModelToJson(RuanganModel data) => json.encode(data.toJson());

class RuanganModel {
    String status;
    String message;
    List<Ruangan> data;
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
        data: List<Ruangan>.from(json["data"].map((x) => Ruangan.fromJson(x))),
        code: json["code"],
    );

    Map<String, dynamic> toJson() => {
        "status": status,
        "message": message,
        "data": List<dynamic>.from(data.map((x) => x.toJson())),
        "code": code,
    };
}

class Ruangan {
    int idRuangan;
    String namaRuangan;
    String namaGedung;
    int idGedung;
    String deskripsiRuangan;
    int kapasitas;
    String namaPeminjam;
    String? namaFasilitas;
    List<String> fotoRuangan;

    Ruangan({
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

    factory Ruangan.fromJson(Map<String, dynamic> json) => Ruangan(
        idRuangan: json["id_ruangan"],
        namaRuangan: json["nama_ruangan"],
        namaGedung: json["nama_gedung"],
        idGedung: json["id_gedung"],
        deskripsiRuangan: json["deskripsi_ruangan"],
        kapasitas: json["kapasitas"],
        namaPeminjam: json["nama_peminjam"],
        namaFasilitas: json["nama_fasilitas"],
        fotoRuangan: List<String>.from(json["foto_ruangan"].map((x) => x)),
    );

    Map<String, dynamic> toJson() => {
        "id_ruangan": idRuangan,
        "nama_ruangan": namaRuangan,
        "nama_gedung": namaGedung,
        "id_gedung": idGedung,
        "deskripsi_ruangan": deskripsiRuangan,
        "kapasitas": kapasitas,
        "nama_peminjam": namaPeminjam,
        "nama_fasilitas": namaFasilitas,
        "foto_ruangan": List<dynamic>.from(fotoRuangan.map((x) => x)),
    };
}