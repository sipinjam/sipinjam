<?php
class Auth{
    private $conn;
    private $table_name = "user";
    public $username;
    public $password;

    // Constructor menerima koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }
    public function verifyUser($username, $password) {
        // Query untuk mengambil data pengguna berdasarkan username
        $query = "SELECT * FROM user WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Jika pengguna ditemukan
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verifikasi password (misalnya menggunakan password_hash)
            if (password_verify($password, $user['password'])) {
                return $user; // Mengembalikan data pengguna
            }
        }
        return null; // Pengguna tidak ditemukan atau password salah
    }
}

?>