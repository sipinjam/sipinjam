<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/response.php';

class PeminjamansController
{
    private $conn;
    
    public function __construct($conn)
    {
        if (!$conn) {
            response(false, 'Database connection failed');
        }
        $this->conn = $conn;
    }

    public function getAllPeminjaman()
    {
        $query = "
        SELECT 
            p.id_peminjaman,
            k.nama_kegiatan,
            k.tema_kegiatan,
            k.id_peminjam,
            p.tgl_peminjaman,
            p.sesi_peminjaman,
            k.daftar_panitia,
            r.nama_ruangan,
            m.nama_mahasiswa AS nama_ketua_ormawa,
            mp.nama_mahasiswa AS nama_ketua_pelaksana,
            pe.nama_peminjam,
            s.nama_status
       FROM 
            peminjaman p
        JOIN 
            kegiatan k ON p.id_kegiatan = k.id_kegiatan
        JOIN 
            ruangan r ON p.id_ruangan = r.id_ruangan
        JOIN 
            mahasiswa m ON k.id_mahasiswa = m.id_mahasiswa
        JOIN 
            mahasiswa mp ON k.id_mahasiswa = mp.id_mahasiswa
        JOIN 
            peminjam pe ON p.id_peminjam = pe.id_peminjam
        JOIN 
            status s ON p.id_status = s.id_status
    ";

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            $peminjamanData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            response('success', 'Peminjaman Data Retrieved Successfully', $peminjamanData, '200');
        } else {
            response('error', 'Failed to retrieve peminjaman data', null, 500);
        }
    }

    public function getPeminjamanById($id_peminjaman)
    {
        $query = "
        SELECT 
            p.id_peminjaman,
            k.nama_kegiatan,
            k.tema_kegiatan,
            p.tgl_peminjaman,
            p.sesi_peminjaman,
            k.daftar_panitia,
            r.nama_ruangan,
            m.nama_mahasiswa AS nama_ketua_ormawa,
            mp.nama_mahasiswa AS nama_ketua_pelaksana,
            pe.nama_peminjam,
            s.nama_status
        FROM 
            peminjaman p
        JOIN 
            kegiatan k ON p.id_kegiatan = k.id_kegiatan
        JOIN 
            ruangan r ON p.id_ruangan = r.id_ruangan
        JOIN 
            mahasiswa m ON k.id_mahasiswa = m.id_mahasiswa
        JOIN 
            mahasiswa mp ON k.id_mahasiswa = mp.id_mahasiswa
        JOIN 
            peminjam pe ON p.id_peminjam = pe.id_peminjam
        JOIN 
            status s ON p.id_status = s.id_status
        WHERE 
            p.id_peminjaman = ?
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_peminjaman]);

        $peminjamanData = $stmt->fetch(PDO::FETCH_OBJ);

        if ($peminjamanData) {
            response('success', 'Peminjaman data fetched successfully', $peminjamanData, 200);
        } else {
            response('error', 'Peminjaman data not found', null, 404);
        }
    }

    public function createPeminjaman()
{
    $requiredFields = ['id_kegiatan', 'id_ruangan', 'id_peminjam', 'id_status', 'keterangan', 'tgl_peminjaman', 'sesi_peminjaman'];
    $missingFields = array_diff($requiredFields, array_keys($_POST));
    if (!empty($missingFields)) {
        response('error', 'Missing parameters: ' . implode(', ', $missingFields), null, 400);
        return;
    }

    $kegiatanQuery = "SELECT * FROM kegiatan WHERE id_kegiatan = ?";
    $kegiatanStmt = $this->conn->prepare($kegiatanQuery);
    $kegiatanStmt->execute([$_POST['id_kegiatan']]);
    $kegiatan = $kegiatanStmt->fetch(PDO::FETCH_ASSOC);

    if (!$kegiatan) {
        response('error', 'Kegiatan tidak ditemukan', null, 400);
        return;
    }

    $ruanganQuery = "SELECT * FROM ruangan WHERE id_ruangan = ?";
    $ruanganStmt = $this->conn->prepare($ruanganQuery);
    $ruanganStmt->execute([$_POST['id_ruangan']]);
    $ruangan = $ruanganStmt->fetch(PDO::FETCH_ASSOC);

    if (!$ruangan) {
        response('error', 'Ruangan tidak ditemukan', null, 400);
        return;
    }

    $peminjamQuery = "SELECT * FROM peminjam WHERE id_peminjam = ?";
    $peminjamStmt = $this->conn->prepare($peminjamQuery);
    $peminjamStmt->execute([$_POST['id_peminjam']]);
    $peminjam = $peminjamStmt->fetch(PDO::FETCH_ASSOC);

    if (!$peminjam) {
        response('error', 'Peminjam tidak ditemukan', null, 400);
        return;
    }

    $statusQuery = "SELECT * FROM status WHERE id_status = ?";
    $statusStmt = $this->conn->prepare($statusQuery);
    $statusStmt->execute([$_POST['id_status']]);
    $status = $statusStmt->fetch(PDO::FETCH_ASSOC);

    if (!$status) {
        response('error', 'Status tidak ditemukan', null, 400);
        return;
    }

    $tgl_peminjaman = date('Y-m-d', strtotime($_POST['tgl_peminjaman']));
    if (!preg_match('/\d{4}-\d{2}-\d{2}/', $tgl_peminjaman)) {
        response('error', 'Format tanggal peminjaman salah', null, 400);
        return;
    }

    $sesi_peminjaman = $_POST['sesi_peminjaman'];
    if (!in_array($sesi_peminjaman, [1,2,3])) {
        response('error', 'Sesi peminjaman salah', null, 400);
        return;
    }

    $peminjamanQuery = "INSERT INTO peminjaman (id_kegiatan, id_ruangan, id_peminjam, id_status, keterangan, tgl_peminjaman, sesi_peminjaman) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
    $peminjamanStmt = $this->conn->prepare($peminjamanQuery);

    if ($peminjamanStmt->execute([$_POST['id_kegiatan'], $_POST['id_ruangan'], $_POST['id_peminjam'], $_POST['id_status'], $_POST['keterangan'], $tgl_peminjaman, $sesi_peminjaman])) {
        $new_id = $this->conn->lastInsertId();
        $result_stmt = $this->conn->prepare("SELECT * FROM peminjaman WHERE id_peminjaman = ?");
        $result_stmt->execute([$new_id]);
        $new_data = $result_stmt->fetch(PDO::FETCH_OBJ);

        response('success', 'Peminjaman Added Successfully', $new_data, statusCode: 201);
    } else {
        response('error', 'Unable to create peminjaman', null, 400);
    }
}
    public function editPeminjaman($id_peminjaman)
    {
        $inputData = json_decode(file_get_contents('php://input'), true);

        if (!isset($inputData['id_status'])) {
            response('error', 'Missing parameter: id_status', null, 400);
            return;
        }

        $updateQuery = "UPDATE peminjaman SET id_status = ? WHERE id_peminjaman = ?";
        $updateStmt = $this->conn->prepare($updateQuery);

        if ($updateStmt->execute([$inputData['id_status'], $id_peminjaman])) {
            response('success', 'Peminjaman updated successfully', null, 200);
        } else {
            response('error', 'Unable to update peminjaman', null, 400);
        }
    }

    public function deletePeminjaman($id_peminjaman)
    {
        $deleteQuery = "DELETE FROM peminjaman WHERE id_peminjaman = ?";
        $deleteStmt = $this->conn->prepare($deleteQuery);

        if ($deleteStmt->execute([$id_peminjaman])) {
            response('success', 'Peminjaman deleted successfully', null, 200);
        } else {
            response('error', 'Unable to delete peminjaman', null, 400);
        }
    }
}
?>