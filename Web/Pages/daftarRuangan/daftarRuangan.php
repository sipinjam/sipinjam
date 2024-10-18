<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan</title>
    <!-- Link ke Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="daftarRuangan.css">
</head>
<body>

<!-- Search Bar -->
<div class="search-bar">
    <input type="text" placeholder="Cari ruangan....">
    <button type="submit"><i class="fas fa-search"></i></button>
</div>

<div class="container">

    <div class="grid-container">
    <?php
    // Contoh data ruangan
    $rooms = [
        ["name" => "GKT Lantai 1", "wifi" => true, "ac" => true, "seat" => 300, "lcd" => true, "status" => "Tersedia"],
        ["name" => "GKT Lantai 2", "wifi" => true, "ac" => true, "seat" => 300, "lcd" => true, "status" => "Tersedia"],
        ["name" => "GKT IV/401", "wifi" => true, "ac" => true, "seat" => 30, "lcd" => true, "status" => "Tersedia"],
        ["name" => "GKT IV/402", "wifi" => true, "ac" => true, "seat" => 30, "lcd" => true, "status" => "Tidak Tersedia"],
        ["name" => "GKT IV/403", "wifi" => true, "ac" => true, "seat" => 30, "lcd" => true, "status" => "Tersedia"],
        ["name" => "GKT IV/404", "wifi" => true, "ac" => true, "seat" => 30, "lcd" => true, "status" => "Tersedia"],
        ["name" => "GKT IV/405", "wifi" => true, "ac" => true, "seat" => 30, "lcd" => true, "status" => "Tersedia"],
        ["name" => "GKT IV/406", "wifi" => true, "ac" => true, "seat" => 30, "lcd" => true, "status" => "Tersedia"],
    ];

    foreach ($rooms as $room) {
        $statusClass = $room['status'] == "Tersedia" ? "status" : "not-available";
        echo '
        <div class="room-card">
            <img src="../../Sources/Img/gedungkuliah-terpadu.png" alt="Building">
            <div class="room-info">
                <h3>'.$room["name"].'</h3>
                <p>';
                if ($room["wifi"]) {
                    echo '<i class="fas fa-wifi"></i> WiFi ';
                }
                if ($room["ac"]) {
                    echo '<i class="fas fa-snowflake"></i> AC ';
                }
                echo '<i class="fas fa-chair"></i> '.$room["seat"].' '; // Menampilkan jumlah kursi tanpa kata "Seat:"
                if ($room["lcd"]) {
                    echo '<i class="fas fa-video"></i> LCD';
                }
                echo '</p>
                <p>Status: <span class="'.$statusClass.'">'.$room["status"].'</span></p>
            </div>
            <a href="#" class="book-btn">Book Now</a>
        </div>';
    }
    ?>
    </div>
</div>

</body>
</html>
