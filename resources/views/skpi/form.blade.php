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
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-2xl p-8 bg-white rounded-2xl shadow-2xl fade-in">
        <h1 class="text-4xl font-extrabold text-center mb-6 text-gray-800 pulse">🎓 Form SKPI 📑</h1>
        <p class="text-center text-gray-600 mb-8">📝 Silakan isi data berikut untuk membuat dokumen <strong>SKPI (Surat Keterangan Pendamping Ijazah)</strong>.</p>

        <form id="formSarjana" action="{{ url('/skpi/generate') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700">👤 Nama</label>
                <input type="text" name="nama" placeholder="Nama lengkap" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">🎂 Tempat, Tanggal Lahir</label>
                <input type="text" name="ttl" placeholder="Contoh: Bandung, 21 Mei 2000" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">🆔 NIM</label>
                <input type="text" name="nim" placeholder="Nomor Induk Mahasiswa" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">📥 Tahun Masuk</label>
                    <input type="text" name="masuk" placeholder="Contoh: 2021" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">🎓 Tahun Lulus</label>
                    <input type="text" name="lulus" placeholder="Contoh: 2025" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">📜 No Ijazah</label>
                <input type="text" name="no_ijazah" placeholder="Nomor Ijazah Resmi" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">🏅 Gelar</label>
                    <input type="text" name="gelar" placeholder="Contoh: S.Kom" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">🏫 Program Studi</label>
                    <input type="text" name="prodi" placeholder="Contoh: Sistem Informasi" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">🗣️ Bahasa</label>
                    <input type="text" name="bahasa" placeholder="Contoh: Indonesia, Inggris" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">🎓 Jenjang Pendidikan</label>
                    <input type="text" name="jenjang" placeholder="Contoh: Sarjana (S1) atau Diploma (D3)" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">💡 Karakter Mahasiswa</label>
                <input type="text" name="karakter" placeholder="Contoh: Disiplin, Jujur, Bertanggung Jawab" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">📅 Tanggal Surat</label>
                <input type="date" name="tanggal_surat" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <div class="text-center space-x-4">
                <button type="submit" class="mt-6 bg-gray-700 hover:bg-gray-900 text-white font-bold px-6 py-3 rounded-full hover:scale-105 transition-transform duration-300 shadow-lg">
                    🚀 Generate SKPI (PDF → Sarjana)
                </button>
            </form>

            <form id="formDiploma" action="{{ url('/skpi/generate-diploma') }}" method="POST" class="inline">
                @csrf
                <!-- Hidden inputs untuk mengirim ulang data dari form sebelumnya -->
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

                <button type="submit" class="mt-6 bg-blue-700 hover:bg-blue-900 text-white font-bold px-6 py-3 rounded-full hover:scale-105 transition-transform duration-300 shadow-lg">
                    🎓 Generate SKPI (PDF → Diploma)
                </button>
            </form>
        </div>

        <script>
            // Auto-copy input dari form utama ke form diploma saat diklik
            document.querySelector('#formDiploma').addEventListener('submit', function (e) {
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
