@extends('layouts.dashboard_organisasi')

@section('title', 'Data Organisasi')

@section('content')
<div class="p-6">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">
        Data Organisasi
    </h2>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Bar -->
    <div class="mb-6 flex justify-center">
        <form method="GET" action="{{ route('organisasi.self.index') }}" class="flex w-full max-w-lg">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari nama organisasi..." 
                value="{{ $search ?? '' }}"
                class="flex-1 px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-400 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
            >
            <button 
                type="submit" 
                class="px-5 py-2 bg-blue-500 text-white font-semibold rounded-r-lg hover:bg-blue-600 transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto shadow-lg rounded-xl">
        <table class="w-full border-collapse bg-white dark:bg-gray-800">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3 border-b">ID</th>
                    <th class="px-6 py-3 border-b">Nama Organisasi</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-600 dark:text-gray-300">
                @forelse($organisasi as $org)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 border-b">
                        {{ $org->id_organisasi }}
                    </td>
                    <td class="px-6 py-4 border-b">
                        {{ $org->nama_organisasi }}
                    </td>
                    <td class="px-6 py-4 border-b text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('organisasi.self.show', $org->id_organisasi) }}"
                               class="px-4 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                Lihat
                            </a>

                            <button
                                onclick="openDeleteModal(
                                    '{{ route('organisasi.self.destroy', $org->id_organisasi) }}',
                                    '{{ $org->nama_organisasi }}'
                                )"
                                class="px-4 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="py-6 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada data organisasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ================= MODAL DELETE ================= -->
<div id="deleteModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md p-6 animate-fadeIn">
        
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">
            ⚠️ Konfirmasi Penghapusan
        </h3>

        <p class="text-gray-600 dark:text-gray-300 mb-4">
            Anda yakin ingin menghapus organisasi:
            <span id="orgName" class="font-semibold text-red-500"></span> ?
        </p>

        <div class="flex items-center mb-6">
            <input type="checkbox" id="confirmCheck"
                   class="w-4 h-4 text-red-500 focus:ring-red-400">
            <label for="confirmCheck"
                   class="ml-2 text-gray-600 dark:text-gray-300">
                Saya yakin ingin menghapus data ini
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
                        class="px-4 py-2 bg-red-500 text-white rounded-lg 
                               opacity-50 cursor-not-allowed transition">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
    function openDeleteModal(action, name) {
        document.getElementById('deleteForm').action = action;
        document.getElementById('orgName').innerText = name;
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
