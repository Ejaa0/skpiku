@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto mt-10 px-6">

{{-- ================= DETAIL ORGANISASI ================= --}}
<div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg mb-12">
    <h2 class="text-3xl font-extrabold text-blue-700 dark:text-blue-400 mb-6 flex items-center gap-3">
        <span class="text-4xl">📄</span> Detail Organisasi
    </h2>

    <div class="space-y-5 text-gray-800 dark:text-gray-200 text-lg border
                border-gray-200 dark:border-gray-700 rounded-lg p-6
                bg-blue-50 dark:bg-gray-700">
        <div class="flex items-center gap-3">
            <span class="font-semibold text-blue-900 dark:text-blue-300">🆔 ID Organisasi:</span>
            <span>{{ $organisasi->id_organisasi }}</span>
        </div>
        <div class="flex items-center gap-3">
            <span class="font-semibold text-blue-900 dark:text-blue-300">🏢 Nama Organisasi:</span>
            <span>{{ $organisasi->nama_organisasi }}</span>
        </div>
    </div>
</div>

{{-- ================= DAFTAR ANGGOTA ================= --}}
<div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-3">
            <span class="text-3xl">👥</span> Daftar Anggota Mahasiswa
        </h3>

        <a href="{{ route('detail_organisasi_mahasiswa.create', ['id' => $organisasi->id_organisasi]) }}"
           class="inline-flex items-center gap-2 bg-green-600 text-white px-5 py-2.5 rounded-lg shadow hover:bg-green-700 transition text-sm font-medium">
            ➕ Tambah Anggota
        </a>
    </div>

    <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg">
        <table class="min-w-full text-left text-sm divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="px-6 py-3">NIM</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Jabatan</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($detailMahasiswa as $anggota)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4">{{ $anggota->nim }}</td>
                        <td class="px-6 py-4">{{ $anggota->nama }}</td>
                        <td class="px-6 py-4">{{ $anggota->jabatan ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $anggota->status_keanggotaan ?? '-' }}</td>

                        <td class="px-6 py-4 text-center space-x-2">

                            {{-- EDIT --}}
                            <a href="{{ route('detail_organisasi_mahasiswa.edit', $anggota->id) }}"
                               class="inline-flex items-center gap-1 bg-yellow-500 text-white px-3 py-1.5 rounded-md shadow hover:bg-yellow-600 transition text-sm">
                                ✏️ Edit
                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('detail_organisasi_mahasiswa.destroy', $anggota->id) }}"
                                  method="POST"
                                  class="inline delete-form"
                                  data-nama="{{ $anggota->nama }}"
                                  data-nim="{{ $anggota->nim }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 bg-red-600 text-white px-3 py-1.5 rounded-md shadow hover:bg-red-700 transition text-sm">
                                    🗑️ Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-6 py-6 text-gray-500 italic">
                            Belum ada anggota terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ================= TOMBOL KEMBALI ================= --}}
<div class="mt-10 text-center">
    <a href="{{ route('organisasi.index') }}"
       class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition text-lg font-semibold">
        ← 🔙 Kembali ke Daftar
    </a>
</div>

</div>

{{-- ================= SWEETALERT2 ================= --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const nama = this.dataset.nama;
            const nim = this.dataset.nim;
            const darkMode = document.documentElement.classList.contains('dark');

            Swal.fire({
                title: 'Hapus Anggota?',
                html: `Mahasiswa <b>${nama}</b><br><small>NIM: ${nim}</small> akan dihapus dari organisasi.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                background: darkMode ? '#1f2937' : '#ffffff',
                color: darkMode ? '#f9fafb' : '#111827',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280'
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
