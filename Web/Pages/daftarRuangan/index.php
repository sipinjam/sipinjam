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
 <!-- membuat search bar -->
<form class="max-w-md mx-auto mt-4">  
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Ruangan" required />
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>
  <div id="room-list" class="container mx-auto p-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Kartu ruangan akan di-generate di sini oleh JavaScript -->
  </div>

  <script>
    const rooms = [
      {
        title: "Gedung Kuliah Terpadu Lantai 1",
        image: "../../Sources/Img/gedungkuliah-terpadu.png",
        description: "Deskripsi tentang Gedung Kuliah Terpadu Lantai 1.",
        features: ["Wi-Fi", "AC", "300 Seats", "LCD"],
      },
      {
        title: "Gedung Kuliah Terpadu Lantai 2",
        image: "../../Sources/Img/gedungkuliah-terpadu.png",
        description: "Deskripsi tentang Gedung Kuliah Terpadu Lantai 2.",
        features: ["Wi-Fi", "AC", "25 Seats", "LCD"],
      },
      {
        title: "Gedung Kuliah Terpadu IV/401",
        image: "../../Sources/Img/gedungkuliah-terpadu.png",
        description: "Deskripsi tentang Gedung Kuliah Terpadu IV/401.",
        features: ["Wi-Fi", "AC", "25 Seats", "LCD"],
      },
      {
        title: "Gedung Kuliah Terpadu IV/402",
        image: "../../Sources/Img/gedungkuliah-terpadu.png",
        description: "Deskripsi tentang Gedung Kuliah Terpadu IV/401.",
        features: ["Wi-Fi", "AC", "25 Seats", "LCD"],
      },
      {
        title: "Gedung Kuliah Terpadu IV/403",
        image: "../../Sources/Img/gedungkuliah-terpadu.png",
        description: "Deskripsi tentang Gedung Kuliah Terpadu IV/401.",
        features: ["Wi-Fi", "AC", "25 Seats", "LCD"],
      },
      {
        title: "Gedung Kuliah Terpadu IV/404",
        image: "../../Sources/Img/gedungkuliah-terpadu.png",
        description: "Deskripsi tentang Gedung Kuliah Terpadu IV/401.",
        features: ["Wi-Fi", "AC", "25 Seats", "LCD"],
      },
      {
        title: "Gedung Kuliah Terpadu IV/405",
        image: "../../Sources/Img/gedungkuliah-terpadu.png",
        description: "Deskripsi tentang Gedung Kuliah Terpadu IV/401.",
        features: ["Wi-Fi", "AC", "25 Seats", "LCD"],
      },
      {
        title: "Gedung Magister Terapan III/05",
        image: "../../Sources/Img/mst.jpg",
        description: "Deskripsi tentang Gedung Kuliah Terpadu IV/401.",
        features: ["Wi-Fi", "AC", "25 Seats", "LCD"],
      },
      {
        title: "Auditorium Polines",
        image: "../../Sources/Img/AB.jpg",
        description: "Deskripsi tentang Gedung Kuliah Terpadu IV/401.",
        features: ["Wi-Fi", "AC", "300 Seats", "LCD"],
      },
    ];

    const roomList = document.getElementById('room-list');

    rooms.forEach(room => {
      const statusColor = room.status === "Tersedia" ? "text-green-600" : "text-red-600";
      const roomCard = `
        <div class="flex max-w-[700px] h-[235px] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <a href="#">
            <img class="rounded-l-lg w-[180px] h-[235px] object-cover" src="${room.image}" alt="${room.title}" />
          </a>
          <div class="p-5 flex-1">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">${room.title}</h5>
            <div class="flex items-center space-x-2 mb-3">
              ${room.features.map(feature => {
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
                  case "300 Seats":
                  case "25 Seats":
                    icon = "fa-chair"; // Menggunakan ikon kursi untuk Seats
                    break;
                  default:
                    icon = "fa-check"; // Ikon default jika tidak ada yang cocok
                }
                return `
                  <div class="flex items-center space-x-1">
                    <i class="fas ${icon} text-gray-700 dark:text-gray-400"></i>
                    <span class="text-gray-700 dark:text-gray-400">${feature}</span>
                  </div>`;
              }).join('')}
            </div>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            </p>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Book Now
            </a>
          </div>
        </div>
      `;
      roomList.innerHTML += roomCard;
    });
  </script>
</body>
</html>
