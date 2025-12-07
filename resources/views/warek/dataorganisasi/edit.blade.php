@extends('layouts.dashboard_warek_utama')

@section('title', 'Edit Anggota Organisasi')

@section('content')
<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">
        ✏️ Edit Anggota Organisasi
    </h1>

    {{-- Alert Success jika ada --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-500 text-white rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM EDIT --}}
    <form action="{{ route('warek.dataorganisasi.anggota.update', $detail->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- NIM --}}
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">NIM</label>
            <input type="text" value="{{ $detail->nim }}" class="w-full p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300" readonly>
        </div>

        {{-- NAMA --}}
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Nama Mahasiswa</label>
            <input type="text" value="{{ $detail->nama }}" class="w-full p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300" readonly>
        </div>

        {{-- JABATAN --}}
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Jabatan</label>

            <select name="jabatan" id="jabatanSelect"
                class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200"
                onchange="toggleCustomJabatan()">

                <option value="Ketua" {{ $detail->jabatan == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                <option value="Wakil Ketua" {{ $detail->jabatan == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                <option value="Sekretaris" {{ $detail->jabatan == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                <option value="Bendahara" {{ $detail->jabatan == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                <option value="Anggota" {{ $detail->jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                <option value="lainnya" {{ !in_array($detail->jabatan, ['Ketua','Wakil Ketua','Sekretaris','Bendahara','Anggota']) ? 'selected' : '' }}>
                    Lainnya
                </option>
            </select>
        </div>

        {{-- INPUT JABATAN CUSTOM --}}
        <div class="mb-4" id="customJabatanWrapper"
            style="{{ !in_array($detail->jabatan, ['Ketua','Wakil Ketua','Sekretaris','Bendahara','Anggota']) ? '' : 'display:none;' }}">

            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Jabatan Lainnya</label>

            <input type="text"
                name="jabatan_custom"
                id="jabatanCustom"
                value="{{ !in_array($detail->jabatan, ['Ketua','Wakil Ketua','Sekretaris','Bendahara','Anggota']) ? $detail->jabatan : '' }}"
                class="w-full p-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
                placeholder="Masukkan jabatan lainnya...">
        </div>

        {{-- STATUS --}}
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Status Keanggotaan</label>

            <select name="status_keanggotaan"
                class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200">

                <option value="aktif" {{ $detail->status_keanggotaan == 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="nonaktif" {{ $detail->status_keanggotaan == 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('warek.dataorganisasi.show', $detail->id_organisasi) }}"
               class="px-4 py-2 bg-gray-500 hover:bg-gray-400 text-white rounded-lg">
                Kembali
            </a>

            <button type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>

{{-- SCRIPT UNTUK MENAMPILKAN INPUT CUSTOM --}}
<script>
    function toggleCustomJabatan() {
        const select = document.getElementById('jabatanSelect');
        const wrapper = document.getElementById('customJabatanWrapper');

        if (select.value === 'lainnya') {
            wrapper.style.display = 'block';
        } else {
            wrapper.style.display = 'none';
        }
    }
</script>

@endsection
