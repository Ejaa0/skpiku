<div>
    <label for="nim" class="block font-medium">NIM</label>
    <input type="text" name="nim" id="nim" value="{{ old('nim', $data->nim ?? '') }}"
        class="w-full border rounded px-3 py-2 @error('nim') border-red-500 @enderror">
    @error('nim') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div>
    <label for="nama" class="block font-medium">Nama</label>
    <input type="text" name="nama" id="nama" value="{{ old('nama', $data->nama ?? '') }}"
        class="w-full border rounded px-3 py-2 @error('nama') border-red-500 @enderror">
    @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div>
    <label for="tipe" class="block font-medium">Tipe</label>
    <select name="tipe" id="tipe" class="w-full border rounded px-3 py-2 @error('tipe') border-red-500 @enderror" onchange="toggleTipeForm()">
        <option value="">-- Pilih Tipe --</option>
        <option value="kegiatan" {{ old('tipe', $data->tipe ?? '') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
        <option value="organisasi" {{ old('tipe', $data->tipe ?? '') == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
    </select>
    @error('tipe') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

{{-- Form Kegiatan --}}
<div id="form-kegiatan" class="{{ old('tipe', $data->tipe ?? '') == 'kegiatan' ? '' : 'hidden' }} space-y-4">
    <div>
        <label for="nama_kegiatan" class="block font-medium">Nama Kegiatan</label>
        <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', $data->nama_kegiatan ?? '') }}"
            class="w-full border rounded px-3 py-2 @error('nama_kegiatan') border-red-500 @enderror">
        @error('nama_kegiatan') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="jenis_kegiatan" class="block font-medium">Jenis Kegiatan</label>
        <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" value="{{ old('jenis_kegiatan', $data->jenis_kegiatan ?? '') }}"
            class="w-full border rounded px-3 py-2 @error('jenis_kegiatan') border-red-500 @enderror">
        @error('jenis_kegiatan') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="tanggal_kegiatan" class="block font-medium">Tanggal Kegiatan</label>
        <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', isset($data->tanggal_kegiatan) ? \Carbon\Carbon::parse($data->tanggal_kegiatan)->format('Y-m-d') : '') }}"
            class="w-full border rounded px-3 py-2 @error('tanggal_kegiatan') border-red-500 @enderror">
        @error('tanggal_kegiatan') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
</div>

{{-- Form Organisasi --}}
<div id="form-organisasi" class="{{ old('tipe', $data->tipe ?? '') == 'organisasi' ? '' : 'hidden' }} space-y-4">
    <div>
        <label for="jabatan" class="block font-medium">Jabatan</label>
        <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $data->jabatan ?? '') }}"
            class="w-full border rounded px-3 py-2 @error('jabatan') border-red-500 @enderror">
        @error('jabatan') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="status_keanggotaan" class="block font-medium">Status Keanggotaan</label>
        <input type="text" name="status_keanggotaan" id="status_keanggotaan" value="{{ old('status_keanggotaan', $data->status_keanggotaan ?? '') }}"
            class="w-full border rounded px-3 py-2 @error('status_keanggotaan') border-red-500 @enderror">
        @error('status_keanggotaan') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label for="deskripsi" class="block font-medium">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" rows="3"
        class="w-full border rounded px-3 py-2 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $data->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div>
    <label for="poin" class="block font-medium">Poin</label>
    <input type="number" name="poin" id="poin" value="{{ old('poin', $data->poin ?? '') }}"
        class="w-full border rounded px-3 py-2 @error('poin') border-red-500 @enderror">
    @error('poin') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<script>
    function toggleTipeForm() {
        const tipe = document.getElementById('tipe').value;
        document.getElementById('form-kegiatan').style.display = tipe === 'kegiatan' ? 'block' : 'none';
        document.getElementById('form-organisasi').style.display = tipe === 'organisasi' ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', toggleTipeForm);
</script>
