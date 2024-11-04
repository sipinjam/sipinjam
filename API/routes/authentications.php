<?php
session_start();
require_once __DIR__ . '/../controllers/AuthController.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Ambil URI dari request (pastikan kamu menggunakan versi yang benar dari index.php)
$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Inisialisasi AuthController
$authController = new AuthController($conn);

// Cek metode request POST dan rute 'authentications'
switch ($method) {
    case 'POST':
        // Untuk login
        $authController->login();
        break;

    case 'DELETE':
        // Untuk logout
        $authController->logout();
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode([
            'status' => 'error',
            'message' => 'Method not allowed.'
        ], JSON_PRETTY_PRINT);
        break;
}
