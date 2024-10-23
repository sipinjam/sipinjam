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
          '1. Membuat surat peminjaman tempat.\n2. Meminta disposisi helper.\n3. Meminta memo ke BEM.\n4. Surat diserahkan ke Bapak Unggul.',
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
