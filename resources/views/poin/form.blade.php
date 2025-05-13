<div>
    <label class="block font-medium">NIM</label>
    <input type="text" name="nim" class="w-full border border-gray-300 rounded p-2" value="{{ old('nim', $data->nim ?? '') }}" required>
</div>

<div>
    <label class="block font-medium">Nama</label>
    <input type="text" name="nama" class="w-full border border-gray-300 rounded p-2" value="{{ old('nama', $data->nama ?? '') }}" required>
</div>

<div>
    <label class="block font-medium">Nama Kegiatan</label>
    <input type="text" name="nama_kegiatan" class="w-full border border-gray-300 rounded p-2" value="{{ old('nama_kegiatan', $data->nama_kegiatan ?? '') }}" required>
</div>

<div>
    <label class="block font-medium">Jenis Kegiatan</label>
    <input type="text" name="jenis_kegiatan" class="w-full border border-gray-300 rounded p-2" value="{{ old('jenis_kegiatan', $data->jenis_kegiatan ?? '') }}" required>
</div>

<div>
    <label class="block font-medium">Tanggal Kegiatan</label>
    <input type="date" name="tanggal_kegiatan" class="w-full border border-gray-300 rounded p-2" value="{{ old('tanggal_kegiatan', $data->tanggal_kegiatan ?? '') }}" required>
</div>

<div>
    <label class="block font-medium">Deskripsi</label>
    <textarea name="deskripsi" class="w-full border border-gray-300 rounded p-2" required>{{ old('deskripsi', $data->deskripsi ?? '') }}</textarea>
</div>

<div>
    <label class="block font-medium">Poin</label>
    <input type="number" name="poin" class="w-full border border-gray-300 rounded p-2" value="{{ old('poin', $data->poin ?? '') }}" required>
</div>
