@extends('layouts.dashboard_mahasiswa')

@section('content')

<h1 class="text-2xl font-bold mb-1">Klaim Poin Mahasiswa</h1>
<p class="text-gray-600 mb-6">
    NIM: <span class="font-semibold">{{ $nim }}</span>
</p>

{{-- ================== TOTAL POIN & STATUS ================== --}}
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Status Klaim SKPI</h2>

    @if($totalPoin < 1000)
        <p class="text-red-600 text-lg font-semibold mb-2">
            Anda belum memenuhi syarat untuk klaim poin SKPI.
        </p>
        <p class="text-gray-700">
            Poin Anda saat ini: <span class="font-bold">{{ $totalPoin }}</span> / 1000
        </p>
    @else
        <p class="text-green-600 text-lg font-semibold mb-2">
            Selamat! Anda sudah memenuhi syarat untuk klaim poin SKPI.
        </p>
        <p class="text-gray-700 mb-4">
            Total poin: <span class="font-bold">{{ $totalPoin }}</span>
        </p>
        <!-- Tombol menuju halaman SKPI -->
        <a href="http://127.0.0.1:8000/skpi"
           class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
           Klaim SKPI Sekarang
        </a>
    @endif
</div>

@endsection
