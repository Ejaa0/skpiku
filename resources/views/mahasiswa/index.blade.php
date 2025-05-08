@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-blue-600">Daftar Mahasiswa</h1>

    <a href="{{ route('mahasiswa.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-full mb-6 inline-block hover:bg-blue-700 transition duration-300 transform hover:scale-105">
        + Tambah Mahasiswa
    </a>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6 shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-blue-50 text-left text-sm font-medium text-blue-700">
                    <th class="px-6 py-4 border-b">NIM</th>
                    <th class="px-6 py-4 border-b">Nama</th>
                    <th class="px-6 py-4 border-b">Tempat Lahir</th>
                    <th class="px-6 py-4 border-b">Tanggal Lahir</th>
                    <th class="px-6 py-4 border-b">Jenis Kelamin</th>
                    <th class="px-6 py-4 border-b">Agama</th>
                    <th class="px-6 py-4 border-b">Hobi</th>
                    <th class="px-6 py-4 border-b">Angkatan</th>
                    <th class="px-6 py-4 border-b">Email</th>
                    <th class="px-6 py-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                    <tr class="hover:bg-gray-100 transition-all duration-300">
                        <td class="px-6 py-4 border-b">{{ $mahasiswa->nim }}</td>
                        <td class="px-6 py-4 border-b">{{ $mahasiswa->nama }}</td>
                        <td class="px-6 py-4 border-b">{{ $mahasiswa->temp_lahir }}</td>
                        <td class="px-6 py-4 border-b">{{ $mahasiswa->tgl_lahir }}</td>
                        <td class="px-6 py-4 border-b">{{ $mahasiswa->sex == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-6 py-4 border-b">{{ $mahasiswa->agama }}</td>
                        <td class="px-6 py-4 border-b">{{ $mahasiswa->hobi }}</td>
                        <td class="px-6 py-4 border-b">{{ $mahasiswa->angkatan }}</td>
                        <td class="px-6 py-4 border-b">{{ $mahasiswa->email }}</td>
                        <td class="px-6 py-4 border-b flex gap-3">
                            <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-300">
                                Lihat
                            </a>
                            <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="text-yellow-500 hover:text-yellow-700 transition duration-300">
                                Edit
                            </a>
                            <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition duration-300">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
