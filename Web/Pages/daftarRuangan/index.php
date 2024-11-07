<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../../Public/theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Daftar Ruangan</title>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>
    <!-- End Sidebar -->

    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

    <!-- Room List Container -->
    <div id="room-list" class="container mx-52 my-24 p-5 grid grid-cols-1 pl-24 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
                                <a href="#">
                                    <img class="rounded-l-lg w-[180px] h-[235px] object-cover" src="${imageUrl}" alt="${nama_ruangan}" />
                                </a>
                                <div class="p-5 flex-1">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight">${nama_ruangan}</h5>
                                    <p class="text-gray-600 mb-1">${nama_gedung}</p>
                                    <p class="text-gray-700 mb-3">${deskripsi_ruangan || "Deskripsi tidak tersedia"}</p>
                                    <p class="text-gray-700 mb-3">Kapasitas: ${kapasitas} orang</p>
                                    <div class="flex items-center space-x-2 mb-3">
                                        ${features.map(feature => {
                                            let icon;
                                            switch (feature) {
                                                case "Wi-Fi": icon = "fa-wifi"; break;
                                                case "AC": icon = "fa-snowflake"; break;
                                                case "LCD": icon = "fa-tv"; break;
                                                default: icon = "fa-check";
                                            }
                                            return `
                                                <div class="flex items-center space-x-1">
                                                    <i class="fas ${icon} text-gray-700"></i>
                                                    <span class="text-gray-700">${feature}</span>
                                                </div>`;
                                        }).join("")}
                                    </div>
                                    <button onclick="openModal(${id_ruangan})" class="bg-blue-600 text-white py-1 px-2 rounded-lg hover:bg-blue-700">
                                        Pinjam
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

        // Function to close the modal
        function closeModal() {
            document.getElementById("modal").classList.add("hidden");
        }

        // Function to open the modal and load room data based on the selected id_ruangan
        function openModal(id_ruangan) {
            loadRoomData(id_ruangan);  // Pass the id_ruangan to loadRoomData
            document.getElementById("modal").classList.remove("hidden");
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

                    images = data.foto_ruangan.length > 0 ? data.foto_ruangan : ["../../Sources/Img/default.jpg"];
                    currentIndex = 0;
                    updateMainImage();

                    const thumbnailContainer = document.getElementById("thumbnailContainer");
                    thumbnailContainer.innerHTML = "";
                    images.forEach((image, index) => {
                        const img = document.createElement("img");
                        img.src = image;
                        img.alt = "Thumbnail";
                        img.classList = "thumbnail w-20 h-20 object-cover rounded-md cursor-pointer";
                        img.id = `thumbnail-${index}`;
                        img.onclick = () => setImage(index);
                        thumbnailContainer.appendChild(img);
                    });
                    updateThumbnailHighlight();
                } else {
                    console.error("Failed to load room data:", result.message);
                }
            } catch (error) {
                console.error("Error loading room data:", error);
            }
        }

        // Fetch room data when the page loads
        window.onload = fetchRooms;
    </script>
</body>
</html>
