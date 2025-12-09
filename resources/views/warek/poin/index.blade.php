@extends('layouts.dashboard_warek_utama')

@section('title', 'Cari Poin Mahasiswa')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Cari Poin Mahasiswa</h1>

    {{-- Form search --}}
    <form method="GET" action="{{ route('warek.poin') }}" class="mb-4 flex items-center space-x-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari NIM atau Nama"
               class="px-4 py-2 border rounded-lg w-full dark:bg-gray-700 dark:text-gray-200">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Cari</button>
    </form>

    @if(request('q')) {{-- Tampilkan hasil hanya jika user melakukan pencarian --}}
        @if($mahasiswas->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <th class="px-4 py-2 text-left">NIM</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Total Poin</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $m)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-2">{{ $m->nim }}</td>
                            <td class="px-4 py-2">
                                @if(request('q'))
                                    {{ $m->nama }}
                                @else
                                    - {{-- Nama disembunyikan sebelum pencarian --}}
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $m->total_poin }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('warek.poin.detail', $m->nim) }}"
                                   class="px-3 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 text-sm">
                                   Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $mahasiswas->appends(['q' => request('q')])->links() }}
                </div>
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400 mt-4">
                Data tidak ditemukan untuk "{{ request('q') }}".
            </p>
        @endif
    @endif
</div>
@endsection
