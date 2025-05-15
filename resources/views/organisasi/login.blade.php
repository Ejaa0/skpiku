@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white px-4">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8 space-y-6">
        <div class="text-center">
            <div class="text-6xl mb-4">🏛️</div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Login Organisasi</h2>
            <p class="text-gray-600 font-medium">Masuk sebagai perwakilan organisasi</p>
        </div>

        {{-- Notifikasi error --}}
        @if(session('error'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 5000)"
                class="relative p-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-400"
                role="alert"
            >
                {{ session('error') }}
                <button
                    @click="show = false"
                    class="absolute top-2 right-2 text-red-700 hover:text-red-900 focus:outline-none"
                    aria-label="Close"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        <form method="POST" action="{{ route('organisasi.login.submit') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">Email Organisasi</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                    placeholder="organisasi@unai.ac.id"
                    class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-400 transition"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-2 text-sm font-semibold text-gray-700">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    placeholder="••••••••"
                    class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-400 transition"
                >
            </div>

            <!-- Tombol Masuk -->
            <div>
                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-extrabold py-3 rounded-xl shadow-lg transition duration-300"
                >
                    Masuk
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="/" class="text-sm font-medium text-green-600 hover:underline">← Kembali ke Dashboard Utama</a>
        </div>
    </div>
</div>
@endsection
