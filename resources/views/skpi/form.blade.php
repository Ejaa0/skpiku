<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📄 Form SKPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fadeIn 1.2s ease-in-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-3xl p-8 bg-white rounded-3xl shadow-2xl fade-in">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2">🎓 Form SKPI</h1>
            <p class="text-gray-600 text-lg">Isi data berikut untuk membuat dokumen <strong>SKPI (Surat Keterangan Pendamping Ijazah)</strong>.</p>
        </div>

        <!-- Form SKPI Sarjana -->
        <form id="formSarjana" action="{{ url('/skpi/generate') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Personal Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">👤 Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Nama lengkap" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">🎂 Tempat, Tanggal Lahir</label>
                    <input type="text" name="ttl" placeholder="Contoh: Bandung, 21 Mei 2000" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                </div>
            </div>

            <!-- NIM + Tahun -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">🆔 NIM</label>
                    <input type="text" name="nim" placeholder="Nomor Induk Mahasiswa" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">📥 Tahun Masuk</label>
                    <input type="text" name="masuk" placeholder="2021" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">🎓 Tahun Lulus</label>
                    <input type="text" name="lulus" placeholder="2025" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                </div>
            </div>

            <!-- Ijazah -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">📜 No Ijazah</label>
                <input type="text" name="no_ijazah" placeholder="Nomor Ijazah Resmi" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
            </div>

            <!-- Gelar & Prodi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">🏅 Gelar</label>
                    <input type="text" name="gelar" placeholder="S.Kom" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">🏫 Program Studi</label>
                    <input type="text" name="prodi" placeholder="Sistem Informasi" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                </div>
            </div>

            <!-- Bahasa & Jenjang -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">🗣️ Bahasa</label>
                    <input type="text" name="bahasa" placeholder="Indonesia, Inggris" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">🎓 Jenjang Pendidikan</label>
                    <input type="text" name="jenjang" placeholder="Sarjana (S1) / Diploma (D3)" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                </div>
            </div>

            <!-- Karakter -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">💡 Karakter Mahasiswa</label>
                <input type="text" name="karakter" placeholder="Disiplin, Jujur, Bertanggung Jawab" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">📅 Tanggal Surat</label>
                <input type="date" name="tanggal_surat" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
            </div>

            <!-- Buttons -->
            <div class="flex flex-col md:flex-row items-center justify-center gap-4 mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold px-8 py-3 rounded-full shadow-lg transition-transform transform hover:scale-105">
                    🚀 Generate SKPI (Sarjana)
                </button>
            </form>

            <!-- Form Diploma -->
            <form id="formDiploma" action="{{ url('/skpi/generate-diploma') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="nama">
                <input type="hidden" name="ttl">
                <input type="hidden" name="nim">
                <input type="hidden" name="masuk">
                <input type="hidden" name="lulus">
                <input type="hidden" name="no_ijazah">
                <input type="hidden" name="gelar">
                <input type="hidden" name="prodi">
                <input type="hidden" name="bahasa">
                <input type="hidden" name="jenjang">
                <input type="hidden" name="karakter">
                <input type="hidden" name="tanggal_surat">

                <button type="submit" class="bg-green-600 hover:bg-green-800 text-white font-bold px-8 py-3 rounded-full shadow-lg transition-transform transform hover:scale-105">
                    🎓 Generate SKPI (Diploma)
                </button>
            </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-copy input dari form utama ke form diploma
        document.querySelector('#formDiploma').addEventListener('submit', function () {
            const mainForm = document.querySelector('#formSarjana');
            const inputs = mainForm.querySelectorAll('input');
            inputs.forEach(input => {
                const target = this.querySelector(`[name="${input.name}"]`);
                if (target) target.value = input.value;
            });
        });
    </script>

</body>
</html>
