@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-6">
    <div class="bg-white p-6 rounded-lg shadow-2xl transition-all duration-500">
        <h2 class="text-4xl font-extrabold text-blue-600 mb-6 border-b pb-2 flex items-center gap-3 animate__animated animate__fadeIn">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Daftar Kegiatan
        </h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded mb-4 animate__animated animate__fadeIn">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tombol tambah kegiatan kiri dan responsif --}}
        <div class="flex flex-col md:flex-row md:justify-start mb-4">
            <a href="{{ route('kegiatan.create') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold px-5 py-2 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl w-full md:w-auto text-center">
                + Tambah Kegiatan
            </a>
        </div>

        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="min-w-full table-auto border-separate border-spacing-0">
                {{-- Header tabel disesuaikan dengan warna sidebar --}}
                <thead class="bg-blue-600 text-white text-sm uppercase tracking-wider">
                    <tr class="text-left">
                        <th class="px-4 py-3 border-b font-semibold">No</th>
                        <th class="px-4 py-3 border-b font-semibold">Nama Kegiatan</th>
                        <th class="px-4 py-3 border-b font-semibold">Tanggal</th>
                        <th class="px-4 py-3 border-b text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                {{-- Isi tabel --}}
                <tbody class="text-sm text-gray-800 bg-white">
                    @foreach($kegiatan as $item)
                        <tr class="hover:bg-blue-50 transition-all duration-300">
                            <td class="border-b px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="border-b px-4 py-3">{{ $item->nama_kegiatan }}</td>
                            <td class="border-b px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d F Y') }}</td>
                            <td class="border-b px-4 py-3 text-center space-x-3">
                                <a href="{{ route('kegiatan.show', $item->id) }}" class="text-green-600 hover:text-green-700 transition duration-200" title="Lihat">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('kegiatan.edit', $item->id) }}" class="text-blue-600 hover:text-blue-700 transition duration-200" title="Edit">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 transition duration-200" title="Hapus">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($kegiatan->isEmpty())
                        <tr class="text-center">
                            <td colspan="4" class="text-gray-500 py-6">Belum ada kegiatan yang tercatat.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
