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

    <!-- Search Bar dengan posisi sticky -->
    <div class="pt-24">
        <form class="flex-grow max-w-md mx-auto">
            <div class="flex flex-row gap-2 items-center">
                <input type="search" id="default-search"
                    class="w-full p-2 md:p-3 pl-10 text-sm md:text-base text-gray-900 rounded-lg bg-gray-300 placeholder-gray-500"
                    placeholder="Cari Ruangan" required />
                <button type="submit"
                    class="right-2 top-1/2 bg-blue-800 text-white px-4 py-1 rounded-md h-10">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Main Menu -->
    <!-- Container for scrolling horizontally -->
    <div class="pt-12 md:pl-[270px] overflow-x-auto">
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
                    <th class="w-1/4 px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-700" id="peminjamanTable">
            </tbody>
        </table>
    </div>

            
    <!-- Page Navigation -->
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
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Next</span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
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
                    gedungItem.className = "w-[300px] h-[230px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0";

                    // Link container for image
                    const link = document.createElement('a');
                    link.href = `http://localhost/sipinjamfix/sipinjam/web/pages/daftarRuangan/index.php?id_gedung=${gedung.id_gedung}`; // Mengarahkan ke daftarRuangan dengan parameter id_gedung

                    // Image
                    const img = document.createElement('img');
                    img.className = "gedung w-full h-[200px] rounded-t-[20px]";
                    img.src = gedung.foto_gedung ? gedung.foto_gedung : "../../Sources/Img/default.jpg";
                    img.alt = gedung.nama_gedung;
                    link.appendChild(img);

                    // Append image link to card container
                    gedungItem.appendChild(link);

                    // Name container
                    const contentDiv = document.createElement('div');
                    contentDiv.className = "p-2";

                    const nameLink = document.createElement('a');
                    nameLink.href = `http://localhost/sipinjamfix/sipinjam/web/pages/daftarRuangan/index.php?id_gedung=${gedung.id_gedung}`; // Mengarahkan ke daftarRuangan dengan parameter id_gedung

                    const namaGedung = document.createElement('span');
                    namaGedung.className = "mb-2 text-base font-medium text-center block tracking-tight text-gray-800";
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


    // GET PEMINJAMAN
    async function getPeminjaman() {
            try {
                const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/peminjaman');
                const result = await response.json();

                if (result.status === 'success') {
                    const peminjamanTable = document.getElementById('peminjamanTable');
                    peminjamanTable.innerHTML = ''; // Kosongkan tabel terlebih dahulu

                    result.data.forEach(item => {
                        if (item.nama_status.toLowerCase() === 'disetujui') { // Filter data yang disetujui
                            const row = document.createElement('tr');
                            row.className = 'bg-white hover:bg-gray-100';

                            row.innerHTML = `
                                <td class="border px-4 py-2">${item.nama_ruangan}</td>
                                <td class="border px-4 py-2">${item.nama_kegiatan}</td>
                                <td class="border px-4 py-2">${item.tanggal_kegiatan}</td>
                                <td class="border px-4 py-2 text-green-600 font-bold">${item.nama_status}</td>
                            `;
                            peminjamanTable.appendChild(row);
                        }
                    });
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