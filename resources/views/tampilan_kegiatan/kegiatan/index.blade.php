@extends('layouts.dashboard_organisasi')

@section('content')
<div class="flex flex-col space-y-6">

    {{-- Header & Search --}}
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Daftar Kegiatan</h1>
        <form action="{{ route('kegiatan-self.index') }}" method="GET" class="flex space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan..."
                   class="px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-400">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                Cari
            </button>
        </form>
    </div>

    {{-- Tambah Kegiatan --}}
    <div>
        <a href="{{ route('kegiatan-self.create') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition">
            + Tambah Kegiatan
        </a>
    </div>

    {{-- Tabel Kegiatan --}}
    <div class="overflow-x-auto bg-white rounded-2xl shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($kegiatans as $kegiatan)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $kegiatan->id_kegiatan }}</td>
                    <td class="px-6 py-4">{{ $kegiatan->nama_kegiatan }}</td>
                    <td class="px-6 py-4">{{ $kegiatan->tanggal_kegiatan }}</td>
                    <td class="px-6 py-4">{{ $kegiatan->jenis_kegiatan }}</td>
                    <td class="px-6 py-4 space-x-2">

                        {{-- Lihat --}}
                        <a href="{{ route('kegiatan-self.show', $kegiatan->id) }}"
                           class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-400 transition">
                            Lihat
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('kegiatan-self.edit', $kegiatan->id) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-400 transition">
                            Edit
                        </a>

                        {{-- Hapus --}}
                        <button
                            onclick="openDeleteModal(
                                '{{ route('kegiatan-self.destroy', $kegiatan->id) }}',
                                '{{ $kegiatan->nama_kegiatan }}'
                            )"
                            class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-500 transition">
                            Hapus
                        </button>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                        Belum ada kegiatan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $kegiatans->links() }}
    </div>
</div>

<!-- ================= MODAL DELETE KEGIATAN ================= -->
<div id="deleteModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            ⚠️ Konfirmasi Hapus Kegiatan
        </h3>

        <p class="text-gray-600 mb-2">
            Anda yakin ingin menghapus kegiatan:
        </p>

        <p class="font-semibold text-red-600 mb-4" id="activityName"></p>

        <div class="flex items-center mb-6">
            <input type="checkbox" id="confirmCheck"
                   class="w-4 h-4 text-red-600 focus:ring-red-400">
            <label for="confirmCheck" class="ml-2 text-gray-600">
                Saya yakin ingin menghapus kegiatan ini
            </label>
        </div>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
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
    function openDeleteModal(action, name) {
        document.getElementById('deleteForm').action = action;
        document.getElementById('activityName').innerText = name;

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
