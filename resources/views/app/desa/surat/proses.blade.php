@extends('templates.admin.master')

@section('content')
    <div class="card">
        <div class="card-header d-md-flex flex-row justify-content-between">
            <h3 class="card-title">{{ $page_attr['title'] }} Table</h3>
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
                                <input type="hidden" name="tracking_pegawai_id" id="tracking_pegawai_id_filter"
                                    value="{{ $pegawai->id }}">
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
                        <th class="text-nowrap">Dari</th>
                        <th class="text-nowrap">Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody> </tbody>

            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-default-title"></h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="MainForm" name="MainForm" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <label for="pegawai_id" class="form-label">Pegawai
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" id="pegawai_id" name="pegawai_id" style="width: 100%;"
                            required></select>

                        <div class="form-group">
                            <label class="form-label" for="keterangan">Keterangan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                placeholder="Contoh: untuk diperiksa dan diproses" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="catatan">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                        <label class="custom-control custom-checkbox-md float-start me-2">
                            <input type="checkbox" class="custom-control-input" name="selesai" id="selesai">
                            <span class="custom-control-label">Set Surat Selesai</span>
                        </label>
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

            $('#pegawai_id').select2({
                ajax: {
                    url: "{{ route(h_prefix('pegawai')) }}",
                    type: "GET",
                    data: function(params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    }
                },
                placeholder: "Jabatan Atau Nama Pegawai",
                dropdownParent: $('#modal-default'),
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
                        d['filter[tracking_pegawai_id]'] = $('#tracking_pegawai_id_filter').val();
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
                            return `<span class="fw-bold">${data}</span><br>
                            <small>${full.tanggal_str}</small>`;
                        },
                        className: 'text-nowrap'
                    },
                    {
                        data: 'tracking_waktu',
                        name: 'tracking_waktu',
                        render(data, type, full, meta) {
                            return `${full.tracking_dari_nama}<br>
                            <small>${full.tracking_waktu_format}</small>`;
                        },
                    },
                    {
                        data: 'tracking_keterangan',
                        name: 'tracking_keterangan',
                        render(data, type, full, meta) {
                            return `${data}` + (full.tracking_catatan ?
                                `<br><small>${full.tracking_catatan}</small>` : '');
                        },
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render(data, type, full, meta) {
                            const selesai = full.tracking_status == 'SELESAI';
                            const btn_lihat = `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-primary btn-sm me-1" title="Detail Pelacakan" onClick="lihatFunc('${data}')">
                                <i class="fas fa-eye"></i>
                                </button>`;

                            const btn_kirim = !selesai ? `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-warning btn-sm me-1" title="Kirim Surat Ke Pegawai Lain" onClick="kirimFunc('${data}')">
                                <i class="far fa-paper-plane"></i>
                                </button>` : '';

                            const btn_selesai = !selesai ? `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-danger btn-sm me-1" title="Set Surat Selesai" onClick="selesaiFunc('${full.id}')">
                                <i class="fas fa-check"></i>
                                </button>` : '';

                            const btn_serahkan = selesai ? `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-success btn-sm me-1" title="Serahkan Surat Kepada Penduduk" onClick="serahkanFunc('${full.id}')">
                                <i class="fas fa-hand-holding"></i>
                                </button>` : '';
                            return btn_lihat + btn_kirim + btn_selesai + btn_serahkan;
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

            $('#MainForm').submit(function(e) {
                e.preventDefault();
                resetErrorAfterInput();
                var formData = new FormData(this);
                setBtnLoading('button[form=MainForm]', 'Kirim');
                $.ajax({
                    type: "POST",
                    url: "{{ route(h_prefix('simpan')) }}",
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

        function kirimFunc(id) {
            $('#modal-default-title').html("Kirim Surat Ke Pegawai Lain");
            $('#modal-default').modal('show');
            $('#id').val(id);
            $('#keterangan').attr('placeholder', 'Contoh: untuk diperiksa dan diproses');
            $('#selesai').prop('checked', false)
            resetErrorAfterInput();
            return true;
        }

        function selesaiFunc(id) {
            swal.fire({
                title: 'Apakah anda yakin?',
                text: "Setelah surat selesai, data tidak bisa di ubah kembali ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: `{{ route(h_prefix('selesai')) }}`,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            swal.fire({
                                title: 'Please Wait..!',
                                text: 'Is working..',
                                onOpen: function() {
                                    Swal.showLoading()
                                }
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Data berhasil disimpan',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var oTable = table_html.dataTable();
                            oTable.fnDraw(false);
                        },
                        complete: function() {
                            swal.hideLoading();
                        },
                        error: function(err, textStatus, errorThrown) {
                            swal.hideLoading();
                            Swal.fire({
                                position: 'center',
                                icon: err.status == 400 ? 'info' : 'error',
                                title: ((err.responseJSON) ? err.responseJSON.message :
                                    'Something went wrong'),
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    });
                }
            });
        }

        function serahkanFunc(id) {
            swal.fire({
                title: 'Apakah anda yakin?',
                text: "Setelah surat diserahkan, data tidak bisa di ubah kembali ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: `{{ route(h_prefix('serahkan')) }}`,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            swal.fire({
                                title: 'Please Wait..!',
                                text: 'Is working..',
                                onOpen: function() {
                                    Swal.showLoading()
                                }
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Data berhasil disimpan',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var oTable = table_html.dataTable();
                            oTable.fnDraw(false);
                        },
                        complete: function() {
                            swal.hideLoading();
                        },
                        error: function(err, textStatus, errorThrown) {
                            swal.hideLoading();
                            Swal.fire({
                                position: 'center',
                                icon: err.status == 400 ? 'info' : 'error',
                                title: ((err.responseJSON) ? err.responseJSON.message :
                                    'Something went wrong'),
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    });
                }
            });
        }
    </script>
@endsection
