@extends('layouts.dashboard_mahasiswa') <!-- pastikan layout sesuai -->

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6">
    <h2 class="text-2xl font-bold mb-4">Profil Saya</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <p class="text-gray-600 font-semibold">Nama:</p>
            <p class="text-gray-800">{{ $mahasiswa->nama }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-semibold">NIM:</p>
            <p class="text-gray-800">{{ $mahasiswa->nim }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-semibold">Tempat Lahir:</p>
            <p class="text-gray-800">{{ $mahasiswa->temp_lahir }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-semibold">Tanggal Lahir:</p>
            <p class="text-gray-800">{{ $mahasiswa->tgl_lahir }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-semibold">Jenis Kelamin:</p>
            <p class="text-gray-800">{{ $mahasiswa->sex }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-semibold">Agama:</p>
            <p class="text-gray-800">{{ $mahasiswa->agama }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-semibold">Hobi:</p>
            <p class="text-gray-800">{{ $mahasiswa->hobi }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-semibold">Angkatan:</p>
            <p class="text-gray-800">{{ $mahasiswa->angkatan }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-semibold">Email:</p>
            <p class="text-gray-800">{{ $mahasiswa->email }}</p>
        </div>
    </div>


</div>
@endsection
