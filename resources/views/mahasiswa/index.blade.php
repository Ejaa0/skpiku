@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Daftar Mahasiswa</h2>

        <table class="min-w-full text-left border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">NIM</th>
                    <th class="p-2 border">Tempat Lahir</th>
                    <th class="p-2 border">Tanggal Lahir</th>
                    <th class="p-2 border">Sex</th>
                    <th class="p-2 border">Agama</th>
                    <th class="p-2 border">Hobi</th>
                    <th class="p-2 border">Angkatan</th>
                    <th class="p-2 border">Email</th>
                    
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $mhs)
                    <tr>
                        <td class="p-2 border">{{ $mhs->nim }}</td>
                        <td class="p-2 border">{{ $mhs->temp_lahir }}</td>
                        <td class="p-2 border">{{ $mhs->tgl_lahir }}</td>
                        <td class="p-2 border">{{ $mhs->sex }}</td>
                        <td class="p-2 border">{{ $mhs->agama }}</td>
                        <td class="p-2 border">{{ $mhs->hobi }}</td>
                        <td class="p-2 border">{{ $mhs->angkatan }}</td>
                        <td class="p-2 border">{{ $mhs->email }}</td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">Belum ada data mahasiswa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
