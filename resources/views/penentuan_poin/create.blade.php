@extends('layouts.app')

@section('content')
<div class="text-gray-900 dark:text-gray-100">
    <h1 class="text-3xl font-bold mb-6">Tambah Penentuan Poin</h1>

    <div class="bg-white dark:bg-gray-700 p-6 rounded-2xl shadow-md">
        <form action="{{ route('penentuan_poin.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Keterangan</label>
                <input type="text" name="keterangan"
                       value="{{ old('keterangan') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('keterangan')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Poin</label>
                <input type="number" name="poin"
                       value="{{ old('poin') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('poin')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('penentuan_poin.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
