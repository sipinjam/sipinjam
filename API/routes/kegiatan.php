<?php
require_once __DIR__ . '/../controllers/KegiatanController.php';
require_once __DIR__ . '/../config/db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$db = new Database();
$conn = $db->getConnection();
$KegiatanController = new KegiatansController($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $KegiatanController->getKegiatanById($id);
        } else {
            $KegiatanController->getAllKegiatan();
        }
        break;
    // case 'POST':
    //     $KegiatanController->createKegiatan();
    //     break;
    // case 'PATCH':
    //     $id = intval($_GET["id"]);
    //     $KegiatanController->editKegiatan($id);
    //     break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode tidak diizinkan."));
        break;
}