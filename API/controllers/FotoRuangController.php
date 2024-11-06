<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/response.php';

class FotoController
{
    private $conn;
    public function __construct($conn)
    {
        if (!$conn) {
            response(false, 'Database connection failed');
        }
        $this->conn = $conn;
    }
    public function createFotoRuangan()
    {
        // Ambil nama_ruangan dari $_POST
        if (!isset($_POST['nama_ruangan'])) {
            response('error', 'Missing nama_ruangan parameter', null, 400);
            return;
        }
        $nama_ruangan = $_POST['nama_ruangan'];

        // Pastikan ada file foto_ruangan yang diunggah
        if (isset($_FILES['nama_foto']) && $_FILES['nama_foto']['error'] == UPLOAD_ERR_OK) {
            $folderPath = '../assets/ruangan/';

            // Mengambil ekstensi file asli
            $fileExtension = pathinfo($_FILES['nama_foto']['name'], PATHINFO_EXTENSION);

            // Mengganti nama file dengan format tanggal
            $fileName = date('YmdHis') . '.' . $fileExtension; // Format: YYYYMMDDHHMMSS
            $filePath = $folderPath . $fileName;
            $relativePath = '../../../api/assets/ruangan/' . $fileName;

            // Pindahkan file ke folder tujuan dengan nama baru
            if (move_uploaded_file($_FILES['nama_foto']['tmp_name'], $filePath)) {
                // Cari id_ruangan berdasarkan nama_ruangan
                $ruanganQuery = "SELECT id_ruangan FROM ruangan WHERE nama_ruangan = ?";
                $ruanganStmt = $this->conn->prepare($ruanganQuery);
                $ruanganStmt->execute([$nama_ruangan]);
                $ruanganResult = $ruanganStmt->fetch(PDO::FETCH_ASSOC);

                // Pastikan id_ruangan ditemukan
                if ($ruanganResult) {
                    $id_ruangan = $ruanganResult['id_ruangan'];

                    // Simpan nama_ruangan dan path foto ke dalam tabel foto_ruangan
                    $query = "INSERT INTO foto_ruangan (id_ruangan, nama_foto) VALUES (?, ?)";
                    $stmt = $this->conn->prepare($query);

                    if ($stmt->execute([$id_ruangan, $relativePath])) {
                        response('success', 'Foto ruangan added successfully', [
                            'id_ruangan' => $id_ruangan,
                            'nama_ruangan' => $nama_ruangan,
                            'nama_foto' => $relativePath
                        ], statusCode: 201);
                    } else {
                        response('error', 'Unable to create foto ruangan', null, 400);
                    }
                } else {
                    response('error', 'Invalid ruangan', null, 400);
                }
            } else {
                response('error', 'Failed to upload photo', null, 500);
            }
        } else {
            response('error', 'Missing or invalid photo file', null, 400);
        }
    }
}
