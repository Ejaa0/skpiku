@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-8">
    <div class="bg-white p-8 rounded-3xl shadow-2xl animate__animated animate__fadeIn">
        <h1 class="text-4xl font-bold mb-8 text-blue-700 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Daftar Mahasiswa
        </h1>

        <a href="{{ route('mahasiswa.create') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-3 rounded-full shadow-md hover:scale-105 transform transition duration-300 mb-6">
            + Tambah Mahasiswa
        </a>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 shadow-md animate-pulse">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl shadow-inner">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Tempat Lahir</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Tanggal Lahir</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Agama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Hobi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Angkatan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($mahasiswas as $mahasiswa)
                        <tr class="hover:bg-blue-50 transition duration-300 ease-in-out transform hover:scale-[1.01]">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->nim }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->temp_lahir }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->tgl_lahir }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->sex == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->agama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->hobi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->angkatan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mahasiswa->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm flex gap-3 items-center">
                                <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="text-blue-500 hover:text-blue-700 transition">
                                    Lihat
                                </a>
                                <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="text-yellow-500 hover:text-yellow-700 transition">
                                    Edit
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
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
</div>
@endsection
