<?php
require_once __DIR__ . '/../controllers/AuthController.php';

// Ambil URI dari request (pastikan kamu menggunakan versi yang benar dari index.php)
$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Inisialisasi AuthController
$authController = new AuthController();

// Cek metode request POST dan rute 'authentications'
if ($method === 'POST' && $uri[4] === 'authentications') {
    // Ambil data dari request body
    $data = json_decode(file_get_contents("php://input"));
    $nama_peminjam = $data->nama_peminjam ?? null;
    $password = $data->password ?? null;

    // Pastikan nama_peminjam dan password tidak kosong
    if ($nama_peminjam && $password) {
        // Panggil fungsi login
        $authController->login($nama_peminjam, $password);
    } else {
        // Respons jika ada data yang kosong
        http_response_code(400);
        echo json_encode(array("message" => "Nama peminjam dan password harus diisi."));
    }
} else {
    // Respons jika metode atau rute salah
    http_response_code(405);
    echo json_encode(array("message" => "Metode tidak diizinkan atau rute salah."));
}
?>
