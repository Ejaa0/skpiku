@extends('layouts.dashboard_warek_utama')

@section('title', 'Tambah Anggota Organisasi')

@section('content')
<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">➕ Tambah Anggota</h1>

    {{-- FORM ACTION HARUS MENGIRIM PARAMETER id_organisasi --}}
    <form action="{{ route('warek.dataorganisasi.anggota.store', $organisasi->id_organisasi) }}" method="POST">
        @csrf

        <input type="hidden" name="id_organisasi" value="{{ $organisasi->id_organisasi }}">

        {{-- PILIH MAHASISWA --}}
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">Pilih Mahasiswa</label>
            <select name="nim" class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                @foreach($mahasiswa as $m)
                    <option value="{{ $m->nim }}">{{ $m->nim }} - {{ $m->nama }}</option>
                @endforeach
            </select>
        </div>

        {{-- JABATAN --}}
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">Jabatan</label>

            <select name="jabatan" id="jabatanSelect"
                class="border px-3 py-2 w-full rounded dark:bg-gray-700 dark:text-gray-200" required>
                <option value="">-- Pilih Jabatan --</option>
                <option value="ketua">Ketua</option>
                <option value="wakil">Wakil</option>
                <option value="bendahara">Bendahara</option>
                <option value="divisi acara">Divisi Acara</option>
                <option value="divisi olahraga">Divisi Olahraga</option>
                <option value="divisi multimedia">Divisi Multimedia</option>
                <option value="divisi logistik">Divisi Logistik</option>
                <option value="divisi humas">Divisi Humas</option>
                <option value="lainnya">➕ Lainnya</option>
            </select>

            {{-- INPUT CUSTOM --}}
            <input 
                type="text" 
                name="jabatan_custom" 
                id="jabatanCustom" 
                class="mt-2 hidden w-full px-3 py-2 border rounded dark:bg-gray-700 dark:text-gray-200" 
                placeholder="Masukkan jabatan/divisi baru..."
            >
        </div>

        {{-- STATUS --}}
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">Status Keanggotaan</label>
            <select name="status_keanggotaan" class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-400 text-white px-4 py-2 rounded-lg">
            Tambah Anggota
        </button>
    </form>
</div>

{{-- SCRIPT UNTUK INPUT CUSTOM --}}
<script>
    document.getElementById('jabatanSelect').addEventListener('change', function () {
        let customInput = document.getElementById('jabatanCustom');
        if (this.value === 'lainnya') {
            customInput.classList.remove('hidden');
            customInput.required = true;
        } else {
            customInput.classList.add('hidden');
            customInput.required = false;
        }
    });
</script>
@endsection
