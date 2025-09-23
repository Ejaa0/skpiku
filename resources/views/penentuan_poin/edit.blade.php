@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">
        Edit Penentuan Poin
    </h1>

    <div class="bg-white dark:bg-gray-700 p-6 rounded-2xl shadow-md">
        <form action="{{ route('penentuan_poin.update', $penentuan_poin->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Keterangan -->
            <div>
                <label for="keterangan" class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan"
                       value="{{ old('keterangan', $penentuan_poin->keterangan) }}"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('keterangan')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Poin -->
            <div>
                <label for="poin" class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Poin</label>
                <input type="number" name="poin" id="poin"
                       value="{{ old('poin', $penentuan_poin->poin) }}"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('poin')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex gap-4 mt-4">
                <a href="{{ route('penentuan_poin.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
