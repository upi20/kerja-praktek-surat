@extends('templates.admin.master')
@section('content')
    <div class="card">
        <div class="card-header bg-info d-md-flex flex-row justify-content-between">
            <h3 class="card-title text-light">{{ $page_attr['title'] }}</h3>
            <div>
                <a type="button" class="btn btn-rounded btn-gray btn-sm" href="{{ url()->previous() }}">
                    <i class="fe fe-arrow-left"></i> Kembali
                </a>
                <a type="button" class="btn btn-rounded btn-success btn-sm"
                    href="{{ route(h_prefix('print', 2), $surat->id) }}">
                    <i class="fas fa-print"></i> Cetak
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <td>RT/RW</td>
                    <td>:</td>
                    <td>{{ $surat->rt->nomor }}/{{ $surat->rw->nomor }}</td>
                </tr>
                <tr>
                    <td>Penduduk Yang Mengajukan</td>
                    <td>:</td>
                    <td>{{ $surat->nama_penduduk }}<br>
                        <small>{{ $surat->nik_penduduk }}</small>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan</td>
                    <td>:</td>
                    <td>
                        {{ Carbon\Carbon::parse($surat->tanggal)->isoFormat('dddd, D MMMM Y') }}
                    </td>
                </tr>
                @if ($surat->dibatalkan)
                    <tr>
                        <td>Dibatalkan</td>
                        <td>:</td>
                        <td>
                            {{ $surat->alasan_dibatalkan }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Dibatalkan</td>
                        <td>:</td>
                        <td>
                            {{ Carbon\Carbon::parse($surat->tanggal_dibatalkan)->isoFormat('dddd, D MMMM Y') }}
                            {{ date('H:i:s', strtotime($surat->tanggal_dibatalkan)) }}
                        </td>
                    </tr>
                @endif

                {{-- calon a --}}
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>
                        <h4 class="card-title mb-1">Calon A </h4>
                    </td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->calon_a }}
                    </td>
                </tr>
                <tr>
                    <td>Nomor Induk Kependudukan</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->anak_nik }}
                    </td>
                </tr>
                <tr>
                    <td>No. Kartu Keluarga</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->anak_no_kk }}
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->anak_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal lahir</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->anak_tempat_lahir }} ,
                        {{ Carbon\Carbon::parse($surat->nikah->anak_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}
                    </td>
                </tr>
                <tr>
                    <td>Warganegara</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->anak_warga_negara == 'WNI' ? 'INDONESIA' : $surat->nikah->anak_negara_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->anak_agama }}</td>
                </tr>
                <tr>
                    <td>Status Perkawinan</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->anak_status_kawin }}</td>
                </tr>
                <tr>
                    <td>Pendidikan Terakhir</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->anak_pendidikan }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->anak_pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->anak_alamat }}</td>
                </tr>

                {{-- orang tua --}}
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h4 class="card-title mb-1">Orang Tua</h4>
                        Data diatas adalah betul anak kandung dari seorang <b>Ayah</b> dan <b>Ibu</b>
                    </td>
                </tr>

                {{-- ayah --}}
                <tr>
                    <td colspan="3">
                        <h5 class="card-title mb-1">Ayah</h5>
                    </td>
                </tr>
                <tr>
                    <td>Nomor Induk Kependudukan</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->ayah_nik }}
                    </td>
                </tr>
                <tr>
                    <td>Nama <b>Ayah</b></td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->ayah_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal lahir/Umur</td>
                    <td>:</td>
                    <td>
                        {{ Carbon\Carbon::parse($surat->nikah->ayah_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }} /
                        {{ $ayah_umur }} Tahun
                    </td>
                </tr>
                <tr>
                    <td>Warganegara</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->ayah_warga_negara == 'WNI' ? 'INDONESIA' : $surat->nikah->ayah_negara_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->ayah_agama }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->ayah_pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->ayah_alamat }}</td>
                </tr>



                {{-- ibu --}}
                <tr>
                    <td colspan="3">
                        <h5 class="card-title mb-1">Ibu</h5>
                    </td>
                </tr>
                <tr>
                    <td>Nomor Induk Kependudukan</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->ibu_nik }}
                    </td>
                </tr>
                <tr>
                    <td>Nama <b>Ayah</b></td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->ibu_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal lahir/Umur</td>
                    <td>:</td>
                    <td>
                        {{ Carbon\Carbon::parse($surat->nikah->ibu_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }} /
                        {{ $ibu_umur }} Tahun
                    </td>
                </tr>
                <tr>
                    <td>Warganegara</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->ibu_warga_negara == 'WNI' ? 'INDONESIA' : $surat->nikah->ibu_negara_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->ibu_agama }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->ibu_pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->ibu_alamat }}</td>
                </tr>

                {{-- Keterangan --}}
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h4 class="card-title mb-1">Keterangan </h4>
                        Orang tersebut diatas akan melangsungkan pernikahan pada
                        Hari: <b>{{ Carbon\Carbon::parse($surat->nikah->tanggal)->isoFormat('dddd') }}</b>
                        Tanggal: <b>{{ Carbon\Carbon::parse($surat->nikah->tanggal)->isoFormat('D MMMM Y') }}</b>
                        Pukul: <b>{{ date('H:i', strtotime($surat->nikah->waktu)) }}</b>
                        Dengan Seorang <b>{{ $surat->nikah->dengan_seorang }}</b>

                    </td>
                </tr>


                {{-- calon b --}}
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>
                        <h4 class="card-title mb-1">Calon B </h4>
                    </td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->calon_b }}
                    </td>
                </tr>
                <tr>
                    <td>Nomor Induk Kependudukan</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->calon_nik }}
                    </td>
                </tr>
                <tr>
                    <td>No. Kartu Keluarga</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->calon_no_kk }}
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->calon_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal lahir</td>
                    <td>:</td>
                    <td>
                        {{ $surat->nikah->calon_tempat_lahir }} ,
                        {{ Carbon\Carbon::parse($surat->nikah->calon_tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}
                    </td>
                </tr>
                <tr>
                    <td>Warganegara</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->calon_warga_negara == 'WNI' ? 'INDONESIA' : $surat->nikah->calon_negara_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->calon_agama }}</td>
                </tr>
                <tr>
                    <td>Status Perkawinan</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->calon_status_kawin }}</td>
                </tr>
                <tr>
                    <td>Pendidikan Terakhir</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->calon_pendidikan }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->calon_pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $surat->nikah->calon_alamat }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-info d-md-flex flex-row justify-content-between">
            <h3 class="card-title text-light">Tracking Surat</h3>
            <div>
                <a type="button" class="btn btn-rounded btn-gray btn-sm" href="{{ url()->previous() }}">
                    <i class="fe fe-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <ul class="task-list">
                @foreach ($trackings ?? [] as $tracking)
                    @php
                        $keterangan = '';
                        if ($tracking->ke_nama != $tracking->dari_nama) {
                            $keterangan = "Diserahkan ke bpk/ibu $tracking->ke_nama dari bpk/ibu $tracking->dari_nama $tracking->keterangan";
                        } else {
                            $keterangan = "$tracking->dari_nama: $tracking->keterangan";
                        }
                    @endphp
                    <li class="d-sm-flex">
                        <div>
                            <i class="task-icon bg-{{ color_status_surat($tracking->status) }}"></i>
                            <h6 class="fw-semibold">{{ $tracking->status }}
                                <span class="text-muted fs-11 mx-2 fw-normal">{{ $tracking->waktu }}</span>
                            </h6>
                            <p class="text-muted fs-12"> {!! $keterangan !!} </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/templates/admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/templates/admin/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/templates/admin/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/templates/admin/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/templates/admin/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    {{-- loading --}}
    <script src="{{ asset('assets/templates/admin/plugins/loading/loadingoverlay.min.js') }}"></script>

    {{-- sweetalert --}}
    <script src="{{ asset('assets/templates/admin/plugins/sweet-alert/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('assets/templates/admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
