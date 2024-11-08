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
        <p class="text-2xl flex font-bold text-gray-800 mb-4">FAQ</p>

        <?php
        $faqs = [
            [
                "question" => "Bagaimana Cara Pengajuan Peminjaman Ruangan?",
                "answer" => "<ol class='list-decimal list-inside'>
                                <li>Memilih gedung yang akan dipinjam pada page home.</li>
                                <li>Memilih ruangan dan pinjam.</li>
                                <li>Mengisi form untuk peminjaman.</li>
                                <li>Tekan tombol pinjam.</li>
                                <li>Cek status peminjaman pada page riwayat.</li>
                             </ol>"
            ],
            [
                "question" => "Apakah Ada Batasan Waktu Dalam Peminjaman Tempat?",
                "answer" => "Ya, batasan waktu peminjaman ditentukan berdasarkan peraturan yang berlaku."
            ],
            [
                "question" => "Bagaimana Cara Mengganti Password?",
                "answer" => "Anda dapat mengganti password melalui halaman profil pengguna."
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
                "answer" => "Anda akan menerima notifikasi atau konfirmasi pada menu home setelah peminjaman disetujui."
            ]
        ];

        foreach ($faqs as $index => $faq) {
            echo '<div class="border-b border-gray-200 py-4">';
            echo '<button onclick="toggleAnswer('.$index.')" class="flex justify-between w-full text-left text-lg font-semibold text-gray-800">';
            echo $faq["question"];
            echo '<span id="icon-'.$index.'" class="transform transition-transform">&#9660;</span>';
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