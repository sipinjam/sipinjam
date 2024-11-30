<?php
require_once __DIR__ . '/../controllers/GedungController.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/HeaderAccessControl.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$db = new Database();
$conn = $db->getConnection();
$gedungsController = new GedungsController($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $usersController->getUserById($id);
        } else {
            $gedungsController->getAllGedung();
        }
        break;
    case 'POST':
        $gedungsController->createGedung();
        break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode tidak diizinkan."));
        break;
}
