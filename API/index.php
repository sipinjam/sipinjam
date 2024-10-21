<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);


if (!isset($uri[1]) || $uri[1] !== 'sipinjam') {
    http_response_code(404);
    echo json_encode(array("message" => "Halaman tidak ditemukan pada sipinjam."));
    exit();
}

if (!isset($uri[2]) || $uri[2] !== 'api') {
    http_response_code(404);
    echo json_encode(array("message" => "Halaman tidak ditemukan pada api."));
    exit();
}


if (!isset($uri[3])) {
    http_response_code(404);
    echo json_encode(array("message" => "Rute tidak ditemukan."));
    exit();
}


switch ($uri[3]) {
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
