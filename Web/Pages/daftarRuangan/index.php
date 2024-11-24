<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../../Public/theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Sipinjam - Daftar Ruangan</title>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>
    <!-- End Sidebar -->

    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

    <!-- Room List Container -->
    <div id="room-list" class="container ml-44 my-24 p-5 grid grid-cols-1 pl-24 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Room cards will be generated here -->
    </div>

    <!-- Modal Popup -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
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
                        <!-- Thumbnail images will be loaded here -->
                    </div>
                </div>

                <!-- Informasi Ruangan -->
                <div class="w-1/3 flex flex-col justify-between">
                    <div>
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
        const apiUrl = "http://localhost/sipinjamfix/sipinjam/api/ruangan";
        let images = [];
        let currentIndex = 0;
        let previousUrl = window.location.href; // Menyimpan URL saat ini sebelum membuka modal

        // Fetch ruangan untuk menampilkan daftar ruangan
        async function fetchRooms() {
            try {
                const response = await fetch(apiUrl);
                const result = await response.json();

                if (result.status === "success") {
                    const rooms = result.data;
                    const roomList = document.getElementById("room-list");

                    const urlParams = new URLSearchParams(window.location.search);
                    const idGedung = urlParams.get('id_gedung');
                    const searchQuery = urlParams.get('search');

                    const filteredRooms = idGedung ? rooms.filter(room => room.id_gedung === parseInt(idGedung)) : rooms;
                    const searchedRooms = searchQuery ? filteredRooms.filter(room => room.nama_ruangan.toLowerCase().includes(searchQuery.toLowerCase())) : filteredRooms;

                    roomList.innerHTML = ''; // Clear content before adding

                    searchedRooms.forEach(room => {
                        const { id_ruangan, nama_ruangan, nama_gedung, kapasitas, nama_fasilitas, foto_ruangan, deskripsi_ruangan } = room;

                        const imageUrl = foto_ruangan[0] || "../../Sources/Img/default.jpg";
                        const features = nama_fasilitas ? nama_fasilitas.split(", ") : [];

                        const roomCard = `
                            <div class="flex max-w-[700px] h-[235px] bg-white border border-gray-200 rounded-lg shadow">
                                <a href="#" onclick="openModalAndRedirect(${id_ruangan})">
                                    <img class="rounded-l-lg w-[180px] h-[235px] object-cover" src="${imageUrl}" alt="${nama_ruangan}" />
                                </a>
                                <div class="p-5 flex-1">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight">${nama_ruangan}</h5>
                                    <p class="text-gray-600 mb-1">${nama_gedung}</p>
                                    <p class="text-gray-700 mb-3">${deskripsi_ruangan}</p>
                                    <p class="text-gray-700 mb-3">Kapasitas: ${kapasitas} orang</p>
                                    <div class="flex items-center space-x-2 mb-3">
                                        ${features.map(feature => {
                                            let icon;
                                            switch (feature) {
                                                case "wifi": icon = "fa-wifi"; break;
                                                case "ac": icon = "fa-snowflake"; break;
                                                case "proyektor": icon = "fa-tv"; break;
                                                case "seat": icon = "fa-chair"; break;
                                                default: icon = "fa-check";
                                            }
                                            return `
                                                <div class="flex items-center space-x-1">
                                                    <i class="fas ${icon} text-gray-700"></i>
                                                    <span class="text-gray-700">${feature}</span>
                                                </div>`;
                                        }).join("")}
                                    </div>
                                    <button onclick="openModalAndRedirect(${id_ruangan})" class="bg-blue-600 text-white py-1 px-2 rounded-lg hover:bg-blue-700">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        `;
                        
                        roomList.innerHTML += roomCard;
                    });
                } else {
                    console.error("Failed to retrieve rooms:", result.message);
                }
            } catch (error) {
                console.error("Error fetching rooms:", error);
            }
        }

        // Fungsi untuk membuka modal dan mengganti URL tanpa memuat ulang halaman
        async function openModalAndRedirect(id_ruangan) {
            previousUrl = window.location.href; // Simpan URL sebelum diubah
            await openModal(id_ruangan); // Buka modal dengan data ruangan
            const newUrl = `http://localhost/sipinjamfix/sipinjam/web/pages/daftarRuangan/index.php?id_ruangan=${id_ruangan}`;
            window.history.pushState({ path: newUrl }, '', newUrl); // Mengganti URL tanpa reload
        }

        // Fungsi untuk membuka modal dan memuat data ruangan
        async function openModal(id_ruangan) {
            document.getElementById("modal").classList.remove("hidden"); // Menampilkan modal
            await loadRoomData(id_ruangan); // Memuat data ruangan ke dalam modal
        }

        // Fungsi untuk menutup modal dan mengembalikan URL ke sebelumnya
        function closeModal() {
            document.getElementById("modal").classList.add("hidden"); // Menyembunyikan modal
            window.history.replaceState({ path: previousUrl }, '', previousUrl); // Mengembalikan URL ke sebelumnya
        }

        async function loadRoomData(id_ruangan) {
            try {
                const response = await fetch(`http://localhost/sipinjamfix/sipinjam/api/ruangan/${id_ruangan}`);
                const result = await response.json();

                if (result.status === "success") {
                    const data = result.data;

                    document.getElementById("namaRuangan").innerText = data.nama_ruangan;
                    document.getElementById("namaGedung").innerText = data.nama_gedung;
                    document.getElementById("kapasitas").innerText = data.kapasitas;

                    const fasilitasContainer = document.getElementById("fasilitasContainer");
                    fasilitasContainer.innerHTML = '';

                    // Pastikan data fasilitas ada dan dipisahkan dengan benar
                    if (data.nama_fasilitas) {
                        const fasilitasList = data.nama_fasilitas.split(', ').map(fasilitas => fasilitas.trim());

                        fasilitasList.forEach(fasilitas => {
                            let icon;
                            switch (fasilitas.toLowerCase()) {
                                case 'ac': icon = 'fas fa-snowflake'; break;
                                case 'wifi': icon = 'fas fa-wifi'; break;
                                case 'proyektor' : icon = 'fas fa-tv'; break;
                                case 'seat' : icon = 'fas fa-chair'; break;

                                default: icon = 'fas fa-check'; break;
                            }
                            fasilitasContainer.innerHTML += `
                                <div class="flex items-center space-x-2 mb-2">
                                    <i class="${icon} text-gray-600"></i>
                                    <span class="text-gray-600">${fasilitas}</span>
                                </div>`;
                        });
                    } else {
                        fasilitasContainer.innerHTML = '<div class="text-gray-600">Fasilitas tidak tersedia</div>';
                    }

                    // Gambar ruangan
                    images = data.foto_ruangan || [];
                    currentIndex = 0;
                    loadThumbnails();
                    updateMainImage();
                } else {
                    console.error("Failed to retrieve room data:", result.message);
                }
            } catch (error) {
                console.error("Error loading room data:", error);
            }
        }

        function loadThumbnails() {
            const thumbnailContainer = document.getElementById("thumbnailContainer");
            thumbnailContainer.innerHTML = '';
            images.forEach((image, index) => {
                thumbnailContainer.innerHTML += `
                    <img src="${image}" class="w-20 h-20 object-cover rounded-lg cursor-pointer" onclick="setMainImage(${index})">
                `;
            });
        }

        function setMainImage(index) {
            currentIndex = index;
            updateMainImage();
        }

        function updateMainImage() {
            if (images.length > 0) {
                document.getElementById("mainImage").src = images[currentIndex];
            }
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            updateMainImage();
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateMainImage();
        }

        // Load data saat halaman dimuat
        fetchRooms();
    </script>

</body>
</html>
