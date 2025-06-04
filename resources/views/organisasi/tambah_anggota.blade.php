@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">

    <h2 class="text-2xl font-bold mb-6 text-blue-700">
        ➕ Tambah Anggota ke {{ $organisasi->nama_organisasi }}
    </h2>

    <form action="{{ route('organisasi.simpanAnggota', $organisasi->id) }}" method="POST" class="space-y-6">
        @csrf

        {{-- Pilih Mahasiswa --}}
        <div>
            <label for="mahasiswa_nim" class="block mb-2 font-medium">Pilih Mahasiswa</label>
            <select name="mahasiswa_nim" id="mahasiswa_nim" required class="w-full border-gray-300 rounded-lg shadow-sm">
                <option value="">-- Pilih Mahasiswa --</option>
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs->nim }}">{{ $mhs->nim }} - {{ $mhs->nama }}</option>
                @endforeach
            </select>
        </div>

        {{-- Nama Organisasi (readonly) --}}
        <div>
            <label class="block mb-2 font-medium">Nama Organisasi</label>
            <input type="text" value="{{ $organisasi->nama_organisasi }}" class="w-full bg-gray-100 border-gray-300 rounded-lg shadow-sm" readonly>
        </div>

        {{-- Jabatan --}}
        <div>
            <label for="jabatan" class="block mb-2 font-medium">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" required class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Contoh: Ketua">
        </div>

        {{-- Status Keanggotaan --}}
        <div>
            <label for="status_keanggotaan" class="block mb-2 font-medium">Status Keanggotaan</label>
            <select name="status_keanggotaan" id="status_keanggotaan" required class="w-full border-gray-300 rounded-lg shadow-sm">
                <option value="">-- Pilih Status --</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        {{-- Tombol Simpan --}}
        <div class="pt-4">
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                💾 Simpan Anggota
            </button>
            <a href="{{ route('organisasi.show', $organisasi->id) }}" class="ml-3 text-blue-600 hover:underline">🔙 Batal</a>
        </div>
    </form>

</div>
@endsection
