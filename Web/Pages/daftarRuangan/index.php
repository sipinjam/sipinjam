<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Sipinjam - Daftar Ruangan</title>
    <style>
    .thumbnail-active {
        border: 2px solid blue;
        opacity: 1;
    }

    .thumbnail-inactive {
        opacity: 0.5;
    }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <?php include '../../components/sidebar.php'; ?>
    <!-- End Sidebar -->

    <!-- Header -->
    <?php include '../../components/header.php'; ?>
    <!-- End Header -->

    <!-- Room List Container -->
    <div id="room-list" class="container ml-44 my-24 p-5 grid grid-cols-1 pl-24 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Room cards will be generated here -->
    </div>

    <!-- Modal Popup -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-6xl w-full mx-4 p-6 relative">
            <!-- Tombol Close -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
                &times;
            </button>

            <!-- Konten utama popup -->
            <div class="flex space-x-6">
                <!-- Carousel Gambar -->
                <div class="w-2/3">
                    <div class="relative">
                        <img id="mainImage" src="" alt="Ruangan" class="rounded-lg object-cover w-full h-80">
                        <button onclick="prevImage()"
                            class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                            &lt;
                        </button>
                        <button onclick="nextImage()"
                            class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                            &gt;
                        </button>
                    </div>

                    <div id="thumbnailContainer" class="flex mt-4 space-x-2"></div>
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

                        <div id="fasilitasContainer"></div>
                    </div>

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
    let previousUrl = window.location.href;

    async function fetchRooms() {
        try {
            const response = await fetch(apiUrl);
            const result = await response.json();

            if (result.status === "success") {
                const rooms = result.data;
                const roomList = document.getElementById("room-list");

                const urlParams = new URLSearchParams(window.location.search);
                const idGedung = urlParams.get("id_gedung");
                const searchQuery = urlParams.get("search");

                const filteredRooms = idGedung ?
                    rooms.filter(room => room.id_gedung === parseInt(idGedung)) :
                    rooms;

                const searchedRooms = searchQuery ?
                    filteredRooms.filter(room =>
                        room.nama_ruangan.toLowerCase().includes(searchQuery.toLowerCase())
                    ) :
                    filteredRooms;

                roomList.innerHTML = "";
                searchedRooms.forEach(room => {
                    const {
                        id_ruangan,
                        nama_ruangan,
                        nama_gedung,
                        kapasitas,
                        foto_ruangan
                    } = room;

                    const imageUrl = foto_ruangan[0] || "../../Sources/Img/default.jpg";

                    const roomCard = `
                            <div class="flex max-w-[700px] bg-white border rounded-lg shadow">
                                <img class="rounded-l-lg w-[180px] h-[235px] object-cover" src="${imageUrl}" alt="${nama_ruangan}" />
                                <div class="p-5 flex-1">
                                    <h5 class="text-xl font-bold">${nama_ruangan}</h5>
                                    <p class="text-gray-600">${nama_gedung}</p>
                                    <button onclick="openModal(${id_ruangan})" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 mt-3">
                                        Detail
                                    </button>
                                </div>
                            </div>`;
                    roomList.innerHTML += roomCard;
                });
            }
        } catch (error) {
            console.error("Error fetching rooms:", error);
        }
    }

    async function openModal(id_ruangan) {
        document.getElementById("modal").classList.remove("hidden");
        await loadRoomData(id_ruangan);
    }

    function closeModal() {
        document.getElementById("modal").classList.add("hidden");
        window.history.replaceState({}, "", previousUrl);
    }

    async function loadRoomData(id_ruangan) {
        try {
            document.getElementById("fasilitasContainer").innerHTML = "";

            const response = await fetch(`http://localhost/sipinjamfix/sipinjam/api/ruangan/${id_ruangan}`);
            const result = await response.json();

            if (result.status === "success") {
                const data = result.data;

                document.getElementById("namaRuangan").innerText = data.nama_ruangan;
                document.getElementById("namaGedung").innerText = data.nama_gedung;
                document.getElementById("kapasitas").innerText = data.kapasitas;

                // Ensure unique images by using Set
                images = [...new Set(data.foto_ruangan.length > 0 ? data.foto_ruangan : [
                    "../../Sources/Img/default.jpg"
                ])];

                currentIndex = 0;
                updateMainImage();
                loadThumbnails();
            }
        } catch (error) {
            console.error("Error loading room data:", error);
        }
    }

    function updateMainImage() {
        document.getElementById("mainImage").src = images[currentIndex];
    }

    function loadThumbnails() {
        const thumbnailContainer = document.getElementById("thumbnailContainer");
        thumbnailContainer.innerHTML = "";

        // Ensure only unique images are shown in the thumbnails
        images.forEach((image, index) => {
            const isActive = index === currentIndex;
            thumbnailContainer.innerHTML += `
            <img src="${image}" 
                 class="w-20 h-20 object-cover rounded-lg cursor-pointer ${isActive ? 'thumbnail-active' : 'thumbnail-inactive'}" 
                 onclick="setMainImage(${index})">
        `;
        });
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateMainImage();
        loadThumbnails();
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        updateMainImage();
        loadThumbnails();
    }

    function setMainImage(index) {
        currentIndex = index;
        updateMainImage();
        loadThumbnails();
    }

    fetchRooms();
    </script>
</body>

</html>