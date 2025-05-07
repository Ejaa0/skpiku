@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-blue-600">Daftar Mahasiswa</h1>

    <a href="{{ route('mahasiswa.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-600">+ Tambah Mahasiswa</a>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="border px-4 py-2">NIM</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Tempat Lahir</th>
                <th class="border px-4 py-2">Tanggal Lahir</th>
                <th class="border px-4 py-2">Jenis Kelamin</th>
                <th class="border px-4 py-2">Agama</th>
                <th class="border px-4 py-2">Hobi</th>
                <th class="border px-4 py-2">Angkatan</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $mahasiswa)
                <tr>
                    <td class="border px-4 py-2">{{ $mahasiswa->nim }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->nama }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->temp_lahir }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->tgl_lahir }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->sex == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->agama }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->hobi }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->angkatan }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->email }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <!-- Tombol Lihat -->
                        <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="text-blue-600 hover:underline">Lihat</a>

                        <!-- Tombol Edit -->
                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="text-yellow-500 hover:underline">Edit</a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
