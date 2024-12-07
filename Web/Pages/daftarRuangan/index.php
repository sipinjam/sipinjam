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
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" onclick="closeModalOnOutsideClick(event)">
        <div class="bg-white rounded-lg shadow-lg max-w-3xl w-full mx-4 p-6 relative" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
                &times;
            </button>

            <!-- Main Content -->
            <div>
                <!-- Image Carousel -->
                <div class="relative">
                    <img id="mainImage" src="" alt="Ruangan" class="rounded-lg object-cover w-full h-80">
                    <button onclick="prevImage()" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                        &lt;
                    </button>
                    <button onclick="nextImage()" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                        &gt;
                    </button>
                </div>
                <div id="thumbnailContainer" class="flex mt-4 space-x-2"></div>

                <!-- Room Information -->
                <div class="mt-4">
                    <h2 id="namaRuangan" class="text-xl font-semibold"></h2>
                    <p id="namaGedung" class="text-gray-600 mb-2"></p>
                    <hr class="my-2 border-gray-300">
                    <p class="text-gray-500 flex items-center space-x-2">
                        <span>Kapasitas: <span id="kapasitas"></span></span>
                    </p>
                    <hr class="my-2 border-gray-300">
                    <div id="fasilitasContainer"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const apiUrl = "http://localhost/sipinjamfix/sipinjam/api/ruangan";
        let images = [];
        let currentIndex = 0;
        let previousUrl = window.location.href;

        const fasilitasIcons = {
            "Proyektor": "fas fa-video",
            "Wifi": "fas fa-wifi",
            "Ac": "fas fa-snowflake",
            "Seat": "fas fa-chair"
        };

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

                    const filteredRooms = idGedung
                        ? rooms.filter(room => room.id_gedung === parseInt(idGedung))
                        : rooms;

                    const searchedRooms = searchQuery
                        ? filteredRooms.filter(room =>
                            room.nama_ruangan.toLowerCase().includes(searchQuery.toLowerCase())
                        )
                        : filteredRooms;

                    roomList.innerHTML = "";
                    searchedRooms.forEach(room => {
                        const { id_ruangan, nama_ruangan, nama_gedung, kapasitas, foto_ruangan, nama_fasilitas } = room;

                        const imageUrl = foto_ruangan[0] || "../../Sources/Img/default.jpg";

                        // Mendefinisikan fasilitasArray
                        const fasilitasArray = nama_fasilitas ? nama_fasilitas.split(",").map(f => f.trim()) : [];

                        // Template room card
                        const roomCard = `
                            <div class="flex max-w-[700px] bg-white border rounded-lg shadow">
                                <img class="rounded-l-lg w-[180px] h-[235px] object-cover" src="${imageUrl}" alt="${nama_ruangan}" />
                                <div class="p-5 flex-1">
                                    <h5 class="text-xl font-bold">${nama_ruangan}</h5>
                                    <p class="text-gray-600">${nama_gedung}</p>
                                     <!-- Garis pemisah -->
                                    <hr class="my-1 border-gray-300">
                                    <p class="text-gray-500 text-sm">Kapasitas: ${kapasitas}</p>
                                    <!-- Garis pemisah -->
                                    <hr class="my-1 border-gray-300">
                                    <div class="text-gray-500 text-sm space-y-1">
                                        ${fasilitasArray.map(fasilitas => {
                                            const iconClass = fasilitasIcons[fasilitas] || "fas fa-question-circle";
                                            return `<p class="flex items-center space-x-2"><i class="${iconClass} text-blue-500"></i><span>${fasilitas}</span></p>`;
                                        }).join('')}
                                    </div>
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

        function closeModalOnOutsideClick(event) {
            const modal = document.getElementById("modal");
            if (event.target === modal) {
                closeModal();
            }
        }

        async function loadRoomData(id_ruangan) {
            try {
                document.getElementById("fasilitasContainer").innerHTML = ""; // Reset fasilitas

                const response = await fetch(`http://localhost/sipinjamfix/sipinjam/api/ruangan/${id_ruangan}`);
                const result = await response.json();

                if (result.status === "success") {
                    const data = result.data;

                    document.getElementById("namaRuangan").innerText = data.nama_ruangan;
                    document.getElementById("namaGedung").innerText = data.nama_gedung;
                    document.getElementById("kapasitas").innerText = data.kapasitas;

                    // Handle fasilitas
                    const fasilitasArray = data.nama_fasilitas ? data.nama_fasilitas.split(",").map(f => f.trim()) : [];
                    const fasilitasContainer = document.getElementById("fasilitasContainer");

                    if (fasilitasArray.length > 0) {
                        fasilitasArray.forEach(fasilitas => {
                            const listItem = document.createElement("li");
                            listItem.className = "text-gray-500 flex items-center space-x-2";

                            const iconClass = fasilitasIcons[fasilitas] || "fas fa-question-circle";

                            listItem.innerHTML = `<i class="${iconClass} text-blue-500"></i><span>${fasilitas}</span>`;
                            fasilitasContainer.appendChild(listItem);
                        });
                    } else {
                        fasilitasContainer.innerHTML = "<p class='text-gray-500'>Tidak ada fasilitas yang terdaftar.</p>";
                    }

                    // Handle images
                    images = [...new Set(data.foto_ruangan.length > 0 ? data.foto_ruangan : ["../../Sources/Img/default.jpg"])];
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

            images.forEach((image, index) => {
                const thumbnail = document.createElement("img");
                thumbnail.src = image;
                thumbnail.className = `w-24 h-24 object-cover rounded-lg cursor-pointer ${index === currentIndex ? "thumbnail-active" : "thumbnail-inactive"}`;
                thumbnail.onclick = () => {
                    currentIndex = index;
                    updateMainImage();
                    loadThumbnails();
                };
                thumbnailContainer.appendChild(thumbnail);
            });
        }

        function prevImage() {
            currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
            updateMainImage();
            loadThumbnails();
        }

        function nextImage() {
            currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
            updateMainImage();
            loadThumbnails();
        }

        fetchRooms(); // Load rooms data when page loads
    </script>
</body>

</html>
