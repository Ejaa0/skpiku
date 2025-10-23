@extends('layouts.dashboard_organisasi')

@section('title', 'Detail Kegiatan')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Judul -->
    <h1 class="text-3xl font-extrabold mb-6 text-gray-800">{{ $kegiatan->nama_kegiatan }}</h1>

    <!-- Info Kegiatan -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- ID Kegiatan -->
        <div class="bg-white p-4 rounded-lg shadow-sm border">
            <p class="text-gray-500 font-semibold">ID Kegiatan</p>
            <p class="text-gray-800">{{ $kegiatan->id_kegiatan }}</p>
        </div>

        <!-- Jenis Kegiatan -->
        <div class="bg-white p-4 rounded-lg shadow-sm border">
            <p class="text-gray-500 font-semibold">Jenis Kegiatan</p>
            @if(strtolower($kegiatan->jenis_kegiatan) === 'major')
                <span class="text-white bg-blue-600 px-2 py-1 rounded-full text-sm font-semibold">Major</span>
            @elseif(strtolower($kegiatan->jenis_kegiatan) === 'reguler')
                <span class="text-white bg-green-600 px-2 py-1 rounded-full text-sm font-semibold">Reguler</span>
            @else
                <span class="text-gray-400 text-sm">-</span>
            @endif
        </div>

        <!-- Nama Kegiatan -->
        <div class="bg-white p-4 rounded-lg shadow-sm border">
            <p class="text-gray-500 font-semibold">Nama Kegiatan</p>
            <p class="text-gray-800">{{ $kegiatan->nama_kegiatan }}</p>
        </div>

        <!-- Tanggal Kegiatan -->
        <div class="bg-white p-4 rounded-lg shadow-sm border">
            <p class="text-gray-500 font-semibold">Tanggal Kegiatan</p>
            <p class="text-gray-800">{{ $kegiatan->tanggal_kegiatan }}</p>
        </div>
    </div>

    <!-- Tombol Tambah Mahasiswa -->
    <a href="{{ route('kegiatan-self.addMahasiswa', $kegiatan->id) }}" 
       class="inline-block bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-200 mb-6">
        Tambah Mahasiswa
    </a>

    <!-- Daftar Mahasiswa -->
    <h2 class="text-2xl font-bold mb-3 text-gray-700">Daftar Mahasiswa</h2>
    <div class="overflow-x-auto bg-white rounded-lg shadow border">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-3 text-gray-600 uppercase text-sm">NIM</th>
                    <th class="border px-4 py-3 text-gray-600 uppercase text-sm">Nama</th>
                    <th class="border px-4 py-3 text-gray-600 uppercase text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatan->detailMahasiswa as $detail)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="border px-4 py-2">{{ $detail->mahasiswa->nim ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $detail->mahasiswa->nama ?? '-' }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('kegiatan-self.destroyMahasiswa', [$kegiatan->id, $detail->mahasiswa->nim]) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded shadow hover:bg-red-700 transition duration-200">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">
                            Belum ada mahasiswa terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Kembali ke daftar -->
    <a href="{{ route('kegiatan-self.index') }}" class="mt-6 inline-block text-blue-600 font-medium hover:underline">
        &larr; Kembali ke daftar kegiatan
    </a>
</div>
@endsection
