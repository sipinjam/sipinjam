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
                        <th class="w-1/4 px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700" id="peminjamanTable">
                </tbody>
            </table>
        </div>
        <!-- Pagination Controls -->
        <nav aria-label="Page navigation example">
            <ul class="flex items-center justify-center h-20 text-sm">
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" aria-current="page"
                        class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700">1</a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Next</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- End Main -->
</body>

<script>
function getCookies(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

async function getPeminjaman() {
    const loggedInUserName = getCookies('nama_peminjam'); // Ambil nama pengguna dari cookie

    if (!loggedInUserName) {
        console.error("Nama peminjam tidak ditemukan dalam cookie.");
        return;
    }

    try {
        const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/peminjaman/');
        const result = await response.json();

        if (result.status === 'success') {
            const peminjamanTable = document.getElementById('peminjamanTable');
            peminjamanTable.innerHTML = '';

            if (result.data.length === 0) {
                peminjamanTable.innerHTML = '<tr><td colspan="5" class="text-center py-4">Tidak ada data peminjaman ditemukan.</td></tr>';
            } else {
                const filteredData = result.data
                    .filter(item => item.nama_peminjam === loggedInUserName)
                    .sort((a, b) => a.nama_peminjam.localeCompare(b.nama_peminjam));

                filteredData.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = 'bg-white hover:bg-gray-100';

                    let statusColor;
                    switch (item.nama_status.toLowerCase()) {
                        case 'proses':
                            statusColor = 'text-yellow-600';
                            break;
                        case 'disetujui':
                            statusColor = 'text-green-600';
                            break;
                        case 'ditolak':
                            statusColor = 'text-red-600';
                            break;
                        default:
                            statusColor = 'text-gray-600';
                    }

                    row.innerHTML = `
                        <td class="border px-4 py-2">${item.nama_ruangan}</td>
                        <td class="border px-4 py-2">${item.nama_kegiatan}</td>
                        <td class="border px-4 py-2">${item.tanggal_kegiatan}</td>
                        <td class="border px-4 py-2 ${statusColor} font-bold">${item.nama_status}</td>
                    `;
                    peminjamanTable.appendChild(row);
                });

                if (filteredData.length === 0) {
                    peminjamanTable.innerHTML = '<tr><td colspan="5" class="text-center py-4">Tidak ada data peminjaman untuk pengguna ini.</td></tr>';
                }
            }
        } else {
            console.error('Gagal mengambil data peminjaman:', result.message);
        }
    } catch (error) {
        console.error('Terjadi kesalahan saat mengambil data:', error);
    }
}

window.onload = function() {
    getPeminjaman();
}

</script>

</html>
