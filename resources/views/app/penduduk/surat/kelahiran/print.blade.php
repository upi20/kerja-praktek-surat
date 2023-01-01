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

        .tbl_calon td {
            padding-bottom: 0px;
        }

        .tbl_calon {
            margin: 0;
        }
    </style>
</head>

<body style="font-size: 14px">
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
    <h4 class="text-center" style="margin-bottom: 5px; text-decoration: underline">
        SURAT PENGANTAR KETERANGAN KELAHIRAN
    </h4>
    <p class="text-center" style="margin-top: 5px">Nomor:
        {{ $surat->no_surat ?? '......./RT ....... / ....... /' . date('y') . '......' }}
    </p>
    <p style="text-indent: 0.5in; text-align: justify; margin-bottom: 0">
        Yang bertanda tangan dibawah ini, kami ketua RT {{ $surat->rt->nomor }} RW {{ $surat->rw->nomor }}
        Desa Wangunsari Kecamatan Lembang Kabupaten Bandung Barat, Dengan ini menerangkan bahwa :
    </p>
    {{-- body --}}
    <table>
        {{-- anak --}}
        <tr style="padding: 0">
            <td style="padding-top: 10px">1.</td>
            <td style="padding: 0">
                <table>
                    <tr style="padding: 0">
                        <td style="padding: 2px 0">Nama</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->nama_anak }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Tempat, Tanggal lahir</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->kelahiran->tempat_lahir }} ,
                            {{ Carbon\Carbon::parse($surat->kelahiran->tanggal_lahir)->isoFormat('D MMMM Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Hari</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ Carbon\Carbon::parse($surat->kelahiran->tanggal_lahir)->isoFormat('dddd') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Pukul</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ date('H:i', strtotime($surat->kelahiran->waktu)) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Jenis Kelamin</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Anak Ke</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->anak_ke }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Berat</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->berat }} <b>GRAM</b></td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Panjang</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->panjang }} <b>CM</b></td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- ayah --}}
        <tr style="padding: 0">
            <td style="padding-top: 10px">2.</td>
            <td style="padding: 0">
                <table>
                    <tr style="padding: 0">
                        <td style="padding: 2px 0">Nama <b>Ayah</b></td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->ayah_nama }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Tempat, Tanggal lahir</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->kelahiran->ayah_tempat_lahir }} ,
                            {{ Carbon\Carbon::parse($surat->kelahiran->ayah_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Agama</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->kelahiran->ayah_agama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Pekerjaan</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->ayah_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Alamat</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->ayah_alamat }}</td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- ibu --}}
        <tr style="padding: 0">
            <td style="padding-top: 10px">3.</td>
            <td style="padding: 0">
                <table>
                    <tr style="padding: 0">
                        <td style="padding: 2px 0">Nama <b>Ibu</b></td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->ibu_nama }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Tempat, Tanggal lahir</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->kelahiran->ibu_tempat_lahir }} ,
                            {{ Carbon\Carbon::parse($surat->kelahiran->ibu_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Agama</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->kelahiran->ibu_agama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Pekerjaan</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->ibu_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0">Alamat</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->kelahiran->ibu_alamat }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    {{-- body --}}
    <p style="text-indent: 0.5in; text-align: justify">
        Anak tersebut diatas adalah benar sebagai anak kandung dari kedua orang tua tersebut dibawahnya dan mohon
        diberikan Surat Keterangan Kelahiran dari Kantor Desa Wangun Sari.
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
