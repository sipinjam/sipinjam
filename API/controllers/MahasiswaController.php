<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/response.php';

class MahasiswaController
{
    private $conn;
    private $table_name = "mahasiswa";

    public function __construct($conn)
    {
        if (!$conn) {
            response(false, 'Database connection failed');
        }
        $this->conn = $conn;
    }

    // Get all Mahasiswa, including their Struktur Organisasi, Jenis Peminjam, and Pembina data
    public function getAllMahasiswa()
    {
        $query = "SELECT 
                    m.id_mahasiswa, 
                    m.nama_mahasiswa,
                    m.nim_mahasiswa,  -- Added nim_mahasiswa
                    m.id_jenis_peminjam, 
                    m.id_ormawa, 
                    o.nama_ormawa, 
                    j.nama_jenis_peminjam, 
                    s.nama_struktur,
                    p.id_pembina,
                    p.nama_pembina, 
                    p.nip_pembina  -- Added pembina fields
                  FROM mahasiswa m
                  LEFT JOIN jenis_peminjam j ON m.id_jenis_peminjam = j.id_jenis_peminjam
                  LEFT JOIN struktur_organisasi s ON m.id_struktur_organisasi = s.id_struktur_organisasi
                  LEFT JOIN ormawa o ON m.id_ormawa = o.id_ormawa
                  LEFT JOIN pembina p ON o.id_ormawa = p.id_ormawa";  // Join pembina table on id_ormawa

        $data = array();

        $stmt = $this->conn->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $data[] = $row;
            }
            response('success', 'List of Mahasiswa Retrieved Successfully', $data, 200);
        } else {
            response('error', 'Failed to Retrieve Mahasiswa', null, [
                'code' => 500,
                'message' => 'Internal server error: ' . $this->conn->errorInfo()[2]
            ]);
        }
    }

    // Get a specific Mahasiswa by ID, including Pembina data
    public function getMahasiswaById($id)
{
    $query = "SELECT 
                m.id_mahasiswa, 
                m.nama_mahasiswa, 
                m.nim_mahasiswa, 
                m.id_jenis_peminjam, 
                m.id_ormawa, 
                o.nama_ormawa, 
                j.nama_jenis_peminjam, 
                s.nama_struktur,
                p.id_pembina,
                p.nama_pembina, 
                p.nip_pembina  
              FROM mahasiswa m
              LEFT JOIN jenis_peminjam j ON m.id_jenis_peminjam = j.id_jenis_peminjam
              LEFT JOIN struktur_organisasi s ON m.id_struktur_organisasi = s.id_struktur_organisasi
              LEFT JOIN ormawa o ON m.id_ormawa = o.id_ormawa
              LEFT JOIN pembina p ON o.id_ormawa = p.id_ormawa  
              WHERE m.id_ormawa = ? AND m.id_struktur_organisasi = 1";  // Dua kondisi di sini

    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        response('success', 'Mahasiswa Retrieved Successfully', $data, 200);
    } else {
        response('error', 'Mahasiswa Not Found', null, 404);
    }
}
// Get all Mahasiswa by id_ormawa
public function getMahasiswaByOrmawa($id_ormawa)
{
    $query = "SELECT 
                m.id_mahasiswa, 
                m.nama_mahasiswa, 
                m.nim_mahasiswa, 
                m.id_jenis_peminjam, 
                m.id_ormawa, 
                o.nama_ormawa, 
                j.nama_jenis_peminjam, 
                s.nama_struktur,
                p.id_pembina,
                p.nama_pembina, 
                p.nip_pembina  
              FROM mahasiswa m
              LEFT JOIN jenis_peminjam j ON m.id_jenis_peminjam = j.id_jenis_peminjam
              LEFT JOIN struktur_organisasi s ON m.id_struktur_organisasi = s.id_struktur_organisasi
              LEFT JOIN ormawa o ON m.id_ormawa = o.id_ormawa
              LEFT JOIN pembina p ON o.id_ormawa = p.id_ormawa  
              WHERE m.id_ormawa = ?";  // Kondisi untuk id_ormawa

    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id_ormawa]);

    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        response('success', 'Mahasiswa Retrieved Successfully', $data, 200);
    } else {
        response('error', 'Mahasiswa Not Found', null, 404);
    }
}
    // Create a new Mahasiswa
    public function createMahasiswa()
    {
        if (!isset($_POST['nama_mahasiswa'])) {
            response('error', 'Missing nama_mahasiswa parameter', null, 400);
            return;
        }
        if (!isset($_POST['id_jenis_peminjam'])) {
            response('error', 'Missing id_jenis_peminjam parameter', null, 400);
            return;
        }
        if (!isset($_POST['id_struktur_organisasi'])) {
            response('error', 'Missing id_struktur_organisasi parameter', null, 400);
            return;
        }
        if (!isset($_POST['id_ormawa'])) {
            response('error', 'Missing id_ormawa parameter', null, 400);
            return;
        }
        if (!isset($_POST['nim_mahasiswa'])) {  // Added validation for nim_mahasiswa
            response('error', 'Missing nim_mahasiswa parameter', null, 400);
            return;
        }

        $nama_mahasiswa = $_POST['nama_mahasiswa'];
        $nim_mahasiswa = $_POST['nim_mahasiswa'];  // Capture nim_mahasiswa
        $id_jenis_peminjam = $_POST['id_jenis_peminjam'];
        $id_struktur_organisasi = $_POST['id_struktur_organisasi'];
        $id_ormawa = $_POST['id_ormawa'];

        $query = "INSERT INTO mahasiswa (nama_mahasiswa, nim_mahasiswa, id_jenis_peminjam, id_struktur_organisasi, id_ormawa) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$nama_mahasiswa, $nim_mahasiswa, $id_jenis_peminjam, $id_struktur_organisasi, $id_ormawa])) {
            $new_id = $this->conn->lastInsertId();

            // Fetch the newly created mahasiswa with associated data
            $result_stmt = $this->conn->prepare("SELECT 
                                                    m.id_mahasiswa, 
                                                    m.nama_mahasiswa, 
                                                    m.nim_mahasiswa,  -- Added nim_mahasiswa
                                                    m.id_jenis_peminjam, 
                                                    m.id_ormawa, 
                                                    o.nama_ormawa, 
                                                    j.nama_jenis_peminjam, 
                                                    s.nama_struktur,
                                                    p.id_pembina,
                                                    p.nama_pembina, 
                                                    p.nip_pembina  -- Added pembina fields
                                                  FROM mahasiswa m
                                                  LEFT JOIN jenis_peminjam j ON m.id_jenis_peminjam = j.id_jenis_peminjam
                                                  LEFT JOIN struktur_organisasi s ON m.id_struktur_organisasi = s.id_struktur_organisasi
                                                  LEFT JOIN ormawa o ON m.id_ormawa = o.id_ormawa
                                                  LEFT JOIN pembina p ON o.id_ormawa = p.id_ormawa  -- Join pembina table on id_ormawa
                                                  WHERE m.id_mahasiswa = ?");
            $result_stmt->execute([$new_id]);
            $new_data = $result_stmt->fetch(PDO::FETCH_OBJ);

            response('success', 'Mahasiswa Created Successfully', $new_data, 201);
        } else {
            response('error', 'Unable to create Mahasiswa', null, 400);
        }
    }

    // Update an existing Mahasiswa
    public function updateMahasiswa($id)
    {
        if (!isset($_POST['nama_mahasiswa']) && !isset($_POST['nim_mahasiswa']) && !isset($_POST['id_jenis_peminjam']) && !isset($_POST['id_struktur_organisasi']) && !isset($_POST['id_ormawa'])) {
            response('error', 'No fields to update', null, 400);
            return;
        }

        $fieldsToUpdate = [];
        $params = [];

        if (isset($_POST['nama_mahasiswa'])) {
            $fieldsToUpdate[] = "nama_mahasiswa = ?";
            $params[] = $_POST['nama_mahasiswa'];
        }
        if (isset($_POST['nim_mahasiswa'])) {  // Added nim_mahasiswa to the update logic
            $fieldsToUpdate[] = "nim_mahasiswa = ?";
            $params[] = $_POST['nim_mahasiswa'];
        }
        if (isset($_POST['id_jenis_peminjam'])) {
            $fieldsToUpdate[] = "id_jenis_peminjam = ?";
            $params[] = $_POST['id_jenis_peminjam'];
        }
        if (isset($_POST['id_struktur_organisasi'])) {
            $fieldsToUpdate[] = "id_struktur_organisasi = ?";
            $params[] = $_POST['id_struktur_organisasi'];
        }
        if (isset($_POST['id_ormawa'])) {
            $fieldsToUpdate[] = "id_ormawa = ?";
            $params[] = $_POST['id_ormawa'];
        }

        $query = "UPDATE mahasiswa SET " . implode(', ', $fieldsToUpdate) . " WHERE id_mahasiswa = ?";
        $params[] = $id;

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute($params)) {
            // Fetch the updated mahasiswa with pembina info
            $result_stmt = $this->conn->prepare("SELECT 
                                                    m.id_mahasiswa, 
                                                    m.nama_mahasiswa, 
                                                    m.nim_mahasiswa,  -- Added nim_mahasiswa
                                                    m.id_jenis_peminjam, 
                                                    m.id_ormawa, 
                                                    o.nama_ormawa, 
                                                    j.nama_jenis_peminjam, 
                                                    s.nama_struktur,
                                                    p.id_pembina,
                                                    p.nama_pembina, 
                                                    p.nip_pembina  -- Added pembina fields
                                                  FROM mahasiswa m
                                                  LEFT JOIN jenis_peminjam j ON m.id_jenis_peminjam = j.id_jenis_peminjam
                                                  LEFT JOIN struktur_organisasi s ON m.id_struktur_organisasi = s.id_struktur_organisasi
                                                  LEFT JOIN ormawa o ON m.id_ormawa = o.id_ormawa
                                                  LEFT JOIN pembina p ON o.id_ormawa = p.id_ormawa
                                                  WHERE m.id_mahasiswa = ?");
            $result_stmt->execute([$id]);
            $updated_data = $result_stmt->fetch(PDO::FETCH_OBJ);

            response('success', 'Mahasiswa Updated Successfully', $updated_data);
        } else {
            response('error', 'Unable to update Mahasiswa', null, 400);
        }
    }

    // Delete a Mahasiswa
    public function deleteMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            response('success', 'Mahasiswa Deleted Successfully');
        } else {
            response('error', 'Unable to delete Mahasiswa', null, 400);
        }
    }
}
