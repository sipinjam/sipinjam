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
    <!-- Header -->
    <?php include '../../components/header.php' ?>

    <!-- Main Content -->
    <div class="flex pl-72 max-w-8xl rounded-lg pt-24 flex-row bg-gray-100">
        <div>
            <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3 w-auto h-auto">
                <!-- Kegiatan Card -->
                <div class="bg-white shadow-lg rounded-lg h-72">
                    <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Kegiatan</div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                            <input id="nama_kegiatan_input" type="text" placeholder="Pilih Kegiatan"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                            <div id="kegiatan_suggestions" class="absolute bg-white border border-gray-300 rounded-md mt-1 hidden">
                                <!-- Suggestions will be populated here -->
                            </div>
                        </div>
                        <p class="text-red-600 text-md">*Jika Kegiatan tidak ada di daftar, mohon tambah kegiatan terlebih dahulu</p>
                        <!-- Tombol untuk menambah kegiatan -->
                        <button id="tambahKegiatan" class="mt-2 py-2 px-4 bg-green-500 text-white rounded-md hover:bg-green-600">
                            Tambah Kegiatan
                        </button>
                    </div>
                </div>
                <div id="createKegiatanForm" class="hidden space-y-4 bg-white shadow-lg rounded-lg">
                    <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Form Tambah Kegiatan</div>
                    <div class="space-y-4 px-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                            <input id="nama_kegiatan_input" type="text" placeholder="Masukkan Nama Kegiatan"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tema Kegiatan</label>
                            <input id="tema_kegiatan_input" type="text" placeholder="Masukkan Tema Kegiatan"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Daftar Panitia (PDF)</label>
                            <input id="daftar_panitia_input" type="file" accept="application/pdf"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ketua Pelaksana</label>
                            <select id="ketuaPelaksanaDropdown" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                                <option value="">Pilih Ketua Pelaksana</option>
                                <!-- Options will be added dynamically -->
                            </select>
                        </div>
                        <button id="submitKegiatan" class="py-2 px-6 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">Submit</button>
                    </div>
                </div>

                <!-- Kegiatan Card -->
                <div id="formPeminjaman" class="w-96">
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
                                <label class="block text-sm font-medium text-gray-700">Tanggal Peminjaman </label>
                                <input id="tgl_peminjaman" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 my-2">Sesi Peminjaman</label>
                                <div class="time-selector flex flex-col space-y-4">
                                    <div>
                                        <button class="time-button flex-1 px-4 border border-silver-500 rounded text-silver-500 w-32 h-8" data-sesi="1">08:00 - 12:00</button>
                                        <button class="time-button flex-1 px-4 border border-silver-500 rounded text-silver-500 w-32 h-8" data-sesi="2">12:00 - 16:00</button>
                                    </div>
                                    <div>
                                        <button class="time-button flex-1 px-4 border border-silver-500 rounded text-silver-500 w-32 h-8" data-sesi="3">08:00 - 16:00</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <input id="keterangan" type="text" placeholder="Masukkan keterangan"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="flex justify-end space-x-4 mt-4">
                                <button class="py-2 px-6 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600">Cancel</button>
                                <button id="submitPeminjaman" class="py-2 px-6 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">Submit</button>
                                <button type="button" onclick="tambahForm()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Tambah Formulir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function tambahForm() {
                const container = document.getElementById('formPeminjaman');

                // Elemen form baru
                const formGroup = document.createElement('div');
                formGroup.classList.add('space-y-4', 'border', 'p-4', 'rounded', 'bg-white', 'shadow-md', 'mb-4');

                formGroup.innerHTML = `
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
                                <label class="block text-sm font-medium text-gray-700">Tanggal Peminjaman </label>
                                <input id="tgl_peminjaman" type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 my-2">Sesi Peminjaman</label>
                                <div class="time-selector flex flex-col space-y-4">
                                    <div>
                                        <button class="time-button flex-1 px-4 border border-silver-500 rounded text-silver-500 w-32 h-8" data-sesi="1">08:00 - 12:00</button>
                                        <button class="time-button flex-1 px-4 border border-silver-500 rounded text-silver-500 w-32 h-8" data-sesi="2">12:00 - 16:00</button>
                                    </div>
                                    <div>
                                        <button class="time-button flex-1 px-4 border border-silver-500 rounded text-silver-500 w-32 h-8" data-sesi="3">08:00 - 16:00</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <input id="keterangan" type="text" placeholder="Masukkan keterangan"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="flex justify-end space-x-4 mt-4">
                                <button class="py-2 px-6 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600">Cancel</button>
                                <button id="submitPeminjaman" class="py-2 px-6 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="text-red-500 text-sm" onclick="hapusForm(this)">Hapus Form</button>
            `;

                container.appendChild(formGroup);
            }

            function hapusForm(button) {
                const formGroup = button.parentElement;
                formGroup.remove();
            }

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

            async function populateKegiatanInput() {
                const inputKegiatan = document.getElementById('nama_kegiatan_input');
                const suggestions = document.getElementById('kegiatan_suggestions');

                if (idOrmawa) {
                    const kegiatanList = await getKegiatan(idOrmawa);

                    inputKegiatan.addEventListener('input', () => {
                        const query = inputKegiatan.value.toLowerCase();
                        suggestions.innerHTML = '';
                        const filteredKegiatan = kegiatanList.filter(kegiatan => kegiatan.nama_kegiatan.toLowerCase().includes(query));

                        filteredKegiatan.forEach(kegiatan => {
                            const suggestionItem = document.createElement('div');
                            suggestionItem.textContent = kegiatan.nama_kegiatan;
                            suggestionItem.classList.add('suggestion-item', 'p-2', 'cursor-pointer');
                            suggestionItem.addEventListener('click', () => {
                                inputKegiatan.value = kegiatan.nama_kegiatan; // Set nama kegiatan di input
                                inputKegiatan.setAttribute('kegiatan-id', kegiatan.id_kegiatan); // Simpan id_kegiatan di atribut data
                                suggestions.innerHTML = '';
                                suggestions.classList.add('hidden');
                            });
                            suggestions.appendChild(suggestionItem);
                        });

                        if (filteredKegiatan.length > 0) {
                            suggestions.classList.remove('hidden');
                        } else {
                            suggestions.classList.add('hidden');
                        }
                    });

                    document.addEventListener('click', () => {
                        suggestions.classList.add('hidden');
                    });
                } else {
                    console.error('id_ormawa cookie not found');
                }
            }

            // Panggil fungsi untuk mengisi input saat halaman dimuat
            window.onload = populateKegiatanInput();
            //fungsi tambah kegiatan
            document.getElementById('tambahKegiatan').addEventListener('click', function() {
                const createKegiatanForm = document.getElementById('createKegiatanForm');
                const formPeminjaman = document.getElementById('formPeminjaman');

                // Tampilkan form untuk membuat kegiatan
                createKegiatanForm.classList.remove('hidden');
                formPeminjaman.classList.add('opacity-50'); // Disable form peminjaman
                formPeminjaman.querySelectorAll('input, select, button').forEach(el => el.disabled = true);
            });

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

                    // Tambahkan opsi untuk ketua pelaksana
                    const dropdown = document.getElementById('ketuaPelaksanaDropdown');
                    if (dropdown) {
                        mahasiswaData.forEach(mahasiswa => {
                            const option = document.createElement('option');
                            option.value = mahasiswa.id_mahasiswa; // NIM sebagai value
                            option.textContent = mahasiswa.nama_mahasiswa; // Nama sebagai teks
                            dropdown.appendChild(option);
                        });

                        // Event listener untuk dropdown
                        dropdown.addEventListener('change', function() {
                            const selectedNIM = this.value;
                            const selectedMahasiswa = mahasiswaData.find(m => m.nim_mahasiswa === selectedNIM);
                            const nimKetuaPelaksanaInput = document.getElementById('nimKetuaPelaksana');

                            if (selectedMahasiswa && nimKetuaPelaksanaInput) {
                                nimKetuaPelaksanaInput.value = selectedMahasiswa.nim_mahasiswa;
                            } else if (nimKetuaPelaksanaInput) {
                                nimKetuaPelaksanaInput.value = '';
                            }
                        });
                    }
                }
            }


            // Panggil fungsi untuk mengisi form saat halaman dimuat
            document.addEventListener('DOMContentLoaded', fillForm);
            document.getElementById('submitKegiatan').addEventListener('click', async () => {
                const namaKegiatan = document.getElementById('nama_kegiatan_input').value;
                const temaKegiatan = document.getElementById('tema_kegiatan_input').value;
                const daftarPanitiaInput = document.getElementById('daftar_panitia_input');
                const idOrmawa = getCookie('id_ormawa'); // Ambil id_ormawa dari cookie
                const idPeminjam = getCookie('id_peminjam'); // Ambil id_peminjam dari cookie
                const ketuaPelaksanaDropdown = document.getElementById('ketuaPelaksanaDropdown');
                const idMahasiswa = ketuaPelaksanaDropdown.value; // Ambil id_mahasiswa dari dropdown

                // Pastikan ada file yang diupload
                if (daftarPanitiaInput.files.length === 0) {
                    alert('Silakan unggah file daftar panitia (PDF).');
                    return;
                }

                const file = daftarPanitiaInput.files[0];
                const formData = new FormData();
                formData.append('nama_kegiatan', namaKegiatan);
                formData.append('tema_kegiatan', temaKegiatan);
                formData.append('daftar_panitia', file);
                formData.append('id_ormawa', idOrmawa);
                formData.append('id_mahasiswa', idMahasiswa);
                formData.append('id_peminjam', idPeminjam);

                try {
                    const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/kegiatan', {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        alert('Kegiatan berhasil dibuat!');
                        // Reset form or redirect as needed
                        location.reload();
                    } else {
                        const errorData = await response.json();
                        alert('Gagal membuat kegiatan: ' + errorData.message);
                    }
                } catch (error) {
                    console.error('Error creating kegiatan:', error);
                }
            });

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
                            // document.querySelectorAll('.time-button').forEach(btn => {
                            //     btn.classList.remove('bg-blue-500', 'text-white');
                            //     btn.classList.add('bg-blue-100', 'text-blue-500'); 
                            // });

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
                const inputKegiatan = document.getElementById('nama_kegiatan_input');
                const idKegiatan = inputKegiatan.getAttribute('kegiatan-id'); // Ganti 'kegiatan_id' dengan 'data-kegiatan-id'
                const inputRuangan = document.getElementById('ruangan');
                const idRuangan = inputRuangan.getAttribute('data-id'); // Ambil id_ruangan dari atribut data
                const tglPeminjaman = document.getElementById('tgl_peminjaman').value;
                const keterangan = document.getElementById('keterangan').value; // Ambil nilai keterangan

                // Array untuk menyimpan pesan kesalahan
                const errors = [];

                // Periksa setiap field dan tambahkan pesan kesalahan jika ada yang kosong
                if (!idKegiatan) {
                    errors.push('ID Kegiatan belum dipilih.');
                }
                if (!idRuangan) {
                    errors.push('ID Ruangan belum dipilih.');
                }
                if (!tglPeminjaman) {
                    errors.push('Tanggal peminjaman belum diisi.');
                }
                if (!sesiPeminjaman) {
                    errors.push('Sesi peminjaman belum dipilih.');
                }
                if (!keterangan) {
                    errors.push('Keterangan belum diisi.');
                }

                // Jika ada kesalahan, tampilkan di konsol dan beri tahu pengguna
                if (errors.length > 0) {
                    console.error('Kesalahan:', errors);
                    alert('Silakan lengkapi semua field:\n' + errors.join('\n'));
                    return; // Hentikan eksekusi jika ada kesalahan
                }

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
            });
        </script>
</body>

</html>