@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto mt-8 px-6">
        <h1 class="text-3xl font-extrabold text-blue-600 mb-6">Daftar Poin Mahasiswa</h1>

        <!-- Tombol Tambah di sebelah kiri -->
        <div class="text-left mb-6">
            <a href="{{ route('poin.create') }}" class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-blue-700">
                + Tambah Poin Mahasiswa
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full bg-white table-auto border-collapse">
                <thead class="bg-blue-600 text-white text-sm uppercase">
                    <tr>
                        <th class="py-3 px-4 border-b">NIM</th>
                        <th class="py-3 px-4 border-b">Nama</th>
                        <th class="py-3 px-4 border-b">Nama Kegiatan</th>
                        <th class="py-3 px-4 border-b">Jenis Kegiatan</th>
                        <th class="py-3 px-4 border-b">Tanggal Kegiatan</th>
                        <th class="py-3 px-4 border-b">Poin</th>
                        <th class="py-3 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @foreach($poin as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-4 border-b">{{ $item->nim }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->nama }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->nama_kegiatan }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->jenis_kegiatan }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->tanggal_kegiatan }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->poin }}</td>
                            <td class="py-3 px-4 border-b text-center">
                                <div class="flex justify-center space-x-3">
                                    <!-- Show -->
                                    <a href="{{ route('poin.show', $item->id) }}" class="text-green-600 hover:text-green-800">
                                        <i class="fas fa-eye"></i> Show
                                    </a>
                                    
                                    <!-- Edit -->
                                    <a href="{{ route('poin.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    <!-- Delete -->
                                    <form action="{{ route('poin.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus poin mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if($poin->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-6">Belum ada poin mahasiswa yang tercatat.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
