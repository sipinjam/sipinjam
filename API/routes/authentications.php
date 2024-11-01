<?php
session_start();
require_once __DIR__ . '/../controllers/AuthController.php';

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
