<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SKPI PDF - Sarjana</title>
<style>
    @page { size: A4 portrait; margin: 10mm; }
    body {
        font-family: 'Times New Roman', serif;
        margin:0; padding:0;
        color:#000; font-size:13px; line-height:1.3;
        background-color:#fff;
        position:relative;
    }
    .container {
        max-width:760px;
        margin:0 auto;
        padding:12px 20px;
        border:4px double #002147;
        background-color:#fff;
        position:relative;
        z-index:1;
    }
    .watermark {
        position:absolute;
        top:50%; left:50%;
        width:400px; opacity:0.08;
        transform:translate(-50%, -50%);
        z-index:0;
    }
    .logo {
        text-align:center;
        margin-bottom:15px;
        position:relative;
        z-index:1;
    }
    .logo img { width:75px; height:auto; }
    .university-name { text-align:center; font-size:17px; font-weight:bold; color:#002147; margin:4px 0; z-index:1; position:relative; }
    .accreditation, .skpi-number { text-align:center; font-size:13px; font-weight:bold; color:#002147; margin:2px 0; z-index:1; position:relative; }
    h2 { text-align:center; font-size:18px; text-transform:uppercase; color:#002147; margin:25px 0 5px; font-weight:bold; z-index:1; position:relative; }
    .document-title { text-align:center; font-size:15px; margin:5px 0 16px; color:#444; font-weight:600; font-style:italic; z-index:1; position:relative; }
    .field-group { font-size:13px; margin:5px 0; z-index:1; position:relative; }
    .field-label { display:inline-block; width:280px; font-weight:bold; vertical-align:top; }
    .footer { margin-top:20px; font-size:13px; font-style:italic; text-align:right; z-index:1; position:relative; }
    table { width:100%; margin-top:10px; font-size:13px; border-collapse: collapse; z-index:1; position:relative; }
    table td, table th { border:1px solid #000; text-align:left; padding:6px; }
    .page-break { page-break-before: always; }

    /* Tanda tangan tanpa border */
    .signature-table {
        width:100%;
        margin-top:40px;
        border-collapse: collapse;
    }
    .signature-table td {
        border:none; /* hapus border */
        text-align:center;
        vertical-align:top;
        padding-top:10px;
    }
</style>
</head>
<body>

{{-- HALAMAN 1 --}}
<div class="container">

    {{-- Watermark Garuda --}}
    @if(!empty($garudaBase64))
        <img src="{{ $garudaBase64 }}" class="watermark" alt="Garuda">
    @endif

    {{-- Logo UNAI --}}
    <div class="logo">
        @if(!empty($base64))
            <img src="{{ $base64 }}" alt="Logo UNAI">
        @endif
    </div>

    <div class="university-name">UNIVERSITAS ADVENT INDONESIA</div>
    <div class="accreditation">Nomor SK Akreditasi Perguruan Tinggi : 426/SK/BAN-PT/Akred/PT/XII/2018</div>
    <div class="skpi-number">Nomor SKPI : 044/06/BK/UNAI/2019</div>

    <h2>SURAT KETERANGAN PENDAMPING IJAZAH</h2>
    <div class="document-title">Bachelor Supplement</div>

    <p style="text-align:center;">
        Surat Keterangan Pendamping Ijazah sebagai Pelengkap Ijazah yang menerangkan Pembelajaran dan Prestasi dari Pemegang Ijazah selama Masa Studi<br>
        <span style="font-style:italic;">
            The Diploma Supplement as a Complement to Diploma that Describes Learning Outcomes and Achievements of the Holder of the Diploma during the Study Period
        </span>
    </p>

    {{-- Data Mahasiswa --}}
    <div class="field-group"><span class="field-label">Nama Lengkap (Full Name)</span>: {{ $skpi->nama }}</div>
    <div class="field-group"><span class="field-label">Tempat & Tanggal Lahir</span>: {{ $skpi->ttl }}</div>
    <div class="field-group"><span class="field-label">Nomor Induk Mahasiswa (Student Registration Number)</span>: {{ $skpi->nim }}</div>
    <div class="field-group"><span class="field-label">Tanggal Masuk (Entrance Date)</span>: {{ $skpi->masuk }}</div>
    <div class="field-group"><span class="field-label">Tanggal Lulus (Date of Judicium)</span>: {{ $skpi->lulus }}</div>
    <div class="field-group"><span class="field-label">Nomor Ijazah (Diploma Number)</span>: {{ $skpi->no_ijazah }}</div>
    <div class="field-group"><span class="field-label">Gelar (Title of Qualification)</span>: {{ $skpi->gelar }}</div>
    <div class="field-group"><span class="field-label">Program Studi (Major)</span>: {{ $skpi->prodi }}</div>
    <div class="field-group"><span class="field-label">Bahasa Pengantar Perkuliahan (Language)</span>: {{ $skpi->bahasa }}</div>
    <div class="field-group"><span class="field-label">Jenis & Jenjang Pendidikan (Type & Level)</span>: {{ $skpi->jenjang }}</div>

    <p style="margin-top:10px;">
        Berdasarkan telaah yang dilakukan, Mahasiswa sebagaimana tertera di atas memenuhi Parameter Program Pengembangan Karakter dengan <strong>{{ $skpi->karakter }}</strong>.<br>
        <em>Based on the review conducted, the student listed above fulfill Good Character Development Program Parameters</em>
    </p>

    <div class="footer">
        Bandung, {{ isset($skpi->tanggal_surat) ? \Carbon\Carbon::parse($skpi->tanggal_surat)->translatedFormat('d F Y') : '-' }}
    </div>

    {{-- Tanda tangan tanpa kotak --}}
    <table class="signature-table">
        <tr>
            <td>
                <strong>Rektor</strong><br><br><br><br>
                <u>Pdt. Dr. Milton T. Pardosi, M.A.R</u><br>
                NIP: A40-96-0354
            </td>
            <td>
                <strong>Wakil Rektor III</strong><br><br><br><br>
                <u>Yunus Elion, S.Kep., Ns., MSN</u><br>
                NIP: C11-09-0832
            </td>
        </tr>
    </table>
</div>

{{-- HALAMAN 2 --}}
<div class="container page-break">

    <h3 style="text-align:left; margin-bottom:10px;">Kegiatan yang Diikuti</h3>
    @if(!empty($kegiatan) && count($kegiatan) > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatan as $index => $k)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $k }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada kegiatan</p>
    @endif

    <h3 style="text-align:left; margin-top:20px; margin-bottom:10px;">Organisasi yang Diikuti</h3>
    @if(!empty($organisasi) && count($organisasi) > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Organisasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($organisasi as $index => $o)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $o }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada organisasi</p>
    @endif
</div>

</body>
</html>
