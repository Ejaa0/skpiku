<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Organisasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Organisasi</h1>

        <a href="{{ route('organisasi.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Tambah Organisasi</a>

        <table class="min-w-full border border-gray-300 text-left text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border">NIM</th>
                    <th class="py-2 px-4 border">Nama Kegiatan</th>
                    <th class="py-2 px-4 border">Absensi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($organisasi as $org)
                <tr class="border-t">
                    <td class="py-2 px-4 border">{{ $org->nim }}</td>
                    <td class="py-2 px-4 border">{{ $org->nama_kegiatan }}</td>
                    <td class="py-2 px-4 border">{{ $org->absensi }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
