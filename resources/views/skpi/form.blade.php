<!DOCTYPE html>
<html lang="id">
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
        .input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #d1d5db;
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 min-h-screen flex items-center justify-center px-4">

<div class="w-full max-w-3xl p-8 bg-white rounded-3xl shadow-2xl fade-in">

    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-2">🎓 Form SKPI</h1>
        <p class="text-gray-600 text-lg">
            Isi data berikut untuk membuat dokumen
            <strong>SKPI (Surat Keterangan Pendamping Ijazah)</strong>
        </p>
    </div>

    <!-- INFO KEGIATAN -->
    <div class="mb-6">
        <h2 class="font-bold text-lg mb-2">📌 Kegiatan yang Diikuti</h2>
        <ul class="list-disc list-inside text-gray-700">
            @forelse($kegiatan as $k)
                <li>{{ $k }}</li>
            @empty
                <li class="italic text-gray-400">Belum ada kegiatan</li>
            @endforelse
        </ul>
    </div>

    <!-- INFO ORGANISASI -->
    <div class="mb-6">
        <h2 class="font-bold text-lg mb-2">🏢 Organisasi yang Diikuti</h2>
        <ul class="list-disc list-inside text-gray-700">
            @forelse($organisasi as $o)
                <li>{{ $o }}</li>
            @empty
                <li class="italic text-gray-400">Belum ada organisasi</li>
            @endforelse
        </ul>
    </div>

    <!-- FORM SKPI -->
    <form id="formSKPI" action="{{ url('/skpi/generate') }}" method="POST" class="space-y-6">
        @csrf

        <!-- HIDDEN WAJIB -->
        <input type="hidden" name="kegiatan_list" value='@json($kegiatan)'>
        <input type="hidden" name="organisasi_list" value='@json($organisasi)'>

        <!-- Personal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input name="nama" placeholder="Nama Lengkap" required class="input">
            <input name="ttl" placeholder="Bandung, 21 Mei 2000" required class="input">
        </div>

        <!-- NIM dan Masa Studi -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <input name="nim" value="{{ $nim }}" readonly class="input bg-gray-100">
            <input name="masuk" placeholder="Tahun Masuk" required class="input">
            <input name="lulus" placeholder="Tahun Lulus" required class="input">
        </div>

        <!-- No Ijazah -->
        <input name="no_ijazah" placeholder="No Ijazah" required class="input">

        <!-- Gelar dan Prodi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input name="gelar" placeholder="S.Kom / A.Md" required class="input">
            <input name="prodi" placeholder="Sistem Informasi" required class="input">
        </div>

        <!-- Bahasa dan Jenjang -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input name="bahasa" placeholder="Indonesia, Inggris" required class="input">
            <select name="jenjang" required class="input bg-gray-100">
                <option value="">-- Pilih Jenjang --</option>
                <option value="Sarjana (S1)" selected>Sarjana (S1)</option>
                <option value="Diploma (D3)">Diploma (D3)</option>
            </select>
        </div>

        <!-- Karakter dan Tanggal Surat -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input name="karakter" placeholder="Disiplin, Jujur, Bertanggung Jawab" required class="input">
            <input type="date" name="tanggal_surat" required class="input">
        </div>

        <!-- BUTTON GENERATE -->
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-800 text-white font-bold px-8 py-3 rounded-full shadow-lg">
            🚀 Generate SKPI Sarjana
        </button>
    </form>

    <!-- FORM DIPLOMA (Copy dari form SKPI) -->
    <form id="formDiploma" action="{{ url('/skpi/generate-diploma') }}" method="POST" class="mt-4">
        @csrf
        @foreach([
            'nama','ttl','nim','masuk','lulus','no_ijazah','gelar',
            'prodi','bahasa','jenjang','karakter','tanggal_surat',
            'kegiatan_list','organisasi_list'
        ] as $field)
            <input type="hidden" name="{{ $field }}">
        @endforeach

        <button type="submit"
            class="w-full bg-green-600 hover:bg-green-800 text-white font-bold px-8 py-3 rounded-full shadow-lg">
            🎓 Generate SKPI (Diploma)
        </button>
    </form>

</div>

<script>
// Copy semua input dari formSKPI ke formDiploma sebelum submit
document.querySelector('#formDiploma').addEventListener('submit', function () {
    const mainForm = document.querySelector('#formSKPI');
    mainForm.querySelectorAll('input, select').forEach(input => {
        const target = this.querySelector(`[name="${input.name}"]`);
        if (target) target.value = input.value;
    });
});
</script>

</body>
</html>
