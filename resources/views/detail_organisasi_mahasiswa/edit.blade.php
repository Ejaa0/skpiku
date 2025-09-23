@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">
        ✏️ Edit Anggota Organisasi: {{ $organisasi->nama_organisasi }}
    </h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('detail_organisasi_mahasiswa.update', $detail->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- NIM --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">NIM</label>
                <input type="text" name="nim" value="{{ old('nim', $detail->nim) }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                @error('nim')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jabatan --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Jabatan</label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $detail->jabatan) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                @error('jabatan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Keanggotaan --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Status Keanggotaan</label>
                <select name="status_keanggotaan"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="aktif" {{ old('status_keanggotaan', $detail->status_keanggotaan) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status_keanggotaan', $detail->status_keanggotaan) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status_keanggotaan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between pt-4">
                <a href="{{ route('organisasi.show', $organisasi->id_organisasi) }}"
   class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
    ← Kembali ke Detail Organisasi
</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
