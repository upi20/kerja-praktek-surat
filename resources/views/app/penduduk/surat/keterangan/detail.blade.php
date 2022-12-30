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
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>
                        {{ Carbon\Carbon::parse($surat->tanggal)->isoFormat('dddd, D MMMM Y') }}
                    </td>
                </tr>
                <tr>
                    <td>Nomor Induk Kependudukan</td>
                    <td>:</td>
                    <td>{{ $surat->nik_untuk_penduduk }}</td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td>{{ $surat->nama_untuk_penduduk }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal lahir</td>
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
                    <td>Warganegara</td>
                    <td>:</td>
                    <td>{{ $surat->keterangan->warga_negara == 'WNI' ? 'INDONESIA' : $surat->keterangan->negara_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $surat->keterangan->agama }}</td>
                </tr>
                <tr>
                    <td>Status Perkawinan</td>
                    <td>:</td>
                    <td>{{ $surat->keterangan->status_kawin }}</td>
                </tr>
                <tr>
                    <td>Pendidikan Terakhir</td>
                    <td>:</td>
                    <td>{{ $surat->keterangan->pendidikan }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $surat->keterangan->pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Alamat Lengkap</td>
                    <td>:</td>
                    <td>{{ $surat->keterangan->alamat }}</td>
                </tr>
                <tr>
                    <td>Jenis Surrat</td>
                    <td>:</td>
                    <td>{{ $surat->keterangan->jenis->nama }}</td>
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
