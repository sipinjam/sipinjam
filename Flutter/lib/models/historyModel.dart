// history_model.dart
class HistoryModel {
  final String status;
  final String date;
  final String name;
  final String location;

  HistoryModel({
    required this.status,
    required this.date,
    required this.name,
    required this.location,
  });

  factory HistoryModel.fromJson(Map<String, dynamic> json) {
    return HistoryModel(
      status: json['nama_status'] ?? 'Unknown',
      date: json['tanggal_kegiatan'] ?? 'Unknown',
      name: json['nama_kegiatan'] ?? 'Unknown',
      location: json['nama_ruangan'] ?? 'Unknown',
    );
  }
}
