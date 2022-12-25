@extends('templates.admin.master')

@section('content')
    <div class="card">
        <div class="card-header d-md-flex flex-row justify-content-between">
            <h3 class="card-title">{{ $page_attr['title'] }} Table</h3>
            <a type="button" class="btn btn-rounded btn-success btn-sm" href="{{ route(h_prefix('pengajuan', 1)) }}">
                <i class="fas fa-edit"></i> Pengajuan Surat
            </a>
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
                        <th class="text-nowrap">Surat</th>
                        <th class="text-nowrap">Penduduk</th>
                        <th class="text-nowrap">Pelacakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody> </tbody>

            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-detail-title">Detail Pelacakan Surat</h6><button aria-label="Close"
                        class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <ul class="task-list" id="list_tracking"></ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-batalkan">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-batalkan-title"></h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="MainForm" name="MainForm" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label class="form-label" for="alasan_dibatalkan">Alasan Dibatalkan
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="alasan_dibatalkan" name="alasan_dibatalkan" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save" form="MainForm">
                        <i class="fas fa-save mr-1"></i> Kirim
                    </button>
                    <button class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Close
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
        const status_surat = JSON.parse(`{!! json_encode(config('app.status_surats')) !!}`);
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
                responsive: true,
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
                        data: 'jenis',
                        name: 'jenis',
                        render(data, type, full, meta) {
                            return `${getStatus(full.status)} <span class="fw-bold">${data}</span><br>
                            <small>${full.tanggal_str}</small>`;
                        },
                        className: 'text-nowrap'
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
                            const btn_detail_tracking = `<button type="button" data-toggle="tooltip" class="btn  mt-1 btn-rounded btn-primary btn-sm me-1" title="Detail Pelacakan" onClick="detailFunc('${data}')">
                                <i class="fas fa-list"></i>
                                </button>`;

                            const btn_detail = `<a href="{{ url(h_prefix_uri('surat', 1)) }}/${jenisSuratLink(full.jenis)}/detail/${data}" data-toggle="tooltip" class="btn  mt-1 btn-rounded btn-info btn-sm me-1" title="Detail Surat">
                                <i class="fas fa-file-alt"></i>
                                </a>`;

                            const btn_print = `<a href="{{ url(h_prefix_uri('surat', 1)) }}/${jenisSuratLink(full.jenis)}/print/${data}" data-toggle="tooltip" class="btn  mt-1 btn-rounded btn-success btn-sm me-1" title="Print Surat" target="_blank">
                                <i class="fas fa-print"></i>
                                </a>`;

                            const bisa_perbaikan = full.status == status_surat[0];
                            const btn_perbaikan = bisa_perbaikan ? `<a href="{{ url(h_prefix_uri('surat', 1)) }}/${jenisSuratLink(full.jenis)}/perbaiki/${data}" data-toggle="tooltip" class="btn  mt-1 btn-rounded btn-warning btn-sm me-1" title="Perbaiki Surat">
                                <i class="fas fa-check"></i>
                                </a>` : '';

                            const bisa_dibatalkan = full.status == status_surat[0] || full.status ==
                                status_surat[1] || full.status == status_surat[2];
                            const btn_batalkan = bisa_dibatalkan ? `<button type="button" data-toggle="tooltip" class="btn  mt-1 btn-rounded btn-danger btn-sm me-1" title="Batalkan Surat" onClick="batalkanFunc('${data}')">
                                <i class="fas fa-times"></i>
                                </button>` : '';
                            return btn_print +
                                btn_detail +
                                btn_detail_tracking +
                                btn_perbaikan +
                                btn_batalkan;
                        },
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

            // batalkan
            $('#MainForm').submit(function(e) {
                e.preventDefault();
                resetErrorAfterInput();
                var formData = new FormData(this);
                setBtnLoading('button[form=MainForm]', 'Kirim');
                $.ajax({
                    type: "POST",
                    url: "{{ route(h_prefix('batalkan_surat')) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $("#modal-default").modal('hide');
                        var oTable = table_html.dataTable();
                        oTable.fnDraw(false);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Surat Berhasil Dikirim',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error: function(data) {
                        const res = data.responseJSON ?? {};
                        errorAfterInput = [];
                        for (const property in res.errors) {
                            errorAfterInput.push(property);
                            setErrorAfterInput(res.errors[property], `#${property}`);
                        }
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: res.message ?? 'Something went wrong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    complete: function() {
                        setBtnLoading('button[form=MainForm]',
                            '<i class="fas fa-save mr-1"></i> Kirim', false);
                    }
                });
            });
        });

        function detailFunc(id) {
            $.LoadingOverlay("show");
            $.ajax({
                type: "GET",
                url: `{{ url(h_prefix_uri('list_tracking')) }}/${id}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (trackings) => {
                    $.LoadingOverlay("hide");
                    $('#modal-detail').modal('show');
                    const container = $('#list_tracking');
                    container.html('');
                    trackings.forEach(tracking => {
                        const color = getStatus(tracking.status, true);
                        let keterangan = '';
                        if (tracking.ke_nama != tracking.dari_nama) {
                            keterangan =
                                `Diserahkan ke bpk/ibu ${tracking.ke_nama} dari bpk/ibu ${tracking.dari_nama} ${tracking.keterangan}`;
                        } else {
                            keterangan = `${tracking.dari_nama}: ${tracking.keterangan}`;
                        }
                        container.append(`<li class="d-sm-flex">
                                <div>
                                    <i class="task-icon bg-${color}"></i>
                                    <h6 class="fw-semibold">${tracking.status}
                                        <span class="text-muted fs-11 mx-2 fw-normal">${tracking.waktu}</span>
                                    </h6>
                                    <p class="text-muted fs-12"> ${keterangan} </p>
                                </div>
                            </li> `);
                    });
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

        function batalkanFunc(id) {
            $('#modal-batalkan-title').html("Batalkan Pengajuan Surat");
            $('#modal-batalkan').modal('show');
            $('#id').val(id);
            $('#keterangan').attr('placeholder', '');
            resetErrorAfterInput();
            return true;
        }
    </script>
@endsection
