<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/response.php';

class FasilitasRuangsController
{
    private $conn;
    public function __construct($conn)
    {
        if (!$conn) {
            response(false, 'Database connection failed');
        }
        $this->conn = $conn;
    }
    public function createFasilitasRuangan($nama_ruangan, $nama_fasilitas) {
        // Cari id_ruangan berdasarkan nama_ruangan
        $ruanganQuery = "SELECT id_ruangan FROM ruangan WHERE nama_ruangan = ?";
        $ruanganStmt = $this->conn->prepare($ruanganQuery);
        $ruanganStmt->execute([$nama_ruangan]);
        $ruanganResult = $ruanganStmt->fetch(PDO::FETCH_ASSOC);
    
        // Cari id_fasilitas berdasarkan nama_fasilitas
        $fasilitasQuery = "SELECT id_fasilitas FROM fasilitas WHERE nama_fasilitas = ?";
        $fasilitasStmt = $this->conn->prepare($fasilitasQuery);
        $fasilitasStmt->execute([$nama_fasilitas]);
        $fasilitasResult = $fasilitasStmt->fetch(PDO::FETCH_ASSOC);
    
        // Pastikan kedua hasil ditemukan
        if ($ruanganResult && $fasilitasResult) {
            $id_ruangan = $ruanganResult['id_ruangan'];
            $id_fasilitas = $fasilitasResult['id_fasilitas'];
    
            // Insert ke tabel fasilitas_ruangan
            $fasilitasRuanganQuery = "INSERT INTO fasilitas_ruangan (id_ruangan, id_fasilitas) VALUES (?, ?)";
            $fasilitasRuanganStmt = $this->conn->prepare($fasilitasRuanganQuery);
            
            if ($fasilitasRuanganStmt->execute([$id_ruangan, $id_fasilitas])) {
                response('success', 'Fasilitas ruangan added successfully', [
                    'id_ruangan' => $id_ruangan,
                    'nama_ruangan' => $nama_ruangan,
                    'id_fasilitas' => $id_fasilitas,
                    'nama_fasilitas' => $nama_fasilitas
                ], statusCode: 201);
            } else {
                response('error', 'Unable to add fasilitas ruangan', null, 400);
            }
        } else {
            response('error', 'Invalid ruangan or fasilitas', null, 400);
        }
    }
    
    
}