<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .active-thumbnail {
            border: 2px solid #4f46e5; /* Warna ungu */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <!-- Overlay Popup -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <!-- Konten Popup -->
        <div class="bg-white rounded-lg shadow-lg max-w-6xl w-full mx-4 p-6 relative">
            <!-- Tombol Close -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
                &times;
            </button>

            <!-- Konten utama popup (gambar dan informasi) -->
            <div class="flex space-x-6">
                <!-- Carousel Gambar -->
                <div class="w-2/3">
                    <div class="relative">
                        <img id="mainImage" src="" alt="Ruangan" class="rounded-lg object-cover w-full h-80">
                        <button onclick="prevImage()" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                            &lt;
                        </button>
                        <button onclick="nextImage()" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                            &gt;
                        </button>
                    </div>

                    <!-- Thumbnail gambar kecil -->
                    <div id="thumbnailContainer" class="flex mt-4 space-x-2">
                        <!-- Thumbnail images akan dimuat di sini -->
                    </div>
                </div>

                <!-- Informasi Ruangan -->
                <div class="w-1/3 flex flex-col justify-between">
                    <div>
                        <!-- Nama Gedung dan Kapasitas -->
                        <h2 id="namaRuangan" class="text-xl font-semibold"></h2>
                        <p id="namaGedung" class="text-gray-600 mb-2"></p>
                        <hr class="my-2 border-gray-300">
                        <p class="text-gray-500 flex items-center space-x-2">
                            <i class="fas fa-users"></i>
                            <span>Kapasitas: <span id="kapasitas"></span></span>
                        </p>
                        <hr class="my-2 border-gray-300">

                        <!-- Fasilitas Ruangan -->
                        <div id="fasilitasContainer"></div>
                        <hr class="my-2 border-gray-300">
                    </div>

                    <!-- Tombol Booking -->
                    <button class="mt-4 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700">
                        Pinjam
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const id_ruangan = 1; // Ganti dengan ID ruangan yang sesuai
        let images = [];
        let currentIndex = 0;

        // Fungsi untuk mengambil data ruangan dari API
        async function loadRoomData() {
            try {
                const response = await fetch(`http://localhost/sipinjamfix/sipinjam/api/ruangan/${id_ruangan}`);
                const result = await response.json();

                if (result.status === "success") {
                    const data = result.data;

                    // Set informasi ruangan
                    document.getElementById("namaRuangan").innerText = data.nama_ruangan;
                    document.getElementById("namaGedung").innerText = data.nama_gedung;
                    document.getElementById("kapasitas").innerText = data.kapasitas;

                    // Menampilkan fasilitas
                    const fasilitasContainer = document.getElementById("fasilitasContainer");
                    fasilitasContainer.innerHTML = '';
                    data.nama_fasilitas.split(', ').forEach(fasilitas => {
                        let icon;
                        switch (fasilitas.toLowerCase()) {
                            case 'ac': icon = 'fas fa-snowflake'; break;
                            case 'proyektor': icon = 'fas fa-tv'; break;
                            default: icon = 'fas fa-check';
                        }
                        fasilitasContainer.innerHTML += `<div class="flex items-center space-x-2 mt-2 text-gray-700">
                                                            <i class="${icon}"></i>
                                                            <span>${fasilitas}</span>
                                                        </div>`;
                    });

                    // Mengatur gambar carousel
                    images = data.foto_ruangan;
                    currentIndex = 0;
                    updateMainImage();

                    // Menampilkan thumbnail
                    const thumbnailContainer = document.getElementById("thumbnailContainer");
                    thumbnailContainer.innerHTML = "";
                    images.forEach((image, index) => {
                        const img = document.createElement("img");
                        img.src = image;
                        img.alt = "Thumbnail";
                        img.classList = "thumbnail w-20 h-20 object-cover rounded-md cursor-pointer";
                        img.id = `thumbnail-${index}`; // Tambahkan ID untuk thumbnail
                        img.onclick = () => setImage(index);
                        thumbnailContainer.appendChild(img);
                    });
                    updateThumbnailHighlight(); // Inisialisasi highlight thumbnail pertama
                } else {
                    console.error("Gagal mendapatkan data:", result.message);
                }
            } catch (error) {
                console.error("Terjadi kesalahan:", error);
            }
        }

        function closeModal() {
            document.getElementById("modal").classList.add("hidden");
        }

        function setImage(index) {
            currentIndex = index;
            updateMainImage();
            updateThumbnailHighlight();
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            updateMainImage();
            updateThumbnailHighlight();
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateMainImage();
            updateThumbnailHighlight();
        }

        function updateMainImage() {
            document.getElementById("mainImage").src = images[currentIndex];
        }

        function updateThumbnailHighlight() {
            document.querySelectorAll('.thumbnail').forEach(thumbnail => {
                thumbnail.classList.remove('active-thumbnail');
            });
            document.getElementById(`thumbnail-${currentIndex}`).classList.add('active-thumbnail');
        }

        // Panggil fungsi loadRoomData saat halaman dimuat
        window.onload = loadRoomData;
    </script>
</body>
</html>
