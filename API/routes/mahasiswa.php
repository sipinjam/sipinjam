<?php
require_once __DIR__ . '/../controllers/MahasiswaController.php'; // Ensure this is the correct file
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/HeaderAccessControl.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$db = new Database();
$conn = $db->getConnection();

// Instantiate the MahasiswaController
$mahasiswaController = new MahasiswaController($conn);

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Remove any trailing slashes from the URI
$requestUri = rtrim($requestUri, '/');

// Extract the ID from the URI if it's present
$uriParts = explode('/', $requestUri);
$id = isset($uriParts[3]) ? intval($uriParts[3]) : null; // Assuming the ID is in the 4th part of the URI

switch ($method) {
    case 'GET':
        // If the ID is provided in the URL, fetch a specific Mahasiswa
        if (!empty($id)) {
            $mahasiswaController->getMahasiswaById($id);
        } else {
            $mahasiswaController->getAllMahasiswa(); // Fetch all Mahasiswa
        }
        break;

    case 'POST':
        // Create a new Mahasiswa entry
        $mahasiswaController->createMahasiswa();
        break;

    case 'PATCH':
        // Update an existing Mahasiswa entry
        if (!empty($id)) {
            $mahasiswaController->updateMahasiswa($id);
        } else {
            response('error', 'Mahasiswa ID is required for update', null, 400);
        }
        break;

    case 'DELETE':
        // Delete a Mahasiswa entry
        if (!empty($id)) {
            $mahasiswaController->deleteMahasiswa($id);
        } else {
            response('error', 'Mahasiswa ID is required for deletion', null, 400);
        }
        break;

    default:
        // Handle unsupported HTTP methods
        http_response_code(405);
        echo json_encode(array("message" => "Method Not Allowed"));
        break;
}
?>
