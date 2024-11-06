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
            k.tanggal_kegiatan,
            k.waktu_mulai,
            k.waktu_selesai,
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
            struktur_organisasi so ON k.id_struktur_organisasi = so.id_struktur_organisasi
        JOIN 
            mahasiswa m ON so.id_mahasiswa = m.id_mahasiswa
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
            response('success', 'Peminjaman Data Retrieved Successfully', $peminjamanData,'200');
        } else {
            response('error', 'Failed to retrieve peminjaman data', null, 500);
        }
    }

    public function getPeminjamanById($id_peminjaman)
    {
        // Query untuk mengambil data peminjaman beserta informasi terkait dari tabel kegiatan, ruangan, mahasiswa, dan peminjam
        $query = "
        SELECT 
            p.id_peminjaman,
            k.nama_kegiatan,
            k.tema_kegiatan,
            k.tanggal_kegiatan,
            k.waktu_mulai,
            k.waktu_selesai,
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
            struktur_organisasi so ON k.id_struktur_organisasi = so.id_struktur_organisasi
        JOIN 
            mahasiswa m ON so.id_mahasiswa = m.id_mahasiswa
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
            response('success', 'Peminjaman data fetched successfully', $peminjamanData);
        } else {
            response('error', 'Peminjaman data not found', null, 404);
        }
    }


    public function createPeminjaman()
    {
        // Validasi data yang diperlukan ada di $_POST dan $_FILES
        $requiredFields = ['nama_kegiatan', 'tema_kegiatan', 'tanggal_kegiatan', 'waktu_mulai', 'waktu_selesai', 'nama_ketua_ormawa', 'nama_ketua_pelaksana', 'nama_peminjam', 'nama_ruangan'];
        $missingFields = array_diff($requiredFields, array_keys($_POST));
        if (!empty($missingFields)) {
            response('error', 'Missing parameters: ' . implode(', ', $missingFields), null, 400);
            return;
        }

        // Proses upload file daftar_panitia
        if (isset($_FILES['daftar_panitia']) && $_FILES['daftar_panitia']['error'] == UPLOAD_ERR_OK) {
            $folderPath = '../assets/daftar_panitia/';
            $fileName = date('YmdHis') . '_' . basename($_FILES['daftar_panitia']['name']);
            $filePath = $folderPath . $fileName;
            $relativePath = '../../../api/assets/daftar_panitia' . $fileName;
            if (!move_uploaded_file($_FILES['daftar_panitia']['tmp_name'], $filePath)) {
                response('error', 'Failed to upload daftar_panitia file', null, 500);
                return;
            }
        } else {
            response('error', 'Missing or invalid daftar_panitia file', null, 400);
            return;
        }

        // Ambil id_struktur_organisasi dan id_mahasiswa berdasarkan nama_ketua_ormawa
        $strukturQuery = "SELECT so.id_struktur_organisasi, m.id_mahasiswa FROM struktur_organisasi so
                          JOIN mahasiswa m ON so.id_mahasiswa = m.id_mahasiswa
                          WHERE m.nama_mahasiswa = ?";
        $strukturStmt = $this->conn->prepare($strukturQuery);
        $strukturStmt->execute([$_POST['nama_ketua_ormawa']]);
        $strukturOrganisasi = $strukturStmt->fetch(PDO::FETCH_ASSOC);

        if (!$strukturOrganisasi) {
            response('error', 'Struktur organisasi not found for the provided mahasiswa', null, 400);
            return;
        }
        $id_struktur_organisasi = $strukturOrganisasi['id_struktur_organisasi'];
        // $id_mahasiswa_organisasi = $strukturOrganisasi['id_mahasiswa'];
        $mahasiswaQuery = "SELECT id_mahasiswa FROM mahasiswa WHERE nama_mahasiswa = ?";
        $mahasiswaStmt = $this->conn->prepare($mahasiswaQuery);
        $mahasiswaStmt->execute([$_POST['nama_ketua_pelaksana']]);
        $mahasiswa = $mahasiswaStmt->fetch(PDO::FETCH_ASSOC);

        if (!$mahasiswa) {
            response('error', 'Mahasiswa peminjam not found', null, 400);
            return;
        }
        $id_mahasiswa_peminjam = $mahasiswa['id_mahasiswa'];
        // Masukkan data ke tabel kegiatan
        $kegiatanQuery = "INSERT INTO kegiatan (nama_kegiatan, tema_kegiatan, tanggal_kegiatan, waktu_mulai, waktu_selesai, daftar_panitia, id_struktur_organisasi, id_mahasiswa) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $kegiatanStmt = $this->conn->prepare($kegiatanQuery);
        $kegiatanStmt->execute([
            $_POST['nama_kegiatan'],
            $_POST['tema_kegiatan'],
            $_POST['tanggal_kegiatan'],
            $_POST['waktu_mulai'],
            $_POST['waktu_selesai'],
            $relativePath,
            $id_struktur_organisasi,
            $id_mahasiswa_peminjam
        ]);

        $id_kegiatan = $this->conn->lastInsertId();

        // Ambil id_peminjam dari nama_peminjam
        $peminjamQuery = "SELECT id_peminjam FROM peminjam WHERE nama_peminjam = ?";
        $peminjamStmt = $this->conn->prepare($peminjamQuery);
        $peminjamStmt->execute([$_POST['nama_peminjam']]);
        $peminjam = $peminjamStmt->fetch(PDO::FETCH_ASSOC);

        if (!$peminjam) {
            response('error', 'Peminjam not found', null, 400);
            return;
        }
        $id_peminjam = $peminjam['id_peminjam'];

        // Ambil id_ruangan dari nama_ruangan
        $ruanganQuery = "SELECT id_ruangan FROM ruangan WHERE nama_ruangan = ?";
        $ruanganStmt = $this->conn->prepare($ruanganQuery);
        $ruanganStmt->execute([$_POST['nama_ruangan']]);
        $ruangan = $ruanganStmt->fetch(PDO::FETCH_ASSOC);

        if (!$ruangan) {
            response('error', 'Ruangan not found', null, 400);
            return;
        }
        $id_ruangan = $ruangan['id_ruangan'];

        // Masukkan data ke tabel peminjaman dengan id_kegiatan, id_peminjam, id_ruangan, dan id_status
        $peminjamanQuery = "INSERT INTO peminjaman (id_kegiatan, id_ruangan, id_peminjam, id_status) VALUES (?, ?, ?, ?)";
        $peminjamanStmt = $this->conn->prepare($peminjamanQuery);

        if ($peminjamanStmt->execute([$id_kegiatan, $id_ruangan, $id_peminjam, 1])) {
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
        // Mengambil data JSON dari body request
        $inputData = json_decode(file_get_contents('php://input'), true);

        // Validasi input id_status
        if (!isset($inputData['id_status'])) {
            response('error', 'Missing parameter: id_status', null, 400);
            return;
        }

        $id_status = $inputData['id_status'];
        $keterangan = null;

        // Jika id_status bernilai 2, validasi input keterangan
        if ($id_status == 2) {
            if (!isset($inputData['keterangan'])) {
                response('error', 'Missing parameter: keterangan for status 2', null, 400);
                return;
            }
            $keterangan = $inputData['keterangan'];
        }

        // Update query untuk memperbarui status dan keterangan
        $query = "UPDATE peminjaman SET id_status = ?, keterangan = ? WHERE id_peminjaman = ?";
        $stmt = $this->conn->prepare($query);

        // Eksekusi query
        if ($stmt->execute([$id_status, $keterangan, $id_peminjaman])) {
            // Ambil data peminjaman yang telah diperbarui
            $result_stmt = $this->conn->prepare("
            SELECT 
                p.id_peminjaman,
                k.nama_kegiatan,
                k.tema_kegiatan,
                k.tanggal_kegiatan,
                k.waktu_mulai,
                k.waktu_selesai,
                r.nama_ruangan,
                m.nama_mahasiswa AS nama_mahasiswa_organisasi,
                pm.nama_peminjam,
                s.nama_status,
                p.keterangan
            FROM 
                peminjaman p
            JOIN 
                kegiatan k ON p.id_kegiatan = k.id_kegiatan
            JOIN 
                ruangan r ON p.id_ruangan = r.id_ruangan
            JOIN 
                struktur_organisasi so ON k.id_struktur_organisasi = so.id_struktur_organisasi
            JOIN 
                mahasiswa m ON so.id_mahasiswa = m.id_mahasiswa
            JOIN 
                peminjam pm ON p.id_peminjam = pm.id_peminjam
            JOIN 
                status s ON p.id_status = s.id_status
            WHERE 
                p.id_peminjaman = ?
        ");
            $result_stmt->execute([$id_peminjaman]);
            $updatedData = $result_stmt->fetch(PDO::FETCH_ASSOC);

            if ($updatedData) {
                response('success', 'Peminjaman status updated successfully', $updatedData);
            } else {
                response('error', 'Failed to retrieve updated peminjaman data', null, 500);
            }
        } else {
            response('error', 'Failed to update peminjaman status', null, 500);
        }
    }
}
