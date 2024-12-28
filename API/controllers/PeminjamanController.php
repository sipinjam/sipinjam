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
            k.id_ormawa,
            p.tgl_peminjaman,
            p.sesi_peminjaman,
            k.daftar_panitia,
            r.nama_ruangan,
            m.nama_mahasiswa AS nama_ketua_ormawa,
            mp.nama_mahasiswa AS nama_ketua_pelaksana,
            s.nama_status,
            p.keterangan,
            o.nama_ormawa,
            pem.nama_lengkap
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
            status s ON p.id_status = s.id_status
        JOIN 
            peminjam pem ON k.id_peminjam = pem.id_peminjam
        JOIN
            ormawa o ON k.id_ormawa = o.id_ormawa
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
            o.nama_ormawa,
            p.tgl_peminjaman,
            p.sesi_peminjaman,
            k.daftar_panitia,
            r.nama_ruangan,
            m.nama_mahasiswa AS nama_ketua_ormawa,
            mp.nama_mahasiswa AS nama_ketua_pelaksana,
            b.nama_pembina,
            s.nama_status,
            p.keterangan,
            pem.nama_lengkap
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
            status s ON p.id_status = s.id_status
        JOIN
            peminjam pem ON k.id_peminjam = pem.id_peminjam
        JOIN
            ormawa o ON k.id_ormawa = o.id_ormawa
        JOIN
            pembina b ON o.id_ormawa = b.id_ormawa
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
    public function getPeminjamanByDate()
    {
        // Ambil parameter dari query string
        $tanggal = $_GET['date'] ?? null;
        $sesi = $_GET['sesi'] ?? null;
        $ruangan = $_GET['ruangan'] ?? null;

        // Validasi input
        if (!$tanggal || !$sesi || !$ruangan) {
            response('error', 'Missing parameters: date, sesi, or ruangan', null, 400);
            return;
        }

        // Query untuk memeriksa ketersediaan ruangan
        $query = "
        SELECT * FROM peminjaman 
        WHERE tgl_peminjaman = ? 
        AND sesi_peminjaman = ? 
        AND id_ruangan = ?
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$tanggal, $sesi, $ruangan]);

        // Cek apakah ada peminjaman yang sudah ada
        if ($stmt->rowCount() > 0) {
            response('success', 'Ruangan tidak tersedia', ['available' => false], 200);
        } else {
            response('success', 'Ruangan tersedia', ['available' => true], 200);
        }
    }
    public function getPeminjamanByIdOrmawa($id_ormawa)
    {
        $query = "
        SELECT 
            p.id_peminjaman,
            k.nama_kegiatan,
            k.tema_kegiatan,
            k.id_ormawa,
            o.nama_ormawa,
            p.tgl_peminjaman,
            p.sesi_peminjaman,
            k.daftar_panitia,
            r.nama_ruangan,
            m.nama_mahasiswa AS nama_ketua_ormawa,
            mp.nama_mahasiswa AS nama_ketua_pelaksana,
            b.nama_pembina,
            s.nama_status,
            p.keterangan,
            pem.nama_lengkap
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
            status s ON p.id_status = s.id_status
        JOIN
            peminjam pem ON k.id_peminjam = pem.id_peminjam
        JOIN
            ormawa o ON k.id_ormawa = o.id_ormawa
        JOIN
            pembina b ON o.id_ormawa = b.id_ormawa
        WHERE 
            k.id_ormawa = ?
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_ormawa]);

        $peminjamanData = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($peminjamanData) {
            response('success', 'Peminjaman data fetched successfully', $peminjamanData, 200);
        } else {
            response('error', 'Peminjaman data not found', null, 404);
        }
    }

    public function createPeminjaman()
{
    // Mengambil data JSON dari request body
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Pastikan inputData adalah array
    if (!is_array($inputData)) {
        response('error', 'Input data harus berupa array', null, 400);
        return;
    }

    $results = []; // Array untuk menyimpan hasil peminjaman
    $errors = []; // Array untuk menyimpan kesalahan

    foreach ($inputData as $data) {
        // Update required fields to remove 'id_peminjam'
        $requiredFields = ['id_kegiatan', 'id_ruangan', 'id_status', 'keterangan', 'tgl_peminjaman', 'sesi_peminjaman'];
        $missingFields = array_diff($requiredFields, array_keys($data));
        if (!empty($missingFields)) {
            $errors[] = 'Missing parameters for one of the entries: ' . implode(', ', $missingFields);
            continue; // Lanjutkan ke peminjaman berikutnya
        }

        // Check if kegiatan exists
        $kegiatanQuery = "SELECT * FROM kegiatan WHERE id_kegiatan = ?";
        $kegiatanStmt = $this->conn->prepare($kegiatanQuery);
        $kegiatanStmt->execute([$data['id_kegiatan']]);
        $kegiatan = $kegiatanStmt->fetch(PDO::FETCH_ASSOC);

        if (!$kegiatan) {
            $errors[] = 'Kegiatan tidak ditemukan untuk ID: ' . $data['id_kegiatan'];
            continue;
        }

        // Check if ruangan exists
        $ruanganQuery = "SELECT * FROM ruangan WHERE id_ruangan = ?";
        $ruanganStmt = $this->conn->prepare($ruanganQuery);
        $ruanganStmt->execute([$data['id_ruangan']]);
        $ruangan = $ruanganStmt->fetch(PDO::FETCH_ASSOC);

        if (!$ruangan) {
            $errors[] = 'Ruangan tidak ditemukan untuk ID: ' . $data['id_ruangan'];
            continue;
        }

        // Check if status exists
        $statusQuery = "SELECT * FROM status WHERE id_status = ?";
        $statusStmt = $this->conn->prepare($statusQuery);
        $statusStmt->execute([$data['id_status']]);
        $status = $statusStmt->fetch(PDO::FETCH_ASSOC);

        if (!$status) {
            $errors[] = 'Status tidak ditemukan untuk ID: ' . $data['id_status'];
            continue;
        }

        // Validate date format
        $tgl_peminjaman = date('Y-m-d', strtotime($data['tgl_peminjaman']));
        if (!preg_match('/\d{4}-\d{2}-\d{2}/', $tgl_peminjaman)) {
            $errors[] = 'Format tanggal peminjaman salah untuk ID: ' . $data['id_kegiatan'];
            continue;
        }

        // Validate session
        $sesi_peminjaman = $data['sesi_peminjaman'];
        if (!in_array($sesi_peminjaman, [1, 2, 3])) {
            $errors[] = 'Sesi peminjaman salah untuk ID: ' . $data['id_kegiatan'];
            continue;
        }

        // Insert into peminjaman table
        $peminjamanQuery = "INSERT INTO peminjaman (id_kegiatan, id_ruangan, id_status, keterangan, tgl_peminjaman, sesi_peminjaman) 
                            VALUES (?, ?, ?, ?, ?, ?)";
        $peminjamanStmt = $this->conn->prepare($peminjamanQuery);

        if ($peminjamanStmt->execute([$data['id_kegiatan'], $data['id_ruangan'], $data['id_status'], $data['keterangan'], $tgl_peminjaman, $sesi_peminjaman])) {
            $new_id = $this->conn->lastInsertId();
            $result_stmt = $this->conn-> prepare("SELECT * FROM peminjaman WHERE id_peminjaman = ?");
            $result_stmt->execute([$new_id]);
            $new_data = $result_stmt->fetch(PDO::FETCH_OBJ);
            $results[] = $new_data; // Simpan data peminjaman yang berhasil
        } else {
            $errors[] = 'Unable to create peminjaman for ID: ' . $data['id_kegiatan'];
        }
    }

    // Mengembalikan respons
    if (!empty($errors)) {
        response('error', 'Beberapa peminjaman gagal: ' . implode('; ', $errors), null, 400);
    } else {
        response('success', 'Semua peminjaman berhasil ditambahkan', $results, statusCode: 201);
    }
}
    public function editPeminjaman($id_peminjaman)
    {
        $inputData = json_decode(file_get_contents('php://input'), true);

        if (!isset($inputData['id_status'])) {
            response('error', 'Missing parameter: id_status', null, 400);
            return;
        }

        $idStatus = $inputData['id_status'];
        $keterangan = isset($inputData['keterangan']) ? $inputData['keterangan'] : null;

        // Menyiapkan query dan parameter berdasarkan nilai id_status
        if ($idStatus == "2") {
            // Jika id_status adalah "2", kita perlu mengupdate keterangan
            if (!isset($inputData['keterangan'])) {
                response('error', 'Missing parameter: keterangan', null, 400);
                return;
            }

            $updateQuery = "UPDATE peminjaman SET id_status = ?, keterangan = ? WHERE id_peminjaman = ?";
            $updateStmt = $this->conn->prepare($updateQuery);
            $params = [$idStatus, $keterangan, $id_peminjaman];
        } elseif ($idStatus == "3") {
            // Jika id_status adalah "3", kita tidak perlu mengupdate keterangan
            $updateQuery = "UPDATE peminjaman SET id_status = ?, keterangan = NULL WHERE id_peminjaman = ?";
            $updateStmt = $this->conn->prepare($updateQuery);
            $params = [$idStatus, $id_peminjaman];
        } else {
            response('error', 'Invalid value for id_status', null, 400);
            return;
        }

        // Eksekusi query
        if ($updateStmt->execute($params)) {
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