@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-xl sm:text-2xl font-bold mb-6 text-green-600">
        🔍 Cari Mahasiswa untuk Organisasi: <span class="text-gray-800">{{ $nama_organisasi }}</span>
    </h2>

    {{-- FORM SEARCH --}}
    <form method="GET" action="{{ route('detail_organisasi_mahasiswa.create', ['id_organisasi' => $id_organisasi]) }}" class="mb-6">
        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari berdasarkan NIM atau Nama"
               class="w-full px-4 py-2 border border-green-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition">
    </form>

    {{-- LIST MAHASISWA --}}
    @if(isset($mahasiswa) && $mahasiswa->isEmpty())
        <p class="text-gray-500">🙁 Tidak ada mahasiswa ditemukan.</p>
    @elseif(isset($mahasiswa))
        <div class="overflow-x-auto bg-white rounded-lg shadow ring-1 ring-gray-200">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-green-500 text-white uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">NIM</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($mahasiswa as $mhs)
                        <tr class="hover:bg-green-50 transition">
                            <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->nim }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->nama }}</td>
                            <td class="px-6 py-3 text-center">
                                <form method="POST" action="{{ route('detail_organisasi_mahasiswa.store') }}"
                                      onsubmit="return confirmTambahMahasiswa();">
                                    @csrf
                                    <input type="hidden" name="mahasiswa_nim" value="{{ $mhs->nim }}">
                                    <input type="hidden" name="nama" value="{{ $mhs->nama }}">
                                    <input type="hidden" name="id_organisasi" value="{{ $id_organisasi }}">
                                    <input type="hidden" name="nama_organisasi" value="{{ $nama_organisasi }}">
                                    <button type="submit" class="inline-flex items-center text-green-600 hover:text-green-800 font-semibold transition">
                                        ➕ Tambah
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $mahasiswa->appends(['cari' => request('cari')])->links() }}
        </div>
    @endif

    {{-- TOMBOL KEMBALI --}}
    <div class="mt-8">
        <a href="{{ route('detail_organisasi_mahasiswa.index') }}"
           class="inline-block text-sm bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            ← Kembali ke Daftar Anggota Organisasi
        </a>
    </div>
</div>

<script>
function confirmTambahMahasiswa() {
    return confirm('Apakah kamu akan menambahkan mahasiswa ini ke organisasi?');
}
</script>
@endsection
