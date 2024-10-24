<?php
require_once __DIR__ . '/../config/db.php';
require_once  __DIR__.'/../models/User.php';

class UsersController {
    private $db;
    private $peminjam;

    public function __construct() {
        // Inisialisasi koneksi database dan model User
        $database = new Database();
        $this->db = $database->getConnection();
        $this->peminjam = new User($this->db);
    }

    // Fungsi untuk menangani request GET (mengambil semua user)
    public function getUsers() {
        $stmt = $this->peminjam->getUsers();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $peminjams_arr = array();
            $peminjams_arr["peminjams"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $peminjam_item = array(
                    "id_peminjam" => $id_peminjam,
                    "nama_peminjam" => $nama_peminjam,
                    "email" => $email
                );
                array_push($peminjams_arr["peminjams"], $peminjam_item);
            }

            http_response_code(200);
            echo json_encode($peminjams_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Tidak ada user yang ditemukan."));
        }
    }

    // Fungsi untuk menangani request POST (membuat user baru)
    public function createUser() {
        $data = json_decode(file_get_contents("php://input"));
    
        if (!empty($data->nama_peminjam) && 
            !empty($data->password) && 
            !empty($data->nama_lengkap) && 
            !empty($data->email) && 
            !empty($data->no_telpon) && 
            !empty($data->id_jenis_peminjam)) {
            
            // Mengisi properti objek peminjam
            $this->peminjam->nama_peminjam = $data->nama_peminjam;
            $this->peminjam->password = $data->password;
            $this->peminjam->nama_lengkap = $data->nama_lengkap;
            $this->peminjam->email = $data->email;
            $this->peminjam->no_telpon = $data->no_telpon;
            $this->peminjam->id_jenis_peminjam = $data->id_jenis_peminjam;
    
            // Mencoba menambahkan user
            if ($this->peminjam->createUser()) {
                http_response_code(201); // Kode untuk resource berhasil dibuat
                echo json_encode(array("message" => "User berhasil ditambahkan."));
            } else {
                http_response_code(503); // Kode untuk service unavailable
                echo json_encode(array("message" => "Gagal menambahkan user."));
            }
    
        } else {
            // Menangani kasus ketika ada data yang kosong
            http_response_code(400); // Kode untuk Bad Request
            $errors = array();
    
            if (empty($data->nama_peminjam)) {
                $errors['nama_peminjam'] = "Nama peminjam tidak boleh kosong.";
            }
            if (empty($data->password)) {
                $errors['password'] = "Password tidak boleh kosong.";
            }
            if (empty($data->nama_lengkap)) {
                $errors['nama_lengkap'] = "Nama lengkap tidak boleh kosong.";
            }
            if (empty($data->email)) {
                $errors['email'] = "Email tidak boleh kosong.";
            }
            if (empty($data->no_telpon)) {
                $errors['no_telpon'] = "No telpon tidak boleh kosong.";
            }
            if (empty($data->id_jenis_peminjam)) {
                $errors['id_jenis_peminjam'] = "ID jenis peminjam tidak boleh kosong.";
            }
    
            // Mengembalikan pesan error dalam bentuk JSON
            echo json_encode(array("message" => "Data tidak lengkap.", "errors" => $errors));
        }
    }
    
   
}
?>
