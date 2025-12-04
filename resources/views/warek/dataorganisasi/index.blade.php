@extends('layouts.dashboard_warek_utama')

@section('title', 'Data Organisasi WR III')

@section('content')
<div class="container mx-auto p-4">

    <h1 class="text-2xl font-bold mb-4">Data Organisasi</h1>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('warek.dataorganisasi.index') }}" 
          class="mb-4 flex items-center space-x-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama organisasi"
               class="px-4 py-2 border rounded-lg w-full dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
        
        <button type="submit" 
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Cari
        </button>
    </form>

    @if(request('q'))
        <p class="mb-2 text-gray-500 dark:text-gray-400">
            Hasil pencarian untuk: 
            <strong class="text-gray-700 dark:text-gray-200">{{ request('q') }}</strong>
        </p>
    @endif

    {{-- Tabel Data --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nama Organisasi</th>
                    <th class="px-4 py-2 text-left">Deskripsi</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($organisasis as $org)
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-2">{{ $org->id_organisasi }}</td>
                        <td class="px-4 py-2">{{ $org->nama_organisasi }}</td>
                        <td class="px-4 py-2">{{ $org->deskripsi ?: '-' }}</td>

                        <td class="px-4 py-2 flex items-center space-x-2">

                            {{-- Lihat --}}
                            <a href="{{ route('warek.dataorganisasi.show', $org->id_organisasi) }}"
                               class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                Lihat
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('warek.dataorganisasi.edit', $org->id_organisasi) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            {{-- Hapus --}}
                            <form action="{{ route('warek.dataorganisasi.destroy', $org->id_organisasi) }}" 
                                  method="POST"
                                  onsubmit="return confirm('Apakah yakin ingin menghapus organisasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada data organisasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $organisasis->appends(['q' => request('q')])->links() }}
    </div>

</div>
@endsection
