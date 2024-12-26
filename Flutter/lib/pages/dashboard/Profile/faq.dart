import 'package:flutter/material.dart';

// Definisikan model untuk FAQ
class Faq {
  final String question;
  final String answer;

  Faq({required this.question, required this.answer});
}

class FaqPage extends StatelessWidget {
  FaqPage({super.key});

  // List FAQ (isi pertanyaan dan jawaban)
  final List<Faq> faqs = [
    Faq(
      question: 'Bagaimana Cara Pengajuan Peminjaman Ruangan?',
      answer:
          '1. Melihat daftar gedung dan ruangan yang akan dipinjam pada page Home.\n2. Perhatikan dengan seksama untuk pemilihan tanggal dengan melihat di page Schedule apakah ruangan pada tanggal tersebut sudah disewa Ormawa lain.\n3. Pilih page Peminjaman.\n4. Mengisi data form untuk peminjaman.\n5. Tekan tombol Pinjam. \n6. Cek status peminjaman pada page Riwayat. \n7. Apabila peminjaman disetujui, Anda dapat melihat Ruangan Yang Dipinjam pada page Home.',
    ),
    Faq(
      question: 'Apakah ada batasan waktu dalam peminjaman tempat?',
      answer: 'Ya, batasan waktu peminjaman ditentukan berdasarkan peraturan yang berlaku.',
    ),
    Faq(
      question: 'Apakah saya bisa memodifikasi peminjaman setelah dikonfirmasi?',
      answer: 'Anda harus menghubungi admin untuk perubahan peminjaman.',
    ),
    Faq(
      question: 'Apakah ada biaya tambahan selain biaya sewa tempat?',
      answer: 'Tergantung pada acara dan fasilitas yang digunakan, mungkin ada biaya tambahan.',
    ),
    Faq(
      question: 'Bagaimana Saya Tahu Bahwa Peminjaman Saya Sudah Berhasil Dikonfirmasi?',
      answer: 'Cek secara berkala di page Riwayat untuk mengetahui peminjaman Anda telat disetujui atau belum. Status "Proses" berarti permintaan peminjaman masih dalam tahap peninjauan. Status "Disetujui" berarti permintaan peminjaman Anda telah diterima dan akan ditampilkan di page Home.',
    ),
    Faq(
      question: 'Bagaimana cara mengetahui ruangan yang sudah dipesan Ormawa lain?',
      answer: 'Anda bisa mengecek ketersediaan ruangan di Schedule Page, ruangan yang sudah dipesan pada tanggal tersebut akan berwarna sesuai keterangan sesi.',
    ),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          'FAQ',
          style: TextStyle(
            color: Colors.black,
            fontSize: 20,
            fontWeight: FontWeight.bold,
          ),
        ),
      ),
      body: ListView.builder(
        itemCount: faqs.length,
        itemBuilder: (context, index) {
          return ExpansionTile(
            title: Text(faqs[index].question),
            children: <Widget>[
              Padding(
                padding: const EdgeInsets.all(16.0),
                child: Text(
                faqs[index].answer,
                textAlign: TextAlign.justify, // Menambahkan justify alignment
              ),
              ),
            ],
          );
        },
      ),
    );
  }
}
