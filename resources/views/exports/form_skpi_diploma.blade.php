<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>SKPI PDF</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 10mm;
        }
        body {
            font-family: 'Times New Roman', serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            color: #000;
            font-size: 13px;
            line-height: 1.3;
        }
        .container {
            max-width: 760px;
            margin: 0 auto;
            padding: 12px 20px;
            border: 4px double #002147;
            background-color: #fff;
            background-image: url('{{ $garudaBase64 }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 750px auto;
            box-sizing: border-box;
            position: relative;
            z-index: 1;
        }
        .logo {
            text-align: center;
            margin-bottom: 15px;
        }
        .logo img {
            width: 75px;
            height: auto;
        }
        .university-name {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            color: #002147;
            margin: 4px 0;
        }
        .accreditation, .skpi-number {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            color: #002147;
            margin: 2px 0;
        }
        h2 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            color: #002147;
            margin: 25px 0 5px 0;
            font-weight: bold;
        }
        .document-title {
            text-align: center;
            font-size: 15px;
            margin: 5px 0 16px 0;
            color: #444;
            font-weight: 600;
            font-style: italic;
        }
        .field-group {
            font-size: 13px;
            margin: 5px 0;
        }
        .field-label {
            display: inline-block;
            width: 280px;
            font-weight: bold;
            vertical-align: top;
        }
        .footer {
            margin-top: 40px;
            font-size: 13px;
            font-style: italic;
            text-align: right;
        }
        table {
            width: 100%;
            margin-top: 60px;
            font-size: 13px;
        }
        table td {
            text-align: center;
            width: 50%;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="logo">
            <img src="{{ $base64 }}" alt="Logo UNAI" />
        </div>

        <div class="university-name">UNIVERSITAS ADVENT INDONESIA</div>
        <div class="accreditation">Nomor SK Akreditasi Perguruan Tinggi : 426/SK/BAN-PT/Akred/PT/XII/2018</div>
        <div class="skpi-number">Nomor SKPI : 044/06/BK/UNAI/2019</div>

        <h2>SURAT KETERANGAN PENDAMPING IJAZAH</h2>
        <div class="document-title">Diploma Supplement</div>

        <p style="text-align: center;">
            Surat Keterangan Pendamping Ijazah sebagai Pelengkap Ijazah yang menerangkan Pembelajaran dan Prestasi dari Pemegang Ijazah selama Masa Studi<br>
            <span style="font-style: italic;">The Diploma Supplement as a Complement to Diploma that Describes Learning Outcomes and Achievements of the Holder of the Diploma during the Study Period</span>
        </p>

        <div class="field-group"><span class="field-label">Nama Lengkap (Full Name)</span>: {{ $skpi->nama }}</div>
        <div class="field-group"><span class="field-label">Tempat dan Tanggal Lahir (Place and Birthdate)</span>: {{ $skpi->ttl }}</div>
        <div class="field-group"><span class="field-label">Nomor Induk Mahasiswa (Student Registration Number)</span>: {{ $skpi->nim }}</div>
        <div class="field-group"><span class="field-label">Tanggal Masuk (Entrance Date)</span>: {{ $skpi->masuk }}</div>
        <div class="field-group"><span class="field-label">Tanggal Lulus (Date of Judicium)</span>: {{ $skpi->lulus }}</div>
        <div class="field-group"><span class="field-label">Nomor Ijazah (Diploma Number)</span>: {{ $skpi->no_ijazah }}</div>
        <div class="field-group"><span class="field-label">Gelar (Title of Qualification)</span>: {{ $skpi->gelar }}</div>
        <div class="field-group"><span class="field-label">Program Studi (Major)</span>: {{ $skpi->prodi }}</div>
        <div class="field-group"><span class="field-label">Bahasa Pengantar Perkuliahan (Language of Instruction)</span>: {{ $skpi->bahasa }}</div>
        <div class="field-group"><span class="field-label">Jenis dan Jenjang Pendidikan (Type and Level of Education)</span>: {{ $skpi->jenjang }}</div>

        <p style="margin-top: 20px;">
            Berdasarkan telaah yang dilakukan, Mahasiswa sebagaimana tertera diatas memenuhi Parameter Program Pengembangan Karakter dengan <strong>{{ $skpi->karakter }}</strong>.<br>
            <em>Based on the review conducted, the student listed above fulfill Good Character Development Program Parameters</em>
        </p>

        <div class="footer">
            Bandung, {{ \Carbon\Carbon::parse($skpi->tanggal_surat)->translatedFormat('d F Y') }}
        </div>

        <table>
            <tr>
                <td>
                    <strong>Rektor / President</strong><br><br><br><br><br>
                    <u>Pdt. Dr. Milton T. Pardosi, M.A.R</u><br>
                    NIP: A40-96-0354
                </td>
                <td>
                    <strong>Pembantu Rektor III / Vice President for Student Affairs</strong><br><br><br><br><br>
                    <u>Yunus Elion, S.Kep., Ns., MSN</u><br>
                    NIP: C11-09-0832
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
