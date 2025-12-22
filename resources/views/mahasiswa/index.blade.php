@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-8">

    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-md animate-fade-in">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-blue-700 select-none">
            Daftar Mahasiswa
        </h1>

        {{-- Tombol Tambah --}}
        <div class="mb-4 flex flex-wrap gap-2">
            <a href="{{ route('mahasiswa.create') }}" 
               class="inline-block bg-blue-600 text-white px-4 py-2 rounded-full shadow-sm hover:bg-blue-500 transition select-none text-sm">
                + Tambah Mahasiswa
            </a>
        </div>

        {{-- Search --}}
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-4 flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mahasiswa..."
                   class="flex-grow px-3 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition text-sm">Cari</button>
            @if(request('search'))
                <a href="{{ route('mahasiswa.index') }}" 
                   class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 text-gray-600 text-sm select-none text-center">
                    Reset
                </a>
            @endif
        </form>

        {{-- Pesan awal --}}
        @if(!request('search'))
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg text-yellow-700 text-center text-sm shadow-sm select-none">
            Silakan cari mahasiswa berdasarkan <strong>NIM</strong> atau <strong>Nama</strong>.
        </div>
        @endif

        {{-- Tabel --}}
        @if(request('search') && $mahasiswas->count() > 0)
        <div class="overflow-x-auto rounded-lg shadow-inner mt-3">
            <table class="min-w-full text-sm table-auto border-collapse">
                <thead class="bg-blue-600 text-white text-xs uppercase select-none">
                    <tr>
                        <th class="px-2 py-2 text-left">NIM</th>
                        <th class="px-2 py-2 text-left">Nama</th>
                        <th class="px-2 py-2 text-left">Tempat Lahir</th>
                        <th class="px-2 py-2 text-left">Tgl Lahir</th>
                        <th class="px-2 py-2 text-left">JK</th>
                        <th class="px-2 py-2 text-left">Agama</th>
                        <th class="px-2 py-2 text-left">Hobi</th>
                        <th class="px-2 py-2 text-left">Angkatan</th>
                        <th class="px-2 py-2 text-left max-w-[150px]">Email</th>
                        <th class="px-2 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-gray-800 text-xs">
                    @foreach ($mahasiswas as $mahasiswa)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-2 py-1">{{ $mahasiswa->nim }}</td>
                            <td class="px-2 py-1">{{ $mahasiswa->nama }}</td>
                            <td class="px-2 py-1">{{ $mahasiswa->temp_lahir }}</td>
                            <td class="px-2 py-1">{{ \Carbon\Carbon::parse($mahasiswa->tgl_lahir)->format('d M Y') }}</td>
                            <td class="px-2 py-1">{{ $mahasiswa->sex === 'L' ? 'L' : 'P' }}</td>
                            <td class="px-2 py-1">{{ $mahasiswa->agama }}</td>
                            <td class="px-2 py-1">{{ Str::limit($mahasiswa->hobi, 15) }}</td>
                            <td class="px-2 py-1">{{ $mahasiswa->angkatan }}</td>
                            <td class="px-2 py-1 max-w-[150px] truncate">{{ $mahasiswa->email }}</td>
                            <td class="px-2 py-1 text-center flex flex-col gap-1">
                                <a href="{{ route('mahasiswa.show', $mahasiswa) }}" class="text-blue-600 hover:text-blue-800 text-xs">Lihat</a>
                                <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="text-yellow-500 hover:text-yellow-700 text-xs">Edit</a>
                                {{-- Modal Hapus --}}
                                <div x-data="{ open: false, confirmed: false }">
                                    <button @click="open = true" class="text-red-500 hover:text-red-700 text-xs">Hapus</button>
                                    <div x-show="open" x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                        <div @click.away="open = false" class="bg-white rounded-lg p-4 max-w-sm w-full space-y-4 shadow-lg">
                                            <h2 class="text-red-600 font-bold text-lg">Konfirmasi Hapus</h2>
                                            <p class="text-gray-700 text-sm">Menghapus mahasiswa ini juga akan menghapus semua data terkait. Yakin?</p>
                                            <label class="flex items-center gap-2 text-sm">
                                                <input type="checkbox" x-model="confirmed" class="form-checkbox h-4 w-4 text-red-600">
                                                Saya yakin ingin menghapus
                                            </label>
                                            <div class="flex justify-end gap-2 mt-2">
                                                <button @click="open = false" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 text-xs">Batal</button>
                                                <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            :disabled="!confirmed"
                                                            :class="confirmed ? 'bg-red-500 hover:bg-red-600 text-white' : 'bg-gray-300 text-gray-500 cursor-not-allowed'"
                                                            class="px-3 py-1 rounded text-xs">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4 text-sm">
                {{ $mahasiswas->links() }}
            </div>
        </div>

        {{-- Pesan tidak ada hasil --}}
        @elseif(request('search') && $mahasiswas->count() === 0)
        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg text-red-700 text-center text-sm shadow-sm select-none mt-4">
            Tidak ada mahasiswa yang cocok dengan: <strong>{{ request('search') }}</strong>
        </div>
        @endif

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
