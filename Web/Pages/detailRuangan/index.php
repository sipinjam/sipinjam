<?php
// Data ruangan, bisa berasal dari database atau sumber lainnya
$room = [
    "name" => "GKT Lantai 1",
    "capacity" => 300,
    "features" => ["WiFi", "AC", "SEAT", "LCD"],
    "images" => [
        "main" => "../../Sources/Img/gedungkuliah-terpadu.png",
        "thumbnails" => ["../../Sources/Img/gktdalam.jpg", "../../Sources/Img/gktdalam2.jpg", "../../Sources/Img/gktdalam3.jpg", "../../Sources/Img/gktdalam.jpg"]
    ]
];
?>

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
            <button onclick="window.location.href='../daftarRuangan/index.php'" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
                &times;
            </button>

            <!-- Konten utama popup (gambar dan informasi) -->
            <div class="flex space-x-6">
                <!-- Carousel Gambar -->
                <div class="w-2/3">
                    <div class="relative">
                        <img id="mainImage" src="<?php echo $room['images']['main']; ?>" alt="Ruangan" class="rounded-lg object-cover w-full h-80">
                        <button onclick="prevImage()" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                            &lt;
                        </button>
                        <button onclick="nextImage()" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                            &gt;
                        </button>
                    </div>

                    <!-- Thumbnail gambar kecil -->
                    <div class="flex mt-4 space-x-2">
                        <?php foreach ($room['images']['thumbnails'] as $index => $thumbnail): ?>
                            <img id="thumbnail-<?php echo $index; ?>" onclick="setImage(<?php echo $index; ?>)" src="<?php echo $thumbnail; ?>" alt="Thumbnail" class="thumbnail w-20 h-20 object-cover rounded-md cursor-pointer">
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Informasi Ruangan -->
                <div class="w-1/3 flex flex-col justify-between">
                    <div>
                        <!-- Nama Gedung -->
                        <h2 class="text-xl font-semibold"><?php echo $room['name']; ?></h2>
                        <hr class="my-2 border-gray-300">

                        <!-- Kapasitas -->
                        <p class="text-gray-500 flex items-center space-x-2">
                            <i class="fas fa-users"></i>
                            <span>Kapasitas: <?php echo $room['capacity']; ?></span>
                        </p>
                        <hr class="my-2 border-gray-300">

                        <!-- Fitur Ruangan -->
                        <?php foreach ($room['features'] as $feature): ?>
                            <div class="flex items-center space-x-2 mt-2 text-gray-700">
                                <?php
                                switch (strtolower($feature)) {
                                    case 'wifi':
                                        echo '<i class="fas fa-wifi"></i>';
                                        break;
                                    case 'ac':
                                        echo '<i class="fas fa-snowflake"></i>';
                                        break;
                                    case 'seat':
                                        echo '<i class="fas fa-chair"></i>';
                                        break;
                                    case 'lcd':
                                        echo '<i class="fas fa-tv"></i>';
                                        break;
                                }
                                ?>
                                <span><?php echo $feature; ?></span>
                            </div>
                        <?php endforeach; ?>
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
        const images = <?php echo json_encode($room['images']['thumbnails']); ?>;
        let currentIndex = 0;

        function closeModal() {
            document.getElementById("modal").classList.add("hidden");
        }

        function setImage(index) {
            currentIndex = index;
            document.getElementById("mainImage").src = images[currentIndex];
            updateThumbnailHighlight();
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            document.getElementById("mainImage").src = images[currentIndex];
            updateThumbnailHighlight();
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            document.getElementById("mainImage").src = images[currentIndex];
            updateThumbnailHighlight();
        }

        function updateThumbnailHighlight() {
            document.querySelectorAll('.thumbnail').forEach(thumbnail => {
                thumbnail.classList.remove('active-thumbnail');
            });

            document.getElementById(`thumbnail-${currentIndex}`).classList.add('active-thumbnail');
        }
    </script>
</body>
</html>
