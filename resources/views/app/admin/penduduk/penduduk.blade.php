@extends('templates.admin.master')

@section('content')
    <div class="card">
        <div class="card-header d-md-flex flex-row justify-content-between">
            <h3 class="card-title">{{ $page_attr['title'] }} Table List</h3>
        </div>
        <div class="card-body">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default active mb-2">
                    <div class="panel-heading " role="tab" id="headingOne1">
                        <h4 class="panel-title">
                            <a role="button" data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapse1"
                                aria-expanded="true" aria-controls="collapse1">
                                Filter Data
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne1">
                        <div class="panel-body">
                            <form action="javascript:void(0)" class="ml-md-3 mb-md-3" id="FilterForm">
                                <div class="form-group float-start me-2">
                                    <label for="created_by_filter">Dibuat Oleh</label>
                                    <br>
                                    <select class="form-control" id="created_by_filter" name="created_by_filter"
                                        style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                    </select>
                                </div>

                                <div class="form-group float-start me-2">
                                    <label for="updated_by_filter">Diubah Oleh</label>
                                    <br>
                                    <select class="form-control" id="updated_by_filter" name="updated_by_filter"
                                        style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                    </select>
                                </div>

                                <div class="form-group float-start me-2" style="max-width: 125px;">
                                    <label for="rt_filter">Rukun Tetangga</label>
                                    <br>
                                    <input type="number" class="form-control" id="rt_filter" name="rt_filter"
                                        style="width: 100%;">
                                </div>

                                <div class="form-group float-start me-2" style="max-width: 125px;">
                                    <label for="rw_filter">Rukun Warga</label>
                                    <br>
                                    <input type="number" class="form-control" id="rw_filter" name="rw_filter"
                                        style="width: 100%;">
                                </div>

                                <div class="form-group float-start me-2">
                                    <label for="jenis_kelamin_filter">Jenis Kelamin</label>
                                    <br>
                                    <select class="form-control filter-select2" id="jenis_kelamin_filter"
                                        name="jenis_kelamin_filter" style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                        <option value="PEREMPUAN">PEREMPUAN</option>
                                        <option value="LAKI-LAKI">LAKI-LAKI</option>
                                    </select>
                                </div>

                                <div class="form-group float-start me-2">
                                    <label for="agama_filter">Agama</label>
                                    <br>
                                    <select class="form-control filter-select2" id="agama_filter" name="agama_filter"
                                        style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                        @foreach ($agamas as $agama)
                                            <option value="{{ $agama }}">{{ $agama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group float-start me-2">
                                    <label for="pendidikan_filter">Pendidikan</label>
                                    <br>
                                    <select class="form-control filter-select2" id="pendidikan_filter"
                                        name="pendidikan_filter" style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                        @foreach ($pendidikans as $pendidikan)
                                            <option value="{{ $pendidikan }}">{{ $pendidikan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group float-start me-2">
                                    <label for="pekerjaan_filter">Pekerjaan</label>
                                    <br>
                                    <select class="form-control filter-select2" id="pekerjaan_filter"
                                        name="pekerjaan_filter" style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                        @foreach ($pekerjaans as $pekerjaan)
                                            <option value="{{ $pekerjaan }}">{{ $pekerjaan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group float-start me-2">
                                    <label for="status_kawin_filter">Status Kawin</label>
                                    <br>
                                    <select class="form-control filter-select2" id="status_kawin_filter"
                                        name="status_kawin_filter" style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                        <option value="KAWIN">KAWIN</option>
                                        <option value="BELUM KAWIN">BELUM KAWIN</option>
                                    </select>
                                </div>

                                <div class="form-group float-start me-2">
                                    <label for="hub_dgn_kk_filter">Hubungan Dengan KK</label>
                                    <br>
                                    <select class="form-control filter-select2" id="hub_dgn_kk_filter"
                                        name="hub_dgn_kk_filter" style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                        @foreach ($hub_dgn_kks as $hub_dgn_kk)
                                            <option value="{{ $hub_dgn_kk['nama'] }}">{{ $hub_dgn_kk['nama'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group float-start me-2">
                                    <label for="warga_negara_filter">Warga Negara</label>
                                    <br>
                                    <select class="form-control filter-select2" id="warga_negara_filter"
                                        name="warga_negara_filter" style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                        <option value="WNI">Warga Negara Indonesia</option>
                                        <option value="WNA">Warga Negara Asing</option>
                                    </select>
                                </div>
                            </form>
                            <div style="clear: both"></div>
                            <button type="submit" form="FilterForm" class="btn btn-rounded btn-md btn-info"
                                data-toggle="tooltip" title="Refresh Filter Table">
                                <i class="bi bi-arrow-repeat"></i> Terapkan filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover" id="tbl_main">
                <thead>
                    <tr>
                        <th class="text-nowrap">No</th>
                        <th class="text-nowrap">Nama/NIK</th>
                        <th class="text-nowrap">Tempat, Tgl Lahir</th>
                        <th class="text-nowrap">Jenis Kelamin</th>
                        <th class="text-nowrap">RT</th>
                        <th class="text-nowrap">RW</th>
                        <th class="text-nowrap">Diubah</th>
                        <th class="text-nowrap">Detail</th>
                    </tr>
                </thead>
                <tbody> </tbody>

            </table>
        </div>
    </div>

    <!-- End Row -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-default-title"></h6><button aria-label="Tutup" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body"> </div>
                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Tutup
                    </button>
                </div>
            </div>
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

    <script>
        const table_html = $('#tbl_main');
        let isEdit = true;
        $(document).ready(function() {

            $('#created_by_filter').select2({
                ajax: {
                    url: "{{ route('user_select2') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    }
                }
            });

            $('#updated_by_filter').select2({
                ajax: {
                    url: "{{ route('user_select2') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    }
                }
            });

            $('.filter-select2').select2();

            // datatable ====================================================================================
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const new_table = table_html.DataTable({
                searchDelay: 500,
                processing: true,
                serverSide: true,
                // responsive: true,
                scrollX: true,
                aAutoWidth: false,
                bAutoWidth: false,
                type: 'GET',
                ajax: {
                    url: "{{ route(h_prefix()) }}",
                    data: function(d) {
                        d['filter[created_by]'] = $('#created_by_filter').val();
                        d['filter[updated_by]'] = $('#updated_by_filter').val();
                        d['filter[jenis_kelamin]'] = $('#jenis_kelamin_filter').val();
                        d['filter[agama]'] = $('#agama_filter').val();
                        d['filter[pendidikan]'] = $('#pendidikan_filter').val();
                        d['filter[pekerjaan]'] = $('#pekerjaan_filter').val();
                        d['filter[status_kawin]'] = $('#status_kawin_filter').val();
                        d['filter[hub_dgn_kk]'] = $('#hub_dgn_kk_filter').val();
                        d['filter[warga_negara]'] = $('#warga_negara_filter').val();
                        d['filter[rt]'] = $('#rt_filter').val();
                        d['filter[rw]'] = $('#rw_filter').val();
                    }
                },
                columns: [{
                        data: null,
                        name: 'id',
                        orderable: false,
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        render(data, type, full, meta) {
                            return `<span class="fw-bold">${data}</span><br>
                            <small>${full.nik}</small>`;
                        },
                        className: 'text-nowrap'
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir',
                        render(data, type, full, meta) {
                            return `<span class="fw-bold">${full.tempat_lahir}</span><br>
                            <small>${full.tanggal_lahir_str}</small>`;
                        },
                        className: 'text-nowrap'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        className: 'text-nowrap'
                    },
                    {
                        data: 'rt',
                        name: 'rt',
                        className: 'text-nowrap'
                    },
                    {
                        data: 'rw',
                        name: 'rw',
                        className: 'text-nowrap'
                    },
                    {
                        data: 'updated',
                        name: 'updated_by_str',
                        render(data, type, full, meta) {
                            const tanggal = data ?? full.created;
                            const oleh = full.updated_by_str ?? full.created_by_str
                            return `${oleh? `${oleh}<br>` : ''}<small>${tanggal}</small>`;
                        },
                        className: 'text-nowrap'
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        render(data, type, full, meta) {
                            return `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-info btn-sm me-1" title="Lihat Data" onClick="viewFunc('${data}')">
                                <i class="fas fa-eye"></i>
                                </button>`;
                        },
                        className: 'text-nowrap',
                        orderable: false,
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                language: {
                    url: datatable_indonesia_language_url
                }
            });

            new_table.on('draw.dt', function() {
                tooltip_refresh();
                var PageInfo = table_html.DataTable().page.info();
                new_table.column(0, {
                    page: 'current'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });

            $('#FilterForm').submit(function(e) {
                e.preventDefault();
                var oTable = table_html.dataTable();
                oTable.fnDraw(false);
            });
        });

        function viewFunc(nik) {
            $.LoadingOverlay("show");
            $.ajax({
                type: "GET",
                url: `{{ url(h_prefix_uri('find')) }}/${nik}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (penduduk) => {
                    $('#modal-default-title').html("Lihat {{ $page_attr['title'] }}");
                    $('#modal-default').modal('show');
                    $('#modal-default').find('.modal-body').html(`
                        <table class="table">
                            <tr>
                                <td >Nomor Induk Kependudukan</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.nik}</td>
                            </tr>
                            <tr>
                                <td >NO Kartu Keluarga</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.no_kk}</td>
                            </tr>
                            <tr>
                                <td >Hubungan Dengan KK</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.hub_dgn_kk}</td>
                            </tr>
                            <tr>
                                <td >Nama Lengkap</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.nama}</td>
                            </tr>
                            <tr>
                                <td >Tempat, Tanggal lahir</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.tempat_lahir}, ${penduduk.tanggal_lahir_text}</td>
                            </tr>
                            <tr>
                                <td >Jenis Kelamin</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.jenis_kelamin}</td>
                            </tr>
                            <tr>
                                <td >Agama</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.agama}</td>
                            </tr>
                            <tr>
                                <td >Pendidikan</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.pendidikan}</td>
                            </tr>
                            <tr>
                                <td >Pekerjaan</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.pekerjaan}</td>
                            </tr>
                            <tr>
                                <td >Status Kawin</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.status_kawin}</td>
                            </tr>
                            <tr>
                                <td >Kewarganegaraan</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.warga_negara}</td>
                            </tr>
                            <tr>
                                <td >Nama Negara</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.negara_nama}</td>
                            </tr>
                            <tr>
                                <td >RT/RW</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.rt.nomor}/${penduduk.rt.rw.nomor}/</td>
                            </tr>
                            <tr>
                                <td >Alamat Lengkap</td>
                                <td style="width: 10px; text-align: center">:</td>
                                <td>${penduduk.alamat}</td>
                            </tr>
                        </table>
                    `);
                },
                error: function(data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Something went wrong',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                complete: function() {
                    $.LoadingOverlay("hide");
                }
            });

        }
    </script>
@endsection
