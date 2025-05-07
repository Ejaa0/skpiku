<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Organisasi</title>
</head>
<body>
    <h1>Tambah Data Organisasi</h1>

    <form method="POST" action="{{ route('organisasi.store') }}">
        @csrf

        <label>NIM:</label>
        <input type="text" name="nim" required><br><br>

        <label>ID Kegiatan:</label>
        <input type="number" name="id_kegiatan" required><br><br>

        <label>Nama Kegiatan:</label>
        <input type="text" name="nama_kegiatan" required><br><br>

        <label>Absensi:</label>
        <input type="text" name="absensi" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
