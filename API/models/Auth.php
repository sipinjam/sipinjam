<?php
class Auth{
    private $conn;
    private $table_name = "peminjam";
    public $nama_peminjam;
    public $password;

    // Constructor menerima koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }
    public function verifyUser($nama_peminjam, $password) {
        // Query untuk mengambil data pengguna berdasarkan nama_peminjam
        $query = "SELECT * FROM peminjam WHERE nama_peminjam = :nama_peminjam LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama_peminjam', $nama_peminjam);
        $stmt->execute();

        // Jika pengguna ditemukan
        if ($stmt->rowCount() > 0) {
            $peminjam = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verifikasi password (misalnya menggunakan password_hash)
            if (password_verify($password, $peminjam['password'])) {
                return $peminjam; // Mengembalikan data pengguna
            }
        }
        return null; // Pengguna tidak ditemukan atau password salah
    }
}

?>