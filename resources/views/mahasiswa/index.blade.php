@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-8">
    <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-2xl animate-fade-in">
        <h1 class="text-3xl sm:text-4xl font-bold mb-8 text-blue-700 flex items-center gap-3 select-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 sm:h-8 sm:w-8 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Daftar Mahasiswa
        </h1>

        <div class="mb-6 flex flex-wrap gap-4">
            <a href="{{ route('mahasiswa.create') }}" 
               class="inline-block bg-gradient-to-r from-blue-700 to-blue-500 text-white px-6 py-3 rounded-full shadow-md hover:scale-105 transform transition duration-300 select-none whitespace-nowrap">
                + Tambah Mahasiswa
            </a>
        </div>

        {{-- Form Search --}}
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-6 flex flex-col sm:flex-row gap-3 sm:gap-2 items-stretch sm:items-center">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari mahasiswa..."
                class="flex-grow px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button type="submit" 
                class="bg-blue-700 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition select-none whitespace-nowrap">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('mahasiswa.index') }}" 
                   class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 text-gray-600 select-none whitespace-nowrap text-center">
                    Reset
                </a>
            @endif
        </form>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 shadow-md animate-pulse select-none">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl shadow-inner">
            <table class="min-w-full w-full text-sm sm:text-base table-auto border-collapse">
                <thead class="bg-blue-700 text-white uppercase text-xs sm:text-sm tracking-wider select-none">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left whitespace-nowrap">NIM</th>
                        <th class="px-4 sm:px-6 py-3 text-left whitespace-nowrap">Nama</th>
                        <th class="px-4 sm:px-6 py-3 text-left whitespace-nowrap">Tempat Lahir</th>
                        <th class="px-4 sm:px-6 py-3 text-left whitespace-nowrap">Tanggal Lahir</th>
                        <th class="px-4 sm:px-6 py-3 text-left whitespace-nowrap">Jenis Kelamin</th>
                        <th class="px-4 sm:px-6 py-3 text-left whitespace-nowrap">Agama</th>
                        <th class="px-4 sm:px-6 py-3 text-left whitespace-nowrap">Hobi</th>
                        <th class="px-4 sm:px-6 py-3 text-left whitespace-nowrap">Angkatan</th>
                        <th class="px-4 sm:px-6 py-3 text-left whitespace-nowrap">Email</th>
                        <th class="px-4 sm:px-6 py-3 text-center w-44 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-gray-800">
                    @forelse ($mahasiswas as $mahasiswa)
                        <tr class="hover:bg-blue-50 transition duration-200">
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mahasiswa->nim }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mahasiswa->nama }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mahasiswa->temp_lahir }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($mahasiswa->tgl_lahir)->format('d M Y') }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">
                                {{ $mahasiswa->sex === 'L' ? 'Laki-laki' : ($mahasiswa->sex === 'P' ? 'Perempuan' : 'Tidak Diketahui') }}
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mahasiswa->agama }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mahasiswa->hobi }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mahasiswa->angkatan }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap break-words max-w-xs">{{ $mahasiswa->email }}</td>
                            <td class="px-4 sm:px-6 py-3 text-center space-x-2 whitespace-nowrap">
                                <a href="{{ route('mahasiswa.show', $mahasiswa->nim) }}" class="text-blue-600 hover:text-blue-800 transition select-none" title="Lihat">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('mahasiswa.edit', $mahasiswa->nim) }}" class="text-yellow-500 hover:text-yellow-700 transition select-none" title="Edit">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $mahasiswa->nim) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition select-none" title="Hapus">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-6 text-gray-500 select-none">
                                Tidak ada data mahasiswa yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 select-none">
            {{ $mahasiswas->links() }}
        </div>
    </div>
</div>
@endsection
