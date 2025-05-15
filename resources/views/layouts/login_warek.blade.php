@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-16 bg-white dark:bg-gray-800 p-8 rounded-xl shadow-xl">
    <div class="text-center mb-6">
        <div class="text-6xl">👨‍💼</div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Login Wakil Rektor III</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Silakan masuk untuk mengakses dashboard SKPI</p>
    </div>

    {{-- Notifikasi Error --}}
    @if(session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg relative"
        role="alert"
    >
        {{ session('error') }}
        <button
            @click="show = false"
            class="absolute top-2 right-2 text-red-700 hover:text-red-900 focus:outline-none"
            aria-label="Close"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif

    <form method="POST" action="{{ route('warek.login.submit') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                required
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 px-4 py-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
            />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
            <input
                type="password"
                name="password"
                id="password"
                required
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 px-4 py-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
            />
        </div>

        <div>
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow-md transition"
            >
                Masuk
            </button>
        </div>
    </form>

    <div class="text-center mt-6">
        <a href="{{ url('/') }}" class="text-sm text-blue-600 hover:underline">← Kembali ke Halaman Utama</a>
    </div>
</div>
@endsection
