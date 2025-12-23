@extends('layouts.dashboard_warek_utama')

@section('title', 'Edit Penentuan Poin')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-primary">Edit Penentuan Poin</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Perbarui keterangan dan nilai poin mahasiswa.
        </p>
    </div>

    <!-- ERROR -->
    @if ($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('warek.penentuanpoin.update', $poin->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- KETERANGAN -->
        <div>
            <label class="block mb-1 text-sm font-medium">
                Keterangan Poin
            </label>
            <input type="text"
                   name="keterangan"
                   value="{{ old('keterangan', $poin->keterangan) }}"
                   required
                   class="w-full px-4 py-2 rounded-lg border
                          dark:bg-gray-700 dark:border-gray-600
                          focus:ring-2 focus:ring-primary focus:outline-none">
        </div>

        <!-- POIN -->
        <div>
            <label class="block mb-1 text-sm font-medium">
                Nilai Poin
            </label>
            <input type="number"
                   name="poin"
                   value="{{ old('poin', $poin->poin) }}"
                   min="0"
                   required
                   class="w-full px-4 py-2 rounded-lg border
                          dark:bg-gray-700 dark:border-gray-600
                          focus:ring-2 focus:ring-primary focus:outline-none">
        </div>

        <!-- ACTION -->
        <div class="flex justify-between pt-4">
            <a href="{{ route('warek.penentuanpoin.index') }}"
               class="px-4 py-2 rounded-lg border
                      hover:bg-gray-100 dark:hover:bg-gray-700">
                ← Kembali
            </a>

            <button type="submit"
                class="px-6 py-2 rounded-lg bg-primary text-white hover:bg-blue-700">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
