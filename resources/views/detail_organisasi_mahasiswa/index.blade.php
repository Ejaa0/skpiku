@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-green-700 flex items-center">
        <span class="text-4xl mr-2">➕</span>
        Tambah Anggota untuk Organisasi: {{ $organisasi->nama_organisasi }}
    </h1>

    <!-- Search Box -->
    <input type="text" placeholder="Cari mahasiswa berdasarkan NIM atau Nama..."
        class="w-full p-3 mb-4 border rounded-lg shadow-sm focus:ring focus:ring-green-300">

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-4 py-2">NIM</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Jabatan</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $mhs)
                <tr class="border-b">
                    <form action="{{ route('detail-organisasi.store') }}" method="POST" class="flex items-center">
                        @csrf
                        <input type="hidden" name="nim" value="{{ $mhs->nim }}">
                        <input type="hidden" name="organisasi_id" value="{{ $organisasi->id }}">

                        <!-- NIM -->
                        <td class="px-4 py-2">{{ $mhs->nim }}</td>

                        <!-- Nama -->
                        <td class="px-4 py-2">{{ $mhs->nama }}</td>

                        <!-- Jabatan -->
                        <td class="px-4 py-2">
                            <select name="jabatan" 
                                class="jabatan-select border rounded-lg p-2 w-40"
                                onchange="toggleInput(this)">
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="Ketua">Ketua</option>
                                <option value="Wakil Ketua">Wakil Ketua</option>
                                <option value="Sekretaris">Sekretaris</option>
                                <option value="Bendahara">Bendahara</option>
                                <option value="Anggota">Anggota</option>
                                <option value="Lainnya">+ Lainnya</option>
                            </select>
                            <!-- Input text tambahan, default hidden -->
                            <input type="text" name="jabatan_baru" 
                                placeholder="Masukkan jabatan baru"
                                class="jabatan-input border rounded-lg p-2 mt-2 hidden w-40">
                        </td>

                        <!-- Status -->
                        <td class="px-4 py-2">
                            <select name="status" class="border rounded-lg p-2">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </td>

                        <!-- Tombol -->
                        <td class="px-4 py-2">
                            <button type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                Tambah
                            </button>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('organisasi.show', $organisasi->id) }}"
        class="mt-6 inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
        ← Kembali ke Detail Organisasi
    </a>
</div>

<script>
function toggleInput(select) {
    let input = select.parentElement.querySelector('.jabatan-input');
    if (select.value === "Lainnya") {
        input.classList.remove('hidden');
        input.required = true;
    } else {
        input.classList.add('hidden');
        input.required = false;
        input.value = ""; // reset kalau user ganti lagi
    }
}
</script>
@endsection
