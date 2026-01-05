@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto mt-12 px-4 sm:px-6 lg:px-8">

    {{-- Detail Kegiatan --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 sm:p-8 border border-yellow-300">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-yellow-600 mb-6 border-b pb-2">📋 Detail Kegiatan</h2>

        <div class="space-y-4 sm:space-y-0 sm:flex sm:justify-between sm:gap-6 mb-6">
            <div class="flex justify-between sm:flex-col sm:items-start w-full sm:w-auto">
                <span class="font-semibold text-gray-700 dark:text-gray-300">🔢 ID Kegiatan:</span>
                <span class="text-gray-700 dark:text-gray-200">{{ $kegiatan->id_kegiatan }}</span>
            </div>
            <div class="flex justify-between sm:flex-col sm:items-start w-full sm:w-auto">
                <span class="font-semibold text-gray-700 dark:text-gray-300">🏷️ Jenis Kegiatan:</span>
                <span class="text-gray-700 dark:text-gray-200">{{ $kegiatan->jenis_kegiatan }}</span>
            </div>
            <div class="flex justify-between sm:flex-col sm:items-start w-full sm:w-auto">
                <span class="font-semibold text-gray-700 dark:text-gray-300">📌 Nama Kegiatan:</span>
                <span class="text-gray-700 dark:text-gray-200">{{ $kegiatan->nama_kegiatan }}</span>
            </div>
            <div class="flex justify-between sm:flex-col sm:items-start w-full sm:w-auto">
                <span class="font-semibold text-gray-700 dark:text-gray-300">📅 Tanggal Kegiatan:</span>
                <span class="text-gray-700 dark:text-gray-200">{{ optional(\Carbon\Carbon::parse($kegiatan->tanggal_kegiatan))->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah Mahasiswa --}}
    <div class="mt-8 flex justify-end">
        <a href="{{ route('kegiatan.tambahMahasiswaForm', ['id' => $kegiatan->id]) }}"
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            + Tambah Mahasiswa
        </a>
    </div>

    {{-- Daftar Mahasiswa --}}
    <div class="mt-6">
        <h3 class="text-xl sm:text-2xl font-semibold text-gray-700 dark:text-gray-100 mb-4">Daftar Mahasiswa yang Mengikuti</h3>

        @if ($data->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">Belum ada mahasiswa yang mengikuti kegiatan ini.</p>
        @else
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden text-sm sm:text-base">
                    <thead class="bg-yellow-500 text-white uppercase tracking-wider text-xs sm:text-sm">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left">No</th>
                            <th class="px-4 sm:px-6 py-3 text-left">NIM</th>
                            <th class="px-4 sm:px-6 py-3 text-left">Nama Mahasiswa</th>
                            <th class="px-4 sm:px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-100 text-gray-700 dark:text-gray-200">
                        @foreach ($data as $index => $mhs)
                            <tr class="hover:bg-yellow-50 dark:hover:bg-yellow-800 transition duration-150">
                                <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mhs->nim }}</td>
                                <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $mhs->nama }}</td>
                                <td class="px-4 sm:px-6 py-3 text-center space-x-2">
                                    {{-- Form Hapus Mahasiswa Modern --}}
                                    <form action="{{ route('kegiatan.hapusMahasiswa', ['id' => $kegiatan->id, 'nim' => $mhs->nim]) }}"
                                          method="POST"
                                          class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="text-red-600 hover:text-red-800 flex items-center gap-1 delete-btn"
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
        @endif
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-8 text-right">
        <a href="{{ route('kegiatan.index') }}"
           class="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            ← Kembali ke Daftar
        </a>
    </div>

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
                title: 'Yakin ingin menghapus mahasiswa ini?',
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
