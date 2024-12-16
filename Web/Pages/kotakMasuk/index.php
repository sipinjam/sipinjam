<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>SIPINJAM - Kotak Masuk</title>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <?php include '../../Components/sidebar.php'; ?>
    <!-- End Sidebar -->

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <h1 class="text-4xl font-bold p-4">Kotak Masuk</h1>
        <!-- Responsive Grid -->
        <div id="peminjamanGrid" class="pt-5 grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4 mb-4">
            <!-- Data peminjaman akan diisi di sini -->
        </div>
    </div>
    <!-- End Main -->

    <!-- Main Modal (Detail Peminjaman) -->
    <div id="mainModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl w-full">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-blue-500 font-semibold text-lg">Detail Peminjaman</h3>
                <button id="closeMainModal" class="text-gray-500 hover:text-gray-800 text-xl">&times;</button>
            </div>

            <!-- Modal Content -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Image Section -->
                <div class="flex justify-center">
                    <div>
                        <img id="modalImage" class="w-full rounded-lg" alt="Gedung Kuliah Terpadu">
                        <h2 id="modalTitle" class="text-center text-lg font-bold mt-2"></h2>
                        <p id="modalRoom" class="text-center text-sm text-gray-500"></p>
                    </div>
                </div>

                <!-- Information Section -->
                <div>
                    <!-- Peminjam -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-xl text-purple-600">Peminjam</h3>
                        <p><span class="font-semibold">Peminjam:</span> <span id="peminjam"></span></p>
                        <p><span class="font-semibold">Ormawa:</span> <span id="ormawa"></span></p>
                        <p><span class="font-semibold">Ketua Ormawa:</span> <span id="ketua_ormawa"></span></p>
                        <p><span class="font-semibold">Pembina:</span> <span id="pembina"></span></p>
                    </div>

                    <!-- Kegiatan -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-xl text-purple-600">Kegiatan</h3>
                        <p><span class="font-semibold">Nama Kegiatan:</span> <span id="nama_kegiatan"></span></p>
                        <p><span class="font-semibold">Tema Kegiatan:</span> <span id="tema_kegiatan"></span></p>
                        <p><span class="font-semibold">Ketua Pelaksana:</span> <span id="ketua_pelaksana"></span></p>
                        <p><span class="font-semibold">Hari/Tanggal:</span> <span id="tanggal"></span></p>
                        <p><span class="font-semibold">Sesi:</span> <span id="sesi"></span></p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-start gap-x-4">
                        <button id="openSubModal"
                            class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">TOLAK</button>
                        <button class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">SETUJU</button>
                    </div>

                    <!-- Sub Modal -->
                    <div id="subModal"
                        class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                            <!-- Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-blue-500 font-semibold text-lg">Keterangan</h3>
                                <button id="closeSubModal"
                                    class="text-gray-500 hover:text-gray-800 text-xl">&times;</button>
                            </div>

                            <!-- Content -->
                            <textarea
                                class="w-full h-32 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan keterangan disini..."></textarea>
                            <div class="flex justify-center mt-4">
                                <button
                                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Modal -->

    <script>
    // Fungsi untuk mengambil data peminjaman dari API dan menambahkannya ke dalam grid
    async function fetchPeminjaman() {
        const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/peminjaman');
        const data = await response.json();

        if (data.status === "success") {
            const peminjamanList = data.data;
            const peminjamanGrid = document.getElementById('peminjamanGrid');

            peminjamanList.forEach(item => {
                const peminjamanCard = document.createElement('a');
                peminjamanCard.href = "#";
                peminjamanCard.classList.add("flex", "flex-col", "items-center", "bg-white", "border",
                    "border-gray-200", "rounded-lg", "shadow", "md:flex-row", "hover:bg-gray-100");

                peminjamanCard.innerHTML = `
                        <img class="object-cover w-full rounded-t-lg h-48 md:h-full md:w-48 md:rounded-none md:rounded-s-lg" 
                            src="../../Sources/Img/gedungkuliah-terpadu.png" alt="png">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">${item.nama_ruangan}</h5>
                            <p class="text-sm text-gray-600 pt-2">Peminjam:</p>
                            <p class="text-sm font-bold">${item.nama_lengkap}</p>
                            <p class="text-sm text-gray-600 pt-1">Tanggal Pinjam:</p>
                            <p class="text-sm font-bold">${item.tgl_peminjaman}</p>
                            <p class="text-sm mt-2">Status: <span class="text-yellow-600 font-bold">${getStatusText(item.nama_status)}</span></p>
                            <button type="button" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" onclick="openDetailModal(${item.id_peminjaman})">Lihat Detail Peminjaman</button>
                        </div>
                    `;

                peminjamanGrid.appendChild(peminjamanCard);
            });
        } else {
            alert('Failed to load peminjaman data.');
        }
    }

    // Fungsi untuk menentukan status yang sesuai
    function getStatusText(status) {
        switch (status) {
            case 'proses':
                return 'Proses';
            case 'disetujui':
                return 'Disetujui';
            case 'ditolak':
                return 'Ditolak';
            default:
                return 'Unknown';
        }
    }

    // Sub Modal
    const subModal = document.getElementById('subModal');
    const openSubModal = document.getElementById('openSubModal');
    const closeSubModal = document.getElementById('closeSubModal');

    openSubModal.addEventListener('click', () => subModal.classList.remove('hidden'));
    closeSubModal.addEventListener('click', () => subModal.classList.add('hidden'));
    window.addEventListener('click', (event) => {
        if (event.target === subModal) subModal.classList.add('hidden');
    });

    // Fungsi untuk membuka modal detail dan menampilkan data peminjaman berdasarkan ID
    async function openDetailModal(idPeminjaman) {
        const url = `http://localhost/sipinjamfix/sipinjam/api/peminjaman/${idPeminjaman}`;

        try {
            const response = await fetch(url);
            const data = await response.json();

            if (data.status === "success") {
                const peminjaman = data.data;

                // Update modal dengan data peminjaman
                document.getElementById('modalImage').src = peminjaman.mainImage;
                document.getElementById('modalTitle').innerText = peminjaman.nama_ruangan;
                document.getElementById('modalRoom').innerText = peminjaman.ruangan;
                document.getElementById('peminjam').innerText = peminjaman.nama_lengkap;
                document.getElementById('ormawa').innerText = peminjaman.nama_ormawa;
                document.getElementById('ketua_ormawa').innerText = peminjaman.nama_ketua_ormawa;
                document.getElementById('pembina').innerText = peminjaman.nama_pembina;
                document.getElementById('nama_kegiatan').innerText = peminjaman.nama_kegiatan;
                document.getElementById('tema_kegiatan').innerText = peminjaman.tema_kegiatan;
                document.getElementById('ketua_pelaksana').innerText = peminjaman.nama_ketua_pelaksana;
                document.getElementById('tanggal').innerText = peminjaman.tgl_peminjaman;

                let sesiText;
                switch (peminjaman.sesi_peminjaman) {
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

                // Menampilkan sesi di modal
                document.getElementById("sesi").innerText = sesiText;

                // Show modal
                document.getElementById('mainModal').classList.remove('hidden');
            } else {
                alert('Failed to load detail peminjaman: ' + data.message || 'Unknown error');
            }
        } catch (error) {
            alert('Error fetching data: ' + error.message);
        }
    }

    // Menutup modal
    document.getElementById('closeMainModal').addEventListener('click', () => {
        document.getElementById('mainModal').classList.add('hidden');
    });

    // Memanggil fetchPeminjaman ketika halaman dimuat
    window.onload = fetchPeminjaman;
    </script>
</body>

</html>