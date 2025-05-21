<!DOCTYPE html>
<html>
<head>
    <title>SKPI PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Surat Keterangan Pendamping Ijazah</h2>
    <p><strong>Nama:</strong> {{ $skpi->nama }}</p>
    <p><strong>Tempat, Tanggal Lahir:</strong> {{ $skpi->ttl }}</p>
    <p><strong>NIM:</strong> {{ $skpi->nim }}</p>
    <p><strong>Tahun Masuk:</strong> {{ $skpi->masuk }}</p>
    <p><strong>Tahun Lulus:</strong> {{ $skpi->lulus }}</p>
    <p><strong>No Ijazah:</strong> {{ $skpi->no_ijazah }}</p>
    <p><strong>Gelar:</strong> {{ $skpi->gelar }}</p>
    <p><strong>Program Studi:</strong> {{ $skpi->prodi }}</p>
    <p><strong>Bahasa:</strong> {{ $skpi->bahasa }}</p>
    <p><strong>Jenjang Pendidikan:</strong> {{ $skpi->jenjang }}</p>
    <p><strong>Karakter Mahasiswa:</strong> {{ $skpi->karakter }}</p>
    <p><strong>Tanggal Surat:</strong> {{ $skpi->tanggal_surat }}</p>
</body>
</html>
