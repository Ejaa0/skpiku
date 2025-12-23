@extends('layouts.dashboard_warek_utama')

@section('title', 'Penentuan Poin Mahasiswa')

@section('content')
<div class="p-6 space-y-6">

    {{-- JUDUL --}}
    <div>
        <h1 class="text-2xl font-bold text-primary">Penentuan Poin Mahasiswa</h1>
        <p class="text-gray-600 dark:text-gray-300">
            Halaman ini digunakan untuk menentukan poin mahasiswa berdasarkan keikutsertaan mereka
            dalam kegiatan dan organisasi.
        </p>
    </div>

    {{-- BUTTON TAMBAH --}}
    <div>
        <a href="{{ route('warek.penentuanpoin.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg
                  hover:bg-blue-700 transition">
            ➕ Tambah Poin
        </a>
    </div>

    {{-- TABEL --}}
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Keterangan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Poin</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($penentuanPoin as $item)
                <tr>
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $item->keterangan }}</td>
                    <td class="px-6 py-4 font-semibold">{{ $item->poin }}</td>
                    <td class="px-6 py-4 space-x-3">

                        <a href="{{ route('warek.penentuanpoin.edit', $item->id) }}"
                           class="text-yellow-600 hover:underline">
                            Edit
                        </a>

                        {{-- FORM DELETE --}}
                        <form id="delete-form-{{ $item->id }}"
                              action="{{ route('warek.penentuanpoin.destroy', $item->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button type="button"
                                onclick="openDeleteModal({{ $item->id }})"
                                class="text-red-600 hover:underline">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                        Data penentuan poin belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ================= MODAL KONFIRMASI HAPUS ================= --}}
<div id="deleteModal"
     class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-sm p-6 animate-scaleIn">

        <div class="text-center">
            <div class="text-4xl mb-3 text-red-600">🗑️</div>
            <h2 class="text-xl font-semibold mb-2">
                Konfirmasi Hapus
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Data penentuan poin yang dihapus tidak dapat dikembalikan.
            </p>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                class="px-4 py-2 rounded-lg border dark:border-gray-600
                       hover:bg-gray-100 dark:hover:bg-gray-700">
                Batal
            </button>

            <button onclick="confirmDelete()"
                class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
let deleteId = null;

function openDeleteModal(id) {
    deleteId = id;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    deleteId = null;
    document.getElementById('deleteModal').classList.add('hidden');
}

function confirmDelete() {
    if (deleteId) {
        document.getElementById(`delete-form-${deleteId}`).submit();
    }
}
</script>
@endsection
