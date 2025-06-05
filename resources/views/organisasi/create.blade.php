    @extends('layouts.app')

    @section('content')
    <div class="max-w-4xl mx-auto mt-10 px-6">
        <div class="bg-white p-6 rounded-lg shadow-xl">
            <h2 class="text-2xl font-bold mb-4">Tambah Organisasi Baru</h2>

            <form action="{{ route('organisasi.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="id_organisasi" class="block text-gray-700">ID Organisasi</label>
                    <input type="text" name="id_organisasi" id="id_organisasi" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="nama_organisasi" class="block text-gray-700">Nama Organisasi</label>
                    <input type="text" name="nama_organisasi" id="nama_organisasi" class="w-full border rounded px-3 py-2" required>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
