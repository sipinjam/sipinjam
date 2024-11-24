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
          '1. Memilih gedung yang akan dipinjam pada page home.\n2. Memilih ruangan dan pinjam.\n3. Mengisi form untuk peminjaman.\n4. Tekan tombol pinjam. \n5. Cek status peminjaman pada page riwayat.',
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
      answer: 'Anda akan menerima notifikasi atau konfirmasi pada menu home setelah peminjaman disetujui.',
    ),
    Faq(
      question: 'Bagaimana Cara Mengganti Password?',
      answer: 'Anda dapat mengganti password melalui halaman profil pengguna.',
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
                child: Text(faqs[index].answer),
              ),
            ],
          );
        },
      ),
    );
  }
}
