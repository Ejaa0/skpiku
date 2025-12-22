@extends('layouts.dashboard_organisasi')

@section('content')
<div class="w-full px-4 md:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {{-- Total Kegiatan --}}
            <div
                class="p-6 rounded-2xl shadow-lg bg-gradient-to-br from-blue-600 to-blue-500
                       text-white transition-transform duration-300 hover:scale-[1.02]">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold opacity-90">Total Kegiatan</h2>
                        <p class="text-5xl font-extrabold mt-2">{{ $totalKegiatan }}</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <span class="material-icons text-4xl">event</span>
                    </div>
                </div>
            </div>

            {{-- Total Organisasi --}}
            <div
                class="p-6 rounded-2xl shadow-lg bg-gradient-to-br from-green-600 to-green-500
                       text-white transition-transform duration-300 hover:scale-[1.02]">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold opacity-90">Total Organisasi</h2>
                        <p class="text-5xl font-extrabold mt-2">{{ $totalOrganisasi }}</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <span class="material-icons text-4xl">groups</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- KEGIATAN TERBARU --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold mb-5 text-gray-800 dark:text-gray-200">
                📅 Kegiatan Terbaru
            </h2>

            @if($latestKegiatan->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 italic">
                    Belum ada kegiatan yang dibuat.
                </p>
            @else
                <div class="space-y-4">
                    @foreach($latestKegiatan as $item)
                        <div
                            class="flex items-center justify-between p-4 rounded-xl
                                   bg-gray-100 dark:bg-gray-700
                                   hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                    {{ $item->nama_kegiatan }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                                </p>
                            </div>
                            <span class="material-icons text-blue-500 text-3xl">
                                event_note
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
