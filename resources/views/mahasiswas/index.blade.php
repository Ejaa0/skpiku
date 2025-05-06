<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f5f5f5;">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Data Mahasiswa</h2>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('mahasiswas.create') }}" class="btn btn-success">Tambah Mahasiswa</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            
                            <th>NIM</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Hobi</th>
                            <th>Angkatan</th>
                            <th>Email</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswas as $data)
                            <tr>
                                <td>{{ $data->nim }}</td>
                                <td>{{ $data->temp_lahir }}</td>
                                <td>{{ $data->tgl_lahir }}</td>
                                <td>{{ $data->sex }}</td>
                                <td>{{ $data->agama }}</td>
                                <td>{{ $data->hobi }}</td>
                                <td>{{ $data->angkatan }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <form onsubmit="return confirm('Yakin hapus data ini?');" action="{{ route('mahasiswas.destroy', $data->id) }}" method="POST">
                                        <a href="{{ route('mahasiswas.show', $data->id) }}" class="btn btn-sm btn-info">Show</a>
                                        <a href="{{ route('mahasiswas.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-danger">Data mahasiswa belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $mahasiswas->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
