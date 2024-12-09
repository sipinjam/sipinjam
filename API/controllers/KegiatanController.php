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

    public function getAllKegiatan(){
        $query = "
        SELECT 
            k.nama_kegiatan,
            k.tema_kegiatan,
            p.tanggal_kegiatan,
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
            $kegiatanData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            response('success', 'Kegiatan Data Retrieved Successfully', $kegiatanData, '200');
        } else {
            response('error', 'Failed to retrieve Kegiatan data', null, 500);
        }
    }

    public function getKegiatanById($id_kegiatan)
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
        $stmt->execute([$id_kegiatan]);

        $peminjamanData = $stmt->fetch(PDO::FETCH_OBJ);

        if ($peminjamanData) {
            response('success', 'Peminjaman data fetched successfully', $peminjamanData, 200);
        } else {
            response('error', 'Peminjaman data not found', null, 404);
        }
    }
    
}
?>