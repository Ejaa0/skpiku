@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded">
    <h1 class="text-2xl font-bold mb-6">Tambah Poin Mahasiswa</h1>

    <form action="{{ route('poin.store') }}" method="POST">
        @csrf

        <!-- Pilih NIM -->
        <div class="mb-4">
            <label for="nim" class="block text-sm font-medium">NIM</label>
            <select name="nim" id="nim" class="w-full border p-2 rounded @error('nim') border-red-500 @enderror" required>
                <option value="">-- Pilih NIM --</option>
                @foreach($mahasiswas as $mhs)
                    <option value="{{ $mhs->nim }}" {{ old('nim') == $mhs->nim ? 'selected' : '' }}>
                        {{ $mhs->nim }} - {{ $mhs->nama }}
                    </option>
                @endforeach
            </select>
            @error('nim') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Nama -->
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium">Nama</label>
            <input type="text" name="nama" id="nama" class="w-full border p-2 rounded" readonly value="{{ old('nama') }}">
        </div>

        <!-- Tipe -->
        <div class="mb-4">
            <label for="tipe" class="block text-sm font-medium">Tipe</label>
            <select name="tipe" id="tipe" class="w-full border p-2 rounded @error('tipe') border-red-500 @enderror" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="organisasi" {{ old('tipe') == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
                <option value="kegiatan" {{ old('tipe') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
            </select>
            @error('tipe') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Kegiatan Fields -->
        <div id="kegiatanFields" class="hidden">
            <div class="mb-4">
                <label for="nama_kegiatan" class="block text-sm font-medium">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="w-full border p-2 rounded @error('nama_kegiatan') border-red-500 @enderror" value="{{ old('nama_kegiatan') }}">
                @error('nama_kegiatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="jenis_kegiatan" class="block text-sm font-medium">Jenis Kegiatan</label>
                <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" class="w-full border p-2 rounded @error('jenis_kegiatan') border-red-500 @enderror" value="{{ old('jenis_kegiatan') }}">
                @error('jenis_kegiatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="tanggal_kegiatan" class="block text-sm font-medium">Tanggal Kegiatan</label>
                <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="w-full border p-2 rounded @error('tanggal_kegiatan') border-red-500 @enderror" value="{{ old('tanggal_kegiatan') }}">
                @error('tanggal_kegiatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Organisasi Fields -->
        <div id="organisasiFields" class="hidden">
            <div class="mb-4">
                <label for="jabatan" class="block text-sm font-medium">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="w-full border p-2 rounded @error('jabatan') border-red-500 @enderror" value="{{ old('jabatan') }}">
                @error('jabatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="status_keanggotaan" class="block text-sm font-medium">Status Keanggotaan</label>
                <input type="text" name="status_keanggotaan" id="status_keanggotaan" class="w-full border p-2 rounded @error('status_keanggotaan') border-red-500 @enderror" value="{{ old('status_keanggotaan') }}">
                @error('status_keanggotaan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="w-full border p-2 rounded" rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        <!-- Poin -->
        <div class="mb-4">
            <label for="poin" class="block text-sm font-medium">Poin</label>
            <input type="number" name="poin" id="poin" class="w-full border p-2 rounded @error('poin') border-red-500 @enderror" value="{{ old('poin') }}" required>
            @error('poin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const nimSelect = document.getElementById('nim');
    const namaInput = document.getElementById('nama');
    const tipeSelect = document.getElementById('tipe');

    const kegiatanFields = document.getElementById('kegiatanFields');
    const organisasiFields = document.getElementById('organisasiFields');

    nimSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const text = selectedOption.text; // format: "nim - nama"
        const nama = text.split(' - ')[1] || '';
        namaInput.value = nama;
    });

    function toggleFields() {
        if (tipeSelect.value === 'kegiatan') {
            kegiatanFields.classList.remove('hidden');
            organisasiFields.classList.add('hidden');
        } else if (tipeSelect.value === 'organisasi') {
            organisasiFields.classList.remove('hidden');
            kegiatanFields.classList.add('hidden');
        } else {
            kegiatanFields.classList.add('hidden');
            organisasiFields.classList.add('hidden');
        }
    }

    tipeSelect.addEventListener('change', toggleFields);

    // Trigger toggle on page load for old input (misal validasi gagal)
    toggleFields();

    // Jika ada NIM yang sudah terpilih dari old input, isi nama otomatis
    if(nimSelect.value) {
        const selectedOption = nimSelect.options[nimSelect.selectedIndex];
        const text = selectedOption.text;
        const nama = text.split(' - ')[1] || '';
        namaInput.value = nama;
    }
});
</script>
@endsection
