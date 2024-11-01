<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>SIPINJAM - Riwayat</title>
</head>

<body>
    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

    <!-- Sidebar -->
    <?php include '../../Components/sidebar.php'; ?>
    <!-- End Sidebar -->

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <h1 class="text-4xl font-bold p-4">Riwayat Aktivitas</h1>
        <!-- Pagination Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-biru-500 text-white">
                    <tr>
                        <th class="w-1/4 px-4 py-2">Nama Ruangan</th>
                        <th class="w-1/4 px-4 py-2">Kegiatan</th>
                        <th class="w-1/4 px-4 py-2">Peminjam</th>
                        <th class="w-1/4 px-4 py-2">Tanggal Pinjam</th>
                        <th class="w-1/4 px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr>
                        <td class="border px-4 py-2">Gedung Kuliah Terpadu</td>
                        <td class="border px-4 py-2">Seminar</td>
                        <td class="border px-4 py-2">Rohkris</td>
                        <td class="border px-4 py-2">28 September 2024</td>
                        <td class="border px-4 py-2 text-green-600 font-bold">Disetujui</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">Gedung Kuliah Terpadu</td>
                        <td class="border px-4 py-2">Workshop</td>
                        <td class="border px-4 py-2">Rohkris</td>
                        <td class="border px-4 py-2">28 September 2024</td>
                        <td class="border px-4 py-2 text-red-600 font-bold">Ditolak</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Gedung Kuliah Terpadu</td>
                        <td class="border px-4 py-2">Meeting</td>
                        <td class="border px-4 py-2">Rohkris</td>
                        <td class="border px-4 py-2">28 September 2024</td>
                        <td class="border px-4 py-2 text-yellow-600 font-bold">Proses</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">Gedung Kuliah Terpadu</td>
                        <td class="border px-4 py-2">Conference</td>
                        <td class="border px-4 py-2">Rohkris</td>
                        <td class="border px-4 py-2">28 September 2024</td>
                        <td class="border px-4 py-2 text-blue-600 font-bold">Selesai</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination Controls -->
        <div class="flex justify-between items-center mt-4">
            <button class="bg-gray-800 text-white px-4 py-2 rounded">Previous</button>
            <span>Page 1 of 10</span>
            <button class="bg-gray-800 text-white px-4 py-2 rounded">Next</button>
        </div>
    </div>
    <!-- End Main -->
</body>

</html>