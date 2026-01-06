<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="fixed md:static inset-y-0 left-0 w-64 md:w-72 lg:w-80 bg-white border-r border-gray-200 p-6 transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 overflow-y-auto">

        <!-- BRAND -->
        <div class="mb-10 hidden md:block">
            <h2 class="text-2xl font-bold text-gray-800">Mahasiswa</h2>
            <p class="text-sm text-gray-500">Dashboard SKPI</p>
        </div>

        <!-- MENU -->
        <nav class="space-y-1">
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                <span class="text-lg">🏠</span> Dashboard
            </a>

            <a href="{{ route('mahasiswa.kegiatan') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                <span class="text-lg">📅</span> Kegiatan
            </a>

            <a href="{{ route('mahasiswa.organisasi') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                <span class="text-lg">🏢</span> Organisasi
            </a>

            <a href="{{ route('mahasiswa.klaim-poin') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                <span class="text-lg">⭐</span> Poin SKPI
            </a>

            <a href="{{ route('mahasiswa.kriteria-poin') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                <span class="text-lg">📝</span> Kriteria Poin
            </a>

            <a href="{{ route('mahasiswa.leaderboard') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
    <span class="text-lg">🏆</span> Leaderboard
</a>

            <hr class="my-4 border-gray-200">

            <!-- LOGOUT MODERN -->
            <button type="button" id="logoutButton"
                    class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition">
                <span class="text-lg">🚪</span> Logout
            </button>
        </nav>
    </aside>

    <!-- OVERLAY MOBILE -->
    <div id="overlay"
         @click="document.getElementById('sidebar').classList.add('-translate-x-full'); $el.classList.add('hidden')"
         class="fixed inset-0 bg-black/40 hidden z-40 md:hidden">
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- HEADER -->
        <header class="flex items-center justify-between bg-white border-b px-6 py-3 shadow-sm">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Mahasiswa</h2>
                <p class="text-xs text-gray-500">Dashboard SKPI</p>
            </div>

            <div class="flex items-center gap-3">

                <!-- NOTIFIKASI -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="relative text-gray-700 hover:text-blue-600 transition">
                        🔔
                        <span x-show="{{ $notifikasi->count() > 0 ? 'true' : 'false' }}"
                              class="absolute -top-1 -right-1 inline-flex items-center justify-center
                                     px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full"
                              x-text="{{ $notifikasi->count() }}">
                        </span>
                    </button>

                    <div x-show="open" @click.outside="open = false"
                         class="absolute right-0 mt-2 w-80 bg-white border border-gray-200
                                rounded-xl shadow-lg overflow-hidden z-50 transition-all duration-200"
                         x-transition>
                        <div class="p-4 text-gray-800 font-bold border-b border-gray-200">
                            Notifikasi
                        </div>

                        <div class="max-h-64 overflow-y-auto">
                            @forelse($notifikasi as $notif)
                                <div class="flex justify-between items-center px-4 py-3 hover:bg-gray-50 transition">
                                    <div>
                                        <p class="text-sm">
                                            <span class="font-semibold">{{ $notif->pengirim_nim }}</span> mengirim permintaan teman
                                        </p>
                                    </div>
                                    <div class="flex gap-2">
                                        <form action="{{ route('mahasiswa.teman.respond', ['id' => $notif->id, 'action' => 'accepted']) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="px-2 py-1 bg-green-500 text-white rounded-md text-xs hover:bg-green-600">
                                                Terima
                                            </button>
                                        </form>
                                        <form action="{{ route('mahasiswa.teman.respond', ['id' => $notif->id, 'action' => 'rejected']) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="px-2 py-1 bg-red-500 text-white rounded-md text-xs hover:bg-red-600">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-3 text-gray-500 text-sm">
                                    Tidak ada notifikasi
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- TAMBAH TEMAN -->
                <button @click="document.getElementById('tambahTemanModal').classList.remove('hidden')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                    👥 Tambah Teman
                </button>

                <!-- SIDEBAR MOBILE -->
                <button @click="document.getElementById('sidebar').classList.toggle('-translate-x-full'); document.getElementById('overlay').classList.toggle('hidden')"
                        class="md:hidden text-2xl text-gray-700">
                    ☰
                </button>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="flex-1 p-6 md:p-10">
            @yield('content')
        </main>
    </div>

    <!-- TAMBAH TEMAN MODAL -->
    <div id="tambahTemanModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50">
        <div class="bg-white rounded-2xl shadow-lg w-96 max-w-full p-6 text-center">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Teman</h2>
            <form action="{{ route('mahasiswa.teman.store') }}" method="POST" class="space-y-4 text-left">
                @csrf
                <div>
                    <label class="block text-gray-700 mb-1">NIM Teman</label>
                    <input type="text" name="nim" required placeholder="Masukkan NIM teman"
                           class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" @click="document.getElementById('tambahTemanModal').classList.add('hidden')"
                            class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT LOGOUT MODERN -->
    <script>
    document.getElementById('logoutButton').addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: "Kamu akan keluar dari akun mahasiswa!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626', // merah
            cancelButtonColor: '#6b7280', // abu-abu
            confirmButtonText: 'Ya, logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('mahasiswa.logout') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                }).then(() => {
                    window.location.href = "{{ route('login') }}";
                });
            }
        });
    });
    </script>

</body>
</html>
