<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../../Public/theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Detail Peminjaman</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

  <!-- Trigger Button -->
  <button id="openMainModal" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
    Buka Detail Peminjaman
  </button>

  <!-- Main Modal -->
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
            <img src="../../Sources/Img/gedungkuliah-terpadu.png" alt="Gedung Kuliah Terpadu" class="w-full rounded-lg">
            <h2 class="text-center text-lg font-bold mt-2">Gedung Kuliah Terpadu</h2>
            <p class="text-center text-sm text-gray-500">Lantai 2</p>
            <div class="mt-4 text-center">
              <a href="#" class="text-blue-500 hover:underline" id="lihatPanitia">Lihat Daftar Panitia</a>
              <br>
              <a href="#" class="text-blue-500 hover:underline">Lihat Surat Peminjaman</a>
            </div>
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
            <button id="openSubModal" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">TOLAK</button>
            <button class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">SETUJU</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Sub Modal -->
  <div id="subModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
      <!-- Header -->
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-blue-500 font-semibold text-lg">Keterangan</h3>
        <button id="closeSubModal" class="text-gray-500 hover:text-gray-800 text-xl">&times;</button>
      </div>
      
      <!-- Content -->
      <textarea class="w-full h-32 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan keterangan disini..."></textarea>
      <div class="flex justify-center mt-4">
        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Submit</button>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // Main Modal
    const mainModal = document.getElementById('mainModal');
    const openMainModal = document.getElementById('openMainModal');
    const closeMainModal = document.getElementById('closeMainModal');

    openMainModal.addEventListener('click', () => mainModal.classList.remove('hidden'));
    closeMainModal.addEventListener('click', () => mainModal.classList.add('hidden'));
    window.addEventListener('click', (event) => {
      if (event.target === mainModal) mainModal.classList.add('hidden');
    });

    // Sub Modal
    const subModal = document.getElementById('subModal');
    const openSubModal = document.getElementById('openSubModal');
    const closeSubModal = document.getElementById('closeSubModal');

    openSubModal.addEventListener('click', () => subModal.classList.remove('hidden'));
    closeSubModal.addEventListener('click', () => subModal.classList.add('hidden'));
    window.addEventListener('click', (event) => {
      if (event.target === subModal) subModal.classList.add('hidden');
    });

    // Fetch API Data
    async function getPeminjamanById() {
      const idPeminjaman = '2';
      const url = `http://localhost/sipinjamfix/sipinjam/api/peminjaman/${idPeminjaman}`;

      try {
        const response = await fetch(url);
        const data = await response.json();

        if (data.status === "success") {
          const peminjaman = data.data;
          document.getElementById("peminjam").innerText = peminjaman.nama_peminjam;
          document.getElementById("ormawa").innerText = peminjaman.nama_ormawa;
          document.getElementById("ketua_ormawa").innerText = peminjaman.nama_ketua_ormawa;
          document.getElementById("pembina").innerText = peminjaman.nama_pembina;
          document.getElementById("nama_kegiatan").innerText = peminjaman.nama_kegiatan;
          document.getElementById("tema_kegiatan").innerText = peminjaman.tema_kegiatan;
          document.getElementById("ketua_pelaksana").innerText = peminjaman.nama_ketua_pelaksana;
          document.getElementById("tanggal").innerText = peminjaman.tanggal_kegiatan;

          const waktuMulai = peminjaman.waktu_mulai;
          const waktuSelesai = peminjaman.waktu_selesai;
          let sesi = '';

          if (waktuMulai === '08:00:00' && waktuSelesai === '12:00:00') sesi = 'Sesi 1';
          else if (waktuMulai === '12:00:00' && waktuSelesai === '16:00:00') sesi = 'Sesi 2';
          else if (waktuMulai === '08:00:00' && waktuSelesai === '16:00:00') sesi = 'Full Sesi';
          else sesi = 'Waktu tidak sesuai sesi yang ditentukan';

          document.getElementById("sesi").innerText = sesi;
        } else {
          alert("Gagal mengambil data peminjaman.");
        }
      } catch (error) {
        alert("Terjadi kesalahan: " + error.message);
      }
    }

    // Call API on load
    window.onload = getPeminjamanById;
  </script>
</body>
</html>