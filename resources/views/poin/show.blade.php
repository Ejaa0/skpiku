@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <h2 class="text-3xl font-extrabold text-blue-600 mb-6">Detail Poin Mahasiswa 🎓</h2>

    <div class="bg-white rounded-lg shadow-lg p-6 space-y-4">
        <p><strong class="text-lg">ID Kegiatan 🆔:</strong> <span class="text-gray-800">{{ $kegiatan->id_kegiatan }}</span></p>
        <p><strong class="text-lg">Nama Kegiatan 📝:</strong> <span class="text-gray-800">{{ $kegiatan->nama_kegiatan }}</span></p>
        <p><strong class="text-lg">Jenis Kegiatan 📚:</strong> <span class="text-gray-800">{{ $kegiatan->jenis_kegiatan }}</span></p>
        <p><strong class="text-lg">Tanggal Kegiatan 📅:</strong> <span class="text-gray-800">{{ $kegiatan->tanggal_kegiatan }}</span></p>
    </div>

    <div class="mt-10">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Mahasiswa Peserta 👥</h3>

        <div class="bg-white rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2 border-b">NIM</th>
                        <th class="px-4 py-2 border-b">Nama</th>
                        <th class="px-4 py-2 border-b">Aksi</th> <!-- Kolom aksi untuk tombol hapus -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $mhs)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $mhs->nim }}</td>
                            <td class="px-4 py-2 border-b">{{ $mhs->nama }}</td>
                            <td class="px-4 py-2 border-b">
                                <form action="{{ route('kegiatan.hapusMahasiswa', [$kegiatan->id_kegiatan, $mhs->nim]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini dari kegiatan?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 flex items-center gap-1">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">
                                Belum ada mahasiswa yang mengikuti kegiatan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('kegiatan.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out">
            🔙 Kembali ke Daftar Kegiatan
        </a>
    </div>
</div>
@endsection
