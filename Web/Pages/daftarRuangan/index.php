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
        status: "Tersedia"
      },
      {
        title: "Gedung Kuliah Terpadu Lantai 2",
        image: "../../Sources/Img/gedungkuliah-terpadu.png",
        description: "Deskripsi tentang Gedung Kuliah Terpadu Lantai 2.",
        features: ["Wi-Fi", "AC", "250 Seats", "LCD"],
        status: "Tersedia"
      },
      {
        title: "Gedung Kuliah Terpadu IV/401",
        image: "../../Sources/Img/gedungkuliah-terpadu.png",
        description: "Deskripsi tentang Gedung Kuliah Terpadu IV/401.",
        features: ["Wi-Fi", "AC", "250 Seats", "LCD"],
        status: "Tidak Tersedia"
      },
      // Tambahkan objek ruangan lainnya di sini
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
                  case "250 Seats":
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
              Status: <span class="${statusColor} font-bold">${room.status}</span>
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
