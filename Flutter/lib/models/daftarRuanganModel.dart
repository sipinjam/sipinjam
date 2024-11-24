class daftarRuanganModel {
  final int id;
  final String name;
  final String buildingName;
  final int buildingId;
  final String description;
  final int capacity;
  final String borrowerName;
  final String? facilities;
  final List<String> photos;

  daftarRuanganModel({
    required this.id,
    required this.name,
    required this.buildingName,
    required this.buildingId,
    required this.description,
    required this.capacity,
    required this.borrowerName,
    this.facilities,
    required this.photos,
  });

  factory daftarRuanganModel.fromJson(Map<String, dynamic> json) {
    return daftarRuanganModel(
      id: json['id_ruangan'],
      name: json['nama_ruangan'],
      buildingName: json['nama_gedung'],
      buildingId: json['id_gedung'],
      description: json['deskripsi_ruangan'] ?? '',
      capacity: json['kapasitas'],
      borrowerName: json['nama_peminjam'] ?? '',
      facilities: json['nama_fasilitas'],
      photos: List<String>.from(json['foto_ruangan'] ?? []),
    );
  }
}