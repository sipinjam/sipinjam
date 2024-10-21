<?php
class User {
    private $conn;
    private $table_name = "user";

    public $id;
    public $username;
    public $email;
    public $password;
    public $nama_lengkap;
    public $no_telpon;
    public $id_role;
    public $id_ormawa;

    // Constructor menerima koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi untuk membuat user baru
    public function createUser() {
        $query = "INSERT INTO " . $this->table_name . " (username, password, nama_lengkap, email, no_telpon, id_role, id_ormawa) VALUES (:username, :password, :nama_lengkap, :email, :no_telpon, :id_role, :id_ormawa)";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->nama_lengkap = htmlspecialchars(strip_tags($this->nama_lengkap));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->no_telpon = htmlspecialchars(strip_tags($this->no_telpon));
        $this->id_role = htmlspecialchars(strip_tags($this->id_role));
        $this->id_ormawa = htmlspecialchars(strip_tags($this->id_ormawa));

        // Bind data
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":nama_lengkap", $this->nama_lengkap);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":no_telpon", $this->no_telpon);
        $stmt->bindParam(":id_role", $this->id_role);
        $stmt->bindParam(":id_ormawa", $this->id_ormawa);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Fungsi untuk mengambil semua user
    public function getUsers() {
        $query = "SELECT id_user, username, email FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
