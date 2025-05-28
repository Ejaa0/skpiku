    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Mahasiswa</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-50 min-h-screen flex font-sans">

        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-500 text-white shadow-xl">
            <div class="p-6 text-2xl font-bold border-b border-blue-400">
                🎓 UNAI Dashboard
            </div>
            <nav class="p-4 space-y-3 text-sm font-medium">
                <a href="{{ url('/mahasiswa/dashboard') }}"
                    class="block py-2 px-4 rounded transition duration-200
                        {{ request()->is('mahasiswa/dashboard') ? 'bg-white text-blue-700 font-bold' : 'hover:bg-blue-600' }}">
                    📊 Dashboard Utama
                </a>

                <a href="{{ route('mahasiswa.data') }}"
                    class="block py-2 px-4 rounded transition duration-200
                        {{ request()->routeIs('mahasiswa.data') ? 'bg-white text-blue-700 font-bold' : 'hover:bg-blue-600' }}">
                    🧾 Data Mahasiswa
                </a>
               <a href="{{ route('mahasiswa.data_kegiatan') }}"
   class="block py-2 px-4 rounded transition duration-200
      {{ request()->routeIs('mahasiswa.data_kegiatan') ? 'bg-white text-blue-700 font-bold' : 'hover:bg-blue-600' }}">
    📅 Data Kegiatan
</a>


                <form method="POST" action="{{ route('logout.mahasiswa') }}" class="pt-6">
                    @csrf
                    <button type="submit"
                        class="w-full py-2 px-4 bg-red-500 hover:bg-red-600 text-white rounded shadow-md transition">
                        🚪 Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <h1 class="text-4xl font-bold text-blue-700 mb-8">📚 Data Mahasiswa</h1>

            <!-- Search dan Tombol Edit Mahasiswa -->
            <form method="GET" action="{{ route('mahasiswa.data') }}" class="mb-6">
                <div class="flex flex-wrap sm:flex-nowrap max-w-3xl gap-2 items-center">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="🔍 Cari NIM atau Nama..."
                        class="w-full sm:w-auto flex-grow px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
                        Cari
                    </button>
                    @if (request('search'))
                        <a href="{{ route('mahasiswa.data') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">
                            Reset
                        </a>
                    @endif

                    <!-- Tombol Edit Mahasiswa -->
                    <a href="http://127.0.0.1:8000/mahasiswa"
                        class="ml-auto px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition whitespace-nowrap">
                        ✏️ Edit Mahasiswa
                    </a>
                </div>
            </form>

            <!-- Tabel Mahasiswa (Hanya muncul saat ada pencarian) -->
            @if (request('search'))
                <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200">
                    <table class="min-w-full text-sm">
                        <thead class="bg-blue-600 text-white uppercase text-left">
                            <tr>
                                <th class="px-6 py-3 font-semibold">NIM</th>
                                <th class="px-6 py-3 font-semibold">Nama</th>
                                <th class="px-6 py-3 font-semibold">Tempat Lahir</th>
                                <th class="px-6 py-3 font-semibold">Tanggal Lahir</th>
                                <th class="px-6 py-3 font-semibold">Jenis Kelamin</th>
                                <th class="px-6 py-3 font-semibold">Agama</th>
                                <th class="px-6 py-3 font-semibold">Hobi</th>
                                <th class="px-6 py-3 font-semibold">Angkatan</th>
                                <th class="px-6 py-3 font-semibold">Email</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            @forelse ($mahasiswas as $mhs)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->nim }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->nama ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->temp_lahir ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->tgl_lahir ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $mhs->sex == 'L' ? 'Laki-laki' : ($mhs->sex == 'P' ? 'Perempuan' : '-') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->agama ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->hobi ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->angkatan ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->email ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-6 text-center text-gray-500">
                                        Tidak ada data mahasiswa yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-sm mt-4">
                    Silakan masukkan NIM atau Nama pada kolom pencarian untuk menampilkan data mahasiswa.
                </p>
            @endif

        </main>

    </body>

    </html>
