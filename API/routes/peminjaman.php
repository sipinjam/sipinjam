<?php
require_once __DIR__ . '/../controllers/PeminjamanController.php';
require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();
$PeminjamanController = new PeminjamansController($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $PeminjamanController->getPeminjamanById($id);
        } else {
            $PeminjamanController->getAllPeminjaman();
        }
        break;
    case 'POST':
        $PeminjamanController->createPeminjaman();
        break;
    case 'PATCH':
        $id = intval($_GET["id"]);
        $PeminjamanController->editPeminjaman($id);
        break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode tidak diizinkan."));
        break;
}
