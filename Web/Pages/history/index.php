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
                        <th class="w-1/4 px-4 py-2 cursor-pointer">Nama Ruangan</th>
                        <th class="w-1/4 px-4 py-2 cursor-pointer">Kegiatan</th>
                        <th class="w-1/4 px-4 py-2 cursor-pointer">Tanggal Pinjam</th>
                        <th class="w-1/4 px-4 py-2 cursor-pointer">Sesi</th>
                        <th class="w-1/4 px-4 py-2 cursor-pointer">Status</th>
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
    <script>
    // Fungsi untuk mendapatkan nilai cookie berdasarkan nama
    function getCookies(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null; // Kembalikan null jika cookie tidak ditemukan
    }

    const itemsPerPage = 10;
    let currentPage = 1;
    let sortColumn = ""; // Kolom yang diurutkan
    let sortDirection = "asc"; // Arah pengurutan: "asc" atau "desc"
    let filteredData = []; // Data yang disaring secara global untuk sorting dan pagination

    // Render kontrol pagination
    function renderPaginationControls(totalItems) {
        const paginationControls = document.getElementById("paginationControls");
        paginationControls.innerHTML = "";

        const totalPages = Math.ceil(totalItems / itemsPerPage);

        if (totalPages <= 1) return;

        const createPageItem = (page, isActive = false) => {
            const li = document.createElement("li");
            li.innerHTML = `
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight ${
                  isActive ? "text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700" : "text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                }">${page}</a>
            `;
            li.addEventListener("click", (e) => {
                e.preventDefault();
                currentPage = page;
                renderTableData(); // Render ulang tabel untuk halaman saat ini
            });
            return li;
        };

        for (let i = 1; i <= totalPages; i++) {
            paginationControls.appendChild(createPageItem(i, i === currentPage));
        }
    }

    // Fungsi untuk mengurutkan data berdasarkan kolom dan arah
    function sortData(data, column, direction) {
        return data.sort((a, b) => {
            let valueA, valueB;

            switch (column) {
                case "sesi":
                    const order = ["Pagi", "Siang", "Full Day"]; // Urutan custom untuk sesi
                    valueA = order.indexOf(a.sesi_peminjaman);
                    valueB = order.indexOf(b.sesi_peminjaman);
                    break;
                case "tanggal":
                    valueA = new Date(a.tgl_peminjaman);
                    valueB = new Date(b.tgl_peminjaman);
                    break;
                case "nama_kegiatan":
                    valueA = a.nama_kegiatan.toLowerCase();
                    valueB = b.nama_kegiatan.toLowerCase();
                    break;
                case "nama_ruangan":
                    valueA = a.nama_ruangan.toLowerCase();
                    valueB = b.nama_ruangan.toLowerCase();
                    break;
                case "status":
                    const statusOrder = ["proses", "ditolak", "disetujui"];
                    valueA = statusOrder.indexOf(a.nama_status);
                    valueB = statusOrder.indexOf(b.nama_status);
                    break;
                default:
                    return 0;
            }

            if (valueA < valueB) return direction === "asc" ? -1 : 1;
            if (valueA > valueB) return direction === "asc" ? 1 : -1;
            return 0;
        });
    }

    // Render data tabel
    function renderTableData() {
        const peminjamanTable = document.getElementById("peminjamanTable");
        peminjamanTable.innerHTML = "";

        // Ambil data untuk halaman saat ini
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedData = filteredData.slice(start, end);

        paginatedData.forEach((item) => {
            const row = document.createElement("tr");
            row.className = "bg-white hover:bg-gray-100";

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

            row.innerHTML = `
                <td class="border px-4 py-2">${item.nama_ruangan}</td>
                <td class="border px-4 py-2">${item.nama_kegiatan}</td>
                <td class="border px-4 py-2">${item.tgl_peminjaman}</td>
                <td class="border px-4 py-2">${sesiText}</td>
                <td class="border px-4 py-2 ${statusColor} font-bold">${item.nama_status}</td>
            `;
            peminjamanTable.appendChild(row);
        });

        renderPaginationControls(filteredData.length);
    }

    // Fetch dan render data
    async function getPeminjaman() {
        const loggedInUserId = getCookies("id_peminjam");

        try {
            const response = await fetch("http://localhost/sipinjamfix/sipinjam/api/peminjaman/");
            const result = await response.json();

            if (result.status === "success") {
                // Filter data berdasarkan ID pengguna yang login
                filteredData = result.data.filter(
                    (item) => item.id_peminjam === parseInt(loggedInUserId)
                );

                // Urutkan data secara awal
                filteredData = sortData(filteredData, sortColumn, sortDirection);

                renderTableData();
            } else {
                console.error("Gagal mendapatkan data peminjaman:", result.message);
            }
        } catch (error) {
            console.error("Terjadi kesalahan saat mengambil data:", error);
        }
    }

    // Tambahkan event listener untuk header tabel
    document.querySelectorAll("th").forEach((header, index) => {
        const columnMap = ["nama_ruangan", "nama_kegiatan", "tanggal", "sesi", "status"];
        header.addEventListener("click", () => {
            const column = columnMap[index];
            if (sortColumn === column) {
                sortDirection = sortDirection === "asc" ? "desc" : "asc";
            } else {
                sortColumn = column;
                sortDirection = "asc";
            }
            filteredData = sortData(filteredData, sortColumn, sortDirection);
            renderTableData();
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        getPeminjaman();
    });
    </script>


</body>

</html>