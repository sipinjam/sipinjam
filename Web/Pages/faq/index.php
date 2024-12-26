<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>Sipinjam</title>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->
    
    <div class="flex">
        <!-- Sidebar -->
        <?php include '../../components/sidebar.php' ?>
        <!-- End Sidebar -->
</div>
<div class="bg-gray-100 p-6">

    <div class="ml-64 max-w-9xl bg-white p-6 rounded-lg mt-20 shadow-md">
    <span class=" gap-5 items-center text-lg">
        <p class="text-2xl font-bold text-blue-800 mb-4">FAQ</p>

        <?php
        $faqs = [
            [
                "question" => "Bagaimana Cara Pengajuan Peminjaman Ruangan?",
                "answer" => "<ol class='list-decimal list-inside'>
                                <li>Melihat daftar gedung dan ruangan yang akan dipinjam pada 'Beranda'</li>
                                <li>Perhatikan dengan seksama untuk pemilihan tanggal dengan melihat di 'Cek Ketersediaan'  apakah ruangan pada tanggal tersebut sudah disewa Ormawa lain.</li>
                                <li>Pilih 'Peminjaman'.</li>
                                <li>Mengisi data form untuk peminjaman.</li>
                                <li>Tekan tombol Pinjam.</li>
                                <li>Cek status peminjaman pada 'Riwayat'.</li>
                                <li>Apabila peminjaman disetujui, Anda dapat melihat Ruangan Yang Dipinjam pada 'Beranda'.</li>
                            </ol>"
            ],
            [
                "question" => "Apakah Ada Batasan Waktu Dalam Peminjaman Tempat?",
                "answer" => "Ya, batasan waktu peminjaman ditentukan berdasarkan peraturan yang berlaku."
            ],
            [
                "question" => "Bagaimana cara mengetahui ruangan yang sudah dipesan Ormawa lain?",
                "answer" => "Anda bisa mengecek ketersediaan ruangan di 'Cek Ketersediaan', ruangan yang sudah dipesan pada tanggal tersebut akan berwarna sesuai keterangan sesi."
            ],
            [
                "question" => "Apakah Ada Biaya Tambahan Selain Biaya Sewa Tempat?",
                "answer" => "Tergantung pada acara dan fasilitas yang digunakan, mungkin ada biaya tambahan."
            ],
            [
                "question" => "Apakah Saya Bisa Memodifikasi Peminjaman Setelah Dikonfirmasi?",
                "answer" => "Modifikasi peminjaman dapat dilakukan dengan persetujuan pihak terkait."
            ],
            [
                "question" => "Bagaimana Saya Tahu Bahwa Peminjaman Saya Sudah Berhasil Dikonfirmasi?",
                "answer" => "Anda bisa mengecek ketersediaan ruangan di Schedule Page, ruangan yang sudah dipesan pada tanggal tersebut akan berwarna sesuai keterangan sesi."
            ]
        ];

        foreach ($faqs as $index => $faq) {
            echo '<div class="border-b border-gray-200 py-4">';
            echo '<button onclick="toggleAnswer('.$index.')" class="flex justify-between w-full text-left text-lg font-semibold text-gray-800">';
            echo $faq["question"];
            echo '<span id="icon-'.$index.'" class="transform transition-transform">⌄</span>';
            echo '</button>';
            echo '<div id="answer-'.$index.'" class="faq-answer mt-2 text-gray-600 hidden">'.$faq["answer"].'</div>';
            echo '</div>';
        }
        ?>
        </div>
    </div>

    <script>
        function toggleAnswer(index) {
            const answer = document.getElementById('answer-' + index);
            const icon = document.getElementById('icon-' + index);

            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                answer.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>