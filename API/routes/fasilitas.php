<?php
require_once __DIR__ . '/../controllers/FasilitasRuangController.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/HeaderAccessControl.php';

$db = new Database();
$conn = $db->getConnection();
$fasilitasController = new FasilitasRuangsController($conn);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
        // case 'GET':
        //     if (!empty($_GET["id"])) {
        //         $id = intval($_GET["id"]);
        //         $fasilitasController->getUserById($id);
        //     } else {
        //         $fasilitasController->getAllGedung();
        //     }
        //     break;

    case 'POST':
        // Ambil data JSON dari request body
        $input = json_decode(file_get_contents('php://input'), true);

        // Pastikan input adalah array
        if (is_array($input)) {
            // Ambil nama_ruangan dan nama_fasilitas dari input JSON
            $nama_ruangan = $input['nama_ruangan'] ?? null; // Menggunakan null coalescing operator
            $nama_fasilitas = $input['nama_fasilitas'] ?? null;

            // Pastikan keduanya tidak null sebelum memanggil fungsi
            if ($nama_ruangan && $nama_fasilitas) {
                $fasilitasController->createFasilitasRuangan($nama_ruangan, $nama_fasilitas);
            } else {
                response('error', 'Missing parameters: nama_ruangan or nama_fasilitas', null, 400);
            }
        } else {
            response('error', 'Invalid JSON input', null, 400);
        }
        break;


    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode tidak diizinkan."));
        break;
}
