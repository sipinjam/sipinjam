<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Tangani OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/../controllers/UsersController.php';
require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();
$usersController = new UsersController($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $usersController->getUserById($id);
        } else {
            $usersController->getAllUser();
        }
        break;
    case 'POST':
        if(isset($_GET['action']) && $_GET['action'] === 'login') {
            $usersController->loginUser();
        } else {
            $usersController->createUser();
        }
        break;
    case 'PATCH':
        $id = intval($_GET["id"]);
        $usersController->editUser($id);

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode tidak diizinkan."));
        break;
}
