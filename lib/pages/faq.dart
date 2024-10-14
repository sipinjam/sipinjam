import 'package:flutter/material.dart';

// Define the FAQ model (struktur data untuk FAQ)
class Faq {
  final String question;
  final String answer;

  Faq({required this.question, required this.answer});
}

class FaqScreen extends StatelessWidget {
  // List of FAQ items
  final List<Faq> faqs = [
    Faq(
      question: 'Bagaimana Cara Pengajuan Peminjaman Ruangan?',
      answer:
          '1. Membuat surat peminjaman tempat. 2. Meminta disposisi helper. 3. Meminta memo ke BEM. 4. Surat diserahkan ke Bapak Unggul.',
    ),
    Faq(
      question: 'Apakah ada batasan waktu dalam peminjaman tempat?',
      answer: 'Batasan waktu tergantung ketersediaan ruangan.',
    ),
    Faq(
      question: 'Apakah saya bisa memodifikasi peminjaman setelah dikonfirmasi?',
      answer: 'Anda harus menghubungi admin untuk perubahan peminjaman.',
    ),
    Faq(
      question: 'Apakah ada biaya tambahan selain biaya sewa tempat?',
      answer: 'Tidak ada biaya tambahan.',
    ),
    // Tambah lebih banyak FAQ jika perlu
  ];

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'FAQ App',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: FaqScreen(), // Set FAQ screen sebagai home
    );
  }
}
