@extends('layouts.dashboard_mahasiswa')

@section('content')

{{-- ================== JUDUL ================== --}}
<h1 class="text-2xl font-bold mb-1">Klaim Poin Mahasiswa</h1>
<p class="text-gray-600 mb-6">
    NIM: <span class="font-semibold">{{ $nim }}</span>
</p>

{{-- ================== RINCIAN POIN ================== --}}
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">Rincian Perolehan Poin</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- ================= ORGANISASI ================= --}}
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-gray-800 mb-2">Organisasi</h3>

            <p class="text-gray-600 mb-2">
                Jumlah organisasi diikuti:
                <span class="font-bold">{{ $organisasi->count() }}</span>
            </p>

            {{-- List Organisasi --}}
            @if($organisasi->count())
                <ul class="list-disc list-inside text-gray-700 mb-3 space-y-1">
                    @foreach($organisasi as $org)
                        <li>{{ $org->nama_organisasi }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-gray-500 italic mb-3">
                    Belum mengikuti organisasi.
                </p>
            @endif

            <p class="text-gray-700">
                Poin: {{ $organisasi->count() }} × 250 =
                <span class="font-bold text-blue-600">
                    {{ $poinOrganisasi }}
                </span>
            </p>
        </div>

        {{-- ================= KEGIATAN ================= --}}
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-gray-800 mb-2">Kegiatan</h3>

            <p class="text-gray-600 mb-2">
                Jumlah kegiatan diikuti:
                <span class="font-bold">{{ $kegiatan->count() }}</span>
            </p>

            {{-- List Kegiatan --}}
            @if($kegiatan->count())
                <ul class="list-disc list-inside text-gray-700 mb-3 space-y-1">
                    @foreach($kegiatan as $keg)
                        <li>{{ $keg->nama_kegiatan }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-gray-500 italic mb-3">
                    Belum mengikuti kegiatan.
                </p>
            @endif

            <p class="text-gray-700">
                Poin: {{ $kegiatan->count() }} × 100 =
                <span class="font-bold text-blue-600">
                    {{ $poinKegiatan }}
                </span>
            </p>
        </div>
    </div>
</div>

{{-- ================== TOTAL POIN & STATUS ================== --}}
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Status Klaim SKPI</h2>

    <p class="text-gray-700 mb-4">
        Total Poin Anda:
        <span class="text-2xl font-bold text-indigo-600">
            {{ $totalPoin }}
        </span>
        / 1000
    </p>

    @if($totalPoin < 1000)
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
            <p class="font-semibold">
                ❌ Anda belum memenuhi syarat klaim SKPI.
            </p>
            <p class="text-sm mt-1">
                Tambahkan keikutsertaan organisasi atau kegiatan untuk mencapai 1000 poin.
            </p>
        </div>
    @else
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-4">
            <p class="font-semibold">
                ✅ Selamat! Anda telah memenuhi syarat klaim SKPI.
            </p>
            <p class="text-sm mt-1">
                Silakan lanjutkan proses klaim SKPI.
            </p>
        </div>

        {{-- Tombol Klaim --}}
        <a href="{{ url('/skpi') }}"
           class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg
                  hover:bg-blue-700 transition">
            Klaim SKPI Sekarang
        </a>
    @endif
</div>

@endsection
