@extends('layouts.dashboard_organisasi')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Tambah Kegiatan</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kegiatan-self.store') }}" method="POST">
        @csrf

        {{-- ID Kegiatan --}}
        <div class="mb-4">
            <label for="id_kegiatan" class="block text-gray-700 dark:text-gray-200 font-medium">ID Kegiatan</label>
            <input type="number" name="id_kegiatan" id="id_kegiatan"
                   value="{{ old('id_kegiatan') }}"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        {{-- Nama Kegiatan --}}
        <div class="mb-4">
            <label for="nama_kegiatan" class="block text-gray-700 dark:text-gray-200 font-medium">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                   value="{{ old('nama_kegiatan') }}"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        {{-- Tanggal Kegiatan --}}
        <div class="mb-4">
            <label for="tanggal_kegiatan" class="block text-gray-700 dark:text-gray-200 font-medium">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan"
                   value="{{ old('tanggal_kegiatan') }}"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        {{-- Jenis Kegiatan --}}
        <div class="mb-4">
            <label for="jenis_kegiatan" class="block text-gray-700 dark:text-gray-200 font-medium">Jenis Kegiatan</label>
            <select name="jenis_kegiatan" id="jenis_kegiatan"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">-- Pilih Jenis Kegiatan --</option>
                <option value="Reguler" {{ old('jenis_kegiatan') == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                <option value="Major" {{ old('jenis_kegiatan') == 'Major' ? 'selected' : '' }}>Major</option>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-medium transition">
                Tambah Kegiatan
            </button>
        </div>
    </form>
</div>
@endsection
