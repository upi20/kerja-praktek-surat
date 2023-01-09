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
            padding-bottom: 0px;
        }

        #my-table {
            margin: 0;
            padding: 0;
        }

        #pengikut {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #pengikut td,
        #pengikut th {
            border: 1px solid black;
            padding: 3px;
        }

        #pengikut th {
            padding-top: 0px;
            padding-bottom: 0px;
            text-align: center;
            vertical-align: middle;
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
    <h4 class="text-center" style="margin-bottom: 5px; text-decoration: underline">
        SURAT PENGANTAR KETERANGAN PINDAH
    </h4>
    <p class="text-center" style="margin-top: 5px">Nomor:
        {{ $surat->no_surat ?? '......./RT ....... / ....... /' . date('y') . '......' }}
    </p>
    <p style="text-indent: 0.5in; text-align: justify; margin-bottom: 0">
        Yang bertanda tangan dibawah ini, kami ketua RT {{ $surat->rt->nomor }} RW {{ $surat->rw->nomor }}
        Desa Wangunsari Kecamatan Lembang Kabupaten Bandung Barat, Dengan ini menerangkan bahwa :
    </p>
    <br>
    <table id="my-table">
        <tr>
            <td style="white-space: nowrap; padding: 2px 0">Nama</td>
            <td style="padding: 0 5px">:</td>
            <td style="padding: 2px 0">{{ $surat->nama_untuk_penduduk }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap; padding: 2px 0">Jenis Kelamin</td>
            <td style="padding: 0 5px">:</td>
            <td style="padding: 2px 0">{{ $surat->pindah->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap; padding: 2px 0">Tempat/Tgl. lahir</td>
            <td style="padding: 0 5px">:</td>
            <td style="padding: 2px 0">
                {{ $surat->pindah->tempat_lahir }},
                {{ Carbon\Carbon::parse($surat->pindah->tanggal_lahir)->isoFormat('D MMMM Y') }}
            </td>
        </tr>
        <tr>
            <td style="white-space: nowrap; padding: 2px 0">Kewarganegaraan</td>
            <td style="padding: 0 5px">:</td>
            <td style="padding: 2px 0">
                {{ $surat->pindah->warga_negara == 'WNI' ? 'INDONESIA' : $surat->pindah->negara_nama }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap; padding: 2px 0">Agama</td>
            <td style="padding: 0 5px">:</td>
            <td style="padding: 2px 0">{{ $surat->pindah->agama }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap; padding: 2px 0">Pendidikan Terakhir</td>
            <td style="padding: 0 5px">:</td>
            <td style="padding: 2px 0">{{ $surat->pindah->pendidikan }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap; padding: 2px 0">Pekerjaan</td>
            <td style="padding: 0 5px">:</td>
            <td style="padding: 2px 0">{{ $surat->pindah->pekerjaan }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap; padding: 2px 0">Status Perkawinan</td>
            <td style="padding: 0 5px">:</td>
            <td style="padding: 2px 0">{{ $surat->pindah->status_kawin }}</td>
        </tr>
        <tr>
            <td style="white-space: nowrap; padding: 2px 0">Alamat Asal</td>
            <td style="padding: 0 5px">:</td>
            <td style="padding: 2px 0">{{ $surat->pindah->alamat }}</td>
        </tr>
        <tr>
            <td style="padding-left: 0">
                <br>
                Pindah Ke
            </td>
            <td colspan="2">
                <br>
                <table style="padding: 0; margin: 0">
                    <tr>
                        <td style="padding-top: 0">Kp / Jl.</td>
                        <td style="padding: 0 5px">:</td>
                        <td style="padding: 0">
                            {{ $surat->pindah->ke_alamat_lengkap }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">RT/RW</td>
                        <td style="padding: 0 5px">:</td>
                        <td style="padding: 0">
                            {{ $surat->pindah->ke_rt }}/{{ $surat->pindah->ke_rw }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Desa / Kel.</td>
                        <td style="padding: 0 5px">:</td>
                        <td style="padding: 0">
                            {{ $surat->pindah->ke_desa_kel }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Kecamatan</td>
                        <td style="padding: 0 5px">:</td>
                        <td style="padding: 0">
                            {{ $surat->pindah->ke_kecamatan }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Kabupaten / Kota</td>
                        <td style="padding: 0 5px">:</td>
                        <td style="padding: 0">
                            {{ $surat->pindah->ke_kab_kota }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0">Provinsi</td>
                        <td style="padding: 0 5px">:</td>
                        <td style="padding: 0">
                            {{ $surat->pindah->ke_provinsi }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table>

    </table>

    <p>Alasan Pindah : {{ $surat->pindah->alasan_pindah }} <br>
        Pengikut : <b>{{ $surat->pindah->pengikuts->count() }}</b> Orang
    </p>
    @if ($surat->pindah->pengikuts->count() > 0)
        <table id="pengikut">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur / Tahun</th>
                    <th>Pekerjaan</th>
                    <th>Pendidikan</th>
                    <th>Ket.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surat->pindah->pengikuts as $i => $pengikut)
                    <tr>
                        <td style="vertical-align: middle; text-align: center">{{ ++$i }}</td>
                        <td>{{ $pengikut->nama }}</td>
                        <td>{{ $pengikut->jenis_kelamin }}</td>
                        <td>{{ Carbon\Carbon::parse($pengikut->tanggal_lahir)->age }} Tahun</td>
                        <td>{{ $pengikut->pekerjaan }}</td>
                        <td>{{ $pengikut->pendidikan }}</td>
                        <td>{{ $pengikut->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

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
