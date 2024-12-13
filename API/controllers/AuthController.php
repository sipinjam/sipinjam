<?php
// Include koneksi database terlebih dahulu
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/response.php';
$conn = new PDO("mysql:host=localhost;dbname=sipinjamdb", "root", "");

// Lalu buat objek AuthController
require_once __DIR__ . '/../controllers/AuthController.php';
$authController = new AuthController($conn);

class AuthController
{
    private $conn;

    public function __construct($conn)
    {
        if (!$conn) {
            response(false, 'Database connection failed');
        }
        $this->conn = $conn;
    }

    // User login
    public function login()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $nama_peminjam = $data['nama_peminjam'] ?? '';
        $password = $data['password'] ?? '';
        $query = "SELECT * FROM peminjam WHERE nama_peminjam = :nama_peminjam LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['nama_peminjam' => $nama_peminjam]);;

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['id_peminjam'] = $result['id_peminjam'];
                $_SESSION['nama_peminjam'] = $result['nama_peminjam'];
                $_SESSION['id_jenis_peminjam'] = $result['id_jenis_peminjam'];

                response('success', 'Login berhasil.', ['id_peminjam' => $result['id_peminjam'], 'nama_lengkap' => $result['nama_lengkap'], 'id_jenis_peminjam' => $result['id_jenis_peminjam'], 'id_ormawa' => $result['id_ormawa']], 200);
            } else {
                header("HTTP/1.0 401 Unauthorized");
                echo json_encode(['status' => 'error', 'message' => 'Password salah.'], JSON_PRETTY_PRINT);
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode(['status' => 'error', 'message' => 'Pengguna tidak ditemukan.'], JSON_PRETTY_PRINT);
        }
    }

    // User logout
    public function logout()
    {
        session_destroy();
        echo json_encode(['status' => 'success', 'message' => 'Logout berhasil.'], JSON_PRETTY_PRINT);
    }

    // Ubah password
    public function changePassword($peminjamId)
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $oldPassword = $data['oldPassword'] ?? '';
        $newPassword = $data['newPassword'] ?? '';

        if (empty($oldPassword) || empty($newPassword)) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(['status' => 'error', 'message' => 'Password lama dan baru wajib diisi.'], JSON_PRETTY_PRINT);
            return;
        }

        $stmt = $this->conn->prepare("SELECT * FROM peminjam WHERE peminjam_id = ?");
        $stmt->execute([$peminjamId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($oldPassword, $result['password'])) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateStmt = $this->conn->prepare("UPDATE peminjam SET password = ? WHERE peminjam_id = ?");
                $updateStmt->execute([$hashedPassword, $peminjamId]);

                echo json_encode(['status' => 'success', 'message' => 'Password berhasil diubah.'], JSON_PRETTY_PRINT);
            } else {
                header("HTTP/1.0 401 Unauthorized");
                echo json_encode(['status' => 'error', 'message' => 'Password lama salah.'], JSON_PRETTY_PRINT);
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode(['status' => 'error', 'message' => 'Pengguna tidak ditemukan.'], JSON_PRETTY_PRINT);
        }
    }
}
