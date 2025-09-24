@extends('tampilan_organisasi.dashboard_organisasi')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-blue-700 dark:text-blue-300">
            Profil Organisasi
        </h2>
        <a href="{{ route('organisasi.edit', $organisasi->id) }}"
           class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white rounded-lg shadow transition">
            Edit Profil
        </a>
    </div>

    <!-- Detail Organisasi -->
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Nama Organisasi</p>
                <p class="text-lg font-semibold">{{ $organisasi->nama_organisasi }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">ID Organisasi</p>
                <p class="text-lg font-semibold">{{ $organisasi->id_organisasi }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                <p class="text-lg font-semibold">{{ $organisasi->email ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Deskripsi</p>
                <p class="text-lg font-semibold">{{ $organisasi->deskripsi ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Tombol hapus -->
    <form action="{{ route('organisasi.destroy', $organisasi->id) }}" method="POST" 
          onsubmit="return confirm('Apakah Anda yakin ingin menghapus organisasi ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow transition">
            Hapus Organisasi
        </button>
    </form>
</div>
@endsection
