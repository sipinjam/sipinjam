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
                        <th class="w-1/4 px-4 py-2">Nama Ruangan</th>
                        <th class="w-1/4 px-4 py-2">Kegiatan</th>
                        <th class="w-1/4 px-4 py-2">Tanggal Pinjam</th>
                        <th class="w-1/4 px-4 py-2">Sesi</th>
                        <th class="w-1/4 px-4 py-2">Status</th>
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

    // Render pagination controls
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
                getPeminjaman();
            });
            return li;
        };

        for (let i = 1; i <= totalPages; i++) {
            paginationControls.appendChild(createPageItem(i, i === currentPage));
        }
    }

    // Function to fetch and render data
    async function getPeminjaman() {
        const loggedInUserId = getCookies("id_peminjam"); // Get the logged-in user ID from cookies

        try {
            const response = await fetch("http://localhost/sipinjamfix/sipinjam/api/peminjaman/");
            const result = await response.json();

            if (result.status === "success") {
                const peminjamanTable = document.getElementById("peminjamanTable");
                peminjamanTable.innerHTML = "";

                const data = result.data;

                // Filter data based on logged-in user ID
                const filteredData = data.filter(item => {

                    // Directly check if 'id_peminjam' matches the logged-in user ID
                    if (item.id_peminjam) {
                        const match = item.id_peminjam === parseInt(loggedInUserId);
                        return match;
                    } else {
                        return false; // Exclude items with missing id_peminjam
                    }
                });

                if (filteredData.length === 0) {
                    peminjamanTable.innerHTML =
                        '<tr><td colspan="5" class="text-center py-4">Tidak ada data peminjaman ditemukan untuk pengguna ini.</td></tr>';
                } else {
                    filteredData.forEach((item) => {
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