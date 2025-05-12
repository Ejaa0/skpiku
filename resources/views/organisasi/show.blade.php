@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-6">
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-3xl font-extrabold text-blue-700 mb-6 flex items-center gap-2">
            📄 Detail Organisasi
        </h2>

        <div class="space-y-4 text-gray-800 text-lg">
            <div class="flex items-center gap-2">
                <span class="font-semibold">🎓 NIM:</span>
                <span>{{ $organisasi->nim }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="font-semibold">👤 Nama:</span>
                <span>{{ $organisasi->nama }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="font-semibold">🆔 ID Organisasi:</span>
                <span>{{ $organisasi->id_organisasi }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="font-semibold">🏢 Nama Organisasi:</span>
                <span>{{ $organisasi->nama_organisasi }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="font-semibold">🕒 Absensi:</span>
                <span>{{ $organisasi->absensi }}</span>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('organisasi.index') }}"
                class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                ← 🔙 Kembali ke daftar
            </a>
        </div>
    </div>
</div>
@endsection
