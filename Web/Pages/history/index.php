<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
        <!-- Table -->
        <div class="overflow-x-auto">
            <table id="riwayatTable" class="min-w-full bg-white">
                <thead class="bg-biru-500 text-white">
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Kegiatan</th>
                        <th>Tanggal Pinjam</th>
                        <th>Sesi</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700" id="peminjamanTable">
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Main -->

    <script>
    function getCookies(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    async function getPeminjaman() {
        const loggedInUserId = getCookies("id_peminjam");

        try {
            const response = await fetch("http://localhost/sipinjamfix/sipinjam/api/peminjaman/");
            const result = await response.json();

            if (result.status === "success") {
                const filteredData = result.data.filter(
                    (item) => item.id_peminjam === parseInt(loggedInUserId)
                );

                const peminjamanTable = document.getElementById("peminjamanTable");

                if (filteredData.length === 0) {
                    peminjamanTable.innerHTML = `
                            <tr>
                                <td colspan="6" class="text-center py-4">Tidak ada data peminjaman ditemukan.</td>
                            </tr>`;
                    return;
                }

                filteredData.forEach((item) => {
                    let statusColor;
                    switch (item.nama_status.toLowerCase()) {
                        case "proses":
                            statusColor = "text-yellow-600";
                            break;
                        case "disetujui":
                            statusColor = "text-green-600";
                            break;
                        case "ditolak":
                            statusColor = "text-red-600";
                            break;
                        default:
                            statusColor = "text-gray-600";
                    }

                    let sesiText;
                    switch (item.sesi_peminjaman) {
                        case "1":
                            sesiText = "Pagi";
                            break;
                        case "2":
                            sesiText = "Siang";
                            break;
                        case "3":
                            sesiText = "Full Day";
                            break;
                        default:
                            sesiText = "Tidak diketahui";
                    }

                    const row = `
                            <tr class="bg-white hover:bg-gray-100">
                                <td class="border px-4 py-2">${item.nama_ruangan}</td>
                                <td class="border px-4 py-2">${item.nama_kegiatan}</td>
                                <td class="border px-4 py-2">${item.tgl_peminjaman}</td>
                                <td class="border px-4 py-2">${sesiText}</td>
                                <td class="border px-4 py-2 ${statusColor} font-bold">${item.nama_status}</td>
                                <td class="border px-4 py-2">${item.keterangan || "Tidak ada keterangan"}</td>
                            </tr>`;
                    peminjamanTable.insertAdjacentHTML("beforeend", row);
                });

                // Inisialisasi DataTables
                $('#riwayatTable').DataTable({
                    order: [
                        [2, 'desc']
                    ], // Urutkan berdasarkan tanggal
                    pageLength: 10
                });
            } else {
                console.error("Gagal mendapatkan data peminjaman:", result.message);
            }
        } catch (error) {
            console.error("Terjadi kesalahan saat mengambil data:", error);
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        getPeminjaman();
    });
    </script>
</body>

</html>