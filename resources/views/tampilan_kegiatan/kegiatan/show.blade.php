@extends('layouts.dashboard_organisasi')

@section('title', 'Detail Kegiatan')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    <!-- Judul -->
    <h1 class="text-3xl font-extrabold mb-6 text-gray-800">
        {{ $kegiatan->nama_kegiatan }}
    </h1>

    <!-- Info Kegiatan -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-4 rounded-lg shadow-sm border">
            <p class="text-gray-500 font-semibold">ID Kegiatan</p>
            <p class="text-gray-800">{{ $kegiatan->id_kegiatan }}</p>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border">
            <p class="text-gray-500 font-semibold">Jenis Kegiatan</p>
            @if(strtolower($kegiatan->jenis_kegiatan) === 'major')
                <span class="text-white bg-blue-600 px-2 py-1 rounded-full text-sm font-semibold">Major</span>
            @elseif(strtolower($kegiatan->jenis_kegiatan) === 'reguler')
                <span class="text-white bg-green-600 px-2 py-1 rounded-full text-sm font-semibold">Reguler</span>
            @else
                <span class="text-gray-400 text-sm">-</span>
            @endif
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border">
            <p class="text-gray-500 font-semibold">Nama Kegiatan</p>
            <p class="text-gray-800">{{ $kegiatan->nama_kegiatan }}</p>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border">
            <p class="text-gray-500 font-semibold">Tanggal Kegiatan</p>
            <p class="text-gray-800">{{ $kegiatan->tanggal_kegiatan }}</p>
        </div>
    </div>

    <!-- Tombol Tambah Mahasiswa -->
    <a href="{{ route('kegiatan-self.addMahasiswa', $kegiatan->id) }}"
       class="inline-block bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow
              hover:bg-blue-700 transition duration-200 mb-6">
        ➕ Tambah Mahasiswa
    </a>

    <!-- Daftar Mahasiswa -->
    <h2 class="text-2xl font-bold mb-3 text-gray-700">
        Daftar Mahasiswa
    </h2>

    <div class="overflow-x-auto bg-white rounded-lg shadow border">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-3 text-gray-600 uppercase text-sm">NIM</th>
                    <th class="border px-4 py-3 text-gray-600 uppercase text-sm">Nama</th>
                    <th class="border px-4 py-3 text-gray-600 uppercase text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatan->detailMahasiswa as $detail)
                <tr class="hover:bg-gray-50 transition">
                    <td class="border px-4 py-2">
                        {{ $detail->mahasiswa->nim ?? '-' }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ $detail->mahasiswa->nama ?? '-' }}
                    </td>
                    <td class="border px-4 py-2">
                        <button
                            onclick="openDeleteModal(
                                '{{ route('kegiatan-self.destroyMahasiswa', [$kegiatan->id, $detail->mahasiswa->nim]) }}',
                                '{{ $detail->mahasiswa->nama ?? '-' }}',
                                '{{ $detail->mahasiswa->nim ?? '-' }}'
                            )"
                            class="bg-red-600 text-white px-3 py-1 rounded-lg shadow
                                   hover:bg-red-700 transition duration-200">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">
                        Belum ada mahasiswa terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Kembali -->
    <a href="{{ route('kegiatan-self.index') }}"
       class="mt-6 inline-block text-blue-600 font-medium hover:underline">
        ← Kembali ke daftar kegiatan
    </a>
</div>

<!-- ================= MODAL DELETE MAHASISWA ================= -->
<div id="deleteModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            ⚠️ Konfirmasi Hapus Mahasiswa
        </h3>

        <p class="text-gray-600 mb-1">
            Anda yakin ingin menghapus mahasiswa:
        </p>

        <p class="font-semibold text-red-600 mb-4">
            <span id="studentName"></span>
            (<span id="studentNim"></span>)
        </p>

        <div class="flex items-center mb-6">
            <input type="checkbox" id="confirmCheck"
                   class="w-4 h-4 text-red-600 focus:ring-red-400">
            <label for="confirmCheck" class="ml-2 text-gray-600">
                Saya yakin ingin menghapus mahasiswa ini
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
    function openDeleteModal(action, name, nim) {
        document.getElementById('deleteForm').action = action;
        document.getElementById('studentName').innerText = name;
        document.getElementById('studentNim').innerText = nim;

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
