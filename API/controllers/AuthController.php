<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Auth.php';

class AuthController {
    private $auth;

    // Konstruktor untuk inisialisasi model Auth
    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->auth = new Auth($db); // Inisialisasi model Auth
    }

    public function login($nama_peminjam, $password) {
        $peminjam = $this->auth->verifyUser($nama_peminjam, $password);

        if ($peminjam) {
            // Jika login berhasil, Anda bisa mengembalikan data pengguna (atau token)
            http_response_code(200);
            echo json_encode(array(
                "message" => "Login berhasil",
                "nama_peminjam" => $peminjam['nama_peminjam'] // Anda bisa menghapus password dari respons
            ));
        } else {
            // Jika login gagal
            http_response_code(401); // Unauthorized
            echo json_encode(array("message" => "Login gagal, nama_peminjam atau password salah."));
        }
    }
}
?>
