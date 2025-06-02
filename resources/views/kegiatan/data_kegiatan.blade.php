<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-3xl font-bold mb-6">Data Kegiatan</h1>

    <form method="GET" action="{{ route('mahasiswa.data_kegiatan') }}" class="mb-6">
        <input
            type="text"
            name="search"
            placeholder="Cari berdasarkan NIM, Nama, Jenis Kegiatan, Nama Kegiatan..."
            value="{{ $search }}"
            class="border border-gray-300 rounded px-3 py-2 w-96"
        >
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Cari</button>
    </form>

    @if ($kegiatan->count() > 0)
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">NIM</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">ID Kegiatan</th>
                    <th class="py-2 px-4 border-b">Jenis Kegiatan</th>
                    <th class="py-2 px-4 border-b">Nama Kegiatan</th>
                    <th class="py-2 px-4 border-b">Tanggal Kegiatan</th>
                    <th class="py-2 px-4 border-b">Absensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kegiatan as $item)
                    <tr class="text-center border-b">
                        <td class="py-2 px-4">{{ $item->nim }}</td>
                        <td class="py-2 px-4">{{ $item->nama }}</td>
                        <td class="py-2 px-4">{{ $item->id_kegiatan }}</td>
                        <td class="py-2 px-4">{{ $item->jenis_kegiatan }}</td>
                        <td class="py-2 px-4">{{ $item->nama_kegiatan }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d-m-Y') }}</td>
                        <td class="py-2 px-4">{{ $item->absensi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $kegiatan->links() }}
        </div>
    @else
        <p>Tidak ada data kegiatan ditemukan.</p>
    @endif

</body>
</html>
