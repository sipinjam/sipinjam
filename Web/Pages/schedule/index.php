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
            <div class="relative">
                <input type="search" id="default-search"
                    class="w-full p-2 md:p-3 pl-10 text-sm md:text-base text-gray-900 rounded-lg bg-gray-300 placeholder-gray-500"
                    placeholder="Cari Ruangan" required />
                <button type="submit"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-800 text-white px-4 py-1 rounded-md">
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
            <tbody class="text-gray-700">
                <tr>
                    <td class="border px-4 py-2">GKT Lantai 2</td>
                    <td class="border px-4 py-2">Seminar</td>
                    <td class="border px-4 py-2">28 September 2024</td>
                    <td class="border px-4 py-2 text-green-600 font-bold">Disetujui</td>
                </tr>
                <!-- Other rows here -->
            </tbody>
        </table>
    </div>

    <!-- Page Navigation -->
    <nav aria-label="Page navigation example">
        <ul class="flex items-center justify-center h-20 text-sm">
            <!-- Page navigation here -->
        </ul>
    </nav>

    <script>
        async function getGedung() {
            try {
                const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/gedung');
                const result = await response.json();

                if (result.status === 'success') {
                    const gedungContainer = document.getElementById('gedungContainer');

                    result.data.forEach(gedung => {
                        // Create card container
                        const gedungItem = document.createElement('div');
                        gedungItem.className = "w-[350px] h-[270px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0";

                        // Link container for image
                        const link = document.createElement('a');
                        link.href = "#";

                        // Image
                        const img = document.createElement('img');
                        img.className = "gedung w-full h-[230px] rounded-t-[20px]";
                        img.src = gedung.foto_gedung ? gedung.foto_gedung : "../../Sources/Img/default.jpg";
                        img.alt = gedung.nama_gedung;
                        link.appendChild(img);

                        // Append image link to card container
                        gedungItem.appendChild(link);

                        // Name container
                        const contentDiv = document.createElement('div');
                        contentDiv.className = "p-2";

                        const nameLink = document.createElement('a');
                        nameLink.href = "#";

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

        // Panggil fungsi getGedung saat halaman dimuat
        window.onload = getGedung;
    </script>

</body>

</html>