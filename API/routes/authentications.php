<?php
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../config/db.php';

$usersController = new AuthController();
$db = new Database();


$method = $_SERVER['REQUEST_METHOD'];


if ($method === 'POST' && $uri[3] === 'authentications') {
    $data = json_decode(file_get_contents("php://input"));
    $username = $data->username ?? null;
    $password = $data->password ?? null;

    if ($username && $password) {

        $usersController->login($username, $password);
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Username dan password harus diisi."));
    }
} else {
    
    http_response_code(405); 
    echo json_encode(array("message" => "Metode tidak diizinkan atau rute salah."));
}
?>
