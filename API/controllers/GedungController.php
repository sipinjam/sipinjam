<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/response.php';

class GedungsController
{
    private $conn;
    private $table_name = "gedung";
    public function __construct($conn)
    {
        if (!$conn) {
            response(false, 'Database connection failed');
        }
        $this->conn = $conn;
    }


    public function getAllGedung()
    {
        $query = "SELECT * FROM gedung";
        $data = array();

        $stmt = $this->conn->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $data[] = $row;
            }
            response('success', 'List of Gedungs Retrieved Successfully', $data, 200);
        } else {
            response('error', 'Failed to Retrieve Gedungs', null, [
                'code' => 500,
                'message' => 'Internal server error: ' . $this->conn->errorInfo()[2]
            ]);
        }
    }
    public function createGedung()
    {
        // Ambil nama_gedung dari $_POST
        if (!isset($_POST['nama_gedung'])) {
            response('error', 'Missing nama_gedung parameter', null, 400);
            return;
        }
        $nama_gedung = $_POST['nama_gedung'];

        // Pastikan ada file foto_gedung yang diunggah
        if (isset($_FILES['foto_gedung']) && $_FILES['foto_gedung']['error'] == UPLOAD_ERR_OK) {
            $folderPath = '../assets/gedung/'; // Lokasi penyimpanan fisik file

            // Mengambil ekstensi file asli
            $fileExtension = pathinfo($_FILES['foto_gedung']['name'], PATHINFO_EXTENSION);

            // Mengganti nama file dengan format tanggal
            $fileName = date('YmdHis') . '.' . $fileExtension;
            $filePath = $folderPath . $fileName;

            // Path yang akan disimpan ke database
            $relativePath = '../../../api/assets/gedung/' . $fileName;

            // Pindahkan file ke folder tujuan dengan nama baru
            if (move_uploaded_file($_FILES['foto_gedung']['tmp_name'], $filePath)) {
                // Simpan nama gedung dan relative path foto ke dalam tabel
                $query = "INSERT INTO gedung (nama_gedung, foto_gedung) VALUES (?, ?)";
                $stmt = $this->conn->prepare($query);

                if ($stmt->execute([$nama_gedung, $relativePath])) {
                    $new_id = $this->conn->lastInsertId();
                    $result_stmt = $this->conn->prepare("SELECT * FROM gedung WHERE id_gedung = ?");
                    $result_stmt->execute([$new_id]);
                    $new_data = $result_stmt->fetch(PDO::FETCH_OBJ);

                    response('success', 'Gedung Added Successfully', $new_data);
                } else {
                    response('error', 'Unable to create gedung', null, 400);
                }
            } else {
                response('error', 'Failed to upload photo', null, 500);
            }
        } else {
            response('error', 'Missing or invalid photo file', null, 400);
        }
    }
}
