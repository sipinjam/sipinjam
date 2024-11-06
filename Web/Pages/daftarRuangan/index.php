<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Daftar Ruangan</title>
</head>
<body class="bg-gray-100">

<!-- Search Bar -->
<form class="max-w-md mx-auto mt-4">  
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Ruangan" required />
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">Search</button>
    </div>
</form>

<!-- Room List Container -->
<div id="room-list" class="container mx-auto p-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
  <!-- Room cards will be generated here -->
</div>

<script>
  // Fungsi untuk mendapatkan parameter dari URL
  function getParameterByName(name) {
    const url = new URL(window.location.href);
    return url.searchParams.get(name);
  }

  // Ambil id_gedung dari URL
  const idGedung = getParameterByName("id_gedung");

  // URL API ruangan (menyesuaikan dengan endpoint API)
  const apiUrl = "http://localhost/sipinjamfix/sipinjam/api/ruangan";

  async function fetchRooms() {
    try {
      const response = await fetch(apiUrl);
      const result = await response.json();

      if (result.status === "success") {
        const rooms = result.data;
        const filteredRooms = rooms.filter(room => room.id_gedung == idGedung); // Filter berdasarkan id_gedung
        const roomList = document.getElementById("room-list");

        roomList.innerHTML = ""; // Kosongkan elemen sebelum menambahkan data baru

        filteredRooms.forEach(room => {
          const { nama_ruangan, nama_gedung, kapasitas, nama_fasilitas, foto_ruangan, deskripsi_ruangan } = room;

          const imageUrl = foto_ruangan[0] || "path/to/default-image.jpg";
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
                <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
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

  // Panggil fetchRooms setelah halaman dimuat
  document.addEventListener("DOMContentLoaded", fetchRooms);
</script>


</body>
</html>
