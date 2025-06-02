@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-6">
    <h2 class="text-2xl font-bold mb-6 text-yellow-600">
        🔍 Cari Mahasiswa untuk Kegiatan: <span class="text-gray-800">{{ $kegiatan->nama_kegiatan }}</span>
    </h2>

    {{-- FORM SEARCH --}}
    <form method="GET" action="{{ route('kegiatan.tambahMahasiswaForm', $kegiatan->id_kegiatan) }}" class="mb-6">
        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari berdasarkan NIM atau Nama"
               class="w-full px-4 py-2 border border-yellow-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </form>

    {{-- LIST MAHASISWA --}}
    @if($mahasiswa->isEmpty())
        <p class="text-gray-500">Tidak ada mahasiswa ditemukan.</p>
    @else
        <table class="w-full table-auto bg-white rounded shadow overflow-hidden">
            <thead class="bg-yellow-100 text-yellow-700">
                <tr>
                    <th class="px-4 py-2 border">NIM</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $mhs)
                    <tr class="hover:bg-yellow-50">
                        <td class="px-4 py-2 border">{{ $mhs->nim }}</td>
                        <td class="px-4 py-2 border">{{ $mhs->nama }}</td>
                        <td class="px-4 py-2 border">
                            <form method="POST" action="{{ route('kegiatan.storeMahasiswa', ['id_kegiatan' => $kegiatan->id_kegiatan]) }}" onsubmit="return confirmTambahMahasiswa();">
                                @csrf
                                <input type="hidden" name="nim" value="{{ $mhs->nim }}">
                                <button type="submit" class="text-green-600 hover:text-green-800 font-semibold">➕ Tambah</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $mahasiswa->appends(['cari' => request('cari')])->links() }}
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('kegiatan.show', $kegiatan->id_kegiatan) }}" class="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">← Kembali</a>
    </div>
</div>

<script>
function confirmTambahMahasiswa() {
    return confirm('Apakah kamu akan menambahkan mahasiswa ini?');
}
</script>
@endsection
