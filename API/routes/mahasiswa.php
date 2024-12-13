<?php
require_once __DIR__ . '/../controllers/MahasiswaController.php';
require_once __DIR__ . '/../config/db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$db = new Database();
$conn = $db->getConnection();
$mahasiswaController = new MahasiswaController($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $mahasiswaController->getMahasiswaById($id);
        } elseif (!empty($_GET["id_ormawa"])) { // Tambahkan kondisi ini
            $id_ormawa = intval($_GET["id_ormawa"]);
            $mahasiswaController->getMahasiswaByOrmawa($id_ormawa);
        } else {
            $mahasiswaController->getAllMahasiswa();
        }
        break;
    case 'POST':
        $mahasiswaController->createMahasiswa();
        break;
    // case 'PATCH':
    //     $id = intval($_GET["id"]);
    //     $mahasiswaController->editMahasiswa($id);
    //     break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode tidak diizinkan."));
        break;
}