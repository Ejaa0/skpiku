{{-- resources/views/mahasiswas/show.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f5f5f5;">

<div class="container mt-5">
    <h2 class="text-center mb-4">Detail Mahasiswa</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                
                <tr>
                    <th>NIM</th>
                    <td>{{ $mahasiswa->nim }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $mahasiswa->temp_lahir }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $mahasiswa->tgl_lahir }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $mahasiswa->sex }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>{{ $mahasiswa->agama }}</td>
                </tr>
                <tr>
                    <th>Hobi</th>
                    <td>{{ $mahasiswa->hobi }}</td>
                </tr>
                <tr>
                    <th>Angkatan</th>
                    <td>{{ $mahasiswa->angkatan }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $mahasiswa->email }}</td>
                </tr>
            </table>

            <a href="{{ route('mahasiswas.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
