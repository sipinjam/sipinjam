<?php
require_once __DIR__ . '/../config/db.php';
require_once  __DIR__.'/../models/User.php';

class UsersController {
    private $db;
    private $user;

    public function __construct() {
        // Inisialisasi koneksi database dan model User
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    // Fungsi untuk menangani request GET (mengambil semua user)
    public function getUsers() {
        $stmt = $this->user->getUsers();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $users_arr = array();
            $users_arr["users"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $user_item = array(
                    "id_user" => $id_user,
                    "username" => $username,
                    "email" => $email
                );
                array_push($users_arr["users"], $user_item);
            }

            http_response_code(200);
            echo json_encode($users_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Tidak ada user yang ditemukan."));
        }
    }

    // Fungsi untuk menangani request POST (membuat user baru)
    public function createUser() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->username) && 
        !empty($data->password) && 
        !empty($data->nama_lengkap) && 
        !empty($data->email) && 
        !empty($data->no_telpon) && 
        !empty($data->id_role) && 
        !empty($data->id_ormawa)) {
            $this->user->username = $data->username;
            $this->user->password = $data->password;
            $this->user->nama_lengkap = $data->nama_lengkap;
            $this->user->email = $data->email;
            $this->user->no_telpon = $data->no_telpon;
            $this->user->id_role = $data->id_role;
            $this->user->id_ormawa = $data->id_ormawa;

            if ($this->user->createUser()) {
                http_response_code(201);
                echo json_encode(array("message" => "User berhasil ditambahkan."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Gagal menambahkan user."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Data tidak lengkap.,,,,,"));
        }
    }
   
}
?>
