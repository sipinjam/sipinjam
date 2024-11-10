class PeminjamModel {
  int? idPeminjam;
  String namaPeminjam;
  String password;
  String? namaLengkap;
  String email;
  String? noTelpon;
  int? idJenisPeminjam;

  PeminjamModel({
    this.idPeminjam,
    required this.namaPeminjam,
    required this.password,
    this.namaLengkap,
    required this.email,
    this.noTelpon,
    this.idJenisPeminjam,
  });

  factory PeminjamModel.fromJson(Map<String, dynamic> json) {
    print(json);
    return PeminjamModel(
      idPeminjam: json["id_peminjam"] ?? 0,
      namaPeminjam: json["nama_peminjam"] ??
          '', // Pastikan selalu ada nilai default jika null
      password:
          json["password"] ?? '', // Pastikan selalu ada nilai default jika null
      namaLengkap: json["nama_lengkap"],
      email: json["email"] ?? '',
      noTelpon: json["no_telpon"],
      idJenisPeminjam:
          json["id_jenis_peminjam"] != null ? json["id_jenis_peminjam"] : null,
    );
  }

  Map<String, dynamic> toJson() => {
        "id_peminjam": idPeminjam,
        "nama_peminjam": namaPeminjam,
        "password": password,
        "nama_lengkap": namaLengkap,
        "email": email,
        "no_telpon": noTelpon,
        "id_jenis_peminjam": idJenisPeminjam,
      };
}
