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

    <!-- Search Bar -->
    <form class="max-w-md mx-auto mt-4 pt-20" id="searchForm">
    </form>


<!-- Room List Container -->
<div id="room-list" class="container mx-52 p-5 grid grid-cols-1 pl-24 md:grid-cols-2 lg:grid-cols-3 gap-4">
  <!-- Room cards will be generated here -->
</div>

<script>
        const apiUrl = "http://localhost/sipinjamfix/sipinjam/api/ruangan";

        async function fetchRooms() {
            try {
                const response = await fetch(apiUrl);
                const result = await response.json();

                if (result.status === "success") {
                    const rooms = result.data;
                    const roomList = document.getElementById("room-list");

                    // Mengambil id_gedung dari URL
                    const urlParams = new URLSearchParams(window.location.search);
                    const idGedung = urlParams.get('id_gedung');
                    const searchQuery = urlParams.get('search'); // Ambil query pencarian

                    // Menyaring ruangan berdasarkan id_gedung yang ada di URL
                    const filteredRooms = idGedung ? rooms.filter(room => room.id_gedung === parseInt(idGedung)) : rooms;

                    // Jika ada pencarian, filter juga berdasarkan nama_ruangan
                    const searchedRooms = searchQuery ? filteredRooms.filter(room => room.nama_ruangan.toLowerCase().includes(searchQuery.toLowerCase())) : filteredRooms;

                    searchedRooms.forEach(room => {
                        const { nama_ruangan, nama_gedung, kapasitas, nama_fasilitas, foto_ruangan, deskripsi_ruangan } = room;

                        // Set default image if no image is available
                        const imageUrl = foto_ruangan[0] || "../../Sources/Img/default.jpg"; // Gambar default jika tidak ada
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
                                                case "Wi-Fi":
                                                    icon = "fa-wifi";
                                                    break;
                                                case "AC":
                                                    icon = "fa-snowflake";
                                                    break;
                                                case "LCD":
                                                    icon = "fa-tv";
                                                    break;
                                                default:
                                                    icon = "fa-check"; // Default icon
                                            }
                                            return `
                                                <div class="flex items-center space-x-1">
                                                    <i class="fas ${icon} text-gray-700"></i>
                                                    <span class="text-gray-700">${feature}</span>
                                                </div>`;
                                        }).join("")}
                                    </div>
                                    <a href="http://localhost/sipinjamfix/sipinjam/web/pages/detailRuangan?id_ruangan=${room.id_ruangan}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                                        Book Now
                                    </a>
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

        // Event listener untuk pencarian
        document.getElementById("searchForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah form submit default

            const searchQuery = document.getElementById('default-search').value.trim();
            const idGedung = new URLSearchParams(window.location.search).get('id_gedung'); // Ambil id_gedung

            // Redirect dengan query pencarian
            window.location.href = `http://localhost/sipinjamfix/sipinjam/web/pages/daftarRuangan/index.php?search=${encodeURIComponent(searchQuery)}&id_gedung=${idGedung}`;
        });

        // Panggil fungsi fetchRooms saat halaman dimuat
        document.addEventListener("DOMContentLoaded", fetchRooms);
    </script>

</body>
</html>
