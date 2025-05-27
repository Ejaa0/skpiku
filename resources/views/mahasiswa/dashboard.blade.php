<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Dashboard Mahasiswa</h2>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <form action="{{ route('mahasiswa.dashboard') }}" method="GET" class="row g-3 mt-3 mb-4">
        <div class="col-auto">
            <input type="text" name="search" class="form-control" placeholder="Cari NIM..." value="{{ request('search') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Angkatan</th>
        </tr>
        </thead>
        <tbody>
        @forelse($mahasiswas as $mhs)
            <tr>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->email }}</td>
                <td>{{ $mhs->angkatan }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Data tidak ditemukan.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
