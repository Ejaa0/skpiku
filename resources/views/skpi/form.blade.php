<!DOCTYPE html>
<html>
<head>
    <title>Form SKPI</title>
</head>
<body>
    <h1>Form SKPI</h1>
    <form action="{{ url('/skpi/generate') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama" required><br>
        <input type="text" name="ttl" placeholder="Tempat, Tanggal Lahir" required><br>
        <input type="text" name="nim" placeholder="NIM" required><br>
        <input type="text" name="masuk" placeholder="Tahun Masuk" required><br>
        <input type="text" name="lulus" placeholder="Tahun Lulus" required><br>
        <input type="text" name="no_ijazah" placeholder="No Ijazah" required><br>
        <input type="text" name="gelar" placeholder="Gelar" required><br>
        <input type="text" name="prodi" placeholder="Program Studi" required><br>
        <input type="text" name="bahasa" placeholder="Bahasa" required><br>
        <input type="text" name="jenjang" placeholder="Jenjang Pendidikan" required><br>
        <input type="text" name="karakter" placeholder="Karakter" required><br>
        <input type="date" name="tanggal_surat" required><br>
        <button type="submit">Generate SKPI (PDF)</button>
    </form>
</body>
</html>
