@extends('templates.admin.master')

@section('content')
    <div class="card">
        <div class="card-header d-md-flex flex-row justify-content-between">
            <h3 class="card-title">{{ $page_attr['title'] }} Table</h3>
        </div>
        <div class="card-body">
            <p>Surat Berada di :
                <i class="fas fa-circle text-gray me-0 ms-2"></i> PENDUDUK,
                <i class="fas fa-circle text-secondary me-0 ms-2"></i> RUKUN TETANGGA,
                <i class="fas fa-circle text-info me-0 ms-2"></i> RUKUN WARGA,
                <i class="fas fa-circle text-warning me-0 ms-2"></i> PIHAK DESA,
                <i class="fas fa-circle text-success me-0 ms-2"></i> SELESAI,
                <i class="fas fa-circle text-danger me-0 ms-2"></i> DIBATALKAN
            </p>
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
                                <div class="form-group float-start me-2" style="min-width: 250px">
                                    <label for="created_by_filter">Dibuat Oleh</label>
                                    <br>
                                    <select class="form-control" id="created_by_filter" name="created_by_filter"
                                        style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                    </select>
                                </div>

                                <div class="form-group float-start me-2" style="min-width: 250px">
                                    <label for="updated_by_filter">Diubah Oleh</label>
                                    <br>
                                    <select class="form-control" id="updated_by_filter" name="updated_by_filter"
                                        style="width: 100%;">
                                        <option value="" selected>Semua</option>
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
                        <th class="text-nowrap">Penduduk</th>
                        <th class="text-nowrap">Surat</th>
                        <th class="text-nowrap">Pelacakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody> </tbody>

            </table>
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
                        d['filter[updated_by]'] = $('#updated_by_filter').val();
                        d['filter[created_by]'] = $('#created_by_filter').val();
                    }
                },
                columns: [{
                        data: null,
                        name: 'id',
                        orderable: false,
                    },
                    {
                        data: 'nama_untuk_penduduk',
                        name: 'nama_untuk_penduduk',
                        render(data, type, full, meta) {
                            return `<span class="fw-bold">${data}</span><br>
                            <small>${full.nik_untuk_penduduk}</small>`;
                        },
                        className: 'text-nowrap'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis',
                        render(data, type, full, meta) {
                            return `${getStatus(full.status)} <span class="fw-bold">${data}</span><br>
                            <small>${full.tanggal_str}</small>`;
                        },
                        className: 'text-nowrap'
                    },
                    {
                        data: 'tracking_waktu',
                        name: 'tracking_waktu',
                        render(data, type, full, meta) {
                            if (full.tracking_ke_nama != full.tracking_dari_nama) {
                                return `${getStatus(full.tracking_status)}${full.tracking_waktu_format}<br><small>Diserahkan ke bpk/ibu ${full.tracking_ke_nama} dari bpk/ibu ${full.tracking_dari_nama} ${full.tracking_keterangan}</small>`;
                            } else {
                                return `${getStatus(full.tracking_status)}${full.tracking_waktu_format}<br><small>${full.tracking_dari_nama}: ${full.tracking_keterangan}</small>`;
                            }
                        },
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render(data, type, full, meta) {
                            const btn_update = `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-primary btn-sm me-1" title="Detail Pelacakan" onClick="editFunc('${data}')">
                                <i class="fas fa-eye"></i>
                                </button>`;
                            const btn_delete = `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-danger btn-sm me-1" title="Batalkan Surat" onClick="deleteFunc('${data}')">
                                <i class="fas fa-times"></i>
                                </button>`;
                            return btn_update + btn_delete;
                        },
                        className: 'text-nowrap',
                        orderable: false,
                    }
                ],
                order: [
                    [3, 'desc']
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

        function getStatus(status) {
            switch (status) {
                case 'PENDUDUK':
                    return '<i class="fas fa-circle text-gray me-1 ms-0"></i>';
                    break;
                case 'RUKUN TETANGGA':
                    return '<i class="fas fa-circle text-secondary me-1 ms-0"></i>';
                    break;
                case 'RUKUN WARGA':
                    return '<i class="fas fa-circle text-info me-1 ms-0"></i>';
                    break;
                case 'PIHAK DESA':
                    return '<i class="fas fa-circle text-warning me-1 ms-0"></i>';
                    break;
                case 'SELESAI':
                    return '<i class="fas fa-circle text-success me-1 ms-0"></i>';
                    break;
                case 'DIBATALKAN':
                    return '<i class="fas fa-circle text-danger me-1 ms-0"></i>';
                    break;

                default:
                    return '';
                    break;
            }


        }
    </script>
@endsection
