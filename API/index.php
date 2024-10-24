<?php
// Headers untuk mengizinkan permintaan dari sumber manapun dan menetapkan tipe konten sebagai JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Mengurai URI yang diminta
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Mengecek jika URI sesuai dengan rute "/sipinjam"
if (!isset($uri[2]) || $uri[2] !== 'sipinjam') {
    http_response_code(404);
    echo json_encode(array("message" => "Halaman tidak ditemukan pada sipinjam."));
    exit();
}

// Mengecek jika URI sesuai dengan rute "/sipinjam/api"
if (!isset($uri[3]) || $uri[3] !== 'api') {
    http_response_code(404);
    echo json_encode(array("message" => "Halaman tidak ditemukan pada api."));
    exit();
}

// Mengecek rute spesifik, misalnya "/sipinjam/api/users" atau "/sipinjam/api/authentications"
if (!isset($uri[4])) {
    http_response_code(404);
    echo json_encode(array("message" => "Rute tidak ditemukan."));
    exit();
}

// Memilih endpoint berdasarkan rute ke-4 dalam URI
switch ($uri[4]) {
    case 'users':
        require_once './routes/users.php';
        break;
        
    case 'authentications':
        require_once './routes/authentications.php';
        break;

    default:
        http_response_code(404);
        echo json_encode(array("message" => "Route tidak ditemukan."));
        break;
}
?>
