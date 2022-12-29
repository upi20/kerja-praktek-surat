<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" href="{{ public_path('favicon/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ public_path('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ public_path('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ public_path('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ public_path('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ public_path('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ public_path('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ public_path('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ public_path('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ public_path('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ public_path('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ public_path('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ public_path('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ public_path('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ public_path('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#0191D7">
    <meta name="msapplication-TileImage" content="{{ public_path('favicon/icon-144x144.png') }}">
    <title>{{ $name }}</title>
    @include('templates.admin.pdf_style')
    <style>
        @page {
            margin: .3cm;
            /* padding: 1cm; */
        }

        body {
            font-family: sans-serif;
            padding: 1cm;
            padding-top: 0cm;
            padding-bottom: 0cm;

        }

        #my-table td {
            padding-bottom: 3px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td style="padding-bottom: 0">
                <img src="{{ public_path(settings()->get(set_admin('app.foto_light_mode'))) }}" alt=""
                    style="height: 30mm;">
            </td>
            <td style="padding-bottom: 0">
                <h3 class="p-title">PENGURUS RUKUN TETANGGA (RT) {{ $surat->rt->nomor }}</h3>
                <h3 class="p-title">PENGURUS RUKUN WARGA (RW) {{ $surat->rw->nomor }}</h3>
                <h2 class="p-title">DESA WANGUNSARI</h2>
                <h5 class="p-title">KECAMATAN LEMBANG KABUPATEN BANDUNG BARAT</h5>
            </td>
        </tr>
    </table>
    <hr style="margin-top: 0" class="garis">
    <h4 class="text-center" style="margin-bottom: 5px; text-decoration: underline">SURAT KETERANGAN</h4>
    <p class="text-center" style="margin-top: 5px">Nomor:
        {{ $surat->no_surat ?? '......./RT ....... / ....... /' . date('y') . '......' }}
    </p>
    <p style="text-indent: 0.5in; text-align: justify">
        Yang bertanda tangan dibawah ini, kami ketua RT {{ $surat->rt->nomor }} RW {{ $surat->rw->nomor }}
        Desa Wangunsari Kecamatan Lembang Kabupaten Bandung Barat, Dengan ini menerangkan bahwa :
    </p>
    <table id="my-table">
        <tr>
            <td style="white-space: nowrap">Nama</td>
            <td>:</td>
            <td>{{ $surat->nama_untuk_penduduk }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap">Tempat/Tgl. lahir</td>
            <td>:</td>
            <td>
                {{ $surat->keterangan->tempat_lahir }},
                {{ Carbon\Carbon::parse($surat->keterangan->tanggal_lahir)->isoFormat('D MMMM Y') }}
            </td>
        </tr>
        <tr>
            <td style="white-space: nowrap">Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $surat->keterangan->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap">Warganegara</td>
            <td>:</td>
            <td>{{ $surat->keterangan->warga_negara == 'WNI' ? 'INDONESIA' : $surat->keterangan->negara_nama }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap">Agama</td>
            <td>:</td>
            <td>{{ $surat->keterangan->agama }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap">Status Perkawinan</td>
            <td>:</td>
            <td>{{ $surat->keterangan->status_kawin }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap">Pendidikan Terakhir</td>
            <td>:</td>
            <td>{{ $surat->keterangan->pendidikan }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap">No. KTP/KTP Sementara</td>
            <td>:</td>
            <td>{{ $surat->nik_untuk_penduduk }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap">Pekerjaan</td>
            <td>:</td>
            <td>{{ $surat->keterangan->pekerjaan }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap">Alamat Lengkap</td>
            <td>:</td>
            <td>{{ $surat->rt->nama_daerah }} RT {{ $surat->rt->nomor }} RW {{ $surat->rw->nomor }}
                {{ $surat->keterangan->alamat }}</td>
        </tr>
    </table>
    <p style="text-indent: 0.5in; text-align: justify">
        Orang Tersebut diatas adalah betul sebagai warga kami dan bermaksud untuk membuat surat keterangan:
    </p>
    <p style="text-indent: 0.5in; text-align: center; font-weight: bold">
        {{ $surat->keterangan->jenis->nama }}
    </p>
    <p style="text-indent: 0.5in; text-align: justify">
        Demikian Surat Pengantar Keterangan ini kami buat dengan sebenarnya agar yang berkepentingan mengetahui dan
        dapat memberikan bantuan seperlunya.
    </p>
    <br>

    <table style="width: 100%; white-space: nowrap; text-align: center">
        <tr>
            <td style="padding-top: 0; padding-bottom: 3px;  white-space: nowrap;">
                Reg No {{ $surat->reg_no ?? '.........................' }}
            </td>
            <td style="padding-top: 0; padding-bottom: 3px;  white-space: nowrap;">
                Wangunsari, {{ Carbon\Carbon::parse($surat->tanggal)->isoFormat('D MMMM Y') }}
            </td>
        </tr>
        <tr>
            <td style="padding-top: 0; padding-bottom: 3px;  white-space: nowrap;">
                Ketua RW {{ $surat->rw->nomor }}
            </td>
            <td style="padding-top: 0; padding-bottom: 3px;  white-space: nowrap;">
                Ketua RT {{ $surat->rt->nomor }}
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <br>
                <br>
            </td>
            <td>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <span style="text-decoration: underline; font-weight: bold">
                    {{ $surat->rw_nama }}</span> <br>NIK. {{ $surat->rw_nik }}
            </td>
            <td>
                <span style="text-decoration: underline; font-weight: bold">
                    {{ $surat->rt_nama }}</span> <br>NIK. {{ $surat->rt_nik }}
            </td>
        </tr>
    </table>
    <p style="text-align: justify">
        <b>Catatan :</b> Bagi Warga Masyarakat yang akan membuat surat-surat ke tingkat Desa, harus dilampiri dengan
        tanda bukti lunas PBB, & Fotocopy Kartu Keluarga (KK).
    </p>
</body>

</html>
