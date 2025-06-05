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

        <div class="mb-6 flex flex-wrap gap-4">
            <a href="{{ route('mahasiswa.create') }}" class="inline-block bg-gradient-to-r from-blue-700 to-blue-500 text-white px-6 py-3 rounded-full shadow-md hover:scale-105 transform transition duration-300">
                + Tambah Mahasiswa
            </a>
        </div>

        {{-- Form Search --}}
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-6 flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari mahasiswa..."
                class="flex-grow px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 text-gray-600">
                    Reset
                </a>
            @endif
        </form>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 shadow-md animate-pulse">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl shadow-inner">
            <table class="min-w-full w-full text-sm">
                <thead class="bg-blue-700 text-white uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">NIM</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Tempat Lahir</th>
                        <th class="px-6 py-3 text-left">Tanggal Lahir</th>
                        <th class="px-6 py-3 text-left">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left">Agama</th>
                        <th class="px-6 py-3 text-left">Hobi</th>
                        <th class="px-6 py-3 text-left">Angkatan</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-center w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-gray-800">
                    @forelse ($mahasiswas as $mahasiswa)
                        <tr class="hover:bg-blue-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->nim }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->temp_lahir }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->tgl_lahir }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $mahasiswa->sex === 'L' ? 'Laki-laki' : ($mahasiswa->sex === 'P' ? 'Perempuan' : 'Tidak Diketahui') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->agama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->hobi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->angkatan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center space-x-3">
                                <a href="{{ route('mahasiswa.show', $mahasiswa->nim) }}" class="text-blue-600 hover:text-blue-800 transition" title="Lihat">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('mahasiswa.edit', $mahasiswa->nim) }}" class="text-yellow-500 hover:text-yellow-700 transition" title="Edit">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $mahasiswa->nim) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Hapus">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-6 text-gray-500">
                                Tidak ada data mahasiswa yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $mahasiswas->links() }}
        </div>
    </div>
</div>
@endsection
