<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <title>SIPINJAM - Kotak Masuk</title>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->
    <!-- Sidebar -->
    <?php include '../../Components/sidebar.php'; ?>
    <!-- End Sidebar -->

    <!-- Main Content -->
    <div class="p-4 pt-20 sm:ml-64">
        <h3 class="text-4xl font-bold p-4">Kotak Masuk</h3>

        <table id="peminjamanTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead class="bg-biru-500 text-white">
                <tr>
                    <th class="px-4 py-2">Nama Ruangan</th>
                    <th class="px-4 py-2">Peminjam</th>
                    <th class="px-4 py-2">Ormawa</th>
                    <th class="px-4 py-2">Tanggal Pinjam</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2 text-center">Detail Peminjaman</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <!-- Data akan dimuat dengan JavaScript -->
            </tbody>
        </table>
    </div>

    <div id="mainModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl max-w-2xl w-full">
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-4 mb-6">
                <h2 id="modalTitle" class="text-2xl font-bold mt-4 text-gray-800 text-left"></h2>
                <button id="closeMainModal"
                    class="text-gray-500 hover:text-gray-800 text-2xl font-semibold">&times;</button>
            </div>

            <!-- Modal Content -->
            <div>
                <!-- Information Section -->
                <div>
                    <!-- Peminjam -->
                    <div class="mb-8">
                        <h3 class="font-bold text-xl text-blue-700 mb-2">Peminjam</h3>
                        <ul class="space-y-1 text-gray-700">
                            <li><strong>Peminjam:</strong> <span id="peminjam"></span></li>
                            <li><strong>Ormawa:</strong> <span id="ormawa"></span></li>
                            <li><strong>Ketua Ormawa:</strong> <span id="ketua_ormawa"></span></li>
                            <li><strong>Pembina:</strong> <span id="pembina"></span></li>
                        </ul>
                    </div>

                    <!-- Kegiatan -->
                    <div class="mb-8">
                        <h3 class="font-bold text-xl text-blue-700 mb-2">Kegiatan</h3>
                        <ul class="space-y-1 text-gray-700">
                            <li><strong>Nama Kegiatan:</strong> <span id="nama_kegiatan"></span></li>
                            <li><strong>Tema Kegiatan:</strong> <span id="tema_kegiatan"></span></li>
                            <li><strong>Ketua Pelaksana:</strong> <span id="ketua_pelaksana"></span></li>
                            <li><strong>Hari/Tanggal:</strong> <span id="tanggal"></span></li>
                            <li><strong>Sesi:</strong> <span id="sesi"></span></li>
                        </ul>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-4">
                    <button id="openSubModal"
                        class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold shadow-lg hover:bg-red-600">TOLAK</button>
                    <button id="btnSetuju"
                        class="bg-green-500 text-white px-6 py-2 rounded-lg font-semibold shadow-lg hover:bg-green-600">SETUJU</button>
                </div>

                <!-- Sub Modal -->
                <div id="subModal"
                    class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                    <div class="bg-white p-6 rounded-lg shadow-2xl max-w-md w-full">
                        <!-- Header -->
                        <div class="flex justify-between items-center border-b pb-4 mb-4">
                            <h3 class="text-blue-600 font-bold text-lg">Keterangan</h3>
                            <button id="closeSubModal"
                                class="text-gray-500 hover:text-gray-800 text-2xl font-semibold">&times;</button>
                        </div>

                        <!-- Content -->
                        <textarea id="alasanTolak"
                            class="w-full h-32 border border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan alasan penolakan di sini..."></textarea>
                        <div class="flex justify-center mt-6">
                            <button id="btnSubmitTolak"
                                class="bg-blue-500 text-white px-6 py-2 rounded-lg font-semibold shadow-lg hover:bg-blue-600">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    // Fungsi untuk mengambil data peminjaman dari API
    async function fetchPeminjaman() {
        const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/peminjaman');
        const data = await response.json();

        if (data.status === "success") {
            const peminjamanList = data.data.filter(item => item.nama_status.toLowerCase() === 'proses');
            loadPeminjamanTable(peminjamanList);
        } else {
            alert('Failed to load peminjaman data.');
        }
    }

    // Fungsi untuk memuat tabel peminjaman dengan DataTables
    function loadPeminjamanTable(peminjamanList) {
        const peminjamanTable = $('#peminjamanTable tbody');
        peminjamanTable.empty(); // Bersihkan tabel sebelum memuat data baru

        peminjamanList.forEach(item => {
            peminjamanTable.append(`
                    <tr>
                        <td class="border px-4 py-2">${item.nama_ruangan}</td>
                        <td class="border px-4 py-2">${item.nama_lengkap}</td>
                        <td class="border px-4 py-2">${item.nama_ormawa}</td>
                        <td class="border px-4 py-2">${item.tgl_peminjaman}</td>
                        <td class="border px-4 py-2 text-yellow-600 font-bold">${item.nama_status}</td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" class="border text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2" onclick="openDetailModal(${item.id_peminjaman})">Lihat Detail</button>
                        </td>
                    </tr>
                `);
        });

        // Inisialisasi DataTables
        $('#peminjamanTable').DataTable({
            destroy: true, // Hapus DataTables lama jika ada
            responsive: true,
            paging: true,
            searching: false,
            ordering: true,
        });
    }

    // Sub Modal
    const subModal = document.getElementById('subModal');
    const openSubModal = document.getElementById('openSubModal');
    const closeSubModal = document.getElementById('closeSubModal');
    const btnSubmitTolak = document.getElementById('btnSubmitTolak');

    // Event listener untuk membuka modal kecil (alasan TOLAK)
    openSubModal.addEventListener('click', () => {
        subModal.classList.remove('hidden');
    });

    // Event listener untuk menutup modal kecil
    closeSubModal.addEventListener('click', () => {
        subModal.classList.add('hidden');
    });

    // Event listener untuk klik di luar modal
    window.addEventListener('click', (event) => {
        if (event.target === subModal) {
            subModal.classList.add('hidden');
        }
    });

    // Event listener untuk tombol submit penolakan
    let selectedIdPeminjaman = null; // Variabel global untuk menyimpan ID peminjaman yang sedang diproses

    // Fungsi untuk membuka modal detail dan menampilkan data peminjaman berdasarkan ID
    async function openDetailModal(idPeminjaman) {
        const url = `http://localhost/sipinjamfix/sipinjam/api/peminjaman/${idPeminjaman}`;
        selectedIdPeminjaman = idPeminjaman; // Set ID peminjaman yang dipilih

        try {
            const response = await fetch(url);
            const data = await response.json();

            if (data.status === "success") {
                const peminjaman = data.data;

                // Update modal dengan data peminjaman
                document.getElementById('modalTitle').innerText = peminjaman.nama_ruangan;
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

    // Event listener untuk tombol SETUJU
    document.getElementById("btnSetuju").addEventListener("click", async () => {
        if (!selectedIdPeminjaman) {
            alert('ID peminjaman tidak ditemukan.');
            return;
        }

        try {
            const response = await fetch(
                `http://localhost/sipinjamfix/sipinjam/api/peminjaman/${selectedIdPeminjaman}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_status: 3
                    }) // 3 untuk disetujui
                });

            const result = await response.json();
            if (result.status === 'success') {
                alert('Peminjaman berhasil disetujui.');
                location.reload(); // Refresh data di halaman
            } else {
                alert('Gagal menyetujui peminjaman: ' + result.message);
            }
        } catch (error) {
            alert('Terjadi kesalahan: ' + error.message);
        }
    });

    // Event listener untuk tombol TOLAK
    document.getElementById('btnSubmitTolak').addEventListener('click', async () => {
        if (!selectedIdPeminjaman) {
            alert('ID peminjaman tidak ditemukan.');
            return;
        }

        const keterangan = document.getElementById('alasanTolak').value.trim(); // Ambil isi dari textarea
        if (!keterangan) {
            alert('Harap masukkan alasan penolakan.');
            return;
        }

        try {
            const response = await fetch(
                `http://localhost/sipinjamfix/sipinjam/api/peminjaman/${selectedIdPeminjaman}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_status: 2,
                        keterangan
                    }) // Tambahkan 'keterangan' ke body request
                });

            const result = await response.json();
            if (result.status === 'success') {
                alert('Peminjaman berhasil ditolak.');
                document.getElementById('subModal').classList.add('hidden'); // Tutup sub-modal
                location.reload(); // Refresh data di halaman
            } else {
                alert('Gagal menolak peminjaman: ' + result.message);
            }
        } catch (error) {
            alert('Terjadi kesalahan: ' + error.message);
        }
    });

    // Menutup modal
    document.getElementById('closeMainModal').addEventListener('click', () => {
        document.getElementById('mainModal').classList.add('hidden');
    });

    // Memanggil fetchPeminjaman ketika halaman dimuat
    window.onload = fetchPeminjaman;
    </script>
</body>

</html>