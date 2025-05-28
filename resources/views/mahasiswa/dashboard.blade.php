<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-600 min-h-screen flex">

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-indigo-900 text-indigo-100 w-64 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 -translate-x-full fixed md:static inset-y-0 left-0 z-30">
        <div class="flex items-center justify-between px-6 py-4 border-b border-indigo-700">
            <h1 class="text-xl font-bold tracking-wide">SKPI UNAI</h1>
            <button id="closeSidebarBtn" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-indigo-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex flex-col mt-6 px-4 space-y-2">
            <a href="#" class="py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-3 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18" />
                </svg>
                <span>Dashboard</span>
            </a>
            
            <a href="/profil" class="py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-3 font-semibold">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 10-8 0v2m12 0v-2a4 4 0 118 0v2m-6 4h6" />
    </svg>
    <span>Profil</span>
</a>
            <!-- Tambahan: Riwayat Poin -->
            <a href="/poin/riwayat" class="py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-3 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8m-4-12v12m-6 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Riwayat Poin</span>
            </a>

            <!-- Tambahan: Lihat SKPI -->
            <a href="/skpi/mahasiswa" class="py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-3 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                </svg>
                <span>Lihat SKPI</span>
            </a>

            <!-- Logout Button -->
            <button id="logoutBtn" class="py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-3 font-semibold mt-auto mb-4 w-full text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                <span>Logout</span>
            </button>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex flex-col flex-grow ml-0 md:ml-64 transition-all duration-300 ease-in-out">
        <!-- Navbar Mobile -->
        <header class="bg-white shadow-md md:hidden flex items-center justify-between px-4 py-3 sticky top-0 z-20">
            <button id="openSidebarBtn" class="focus:outline-none">
                <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-indigo-700 font-bold text-lg">Dashboard Mahasiswa</h1>
            <div></div>
        </header>

        <main class="p-8 flex-grow bg-white bg-opacity-90 rounded-tl-3xl rounded-tr-3xl shadow-xl min-h-screen">
            <h2 class="text-3xl font-bold mb-6 text-indigo-900">🎓 Selamat Datang, Mahasiswa!</h2>

            <!-- Card Berita -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://source.unsplash.com/400x200/?education,university" alt="Berita 1" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-indigo-800 mb-2">Pelatihan SKPI untuk Mahasiswa Baru</h3>
                        <p class="text-gray-600 mb-4 text-sm">Ikuti pelatihan SKPI yang akan diadakan pada tanggal 10 Juni 2025. Pastikan kamu mendaftar sebelum tanggal 5 Juni!</p>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Baca Selengkapnya →</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://source.unsplash.com/400x200/?campus,event" alt="Berita 2" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-indigo-800 mb-2">Festival Kewirausahaan Mahasiswa</h3>
                        <p class="text-gray-600 mb-4 text-sm">Jangan lewatkan festival kewirausahaan di kampus dengan berbagai lomba dan pameran produk inovatif mahasiswa.</p>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Baca Selengkapnya →</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://source.unsplash.com/400x200/?library,study" alt="Berita 3" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-indigo-800 mb-2">Perpustakaan Buka Hingga Malam</h3>
                        <p class="text-gray-600 mb-4 text-sm">Mulai bulan Mei, perpustakaan kampus akan buka hingga pukul 22.00 untuk mendukung aktivitas belajar mahasiswa.</p>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Baca Selengkapnya →</a>
                    </div>
                </div>

                <!-- Tambahan Card 4 -->
<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <img src="https://source.unsplash.com/400x200/?achievement,award" alt="Berita 4" class="w-full h-48 object-cover">
    <div class="p-4">
        <h3 class="text-xl font-semibold text-indigo-800 mb-2">Penghargaan Mahasiswa Berprestasi</h3>
        <p class="text-gray-600 mb-4 text-sm">UNAI memberikan penghargaan kepada 10 mahasiswa berprestasi dalam bidang akademik dan non-akademik.</p>
        <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Baca Selengkapnya →</a>
    </div>
</div>

<!-- Tambahan Card 5 -->
<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <img src="https://source.unsplash.com/400x200/?technology,workshop" alt="Berita 5" class="w-full h-48 object-cover">
    <div class="p-4">
        <h3 class="text-xl font-semibold text-indigo-800 mb-2">Workshop Teknologi Digital</h3>
        <p class="text-gray-600 mb-4 text-sm">Daftar workshop teknologi terbaru yang diadakan Fakultas Sains dan Teknologi bulan depan!</p>
        <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Baca Selengkapnya →</a>
    </div>
</div>

<!-- Tambahan Card 6 -->
<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <img src="https://source.unsplash.com/400x200/?volunteer,community" alt="Berita 6" class="w-full h-48 object-cover">
    <div class="p-4">
        <h3 class="text-xl font-semibold text-indigo-800 mb-2">Aksi Sosial Mahasiswa UNAI</h3>
        <p class="text-gray-600 mb-4 text-sm">Gabung dalam aksi sosial yang dilaksanakan oleh BEM untuk membantu masyarakat sekitar kampus.</p>
        <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Baca Selengkapnya →</a>
    </div>
</div>

            </section>
        </main>

        <footer class="text-center py-6 text-indigo-700 font-semibold select-none">
            &copy; 2025 Sistem SKPI UNAI • Dashboard Mahasiswa
        </footer>
    </div>

    <!-- Modal Background -->
    <div id="modalBg" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <!-- Modal -->
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 mx-4 text-center">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Apakah Kamu yakin ingin keluar?</h3>
            <div class="flex justify-center space-x-4">
                <button id="confirmLogout" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition">Ya</button>
                <button id="cancelLogout" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition">Tidak</button>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openSidebarBtn');
        const closeBtn = document.getElementById('closeSidebarBtn');
        const logoutBtn = document.getElementById('logoutBtn');
        const modalBg = document.getElementById('modalBg');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');

        // Sidebar toggle for mobile
        openBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });

        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });

        // Show modal on logout button click
        logoutBtn.addEventListener('click', () => {
            modalBg.classList.remove('hidden');
        });

        // Confirm logout -> redirect
        confirmLogout.addEventListener('click', () => {
            window.location.href = 'http://127.0.0.1:8000/login/mahasiswa';
        });

        // Cancel logout -> hide modal
        cancelLogout.addEventListener('click', () => {
            modalBg.classList.add('hidden');
        });

        // Close modal if click outside modal box
        modalBg.addEventListener('click', (e) => {
            if(e.target === modalBg) {
                modalBg.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
