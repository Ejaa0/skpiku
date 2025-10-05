@extends('layouts.dashboard_organisasi')
@section('title', 'Edit Organisasi')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-green-600 mb-6">✏️ Edit Data Organisasi</h2>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('organisasi.self.update', $organisasi->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nama Organisasi -->
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Nama Organisasi</label>
                <input type="text" name="nama_organisasi"
                    class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-400 focus:outline-none"
                    value="{{ old('nama_organisasi', $organisasi->nama_organisasi) }}" required>
            </div>




            <!-- Jabatan -->
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Jabatan</label>
                <select name="jabatan"
                    class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-400 focus:outline-none">
                    <option value="Ketua" {{ old('jabatan', $organisasi->jabatan) == 'Ketua' ? 'selected' : '' }}>Ketua
                    </option>
                    <option value="Wakil" {{ old('jabatan', $organisasi->jabatan) == 'Wakil' ? 'selected' : '' }}>Wakil
                    </option>
                    <option value="Sekretaris" {{ old('jabatan', $organisasi->jabatan) == 'Sekretaris' ? 'selected' : '' }}>
                        Sekretaris</option>
                    <option value="Bendahara" {{ old('jabatan', $organisasi->jabatan) == 'Bendahara' ? 'selected' : '' }}>
                        Bendahara</option>
                    <option value="Divisi Akademik"
                        {{ old('jabatan', $organisasi->jabatan) == 'Divisi Akademik' ? 'selected' : '' }}>Divisi Akademik
                    </option>
                    <option value="Divisi Acara"
                        {{ old('jabatan', $organisasi->jabatan) == 'Divisi Acara' ? 'selected' : '' }}>Divisi Acara</option>
                    <option value="Divisi Olahraga"
                        {{ old('jabatan', $organisasi->jabatan) == 'Divisi Olahraga' ? 'selected' : '' }}>Divisi Olahraga
                    </option>
                    <option value="Divisi Multimedia"
                        {{ old('jabatan', $organisasi->jabatan) == 'Divisi Multimedia' ? 'selected' : '' }}>Divisi
                        Multimedia</option>
                    <option value="Divisi
                <option value="Divisi Logistik"
                        {{ old('jabatan', $organisasi->jabatan) == 'Divisi Logistik' ? 'selected' : '' }}>Divisi Logistik
                    </option>
                    <option value="Divisi Humas"
                        {{ old('jabatan', $organisasi->jabatan) == 'Divisi Humas' ? 'selected' : '' }}>Divisi Humas
                    </option>
                    <option value="Divisi Kerohanian"
                        {{ old('jabatan', $organisasi->jabatan) == 'Divisi Kerohanian' ? 'selected' : '' }}>Divisi
                        Kerohanian</option>
                </select>
            </div>

            <!-- Status Keanggotaan -->
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Status Keanggotaan</label>
                <select name="status_keanggotaan"
                    class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-400 focus:outline-none">
                    <option value="aktif"
                        {{ old('status_keanggotaan', $organisasi->status_keanggotaan) == 'aktif' ? 'selected' : '' }}>Aktif
                    </option>
                    <option value="nonaktif"
                        {{ old('status_keanggotaan', $organisasi->status_keanggotaan) == 'nonaktif' ? 'selected' : '' }}>
                        Nonaktif</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('organisasi.self.index') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition duration-200">
                    ← Kembali
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
