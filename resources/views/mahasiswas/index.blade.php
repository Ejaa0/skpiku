@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Daftar Mahasiswa</h1>
                <a href="{{ route('mahasiswa.create') }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Tambah Mahasiswa
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">NIM</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">TTL</th>
                            <th class="px-4 py-2 border">JK</th>
                            <th class="px-4 py-2 border">Agama</th>
                            <th class="px-4 py-2 border">Hobi</th>
                            <th class="px-4 py-2 border">Angkatan</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswas as $mahasiswa)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $mahasiswa->nim }}</td>
                                <td class="px-4 py-2 border">{{ $mahasiswa->nama }}</td>
                                <td class="px-4 py-2 border">{{ $mahasiswa->temp_lahir }}, {{ $mahasiswa->tgl_lahir }}</td>
                                <td class="px-4 py-2 border">{{ $mahasiswa->sex === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td class="px-4 py-2 border">{{ $mahasiswa->agama }}</td>
                                <td class="px-4 py-2 border">{{ $mahasiswa->hobi }}</td>
                                <td class="px-4 py-2 border">{{ $mahasiswa->angkatan }}</td>
                                <td class="px-4 py-2 border">{{ $mahasiswa->email }}</td>
                                <td class="px-4 py-2 border">
                                    <div class="flex gap-2">
                                        <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}"
                                            class="text-blue-600 hover:underline">Lihat</a>
                                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}"
                                            class="text-yellow-500 hover:underline">Edit</a>
                                        <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center px-4 py-2 border text-gray-500">Belum ada data
                                    mahasiswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
