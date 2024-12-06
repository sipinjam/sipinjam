<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>SIPINJAM</title>
</head>

<body class="flex flex-col min-h-screen">

    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>
    <!-- End Sidebar -->

    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

    <!-- Main Menu -->
    <!-- Container for scrolling horizontally -->
    <div class="pt-24 md:pl-[270px] overflow-x-auto">
        <div class="flex space-x-4 pb-4" id="gedungContainer"></div>
    </div>

    <!--Ruangan yang Sedang Dipinjam-->
    <div class="p-4 sm:ml-64">
        <h3 class="text-4xl font-bold p-4">Ruangan yang Sedang Dipinjam</h3>
        <!-- Pagination Table -->
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
</body>

<script>
// GET GEDUNG
async function getGedung() {
    try {
        const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/gedung');
        const result = await response.json();

        if (result.status === 'success') {
            const gedungContainer = document.getElementById('gedungContainer');

            result.data.forEach(gedung => {
                // Create card container
                const gedungItem = document.createElement('div');
                gedungItem.className =
                    "w-[300px] h-[230px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0";

                // Link container for image
                const link = document.createElement('a');
                link.href =
                    `http://localhost/sipinjamfix/sipinjam/web/pages/daftarRuangan/index.php?id_gedung=${gedung.id_gedung}`; // Mengarahkan ke daftarRuangan dengan parameter id_gedung

                // Image
                const img = document.createElement('img');
                img.className = "gedung w-full h-[190px] rounded-t-[20px]";
                img.src = gedung.foto_gedung ? gedung.foto_gedung : "../../Sources/Img/default.jpg";
                img.alt = gedung.nama_gedung;
                link.appendChild(img);

                // Append image link to card container
                gedungItem.appendChild(link);

                // Name container
                const contentDiv = document.createElement('div');
                contentDiv.className = "p-2";

                const nameLink = document.createElement('a');
                nameLink.href =
                    `http://localhost/sipinjamfix/sipinjam/web/pages/daftarRuangan/index.php?id_gedung=${gedung.id_gedung}`; // Mengarahkan ke daftarRuangan dengan parameter id_gedung

                const namaGedung = document.createElement('span');
                namaGedung.className =
                    "mb-2 text-base font-medium text-center block tracking-tight text-gray-800";
                namaGedung.textContent = gedung.nama_gedung;

                // Append name and name link to content div
                nameLink.appendChild(namaGedung);
                contentDiv.appendChild(nameLink);
                gedungItem.appendChild(contentDiv);

                // Append card to container
                gedungContainer.appendChild(gedungItem);
            });
        } else {
            console.error('Gagal mengambil data gedung:', result.message);
        }
    } catch (error) {
        console.error('Terjadi kesalahan saat mengambil data:', error);
    }
}

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
                peminjamanTable.innerHTML =
                    '<tr><td colspan="6" class="text-center py-4">Tidak ada data peminjaman ditemukan.</td></tr>';
            } else {
                const today = new Date();
                const filteredData = result.data
                    .filter(item => {
                        const itemDate = new Date(item.tanggal_kegiatan);
                        return item.nama_peminjam === loggedInUserName &&
                            (item.nama_status.toLowerCase() === 'disetujui' || item.nama_status.toLowerCase() === 'proses') &&
                            itemDate > today;
                    })
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
                        default:
                            statusColor = 'text-gray-600';
                    }

                    // Tentukan sesi berdasarkan waktu_mulai dan waktu_selesai
                    let sesi = '';
                    if (item.waktu_mulai === "08:00:00" && item.waktu_selesai === "12:00:00") {
                        sesi = 'Sesi 1';
                    } else if (item.waktu_mulai === "12:00:00" && item.waktu_selesai === "16:00:00") {
                        sesi = 'Sesi 2';
                    } else if (item.waktu_mulai === "08:00:00" && item.waktu_selesai === "16:00:00") {
                        sesi = 'Full Sesi';
                    } else {
                        sesi = 'Tidak Diketahui';
                    }

                    row.innerHTML = `
                        <td class="border px-4 py-2">${item.nama_ruangan}</td>
                        <td class="border px-4 py-2">${item.nama_kegiatan}</td>
                        <td class="border px-4 py-2">${item.tanggal_kegiatan}</td>
                        <td class="border px-4 py-2">${sesi}</td>
                        <td class="border px-4 py-2 ${statusColor} font-bold">${item.nama_status}</td>
                    `;
                    peminjamanTable.appendChild(row);
                });

                if (filteredData.length === 0) {
                    peminjamanTable.innerHTML =
                        '<tr><td colspan="6" class="text-center py-4">Tidak ada ruangan yang sedang dipinjam.</td></tr>';
                }
            }
        } else {
            console.error('Gagal mengambil data peminjaman:', result.message);
        }
    } catch (error) {
        console.error('Terjadi kesalahan saat mengambil data:', error);
    }
}


// Panggil fungsi saat halaman dimuat
window.onload = function() {
    getGedung();
    getPeminjaman();
}
</script>

</html>