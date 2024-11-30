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
    <div class="p-4 pt-20 sm:ml-64">
        <h1 class="text-4xl font-bold p-4">Riwayat Aktivitas</h1>
        <!-- Pagination Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-biru-500 text-white">
                    <tr>
                        <th class="w-1/4 px-4 py-2 cursor-pointer" data-sort="nama_ruangan">
                            Nama Ruangan
                            <span id="sort-nama_ruangan"></span>
                        </th>
                        <th class="w-1/4 px-4 py-2 cursor-pointer" data-sort="nama_kegiatan">
                            Kegiatan
                            <span id="sort-nama_kegiatan"></span>
                        </th>
                        <th class="w-1/4 px-4 py-2 cursor-pointer" data-sort="tanggal_kegiatan">
                            Tanggal Pinjam
                            <span id="sort-tanggal_kegiatan"></span>
                        </th>
                        <th class="w-1/4 px-4 py-2 cursor-pointer" data-sort="sesi">
                            Sesi
                            <span id="sort-sesi"></span>
                        </th>
                        <th class="w-1/4 px-4 py-2 cursor-pointer" data-sort="nama_status">
                            Status
                            <span id="sort-nama_status"></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-700" id="peminjamanTable">
                </tbody>
            </table>
        </div>
        <!-- Pagination Controls -->
        <nav aria-label="Page navigation example">
            <ul class="flex items-center justify-center h-20 text-sm" id="paginationControls">
            </ul>
        </nav>
    </div>
    <!-- End Main -->
    <script src="scripts.js"></script>
</body>

</html>