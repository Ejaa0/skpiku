@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold mb-6 text-center text-indigo-700">Tambah Poin Mahasiswa</h1>

    @if(session('error'))
        <div class="mb-4 p-3 text-red-800 bg-red-200 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('poin.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="nim" class="block mb-2 font-medium text-gray-700">Pilih Mahasiswa:</label>
            <select name="nim" id="nim" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                onchange="showNamaMahasiswa()">
                <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                @foreach($mahasiswas as $m)
                    <option value="{{ $m->nim }}" data-nama="{{ $m->nama }}">{{ $m->nim }} - {{ $m->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Nama Mahasiswa:</label>
            <p id="namaMahasiswa" class="text-gray-900 font-semibold">-</p>
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded transition duration-300">
            Simpan
        </button>
    </form>
</div>

<script>
    function showNamaMahasiswa() {
        var select = document.getElementById('nim');
        var nama = select.options[select.selectedIndex].getAttribute('data-nama');
        document.getElementById('namaMahasiswa').innerText = nama || '-';
    }
</script>
@endsection
