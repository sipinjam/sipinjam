<?php
class User {
    private $conn;
    private $table_name = "peminjam";

    public $id;
    public $nama_peminjam;
    public $email;
    public $password;
    public $nama_lengkap;
    public $no_telpon;
    public $id_jenis_peminjam;

    // Constructor menerima koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi untuk membuat user baru
    public function createUser() {
        $query = "INSERT INTO " . $this->table_name . " (nama_peminjam, password, nama_lengkap, email, no_telpon, id_jenis_peminjam) VALUES (:nama_peminjam, :password, :nama_lengkap, :email, :no_telpon, :id_jenis_peminjam)";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->nama_peminjam = htmlspecialchars(strip_tags($this->nama_peminjam));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->nama_lengkap = htmlspecialchars(strip_tags($this->nama_lengkap));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->no_telpon = htmlspecialchars(strip_tags($this->no_telpon));
        $this->id_jenis_peminjam = htmlspecialchars(strip_tags($this->id_jenis_peminjam));

        // Bind data
        $stmt->bindParam(":nama_peminjam", $this->nama_peminjam);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":nama_lengkap", $this->nama_lengkap);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":no_telpon", $this->no_telpon);
        $stmt->bindParam(":id_jenis_peminjam", $this->id_jenis_peminjam);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Fungsi untuk mengambil semua user
    public function getUsers() {
        $query = "SELECT id_peminjam, nama_peminjam, email FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
