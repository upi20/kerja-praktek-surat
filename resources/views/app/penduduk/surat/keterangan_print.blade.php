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
    <title>SURAT KETERANGAN</title>
    @include('templates.admin.pdf_style')
</head>

<body>
    <table>
        <tr>
            <td>
                <img src="{{ public_path(settings()->get(set_admin('app.foto_light_mode'))) }}" alt=""
                    style="height: 30mm;">
            </td>
            <td>
                <h3 class="p-title">PENGURUS RUKUN TETANGGA (RT) {{ $surat->rt->nomor }}</h3>
                <h3 class="p-title">PENGURUS RUKUN WARGA (Rw) {{ $surat->rw->nomor }}</h3>
                <p class="p-title">Telp:
                    <a href="tel:0227303759">0227303759</a> –
                    <a href="tel:0227900502">0227900502</a> /
                    WA: <a href="https://wa.me/081214886315">081214886315</a> –
                    <a href="https://wa.me/081214939435">081214939435</a>
                </p>
                <p class="p-title">Website: <a href="http://hayatpesta.com">hayatpesta.com</a>
                    / Email: <a href="mailto:INFO@HAYATPESTA.COM">info@hayatpesta.com</a></p>
            </td>
        </tr>
    </table>
    <hr class="garis">
    <h4 class="text-center" style="margin-bottom: 5px">SURAT KETERANGAN</h4>
    <p class="text-center" style="margin-top: 5px">Nomor:
        {{ $surat->nomr ?? '......./RT ....... /' . date('y') . '......' }}
    </p>
    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $surat->nama_untuk_penduduk }}</td>
        </tr>
        <tr>
            <td>Tempat, Tgl. lahir</td>
            <td>:</td>
            <td>
                {{ $surat->keterangan->tempat_lahir }} ,
                {{ Carbon\Carbon::parse($surat->keterangan->tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}
            </td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $surat->keterangan->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td>{{ $surat->keterangan->agama }}</td>
        </tr>
        <tr>
            <td>Status Kawin</td>
            <td>:</td>
            <td>{{ $surat->keterangan->status_kawin }}</td>
        </tr>
        <tr>
            <td>Pendidikan Terakhir</td>
            <td>:</td>
            <td>{{ $surat->keterangan->pendidikan }}</td>
        </tr>
        <tr>
            <td>No. KTP/KTP Sementara</td>
            <td>:</td>
            <td>{{ $surat->nik_untuk_penduduk }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $surat->keterangan->pekerjaan }}</td>
        </tr>
        <tr>
            <td>Alamat Lengkap</td>
            <td>:</td>
            <td>{{ $surat->rt->nomor }} {{ $surat->keterangan->alamat }}</td>
        </tr>
        <tr>
            <td>RT/RW</td>
            <td>:</td>
            <td>/{{ $surat->rw->nomor }}</td>
        </tr>
        <tr>
            <td>Jenis Surrat</td>
            <td>:</td>
            <td>{{ $surat->keterangan->jenis->nama }}</td>
        </tr>
    </table>
</body>

</html>
