<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman</title>
</head>
<body>
    <h2>Form Peminjaman</h2>
    <form action="http://localhost/sipinjamfix/sipinjam/api/peminjaman" method="POST" enctype="multipart/form-data">
        <div>
            <label for="nama_kegiatan">Nama Kegiatan:</label>
            <input type="text" id="nama_kegiatan" name="nama_kegiatan" required>
        </div>

        <div>
            <label for="tema_kegiatan">Tema Kegiatan:</label>
            <input type="text" id="tema_kegiatan" name="tema_kegiatan" required>
        </div>

        <div>
            <label for="tanggal_kegiatan">Tanggal Kegiatan:</label>
            <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" required>
        </div>

        <div>
            <label for="waktu_mulai">Waktu Mulai:</label>
            <input type="time" id="waktu_mulai" name="waktu_mulai" required>
        </div>

        <div>
            <label for="waktu_selesai">Waktu Selesai:</label>
            <input type="time" id="waktu_selesai" name="waktu_selesai" required>
        </div>

        <div>
            <label for="nama_mahasiswa_organisasi">Nama Mahasiswa Organisasi:</label>
            <input type="text" id="nama_mahasiswa_organisasi" name="nama_mahasiswa_organisasi" required>
        </div>

        <div>
            <label for="nama_mahasiswa_peminjam">Nama Mahasiswa Peminjam:</label>
            <input type="text" id="nama_mahasiswa_peminjam" name="nama_mahasiswa_peminjam" required>
        </div>

        <div>
            <label for="nama_ruangan">Nama Ruangan:</label>
            <input type="text" id="nama_ruangan" name="nama_ruangan" required>
        </div>

        <div>
            <label for="nama_peminjam">Nama Peminjam:</label>
            <input type="text" id="nama_peminjam" name="nama_peminjam" required>
        </div>

        <div>
            <label for="daftar_panitia">Daftar Panitia:</label>
            <input type="file" id="daftar_panitia" name="daftar_panitia" required>
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
