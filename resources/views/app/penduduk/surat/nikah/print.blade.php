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
        SURAT PENGANTAR KETERANGAN NIKAH
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
        <tr>
            <td>
                1. Calon : <b>{{ $surat->nikah->calon_a }}</b>
            </td>
            <td style="padding: 0">
                <table class="tbl_calon">
                    <tr>
                        <td style="padding-top: 0">Nama</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->anak_nama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Tempat, Tanggal lahir</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->anak_tempat_lahir }} ,
                            {{ Carbon\Carbon::parse($surat->nikah->anak_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Warganegara / Agama</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->anak_warga_negara == 'WNI' ? 'INDONESIA' : $surat->nikah->anak_negara_nama }}
                            / {{ $surat->nikah->anak_agama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Pendidikan Terakhir</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->anak_pendidikan }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">No. KTP/KTP Sementara</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->anak_nik }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">No. Kartu Keluarga</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->anak_no_kk }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Status Perkawinan</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->anak_status_kawin }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Pekerjaan</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->anak_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Alamat</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->anak_alamat }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- orang tua --}}
    <p style="text-indent: 0.5in; text-align: justify; margin-bottom: 0">
        Adalah betul anak kandung dari seorang <b>Ayah</b> dan <b>Ibu</b>:
    </p>
    <table style="padding: 0">
        <tr style="padding: 0">
            <td style="padding: 0">
                <table class="tbl_calon">
                    <tr>
                        <td style="padding-top: 0">Nama <b>Ayah</b></td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->ayah_nama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Tgl. Lahir/Umur</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ Carbon\Carbon::parse($surat->nikah->ayah_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}
                            / {{ $ayah_umur }} Tahun
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Warganegara</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->ayah_warga_negara == 'WNI' ? 'INDONESIA' : $surat->nikah->ayah_negara_nama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Agama</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->ayah_agama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Pekerjaan</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->ayah_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Alamat</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->ayah_alamat }}</td>
                    </tr>

                </table>
            </td>
            <td style="padding: 0">
                <table class="tbl_calon">
                    <tr>
                        <td style="padding-top: 0">Nama <b>Ibu</b></td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->ibu_nama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Tgl. Lahir/Umur</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ Carbon\Carbon::parse($surat->nikah->ibu_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}
                            / {{ $ibu_umur }} Tahun
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Warganegara</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->ibu_warga_negara == 'WNI' ? 'INDONESIA' : $surat->nikah->ibu_negara_nama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Agama</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->ibu_agama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Pekerjaan</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->ibu_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Alamat</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->ibu_alamat }}</td>
                    </tr>

                </table>
            </td>

        </tr>
    </table>

    <p style="margin-bottom: 0"> Orang tersebut diatas akan melangsungkan pernikahan pada
        Hari: <b>{{ Carbon\Carbon::parse($surat->nikah->tanggal)->isoFormat('dddd') }}</b>
        Tanggal: <b>{{ Carbon\Carbon::parse($surat->nikah->tanggal)->isoFormat('D MMMM Y') }}</b>
        Pukul: <b>{{ date('H:i', strtotime($surat->nikah->waktu)) }}</b>
        Dengan Seorang <b>{{ $surat->nikah->dengan_seorang }}</b>:</p>

    <table style="margin-top: 0">
        <tr>
            <td style="padding-top: 0">
                2. Calon : <b>{{ $surat->nikah->calon_b }}</b>
            </td>
            <td style="padding: 0">
                <table class="tbl_calon" style="margin: 0; padding: 0">
                    <tr>
                        <td style="padding-top: 0">Nama</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->calon_nama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Tempat, Tanggal lahir</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->calon_tempat_lahir }} ,
                            {{ Carbon\Carbon::parse($surat->nikah->calon_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Warganegara / Agama</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->calon_warga_negara == 'WNI' ? 'INDONESIA' : $surat->nikah->calon_negara_nama }}
                            / {{ $surat->nikah->calon_agama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Pendidikan Terakhir</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->calon_pendidikan }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">No. KTP/KTP Sementara</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->calon_nik }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">No. Kartu Keluarga</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">
                            {{ $surat->nikah->calon_no_kk }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Status Perkawinan</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->calon_status_kawin }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Pekerjaan</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->calon_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Alamat</td>
                        <td style="padding: 0 4px">:</td>
                        <td style="padding: 0">{{ $surat->nikah->calon_alamat }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>



    {{-- body --}}
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
