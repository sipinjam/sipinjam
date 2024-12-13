<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Kegiatan</title>
    <link rel="stylesheet" href="../../Public/theme.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen ">

    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>
    <!-- End Sidebar -->

    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

    <!-- Main Content -->
    <div class="flex pl-44 max-w-6xl mx-auto bg-gray-50 rounded-lg p-8 pt-24 flex-row items-center justify-center min-h-screen bg-gray-100">

        <!-- Grid Container for Responsive Layout -->
        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

            <!-- Kegiatan Card -->
            <div class="bg-white shadow-lg rounded-lg h-64">
                <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Kegiatan</div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                        <select id="nama_kegiatan" name="nama_kegiatan"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih Kegiatan</option>
                            <!-- Options will be added dynamically -->
                        </select>
                    </div>
                </div>
            </div>

            <!-- Ormawa Card -->
            <div class="bg-white shadow-lg rounded-lg h-[36rem]">
                <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Ormawa</div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Ketua HM/UKM</label>
                        <input id="namaKetuaHMUKM" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM Ketua HM/UKM</label>
                        <input id="nimKetuaHMUKM" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ketua Pelaksana</label>
                        <select id="ketuaPelaksanaDropdown" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih Ketua Pelaksana</option>
                            <!-- Options will be added dynamically -->
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM Ketua Pelaksana</label>
                        <input id="nimKetuaPelaksana" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pembina HM/UKM</label>
                        <input id="namaPembinaHMUKM" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIP Pembina HM/UKM</label>
                        <input id="nipPembinaHMUKM" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                </div>
            </div>

            <!-- Kegiatan Card -->
            <div class="w-96">
                <div class="bg-white shadow-lg rounded-lg">
                    <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Form Peminjaman</div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ruangan</label>
                            <input id="ruangan" type="text" placeholder="Pilih Ruangan"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                            <div id="suggestions" class="absolute bg-white border border-gray-300 rounded-md mt-1 hidden">
                                <!-- Suggestions will be populated here -->
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Peminjaman</label>
                            <input id="tgl_peminjaman" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 my-2">Sesi Peminjaman</label>
                            <div class="time-selector">
                                <button class="time-button flex-1 px-4 border border-silver-500 rounded text-silver-500 w-32 h-8" data-sesi="1">08:00 - 12:00</button>
                                <button class="time-button flex-1 px-4 border border-silver-500 rounded text-silver-500 w-32 h-8" data-sesi="2">12:00 - 16:00</button>
                                <button class="time-button flex-1 px-4 border border-silver-500 rounded text-silver-500 w-32 h-8" data-sesi="3">08:00 - 16:00</button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <input id="keterangan" type="text" placeholder="Masukkan keterangan"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-4">
                    <button class="py-2 px-6 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600">Cancel</button>
                    <button id="submitPeminjaman" class="py-2 px-6 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }
        const idOrmawa = getCookie('id_ormawa');
        const idPeminjam = getCookie('id_peminjam');
        async function getKegiatan(idOrmawa) {
            try {
                const response = await fetch(`http://localhost/sipinjamfix/sipinjam/api/kegiatan/${idOrmawa}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const result = await response.json();
                return result.data || [];
            } catch (error) {
                console.error('Error fetching data:', error);
                return [];
            }
        }

        async function populateKegiatanDropdown() {
            if (idOrmawa) {
                const kegiatanList = await getKegiatan(idOrmawa);
                const selectKegiatan = document.getElementById('nama_kegiatan');

                if (Array.isArray(kegiatanList) && kegiatanList.length > 0) {
                    kegiatanList.forEach(kegiatan => {
                        const option = document.createElement('option');
                        option.value = kegiatan.id_kegiatan;
                        option.textContent = kegiatan.nama_kegiatan;
                        selectKegiatan.appendChild(option);
                    });
                } else {
                    const option = document.createElement('option');
                    option.textContent = 'Tidak ada kegiatan tersedia';
                    selectKegiatan.appendChild(option);
                }
            } else {
                console.error('id_ormawa cookie not found');
            }
        }

        window.onload = populateKegiatanDropdown();
        async function getMahasiswaByOrmawa(idOrmawa) {
            try {
                const response = await fetch(`http://localhost/sipinjamfix/sipinjam/api/mahasiswa?id_ormawa=${idOrmawa}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const result = await response.json();
                return result.data; // Pastikan ini sesuai dengan struktur respons API Anda
            } catch (error) {
                console.error('Error fetching data:', error);
                return [];
            }
        }

        // Fungsi untuk mengisi form
        async function fillForm() {
            const mahasiswaData = await getMahasiswaByOrmawa(idOrmawa);

            if (mahasiswaData.length > 0) {
                // Ambil data ketua HM/UKM
                const ketuaHMUKM = mahasiswaData[0]; // Asumsi ketua HM/UKM adalah mahasiswa pertama
                document.getElementById('namaKetuaHMUKM').value = ketuaHMUKM.nama_mahasiswa;
                document.getElementById('nimKetuaHMUKM').value = ketuaHMUKM.nim_mahasiswa;
                document.getElementById('namaPembinaHMUKM').value = ketuaHMUKM.nama_pembina;
                document.getElementById('nipPembinaHMUKM').value = ketuaHMUKM.nip_pembina;

                // Tambahkan opsi untuk ketua pelaksana
                const dropdown = document.getElementById('ketuaPelaksanaDropdown');
                mahasiswaData.forEach(mahasiswa => {
                    const option = document.createElement('option');
                    option.value = mahasiswa.nim_mahasiswa; // NIM sebagai value
                    option.textContent = mahasiswa.nama_mahasiswa; // Nama sebagai teks
                    dropdown.appendChild(option);
                });

                // Event listener untuk dropdown
                dropdown.addEventListener('change', function() {
                    const selectedNIM = this.value;
                    const selectedMahasiswa = mahasiswaData.find(m => m.nim_mahasiswa === selectedNIM);
                    if (selectedMahasiswa) {
                        document.getElementById('nimKetuaPelaksana').value = selectedMahasiswa.nim_mahasiswa;
                    } else {
                        document.getElementById('nimKetuaPelaksana').value = '';
                    }
                });
            }
        }

        // Panggil fungsi untuk mengisi form saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fillForm);
        async function getKegiatan() {
            try {
                const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/kegiatan');
                const result = await response.json();
                const selectKegiatan = document.getElementById('nama_kegiatan');
                result.data.forEach(kegiatan => {
                    const option = document.createElement('option');
                    option.value = kegiatan.id_kegiatan;
                    option.textContent = kegiatan.nama_kegiatan;
                    selectKegiatan.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching kegiatan:', error);
            }
        }

        async function getRuangan() {
            try {
                const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/ruangan');
                const result = await response.json();
                const inputRuangan = document.getElementById('ruangan');
                const suggestions = document.getElementById('suggestions');

                inputRuangan.addEventListener('input', () => {
                    const query = inputRuangan.value.toLowerCase();
                    suggestions.innerHTML = '';
                    const filteredRuangan = result.data.filter(ruangan => ruangan.nama_ruangan.toLowerCase().includes(query));
                    filteredRuangan.forEach(ruangan => {
                        const suggestionItem = document.createElement('div');
                        suggestionItem.textContent = ruangan.nama_ruangan;
                        suggestionItem.classList.add('suggestion-item', 'p-2', 'cursor-pointer');
                        suggestionItem.addEventListener('click', () => {
                            inputRuangan.value = ruangan.nama_ruangan; // Set nama ruangan di input
                            inputRuangan.setAttribute('data-id', ruangan.id_ruangan); // Simpan id_ruangan di atribut data
                            suggestions.innerHTML = '';
                            suggestions.classList.add('hidden');
                        });
                        suggestions.appendChild(suggestionItem);
                    });
                    suggestions.classList.remove('hidden');
                });

                document.addEventListener('click', () => {
                    suggestions.classList.add('hidden');
                });
            } catch (error) {
                console.error('Error fetching ruangan:', error);
            }
        }
        window.onload = getRuangan()
        let sesiPeminjaman = null;

        // Fungsi untuk memeriksa ketersediaan ruangan
        // Fungsi untuk memeriksa ketersediaan ruangan

        document.querySelectorAll('.time-button').forEach(button => {
            button.addEventListener('click', async () => {
                const selectedSesi = button.getAttribute('data-sesi');
                const tglPeminjaman = document.getElementById('tgl_peminjaman').value;
                const inputRuangan = document.getElementById('ruangan');
                const idRuangan = inputRuangan.getAttribute('data-id'); // Ambil id_ruangan dari atribut data

                if (tglPeminjaman && idRuangan) {
                    const isAvailable = await checkRuanganAvailability(tglPeminjaman, selectedSesi, idRuangan); // Gunakan id_ruangan
                    if (isAvailable) {
                        // Reset semua tombol
                        document.querySelectorAll('.time-button').forEach(btn => {
                            btn.classList.remove('bg-blue-500', 'text-white'); // Reset warna aktif
                            btn.classList.add('bg-blue-100', 'text-blue-500'); // Kembalikan warna default
                        });

                        // Ubah warna tombol yang dipilih
                        button.classList.add('bg-blue-500', 'text-white'); // Set warna aktif
                        button.classList.remove('bg-blue-100', 'text-blue-500'); // Hapus warna default
                        sesiPeminjaman = selectedSesi; // Simpan sesi yang dipilih
                    } else {
                        alert('Ruangan tidak tersedia untuk sesi ini.');
                    }
                } else {
                    alert('Silakan pilih tanggal dan ruangan terlebih dahulu.');
                }
            });
        });


        async function checkRuanganAvailability(tanggal, sesi, idRuangan) {

            try {
                const response = await fetch(`http://localhost/sipinjamfix/sipinjam/api/peminjaman?date=${tanggal}&sesi=${sesi}&ruangan=${idRuangan}`);
                const result = await response.json();
                return result.data.available; // Pastikan API mengembalikan status ketersediaan
            } catch (error) {
                console.error('Error checking availability:', error);
                return false;
            }
        }
        // Fungsi untuk menonaktifkan tombol sesi yang tidak tersedia
        async function disableUnavailableSessions(tanggal, ruangan) {
            let sesi3Available = await checkRuanganAvailability(tanggal, 3, ruangan);

            // Nonaktifkan sesi 1 dan 2 jika sesi 3 tidak tersedia
            if (!sesi3Available) {
                const button1 = document.querySelector('.time-button[data-sesi="1"]');
                const button2 = document.querySelector('.time-button[data-sesi="2"]');

                button1.disabled = true; // Nonaktifkan tombol sesi 1
                button1.classList.add('opacity-50', 'cursor-not-allowed'); // Tambahkan gaya untuk menunjukkan nonaktif

                button2.disabled = true; // Nonaktifkan tombol sesi 2
                button2.classList.add('opacity-50', 'cursor-not-allowed'); // Tambahkan gaya untuk menunjukkan nonaktif
            } else {
                // Jika sesi 3 tersedia, periksa ketersediaan sesi 1 dan 2
                for (let sesi = 1; sesi <= 2; sesi++) {
                    const isAvailable = await checkRuanganAvailability(tanggal, sesi, ruangan);
                    const button = document.querySelector(`.time-button[data-sesi="${sesi}"]`);
                    if (!isAvailable) {
                        button.disabled = true; // Nonaktifkan tombol
                        button.classList.add('opacity-50', 'cursor-not-allowed'); // Tambahkan gaya untuk menunjukkan nonaktif
                    } else {
                        button.disabled = false; // Pastikan tombol dapat diklik
                        button.classList.remove('opacity-50', 'cursor-not-allowed'); // Hapus gaya nonaktif
                    }
                }
            }
        }

        // Event listener untuk input tanggal dan ruangan
        document.getElementById('tgl_peminjaman').addEventListener('change', () => {
            const tglPeminjaman = document.getElementById('tgl_peminjaman').value;
            const inputRuangan = document.getElementById('ruangan');
            const idRuangan = inputRuangan.getAttribute('data-id'); // Ambil id_ruangan dari atribut data
            if (tglPeminjaman && idRuangan) {
                disableUnavailableSessions(tglPeminjaman, idRuangan);
            }
        });
        document.getElementById('submitPeminjaman').addEventListener('click', async () => {
            const idKegiatan = document.getElementById('nama_kegiatan').value;
            const inputRuangan = document.getElementById('ruangan');
            const idRuangan = inputRuangan.getAttribute('data-id'); // Ambil id_ruangan dari atribut data
            const tglPeminjaman = document.getElementById('tgl_peminjaman').value;
            const keterangan = document.getElementById('keterangan').value; // Ambil nilai keterangan

            if (idKegiatan && idRuangan && tglPeminjaman && sesiPeminjaman && keterangan) {
                const data = {
                    id_kegiatan: idKegiatan,
                    id_ruangan: idRuangan, // Kirim id_ruangan ke API
                    id_status: 1,
                    keterangan: keterangan, // Sertakan keterangan
                    tgl_peminjaman: tglPeminjaman,
                    sesi_peminjaman: sesiPeminjaman
                };

                try {
                    const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/peminjaman', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    if (response.ok) {
                        alert('Peminjaman berhasil dibuat!');
                        // Reset form or redirect as needed
                    } else {
                        const errorData = await response.json();
                        alert('Gagal membuat peminjaman: ' + errorData.message);
                    }
                } catch (error) {
                    console.error('Error creating peminjaman:', error);
                }
            } else {
                alert('Silakan lengkapi semua field.');
            }
        });
    </script>
</body>

</html>