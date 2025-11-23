@extends('layouts.dashboard_organisasi')

@section('content')

<div class="space-y-6">

    {{-- Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-6 rounded-2xl shadow-lg bg-gradient-to-br from-blue-600 to-blue-500 
                    text-white transform hover:scale-[1.03] transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold opacity-90">Total Kegiatan</h2>
                    <p class="text-5xl font-extrabold mt-3 drop-shadow-md">{{ $totalKegiatan }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl backdrop-blur-md">
                    <span class="material-icons text-white text-4xl">event</span>
                </div>
            </div>
        </div>

        <div class="p-6 rounded-2xl shadow-lg bg-gradient-to-br from-green-600 to-green-500 
                    text-white transform hover:scale-[1.03] transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold opacity-90">Total Organisasi</h2>
                    <p class="text-5xl font-extrabold mt-3 drop-shadow-md">{{ $totalOrganisasi }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl backdrop-blur-md">
                    <span class="material-icons text-white text-4xl">groups</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Kegiatan Terbaru --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">📅 Kegiatan Terbaru</h2>

        @if($latestKegiatan->isEmpty())
            <p class="text-gray-500 dark:text-gray-400 italic">Belum ada kegiatan yang dibuat.</p>
        @else
            <div class="space-y-4">
                @foreach($latestKegiatan as $item)
                    <div class="p-4 rounded-xl bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 
                                dark:hover:bg-gray-600 transition flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $item->nama_kegiatan }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                            </p>
                        </div>
                        <span class="material-icons text-blue-500 text-3xl">event_note</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

@endsection
