<?php
require_once __DIR__ . '/../controllers/RuanganController.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/HeaderAccessControl.php';

$db = new Database();
$conn = $db->getConnection();
$ruanganController = new RuangansController($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $ruanganController->getRuanganById($id);
        } else {
            $ruanganController->getAllRuangan();
        }
        break;
    case 'POST':
        $ruanganController->createRuangan();
        break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode tidak diizinkan."));
        break;
}
