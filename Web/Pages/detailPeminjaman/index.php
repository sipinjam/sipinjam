<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Detail Peminjaman</title>
</head>
 <!--Sidebar-->
    <aside style="background-color: #1e3a8a; color: white;" class="fixed top-0 left-0 z-40 w-64 h-screen">
    <?php include '../../Components/sidebar.php'; ?>
    </aside>
    <!--End Sidebar-->
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <?php
    // Contoh data yang biasanya diambil dari database atau API
    $data_peminjam = [
        'nama' => 'John Doe',
        'ormawa' => 'UKM Jazirah',
        'ketua_ormawa' => 'Rohimatun',
        'pembina' => 'Heri Prasetyo'
    ];

    $data_kegiatan = [
        'nama_kegiatan' => 'Maulid Nabi',
        'tema_kegiatan' => 'Lorem Ipsum',
        'ketua_pelaksana' => 'Ahmad',
        'tanggal' => 'Senin 19 Sept',
        'sesi' => '2 Sesi'
    ];
    ?>

    <div class="max-w-4xl mx-auto mt-[-10px] bg-white shadow-lg rounded-lg">
        <div class="grid grid-cols-2 gap-4 p-6">
            <!-- Image Section -->
            <div class="flex justify-center">
                <div>
                    <img src="../../Sources/Img/gedungkuliah-terpadu.png" alt="Gedung Kuliah Terpadu" class="w-full rounded-lg">
                    <h2 class="text-center text-lg font-bold mt-2">Gedung Kuliah Terpadu</h2>
                    <p class="text-center text-sm text-gray-500">Lantai 2</p>
                    <div class="mt-4 text-center">
                        <a href="#" class="text-blue-500 hover:underline">Lihat Daftar Panitia</a>
                        <br>
                        <a href="#" class="text-blue-500 hover:underline">Lihat Surat Peminjaman</a>
                    </div>
                </div>
            </div>

            <!-- Information Section -->
            <div>
                <!-- Peminjam -->
                <div class="mb-6 mt-6">
                    <h3 class="font-semibold text-xl text-purple-600">Peminjam</h3>
                    <p><span class="font-semibold">Peminjam:</span> <?php echo $data_peminjam['nama']; ?></p>
                    <p><span class="font-semibold">Ormawa:</span> <?php echo $data_peminjam['ormawa']; ?></p>
                    <p><span class="font-semibold">Ketua Ormawa:</span> <?php echo $data_peminjam['ketua_ormawa']; ?></p>
                    <p><span class="font-semibold">Pembina:</span> <?php echo $data_peminjam['pembina']; ?></p>
                </div>

                <!-- Kegiatan -->
                <div class="mb-6">
                    <h3 class="font-semibold text-xl text-purple-600">Kegiatan</h3>
                    <p><span class="font-semibold">Nama Kegiatan:</span> <?php echo $data_kegiatan['nama_kegiatan']; ?></p>
                    <p><span class="font-semibold">Tema Kegiatan:</span> <?php echo $data_kegiatan['tema_kegiatan']; ?></p>
                    <p><span class="font-semibold">Ketua Pelaksana:</span> <?php echo $data_kegiatan['ketua_pelaksana']; ?></p>
                    <p><span class="font-semibold">Hari/Tanggal:</span> <?php echo $data_kegiatan['tanggal']; ?></p>
                    <p><span class="font-semibold">Sesi:</span> <?php echo $data_kegiatan['sesi']; ?></p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-mt-6 gap-x-4">
                <a href="http://localhost/sipinjamfix/sipinjam/web/components/popKeterangan.php" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">TOLAK</a>
                    <button class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">SETUJU</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>