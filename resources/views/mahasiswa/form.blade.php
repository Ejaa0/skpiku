<!-- resources/views/mahasiswas/form.blade.php -->

<div class="mb-3">
    <label>NIM</label>
    <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Tempat Lahir</label>
    <input type="text" name="temp_lahir" value="{{ old('temp_lahir', $mahasiswa->temp_lahir ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Tanggal Lahir</label>
    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $mahasiswa->tgl_lahir ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Jenis Kelamin</label>
    <select name="sex" class="form-control">
        <option value="L" {{ (old('sex', $mahasiswa->sex ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ (old('sex', $mahasiswa->sex ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>

<div class="mb-3">
    <label>Agama</label>
    <input type="text" name="agama" value="{{ old('agama', $mahasiswa->agama ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Hobi</label>
    <input type="text" name="hobi" value="{{ old('hobi', $mahasiswa->hobi ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Angkatan</label>
    <input type="text" name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $mahasiswa->email ?? '') }}" class="form-control">
</div>
