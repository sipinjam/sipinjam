<?php
require_once __DIR__ . '/../controllers/FotoRuangController.php';
require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();
$fotoController = new FotoController($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $fotoController->createFotoRuangan();
        break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode tidak diizinkan."));
        break;
}
