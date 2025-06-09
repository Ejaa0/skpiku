@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Tambah Poin Mahasiswa</h2>

    <form action="{{ route('poin.store') }}" method="POST">
        @csrf

        {{-- NIM --}}
        <div class="mb-4">
            <label for="nim" class="block text-sm font-medium">NIM</label>
            <select name="nim" id="nim" class="w-full border p-2 rounded @error('nim') border-red-500 @enderror" required>
                <option value="">Pilih NIM</option>
                @foreach($mahasiswas as $mhs)
                    <option value="{{ $mhs->nim }}" data-nama="{{ $mhs->nama }}" {{ old('nim') == $mhs->nim ? 'selected' : '' }}>
                        {{ $mhs->nim }} - {{ $mhs->nama }}
                    </option>
                @endforeach
            </select>
            @error('nim') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Nama --}}
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium">Nama</label>
            <input type="text" name="nama" id="nama" class="w-full border p-2 rounded bg-gray-100" readonly value="{{ old('nama') }}">
        </div>

        {{-- Tipe --}}
        <div class="mb-4">
            <label for="tipe" class="block text-sm font-medium">Tipe</label>
            <select name="tipe" id="tipe" class="w-full border p-2 rounded @error('tipe') border-red-500 @enderror" required>
                <option value="">Pilih Tipe</option>
                <option value="kegiatan" {{ old('tipe') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="organisasi" {{ old('tipe') == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
            </select>
            @error('tipe') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Kegiatan --}}
        <div id="kegiatanFields" class="{{ old('tipe') != 'kegiatan' ? 'hidden' : '' }}">
            <div class="mb-4">
                <label for="nama_kegiatan" class="block text-sm font-medium">Nama Kegiatan</label>
                <select name="nama_kegiatan" id="nama_kegiatan" class="w-full border p-2 rounded @error('nama_kegiatan') border-red-500 @enderror">
                    <option value="">Pilih Kegiatan</option>
                    @foreach($kegiatans as $kg)
                        <option value="{{ $kg->nama_kegiatan }}"
                            data-poin="{{ $kg->poin }}"
                            data-jenis="{{ $kg->jenis_kegiatan }}"
                            data-tanggal="{{ $kg->tanggal_kegiatan }}"
                            {{ old('nama_kegiatan') == $kg->nama_kegiatan ? 'selected' : '' }}>
                            {{ $kg->nama_kegiatan }}
                        </option>
                    @endforeach
                </select>
                @error('nama_kegiatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="jenis_kegiatan" class="block text-sm font-medium">Jenis Kegiatan</label>
                <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" class="w-full border p-2 rounded" readonly value="{{ old('jenis_kegiatan') }}">
            </div>

            <div class="mb-4">
                <label for="tanggal_kegiatan" class="block text-sm font-medium">Tanggal Kegiatan</label>
                <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="w-full border p-2 rounded" readonly value="{{ old('tanggal_kegiatan') }}">
            </div>
        </div>

        {{-- Organisasi --}}
        <div id="organisasiFields" class="{{ old('tipe') != 'organisasi' ? 'hidden' : '' }}">
            <div class="mb-4">
                <label for="nama_organisasi" class="block text-sm font-medium">Nama Organisasi</label>
                <select name="nama_organisasi" id="nama_organisasi" class="w-full border p-2 rounded @error('nama_organisasi') border-red-500 @enderror">
                    <option value="">Pilih Organisasi</option>
                    @foreach($organisasis as $org)
                        <option value="{{ $org->nama_organisasi }}"
                            data-poin="{{ $org->poin }}"
                            {{ old('nama_organisasi') == $org->nama_organisasi ? 'selected' : '' }}>
                            {{ $org->nama_organisasi }}
                        </option>
                    @endforeach
                </select>
                @error('nama_organisasi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="jabatan" class="block text-sm font-medium">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="w-full border p-2 rounded" value="{{ old('jabatan') }}">
            </div>

            <div class="mb-4">
                <label for="status_keanggotaan" class="block text-sm font-medium">Status Keanggotaan</label>
                <input type="text" name="status_keanggotaan" id="status_keanggotaan" class="w-full border p-2 rounded" value="{{ old('status_keanggotaan') }}">
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full border p-2 rounded">{{ old('deskripsi') }}</textarea>
        </div>

        {{-- Poin --}}
        <div class="mb-4">
            <label for="poin" class="block text-sm font-medium">Poin</label>
            <input type="number" name="poin" id="poin" class="w-full border p-2 rounded @error('poin') border-red-500 @enderror"
                value="{{ old('poin') ?? '' }}"
                {{ old('tipe') == 'kegiatan' ? 'readonly' : '' }} required>
            @error('poin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>

{{-- Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nimSelect = document.getElementById('nim');
        const namaInput = document.getElementById('nama');
        const tipeSelect = document.getElementById('tipe');
        const kegiatanFields = document.getElementById('kegiatanFields');
        const organisasiFields = document.getElementById('organisasiFields');
        const namaKegiatanSelect = document.getElementById('nama_kegiatan');
        const namaOrganisasiSelect = document.getElementById('nama_organisasi');
        const jenisKegiatanInput = document.getElementById('jenis_kegiatan');
        const tanggalKegiatanInput = document.getElementById('tanggal_kegiatan');
        const poinInput = document.getElementById('poin');

        function updateNama() {
            const selectedOption = nimSelect.options[nimSelect.selectedIndex];
            namaInput.value = selectedOption.dataset.nama || '';
        }
        nimSelect.addEventListener('change', updateNama);
        updateNama();

        function toggleFields() {
            const tipe = tipeSelect.value;
            kegiatanFields.classList.toggle('hidden', tipe !== 'kegiatan');
            organisasiFields.classList.toggle('hidden', tipe !== 'organisasi');

            if (tipe === 'kegiatan') {
                poinInput.setAttribute('readonly', true);
                poinInput.value = '';
                if (namaOrganisasiSelect) namaOrganisasiSelect.value = '';
                jenisKegiatanInput.value = '';
                tanggalKegiatanInput.value = '';
            } else if (tipe === 'organisasi') {
                poinInput.removeAttribute('readonly');
                poinInput.value = '';
                if (namaKegiatanSelect) namaKegiatanSelect.value = '';
                jenisKegiatanInput.value = '';
                tanggalKegiatanInput.value = '';
            } else {
                poinInput.value = '';
                poinInput.removeAttribute('readonly');
                if (namaKegiatanSelect) namaKegiatanSelect.value = '';
                if (namaOrganisasiSelect) namaOrganisasiSelect.value = '';
                jenisKegiatanInput.value = '';
                tanggalKegiatanInput.value = '';
            }
        }
        tipeSelect.addEventListener('change', toggleFields);
        toggleFields();

        function updateKegiatanFields() {
            const selectedOption = namaKegiatanSelect.options[namaKegiatanSelect.selectedIndex];
            jenisKegiatanInput.value = selectedOption.dataset.jenis || '';
            tanggalKegiatanInput.value = selectedOption.dataset.tanggal || '';
            poinInput.value = selectedOption.dataset.poin || '';
        }
        if (namaKegiatanSelect) {
            namaKegiatanSelect.addEventListener('change', updateKegiatanFields);
            if (namaKegiatanSelect.value) updateKegiatanFields();
        }

        function updateOrganisasiPoin() {
            const selectedOption = namaOrganisasiSelect.options[namaOrganisasiSelect.selectedIndex];
            poinInput.value = selectedOption.dataset.poin || '';
        }
        if (namaOrganisasiSelect) {
            namaOrganisasiSelect.addEventListener('change', updateOrganisasiPoin);
            if (namaOrganisasiSelect.value) updateOrganisasiPoin();
        }
    });
</script>
@endsection
