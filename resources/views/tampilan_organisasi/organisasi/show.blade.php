@extends('layouts.dashboard_organisasi')

@section('title', 'Detail Organisasi')

@section('content')
<div class="p-6">
    <!-- Header -->
    <h2 class="text-3xl font-bold text-green-600 mb-6">
        Detail Organisasi: {{ $organisasi->nama_organisasi }}
    </h2>

    <!-- Tombol tambah anggota -->
    <div class="mb-6">
        <a href="{{ route('organisasi.self.tambah_anggota', $organisasi->id_organisasi) }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
           ➕ Tambah Anggota
        </a>
    </div>

    <!-- Tabel anggota -->
    <div class="overflow-x-auto shadow-lg rounded-xl">
        <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3 text-left">NIM</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Jabatan</th>
                    <th class="px-6 py-3 text-left">Status Keanggotaan</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-600 dark:text-gray-300">
                @forelse($mahasiswa as $m)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4">{{ $m->nim }}</td>
                    <td class="px-6 py-4">{{ $m->nama }}</td>
                    <td class="px-6 py-4">{{ $m->jabatan ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $m->status_keanggotaan ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('organisasi.self.edit_anggota', [$organisasi->id_organisasi, $m->nim]) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                                Edit
                            </a>

                            <button
                                onclick="openDeleteModal(
                                    '{{ route('organisasi.self.delete_anggota', [$organisasi->id_organisasi, $m->nim]) }}',
                                    '{{ $m->nama }}',
                                    '{{ $m->nim }}'
                                )"
                                class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada anggota di organisasi ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-6">
        <a href="{{ route('organisasi.self.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
           ← Kembali ke Daftar Organisasi
        </a>
    </div>
</div>

<!-- ================= MODAL DELETE ANGGOTA ================= -->
<div id="deleteModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md p-6">
        
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">
            ⚠️ Konfirmasi Hapus Anggota
        </h3>

        <p class="text-gray-600 dark:text-gray-300 mb-2">
            Anda yakin ingin menghapus anggota:
        </p>

        <p class="font-semibold text-red-500 mb-4">
            <span id="memberName"></span> (<span id="memberNim"></span>)
        </p>

        <div class="flex items-center mb-6">
            <input type="checkbox" id="confirmCheck"
                   class="w-4 h-4 text-red-500 focus:ring-red-400">
            <label for="confirmCheck"
                   class="ml-2 text-gray-600 dark:text-gray-300">
                Saya yakin ingin menghapus anggota ini
            </label>
        </div>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 
                               text-gray-800 dark:text-gray-200 rounded-lg 
                               hover:bg-gray-400 transition">
                    Batal
                </button>

                <button type="submit"
                        id="deleteButton"
                        disabled
                        class="px-4 py-2 bg-red-600 text-white rounded-lg 
                               opacity-50 cursor-not-allowed transition">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
    function openDeleteModal(action, name, nim) {
        document.getElementById('deleteForm').action = action;
        document.getElementById('memberName').innerText = name;
        document.getElementById('memberNim').innerText = nim;

        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');

        document.getElementById('confirmCheck').checked = false;
        toggleDeleteButton(false);
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }

    function toggleDeleteButton(enabled) {
        const btn = document.getElementById('deleteButton');
        btn.disabled = !enabled;
        btn.classList.toggle('opacity-50', !enabled);
        btn.classList.toggle('cursor-not-allowed', !enabled);
    }

    document.getElementById('confirmCheck').addEventListener('change', function () {
        toggleDeleteButton(this.checked);
    });
</script>
@endsection
