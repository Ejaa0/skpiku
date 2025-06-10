@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Daftar Poin Mahasiswa</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('poin.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-6 inline-block hover:bg-blue-700 transition">
        + Tambah Data
    </a>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full border border-gray-200 text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr class="text-left">
                    <th class="py-3 px-4 border-b">NIM</th>
                    <th class="py-3 px-4 border-b">Nama</th>
                    <th class="py-3 px-4 border-b">Poin</th>
                    <th class="py-3 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($poinMahasiswas as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $item->nim }}</td>
                        <td class="py-2 px-4">{{ $item->nama }}</td>
                        <td class="py-2 px-4" id="poin-{{ $item->nim }}">{{ $item->poin }}</td>
                        <td class="py-2 px-4 flex space-x-2">
                            <a href="{{ route('poin.show', $item->id) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">View</a>
                            <a href="{{ route('poin.edit', $item->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('poin.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada data poin mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updatePoinRealtime() {
        $.get("{{ url('/poin/latest/all') }}", function(data) {
            data.forEach(function(item) {
                const target = $('#poin-' + item.nim);
                const oldValue = target.text();
                if (oldValue != item.poin) {
                    target.text(item.poin).css('color', 'red');
                    setTimeout(() => {
                        target.css('color', 'black');
                    }, 1000);
                }
            });
        });
    }

    updatePoinRealtime(); // Jalankan saat awal
    setInterval(updatePoinRealtime, 5000); // Ulang tiap 5 detik
</script>
@endsection
