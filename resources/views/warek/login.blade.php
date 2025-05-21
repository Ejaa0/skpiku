@extends('layouts.login_warek')

@section('content')
<style>
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .animated-emoji {
        display: inline-block;
        animation: bounce 1s infinite;
    }
</style>

<div class="max-w-md mx-auto mt-16 bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
    <div class="text-center mb-8">
        <div class="text-6xl animated-emoji">👨‍💼</div>
        <h2 class="mt-4 text-3xl font-bold text-gray-900 dark:text-white">Login Wakil Rektor III</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Masuk untuk mengelola sistem SKPI sebagai WR III</p>
    </div>

    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
        class="mb-6 px-4 py-3 rounded bg-red-100 text-red-700 text-sm relative">
        {{ session('error') }}
        <button @click="show = false" class="absolute top-1 right-2 text-red-700 hover:text-red-900" aria-label="Close">
            &times;
        </button>
    </div>
    @endif

    <form method="POST" action="{{ route('warek.login.submit') }}" class="space-y-6">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input id="email" name="email" type="email" required autofocus
                class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 dark:bg-gray-700 dark:text-white">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
            <input id="password" name="password" type="password" required
                class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 dark:bg-gray-700 dark:text-white">
        </div>

        <div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md shadow-md">
                Masuk
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="/" class="text-blue-600 hover:underline">← Kembali ke Dashboard Utama</a>
    </div>
</div>
@endsection
