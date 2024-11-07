<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/response.php';

class UsersController
{
    private $conn;
    private $table_name = "peminjam";
    public function __construct($conn)
    {
        if (!$conn) {
            response(false, 'Database connection failed');
        }
        $this->conn = $conn;
    }

    public function getAllUser()
    {
        $query = "SELECT * FROM peminjam";
        $data = array();

        $stmt = $this->conn->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $data[] = $row;
            }
            response(true, 'List of Users Retrieved Successfully', $data, 200);
        } else {
            response(false, 'Failed to Retrieve Users', null, [
                'code' => 500,
                'message' => 'Internal server error: ' . $this->conn->errorInfo()[2]
            ]);
        }
    }
    public function getUserById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_peminjam = :id_peminjam";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_peminjam', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            response('success', 'Get user by id successfully', $user, 200);
        } else {
            response('error', 'User not found', null, 404);
        }
    }

    public function createUser()
    {
        // Menerima data JSON dan mendekode
        $input = json_decode(file_get_contents('php://input'), true);

        // Pastikan input bukan null dan merupakan array
        if (!is_array($input)) {
            response('error', 'Invalid JSON input', null, 400);
            return;
        }

        $requiredFields = ['nama_peminjam', 'email', 'password', 'no_telpon', 'nama_jenis_peminjam'];
        $missingParams = array_diff($requiredFields, array_keys($input));

        if (empty($missingParams)) {
            // Memastikan nama_jenis_peminjam ada di tabel jenis_peminjam
            $jenisQuery = "SELECT id_jenis_peminjam FROM jenis_peminjam WHERE nama_jenis_peminjam = ?";
            $jenisStmt = $this->conn->prepare($jenisQuery);
            $jenisStmt->execute([$input['nama_jenis_peminjam']]);
            $jenisResult = $jenisStmt->fetch(PDO::FETCH_ASSOC);

            if ($jenisResult) {
                $id_jenis_peminjam = $jenisResult['id_jenis_peminjam'];

                $query = "INSERT INTO peminjam (nama_peminjam, password, nama_lengkap, email, no_telpon, id_jenis_peminjam) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($query);

                if ($stmt->execute([
                    $input['nama_peminjam'],
                    password_hash($input['password'], PASSWORD_BCRYPT),
                    $input['nama_lengkap'],
                    $input['email'],
                    $input['no_telpon'],
                    $id_jenis_peminjam
                ])) {
                    $new_id = $this->conn->lastInsertId();
                    $result_stmt = $this->conn->prepare("SELECT * FROM peminjam WHERE id_peminjam = ?");
                    $result_stmt->execute([$new_id]);
                    $new_data = $result_stmt->fetch(PDO::FETCH_OBJ);

                    response('success', 'User Added Successfully', $new_data, statusCode: 201);
                } else {
                    response('error', 'Unable to create user', null, 400);
                }
            } else {
                response('error', 'Invalid jenis peminjam', null, 400);
            }
        } else {
            response('error', 'Missing parameters: ' . implode(', ', $missingParams), null, 400);
        }
    }

    public function editUser($id_peminjam)
    {
        // Menerima data JSON dan mendekode
        $input = json_decode(file_get_contents('php://input'), true);

        // Pastikan input bukan null dan merupakan array
        if (!is_array($input)) {
            response('error', 'Invalid JSON input', null, 400);
            return;
        }

        // Cek apakah user dengan ID yang diberikan ada
        $userQuery = "SELECT * FROM peminjam WHERE id_peminjam = ?";
        $userStmt = $this->conn->prepare($userQuery);
        $userStmt->execute([$id_peminjam]);
        $existingUser = $userStmt->fetch(PDO::FETCH_ASSOC);

        if (!$existingUser) {
            response('error', 'User not found', null, 404);
            return;
        }

        // Siapkan kolom yang bisa diupdate
        $updateFields = [];
        $params = [];

        // Periksa masing-masing kolom dan tambahkan ke query jika tersedia
        if (isset($input['nama_peminjam'])) {
            $updateFields[] = 'nama_peminjam = ?';
            $params[] = $input['nama_peminjam'];
        }
        if (isset($input['email'])) {
            $updateFields[] = 'email = ?';
            $params[] = $input['email'];
        }
        if (isset($input['password'])) {
            $updateFields[] = 'password = ?';
            $params[] = password_hash($input['password'], PASSWORD_BCRYPT);
        }
        if (isset($input['no_telpon'])) {
            $updateFields[] = 'no_telpon = ?';
            $params[] = $input['no_telpon'];
        }
        if (isset($input['nama_lengkap'])) {
            $updateFields[] = 'nama_lengkap = ?';
            $params[] = $input['nama_lengkap'];
        }

        // Memastikan nama_jenis_peminjam valid dan mengambil id_jenis_peminjam jika ada
        if (isset($input['nama_jenis_peminjam'])) {
            $jenisQuery = "SELECT id_jenis_peminjam FROM jenis_peminjam WHERE nama_jenis_peminjam = ?";
            $jenisStmt = $this->conn->prepare($jenisQuery);
            $jenisStmt->execute([$input['nama_jenis_peminjam']]);
            $jenisResult = $jenisStmt->fetch(PDO::FETCH_ASSOC);

            if ($jenisResult) {
                $updateFields[] = 'id_jenis_peminjam = ?';
                $params[] = $jenisResult['id_jenis_peminjam'];
            } else {
                response('error', 'Invalid jenis peminjam', null, 400);
                return;
            }
        }

        // Cek apakah ada field yang diupdate
        if (!empty($updateFields)) {
            // Tambahkan id_peminjam ke params
            $params[] = $id_peminjam;

            // Buat query update
            $updateQuery = "UPDATE peminjam SET " . implode(', ', $updateFields) . " WHERE id_peminjam = ?";
            $stmt = $this->conn->prepare($updateQuery);

            // Eksekusi query
            if ($stmt->execute($params)) {
                // Ambil data terbaru dari user yang sudah diperbarui
                $result_stmt = $this->conn->prepare("SELECT * FROM peminjam WHERE id_peminjam = ?");
                $result_stmt->execute([$id_peminjam]);
                $updatedUser = $result_stmt->fetch(PDO::FETCH_OBJ);

                response('success', 'User updated successfully', $updatedUser);
            } else {
                response('error', 'Unable to update user', null, 400);
            }
        } else {
            response('error', 'No data provided to update', null, 400);
        }
    }
}
