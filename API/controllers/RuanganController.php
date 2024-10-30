<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/response.php';
// Dalam ruanganController
//require_once __DIR__ . 'FasilitasController.php';

// Buat instance FasilitasController
//$fasilitasController = new FasilitasRuangsController($this->conn);

// Tambahkan fasilitas ruangan dengan memanggil createFasilitasRuangan
//$fasilitasController->createFasilitasRuangan($nama_ruangan, $nama_fasilitas_ruangan);


class RuangansController
{
    private $conn;

    public function __construct($conn)
    {
        if (!$conn) {
            response(false, 'Database connection failed');
        }
        $this->conn = $conn;
    }
    public function getAllRuangan()
    {
        $query = "SELECT * FROM ruangan";
        $data = array();

        $stmt = $this->conn->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $data[] = $row;
            }
            response('success', 'List of Ruangans Retrieved Successfully', $data);
        } else {
            response('error', 'Failed to Retrieve Ruangans', null, [
                'code' => 500,
                'message' => 'Internal server error: ' . $this->conn->errorInfo()[2]
            ]);
        }
    }
    public function getRuanganById($id_ruangan)
    {
        // Validasi id_ruangan
        if (empty($id_ruangan) || !is_numeric($id_ruangan)) {
            response('error', 'Invalid or missing id_ruangan parameter', null, 400);
            return;
        }

        // Query untuk mengambil data ruangan beserta informasi terkait
        $query = "
            SELECT 
                r.nama_ruangan,
                g.nama_gedung,
                r.deskripsi_ruangan,
                r.kapasitas,
                p.nama_peminjam,
                f.nama_fasilitas,
                fr2.nama_foto
            FROM 
                ruangan r
            LEFT JOIN 
                gedung g ON r.id_gedung = g.id_gedung
            LEFT JOIN 
                peminjam p ON r.id_peminjam = p.id_peminjam
            LEFT JOIN 
                fasilitas_ruangan fr ON r.id_ruangan = fr.id_ruangan
            LEFT JOIN 
                fasilitas f ON fr.id_fasilitas = f.id_fasilitas
            LEFT JOIN 
                foto_ruangan fr2 ON r.id_ruangan = fr2.id_ruangan
            WHERE 
                r.id_ruangan = ?
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_ruangan]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            response('success', 'Ruangan found', $result);
        } else {
            response('error', 'Ruangan not found', null, 404);
        }
    }


    public function createRuangan()
    {
        // Menerima data JSON dan mendekode
        $input = json_decode(file_get_contents('php://input'), true);

        // Validasi input
        $requiredFields = ['nama_ruangan', 'nama_gedung', 'deskripsi_ruangan', 'kapasitas', 'nama_peminjam'];
        $missingParams = array_diff($requiredFields, array_keys($input));

        if (!empty($missingParams)) {
            response('error', 'Missing parameters: ' . implode(', ', $missingParams), null, 400);
            return;
        }

        // Memastikan gedung dan peminjam sudah ada di database
        $gedungQuery = "SELECT id_gedung FROM gedung WHERE nama_gedung = ?";
        $gedungStmt = $this->conn->prepare($gedungQuery);
        $gedungStmt->execute([$input['nama_gedung']]);
        $gedungResult = $gedungStmt->fetch(PDO::FETCH_ASSOC);

        $peminjamQuery = "SELECT id_peminjam FROM peminjam WHERE nama_peminjam = ?";
        $peminjamStmt = $this->conn->prepare($peminjamQuery);
        $peminjamStmt->execute([$input['nama_peminjam']]);
        $peminjamResult = $peminjamStmt->fetch(PDO::FETCH_ASSOC);

        if (!$gedungResult || !$peminjamResult) {
            response('error', 'Invalid gedung or peminjam', null, 400);
            return;
        }

        $id_gedung = $gedungResult['id_gedung'];
        $id_peminjam = $peminjamResult['id_peminjam'];

        // Insert data ruangan
        $ruanganQuery = "INSERT INTO ruangan (nama_ruangan, id_gedung, deskripsi_ruangan, kapasitas, id_peminjam) VALUES (?, ?, ?, ?, ?)";
        $ruanganStmt = $this->conn->prepare($ruanganQuery);

        if ($ruanganStmt->execute([
            $input['nama_ruangan'],
            $id_gedung,
            $input['deskripsi_ruangan'],
            $input['kapasitas'],
            $id_peminjam
        ])) {
            $id_ruangan = $this->conn->lastInsertId();
            // Mengambil data ruangan baru sebagai respons
            $resultStmt = $this->conn->prepare("SELECT * FROM ruangan WHERE id_ruangan = ?");
            $resultStmt->execute([$id_ruangan]);
            $newData = $resultStmt->fetch(PDO::FETCH_OBJ);

            response('success', 'Ruangan Added Successfully', $newData);
        } else {
            response('error', 'Unable to create ruangan', null, 400);
        }
    }
}