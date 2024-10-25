<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Auth.php';

class AuthController {
    private $auth;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->auth = new Auth($db);
    }

    public function login($nama_peminjam, $password) {
        $peminjam = $this->auth->verifyUser($nama_peminjam, $password);

        if ($peminjam) {
            // Simpan data ke dalam session
            $_SESSION['id_peminjam'] = $peminjam['id_peminjam'];  // Simpan ID peminjam
            $_SESSION['nama_peminjam'] = $peminjam['nama_peminjam']; // Simpan nama_peminjam
            $_SESSION['logged_in'] = true;  // Tandai bahwa pengguna sudah login

            http_response_code(200);
            echo json_encode(array(
                "message" => "Login berhasil",
                "peminjam" => array(
                    "id_peminjam" => $peminjam['id_peminjam'],
                    "nama_peminjam" => $peminjam['nama_peminjam'],
                    "email" => $peminjam['email']
                )
            ));
        } else {
            http_response_code(401); // Unauthorized
            echo json_encode(array("message" => "Login gagal, nama peminjam atau password salah."));
        }
    }

    // Fungsi logout
    public function logout() {
        // Hapus session
        session_destroy();
        http_response_code(200);
        echo json_encode(array("message" => "Logout berhasil."));
    }
}
?>
