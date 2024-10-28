<?php
require_once __DIR__ . '/../controllers/UsersController.php';
require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();
$usersController = new UsersController($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $usersController->getAllUser();
        break;

        // case 'POST':
        //     $usersController->createUser();
        //     break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode tidak diizinkan."));
        break;
}
