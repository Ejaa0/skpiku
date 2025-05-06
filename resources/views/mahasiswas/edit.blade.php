{{-- resources/views/mahasiswas/edit.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f5f5f5;">

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Data Mahasiswa</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('mahasiswas.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" value="{{ old('nim', $mahasiswa->nim) }}" required>
                </div>

                <div class="mb-3">
                    <label for="temp_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="temp_lahir" class="form-control" value="{{ old('temp_lahir', $mahasiswa->temp_lahir) }}">
                </div>

                <div class="mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $mahasiswa->tgl_lahir) }}">
                </div>

                <div class="mb-3">
                    <label for="sex" class="form-label">Jenis Kelamin</label>
                    <select name="sex" class="form-control">
                        <option value="L" {{ $mahasiswa->sex == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $mahasiswa->sex == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <input type="text" name="agama" class="form-control" value="{{ old('agama', $mahasiswa->agama) }}">
                </div>

                <div class="mb-3">
                    <label for="hobi" class="form-label">Hobi</label>
                    <input type="text" name="hobi" class="form-control" value="{{ old('hobi', $mahasiswa->hobi) }}">
                </div>

                <div class="mb-3">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <input type="text" name="angkatan" class="form-control" value="{{ old('angkatan', $mahasiswa->angkatan) }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $mahasiswa->email) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('mahasiswas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
