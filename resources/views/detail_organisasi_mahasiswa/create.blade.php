@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-4">
        <h2 class="text-2xl font-bold mb-6 text-green-700">
            ➕ Tambah Anggota untuk Organisasi: {{ $organisasi->nama_organisasi }}
        </h2>

        {{-- FORM SEARCH MAHASISWA --}}
        <form method="GET" action="{{ url()->current() }}" class="mb-6">
            <input type="text" name="cari" value="{{ request('cari') }}"
                placeholder="Cari mahasiswa berdasarkan NIM atau Nama..."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
        </form>

        {{-- LIST MAHASISWA --}}
        @if ($mahasiswa->isEmpty())
            <p class="text-gray-500">🙁 Tidak ada mahasiswa ditemukan.</p>
        @else
            <div class="overflow-x-auto bg-white rounded-lg shadow border">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-green-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">NIM</th>
                            <th class="px-6 py-3 text-left">Nama</th>
                            <th class="px-6 py-3 text-left">Jabatan</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($mahasiswa as $mhs)
                            <tr class="hover:bg-green-50 transition">
                                <form method="POST" action="{{ route('detail_organisasi_mahasiswa.store') }}">
                                    @csrf
                                    <input type="hidden" name="id_organisasi" value="{{ $organisasi->id_organisasi }}">
                                    <input type="hidden" name="nim" value="{{ $mhs->nim }}">

                                    <td class="px-6 py-2">{{ $mhs->nim }}</td>
                                    <td class="px-6 py-2">{{ $mhs->nama }}</td>
                                    <td class="px-6 py-2">
                                        @php
                                            $oldJabatan = old('jabatan');
                                            $oldCustom = old('jabatan_custom');
                                        @endphp
                                        <select name="jabatan" class="jabatan-select border px-2 py-1 w-full rounded"
                                            required>
                                            <option value="">-- Pilih Jabatan --</option>
                                            <option value="ketua" {{ $oldJabatan == 'ketua' ? 'selected' : '' }}>Ketua
                                            </option>
                                            <option value="wakil" {{ $oldJabatan == 'wakil' ? 'selected' : '' }}>Wakil
                                            </option>
                                            <option value="bendahara" {{ $oldJabatan == 'bendahara' ? 'selected' : '' }}>
                                                Bendahara</option>
                                            <option value="divisi acara"
                                                {{ $oldJabatan == 'divisi acara' ? 'selected' : '' }}>Divisi Acara</option>
                                            <option value="divisi olahraga"
                                                {{ $oldJabatan == 'divisi olahraga' ? 'selected' : '' }}>Divisi Olahraga
                                            </option>
                                            <option value="divisi multimedia"
                                                {{ $oldJabatan == 'divisi multimedia' ? 'selected' : '' }}>Divisi
                                                Multimedia</option>
                                            <option value="divisi logistik"
                                                {{ $oldJabatan == 'divisi logistik' ? 'selected' : '' }}>Divisi Logistik
                                            </option>
                                            <option value="divisi humas"
                                                {{ $oldJabatan == 'divisi humas' ? 'selected' : '' }}>Divisi Humas</option>
                                            <option value="lainnya"
                                                {{ strtolower($oldJabatan) == 'lainnya' ? 'selected' : '' }}>➕ Lainnya
                                            </option>
                                        </select>
                                        {{-- Input tambahan jika pilih "Lainnya" --}}
                                        <input type="text" name="jabatan_custom"
                                            class="jabatan-custom mt-2 {{ strtolower($oldJabatan) == 'lainnya' ? '' : 'hidden' }} w-full px-2 py-1 border rounded"
                                            placeholder="Masukkan jabatan/divisi baru..." value="{{ $oldCustom }}">
                                    </td>
                                    <td class="px-6 py-2">
                                        <select name="status_keanggotaan" class="border px-2 py-1 rounded w-full" required>
                                            <option value="aktif"
                                                {{ old('status_keanggotaan') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="nonaktif"
                                                {{ old('status_keanggotaan') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                            </option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-2 text-center">
                                        <button type="submit"
                                            class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                            Tambah
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINASI --}}
            <div class="mt-4">
                {{ $mahasiswa->appends(['cari' => request('cari')])->links() }}
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('organisasi.show', $organisasi->id_organisasi) }}"
                class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
                ← Kembali ke Detail Organisasi
            </a>
        </div>
    </div>

    {{-- SCRIPT: Show input custom jika pilih "Lainnya" --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".jabatan-select").forEach(select => {
                select.addEventListener("change", function() {
                    const input = this.parentElement.querySelector(".jabatan-custom");
                    if (this.value.toLowerCase() === "lainnya") {
                        input.classList.remove("hidden");
                        input.setAttribute("required", "true");
                    } else {
                        input.classList.add("hidden");
                        input.removeAttribute("required");
                        input.value = "";
                    }
                });
            });
        });
    </script>
@endsection
