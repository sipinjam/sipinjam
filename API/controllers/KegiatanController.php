<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/response.php';

class KegiatansController
{
    private $conn;

    public function __construct($conn)
    {
        if (!$conn) {
            response(false, 'Database connection failed');
        }
        $this->conn = $conn;
    }

    public function getAllKegiatan()
    {
        $query = "
        SELECT * FROM kegiatan
    ";

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            $kegiatanData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            response('success', 'Kegiatan Data Retrieved Successfully', $kegiatanData, '200');
        } else {
            response('error', 'Failed to retrieve Kegiatan data', null, 500);
        }
    }

    public function getKegiatanById($id_ormawa)
    {
        $query = "
        SELECT *
        FROM 
            kegiatan
        WHERE 
            id_ormawa = ?
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_ormawa]);

        $kegiatanData = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($kegiatanData) {
            response('success', 'Kegiatan data fetched successfully', $kegiatanData, 200);
        } else {
            response('error', 'Kegiatan data not found', null, 404);
        }
    }
    public function createKegiatan()
    {
    $requiredFields = ['nama_kegiatan', 'tema_kegiatan', 'id_ormawa', 'id_mahasiswa', 'id_peminjam'];
    $missingFields = array_diff($requiredFields, array_keys($_POST));
    if (!empty($missingFields)) {
        response('error', 'Missing parameters: ' . implode(', ', $missingFields), null, 400);
        return;
    }

    if (isset($_FILES['daftar_panitia']) && $_FILES['daftar_panitia']['error'] == UPLOAD_ERR_OK) {
        $folderPath = '../assets/daftar_panitia/';
        $fileName = date('YmdHis') . '_' . basename($_FILES['daftar_panitia']['name']);
        $filePath = $folderPath . $fileName;
        $relativePath = '../../../api/assets/daftar_panitia/' . $fileName;
        if (!move_uploaded_file($_FILES['daftar_panitia']['tmp_name'], $filePath)) {
            response('error', 'Failed to upload daftar_panitia file', null, 500);
            return;
        }
    } else {
        response('error', 'Missing or invalid daftar_panitia file', null, 400);
        return;
    }

    $ormawaQuery = "SELECT * FROM ormawa WHERE id_ormawa = ?";
    $ormawaStmt = $this->conn->prepare($ormawaQuery);
    $ormawaStmt->execute([$_POST['id_ormawa']]);
    $ormawa = $ormawaStmt->fetch(PDO::FETCH_ASSOC);

    if (!$ormawa) {
        response('error', 'Ormawa not found', null, 400);
        return;
    }

    $mahasiswaQuery = "SELECT * FROM mahasiswa WHERE id_mahasiswa = ?";
    $mahasiswaStmt = $this->conn->prepare($mahasiswaQuery);
    $mahasiswaStmt->execute([$_POST['id_mahasiswa']]);
    $mahasiswa = $mahasiswaStmt->fetch(PDO::FETCH_ASSOC);

    if (!$mahasiswa) {
        response('error', 'Mahasiswa not found', null, 400);
        return;
    }

    $peminjamQuery = "SELECT * FROM peminjam WHERE id_peminjam = ?";
    $peminjamStmt = $this->conn->prepare($peminjamQuery);
    $peminjamStmt->execute([$_POST['id_peminjam']]);
    $peminjam = $peminjamStmt->fetch(PDO::FETCH_ASSOC);

    if (!$peminjam) {
        response('error', 'Peminjam not found', null, 400);
        return;
    }

    $nama_kegiatan = $_POST['nama_kegiatan'];
    if (empty($nama_kegiatan)) {
        response('error', 'Nama kegiatan tidak boleh kosong', null, 400);
        return;
    }

    $tema_kegiatan = $_POST['tema_kegiatan'];
    if (empty($tema_kegiatan)) {
        response('error', 'Tema kegiatan tidak boleh kosong', null, 400);
        return;
    }

    $kegiatanQuery = "INSERT INTO kegiatan (nama_kegiatan, tema_kegiatan, daftar_panitia, id_ormawa, id_mahasiswa, id_peminjam) 
                      VALUES (?, ?, ?, ?, ?, ?)";
    $kegiatanStmt = $this->conn->prepare($kegiatanQuery);

    if ($kegiatanStmt->execute([$nama_kegiatan, $tema_kegiatan, $relativePath, $_POST['id_ormawa'], $_POST['id_mahasiswa'], $_POST['id_peminjam']])) {
        $new_id = $this->conn->lastInsertId();
        $result_stmt = $this->conn->prepare("SELECT * FROM kegiatan WHERE id_kegiatan = ?");
        $result_stmt->execute([$new_id]);
        $new_data = $result_stmt->fetch(PDO::FETCH_OBJ);

        response('success', 'Kegiatan Added Successfully', $new_data, statusCode: 201);
    } else {
        response('error', 'Unable to create kegiatan', null, 400);
    }
}
}

