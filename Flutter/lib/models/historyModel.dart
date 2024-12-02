// // history_model.dart
// class HistoryModel {
//   final String status;
//   final String date;
//   final String name;
//   final String location;
//   final String time1;
//   final String time2;
//   final String nama_

//   HistoryModel({
//     required this.status,
//     required this.date,
//     required this.name,
//     required this.location,
//     required this.time1,
//     required this.time2,
//   });

//   factory HistoryModel.fromJson(Map<String, dynamic> json) {
//     return HistoryModel(
//       status: json['nama_status'] ?? 'Unknown',
//       date: json['tanggal_kegiatan'] ?? 'Unknown',
//       name: json['nama_kegiatan'] ?? 'Unknown',
//       location: json['nama_ruangan'] ?? 'Unknown',
//       time1: json['waktu_mulai'] ?? 'Unknown',
//       time2: json['waktu_selesai'] ?? 'Unknown',
//     );
//   }
// }
