@extends('layouts.dashboard_warek_utama')

@section('title', 'Detail Organisasi')

@section('content')
<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">📄 Detail Organisasi</h1>

    {{-- INFORMASI ORGANISASI --}}
    <div class="mb-6">
        <p class="text-gray-700 dark:text-gray-300">
            <strong>🆔 ID Organisasi:</strong> {{ $organisasi->id_organisasi }}
        </p>
        <p class="text-gray-700 dark:text-gray-300">
            <strong>🏢 Nama Organisasi:</strong> {{ $organisasi->nama_organisasi }}
        </p>
    </div>

    {{-- HEADER ANGGOTA + TOMBOL TAMBAH --}}
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">👥 Daftar Anggota Mahasiswa</h2>

        <a href="{{ route('warek.dataorganisasi.anggota.create', $organisasi->id_organisasi) }}"
           class="bg-green-500 hover:bg-green-400 text-white px-4 py-2 rounded-lg transition">
            ➕ Tambah Anggota
        </a>
    </div>

    @php
        $anggota = $organisasi->anggota ?? collect();
    @endphp

    {{-- TABEL ANGGOTA --}}
    @if($anggota->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-200">NIM</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Nama Mahasiswa</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Jabatan</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Status Keanggotaan</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($anggota as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->nim }}</td>
                            <td class="px-4 py-2">{{ $item->nama }}</td>
                            <td class="px-4 py-2">{{ $item->jabatan }}</td>
                            <td class="px-4 py-2">{{ $item->status_keanggotaan }}</td>

                            <td class="px-4 py-2 space-x-3 flex items-center">

                                {{-- EDIT ANGGOTA --}}
                                <a href="{{ route('warek.dataorganisasi.anggota.edit', $item->id) }}"
                                   class="text-blue-500 hover:underline">
                                    Edit
                                </a>

                                {{-- HAPUS ANGGOTA MODERN --}}
                                <form action="{{ route('warek.dataorganisasi.anggota.destroy', $item->id) }}"
                                      method="POST"
                                      class="delete-form inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn text-red-500 hover:underline">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-700 dark:text-gray-300">Belum ada anggota terdaftar.</p>
    @endif

</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.delete-form');

            Swal.fire({
                title: 'Yakin ingin menghapus anggota ini?',
                text: "Data anggota akan hilang permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#fff' : '#000'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
