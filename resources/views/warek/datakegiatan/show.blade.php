@extends('layouts.dashboard_warek_utama')

@section('title', 'Detail Kegiatan')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">📋 Detail Kegiatan</h1>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow mb-6">
        <p class="mb-2 text-gray-700 dark:text-gray-300">🔢 <strong>ID Kegiatan:</strong> {{ $kegiatan->id }}</p>
        <p class="mb-2 text-gray-700 dark:text-gray-300">🏷️ <strong>Jenis Kegiatan:</strong> {{ $kegiatan->jenis_kegiatan }}</p>
        <p class="mb-2 text-gray-700 dark:text-gray-300">📌 <strong>Nama Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }}</p>
        <p class="mb-2 text-gray-700 dark:text-gray-300">📅 <strong>Tanggal Kegiatan:</strong> {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d F Y') }}</p>

        <!-- Tombol tambah mahasiswa -->
        <a href="{{ route('warek.datakegiatan.tambahanggota.create', $kegiatan->id) }}" 
           class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
           + Tambah Mahasiswa
        </a>
    </div>

    <h2 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-100">Daftar Mahasiswa yang Mengikuti</h2>

    @if($kegiatan->mahasiswa->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 border-b text-gray-700 dark:text-gray-200">No</th>
                        <th class="px-4 py-2 border-b text-gray-700 dark:text-gray-200">NIM</th>
                        <th class="px-4 py-2 border-b text-gray-700 dark:text-gray-200">Nama Mahasiswa</th>
                        <th class="px-4 py-2 border-b text-gray-700 dark:text-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatan->mahasiswa as $index => $mhs)
                        <tr class="text-center text-gray-700 dark:text-gray-200">
                            <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b">{{ $mhs->nim }}</td>
                            <td class="px-4 py-2 border-b">{{ $mhs->nama }}</td>
                            <td class="px-4 py-2 border-b">
                                <form action="{{ route('warek.datakegiatan.tambahanggota.destroy', [$kegiatan->id, $mhs->nim]) }}" 
                                      method="POST" 
                                      class="delete-form inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 delete-btn"
                                            data-nama="{{ $mhs->nama }}">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-700 dark:text-gray-300">Belum ada mahasiswa yang mengikuti kegiatan ini.</p>
    @endif

    <a href="{{ route('warek.datakegiatan.index') }}" 
       class="inline-block mt-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
       ← Kembali ke Daftar
    </a>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.delete-form');
            const namaMahasiswa = this.getAttribute('data-nama');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `Mahasiswa "${namaMahasiswa}" akan dihapus dari kegiatan!`,
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
