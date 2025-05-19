@extends('layouts.app')

@push('styles')
    <style>
        @keyframes smooth-bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .smooth-bounce {
            animation: smooth-bounce 3s ease-in-out infinite;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-md mx-auto mt-20 bg-white dark:bg-gray-800 p-10 rounded-3xl shadow-2xl">
        <div class="text-center mb-8">
            <div class="inline-block text-7xl select-none smooth-bounce" aria-hidden="true">👨‍💼</div>
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-4 tracking-wide">Login Wakil Rektor III</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Silakan masuk untuk mengakses dashboard SKPI</p>
        </div>

        {{-- Notifikasi Error --}}
        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                class="mb-5 p-4 text-sm text-red-700 bg-red-100 rounded-lg relative border border-red-400 shadow-sm"
                role="alert">
                {{ session('error') }}
                <button @click="show = false"
                    class="absolute top-2 right-2 text-red-700 hover:text-red-900 focus:outline-none" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <form method="POST" action="{{ route('warek.login.submit') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" required placeholder="warek3@unai.ac.id"
                    class="mt-1 block w-full rounded-xl border border-gray-300 dark:border-gray-600 px-5 py-3 focus:ring-4 focus:ring-blue-400 dark:bg-gray-700 dark:text-white transition" />
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" name="password" id="password" required placeholder="••••••••"
                    class="mt-1 block w-full rounded-xl border border-gray-300 dark:border-gray-600 px-5 py-3 focus:ring-4 focus:ring-blue-400 dark:bg-gray-700 dark:text-white transition" />
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-extrabold py-3 rounded-xl shadow-lg transition duration-300">
                    Masuk
                </button>
            </div>
        </form>

        <div class="text-center mt-8">
            <a href="{{ url('/') }}" class="text-sm font-medium text-blue-600 hover:underline">← Kembali ke Halaman
                Utama</a>
        </div>
    </div>
@endsection
