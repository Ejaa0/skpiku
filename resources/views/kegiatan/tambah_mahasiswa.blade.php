@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-xl sm:text-2xl font-bold mb-6 text-yellow-600">
        🔍 Cari Mahasiswa untuk Kegiatan: <span class="text-gray-800">{{ $kegiatan->nama_kegiatan }}</span>
    </h2>

```
{{-- FORM SEARCH --}}
<form method="GET" action="{{ route('kegiatan.tambahMahasiswaForm', ['id' => $kegiatan->id]) }}" class="mb-6">
    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari berdasarkan NIM atau Nama"
           class="w-full px-4 py-2 border border-yellow-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition">
</form>

{{-- LIST MAHASISWA --}}
@if($mahasiswa->isEmpty())
    <p class="text-gray-500">🙁 Tidak ada mahasiswa ditemukan.</p>
@else
    <div class="overflow-x-auto bg-white rounded-lg shadow ring-1 ring-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-yellow-500 text-white uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">NIM</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($mahasiswa as $mhs)
                    <tr class="hover:bg-yellow-50 transition">
                        <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->nim }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $mhs->nama }}</td>
                        <td class="px-6 py-3 text-center">
                            <form method="POST" action="{{ route('kegiatan.storeMahasiswa', ['id' => $kegiatan->id]) }}"
                                  onsubmit="return confirmTambahMahasiswa();">
                                @csrf
                                <input type="hidden" name="nim" value="{{ $mhs->nim }}">
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
    <a href="{{ route('kegiatan.show', ['kegiatan' => $kegiatan->id]) }}"
       class="inline-block text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        ← Kembali ke Detail Kegiatan
    </a>
</div>
```

</div>

<script>
function confirmTambahMahasiswa() {
    return confirm('Apakah kamu akan menambahkan mahasiswa ini?');
}
</script>

@endsection
