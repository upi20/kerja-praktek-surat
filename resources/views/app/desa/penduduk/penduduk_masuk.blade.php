@extends('templates.admin.master')

@section('content')
    @php
        $can_insert = auth_can(h_prefix('insert'));
        $can_update = auth_can(h_prefix('update'));
        $can_delete = auth_can(h_prefix('delete'));
    @endphp

    <div class="card">
        <div class="card-header d-md-flex flex-row justify-content-between">
            <h3 class="card-title">{{ $page_attr['title'] }} Table List</h3>
            @if ($can_insert)
                <button type="button" class="btn btn-rounded btn-success btn-sm" data-bs-effect="effect-scale"
                    data-bs-toggle="modal" href="#modal-default" onclick="add()" data-target="#modal-default">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            @endif
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
                                <div class="form-group float-start me-2" style="min-width: 250px">
                                    <label for="created_by">Dibuat Oleh</label>
                                    <br>
                                    <select class="form-control" id="created_by" name="created_by" style="width: 100%;">
                                        <option value="" selected>Semua</option>
                                    </select>
                                </div>

                                <div class="form-group float-start me-2" style="min-width: 250px">
                                    <label for="updated_by">Diubah Oleh</label>
                                    <br>
                                    <select class="form-control" id="updated_by" name="updated_by" style="width: 100%;">
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
                        <th class="text-nowrap">Keterangan</th>
                        <th class="text-nowrap">Tanggal</th>
                        <th class="text-nowrap">Diubah</th>
                        {!! $can_delete || $can_update ? '<th>Aksi</th>' : '' !!}
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
                <div class="modal-body">
                    <form action="javascript:void(0)" id="MainForm" name="MainForm" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-3">
                            <label for="nik" class="col-sm-3 col-form-label">NIK
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="Nomor Induk Kependudukan"
                                    id="nik" name="nik" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="no_kk" class="col-sm-3 col-form-label">NO KK
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="Nomor Kartu Keluarga"
                                    id="no_kk" name="no_kk">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="agama" class="col-sm-3 col-form-label">Hubungan Dengan KK
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="agama" name="agama">
                                    <option value="">Pilih Hubungan Dengan KK</option>
                                    @foreach (config('app.hub_dgn_kks') as $hub)
                                        <option value="{{ $hub['nama'] }}">{{ $hub['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Nama Lengkap" id="nama"
                                    name="nama" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama" class="col-sm-3 col-form-label">Tempat, Tanggal lahir
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9 d-flex flex-row">
                                <input type="text" class="form-control d-inline me-lg-2" placeholder="Tempat Lahir"
                                    value="" id="tempat_lahir" name="tempat_lahir"required>
                                <input type="date" class="form-control d-inline" placeholder="Tanggal Lahir"
                                    value="" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="agama" class="col-sm-3 col-form-label">Agama
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="agama" name="agama">
                                    <option value="">Pilih Agama</option>
                                    @foreach (config('app.agamas') as $agama)
                                        <option value="{{ $agama }}">{{ $agama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="pendidikan" name="pendidikan" required>
                                    <option value="">Pilih Pendidikan</option>
                                    @foreach (config('app.pendidikans') as $pendidikan)
                                        <option value="{{ $pendidikan }}">{{ $pendidikan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status_kawin" class="col-sm-3 col-form-label">Status Kawin
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="status_kawin" name="status_kawin" required>
                                    <option value="">Pilih Status Kawin</option>
                                    <option value="KAWIN">KAWIN</option>
                                    <option value="BELUM KAWIN">BELUM KAWIN</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="negara_nama" class="col-sm-3 col-form-label">Kewarganegaraan
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="negara_nama" name="negara_nama" required>
                                    <option value="">Pilih Kewarganegaraan</option>
                                    <option value="WNI">Warga Negara Indonesia</option>
                                    <option value="WNA">Warga Negara Asing</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="negara_nama" class="col-sm-3 col-form-label">Nama Negara
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Nama Negara" id="negara_nama"
                                    name="negara_nama" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="rw" class="col-sm-3 col-form-label">RT/RW
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9 d-flex flex-row">
                                <input type="number" class="form-control d-inline me-lg-2" placeholder="Rukun Tetangga"
                                    value="" id="rt" name="rt"required>
                                <input type="number" class="form-control d-inline me-lg-2" placeholder="Rukun Warga"
                                    value="" id="rw" name="rw"required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" placeholder="Nama Negara" id="alamat" name="alamat" required></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save" form="MainForm">
                        <li class="fas fa-save mr-1"></li> Simpan
                    </button>
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
        const can_update = {{ $can_update ? 'true' : 'false' }};
        const can_delete = {{ $can_delete ? 'true' : 'false' }};
        const table_html = $('#tbl_main');
        let isEdit = true;
        $(document).ready(function() {

            $('#created_by').select2({
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

            $('#updated_by').select2({
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
                        d['filter[updated_by]'] = $('#updated_by').val();
                        d['filter[created_by]'] = $('#created_by').val();
                    }
                },
                columns: [{
                        data: null,
                        name: 'id',
                        orderable: false,
                    },
                    {
                        data: 'penduduk_nama',
                        name: 'penduduk_nama',
                        render(data, type, full, meta) {
                            return `<span class="fw-bold">${data}</span><br>
                            <small>${full.penduduk_nik}</small>`;
                        },
                        className: 'text-nowrap'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        render(data, type, full, meta) {
                            return `<span class="fw-bold">${data}</span><br>
                            <small>${full.keterangan??''}</small>`;
                        },
                    },
                    {
                        data: 'tanggal_str',
                        name: 'tanggal',
                        className: 'text-nowrap'
                    },
                    {
                        data: 'updated',
                        name: 'updated_by_str',
                        render(data, type, full, meta) {
                            const tanggal = data ?? full.created;
                            const oleh = full.updated_by_str ?? full.created_by_str
                            return `${oleh ?? ''}<br><small>${tanggal}</small>`;
                        },
                        className: 'text-nowrap'
                    },
                    ...(can_update || can_delete ? [{
                        data: 'id',
                        name: 'id',
                        render(data, type, full, meta) {
                            const btn_update = can_update ? `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-primary btn-sm me-1" title="Ubah Data" onClick="editFunc('${data}')">
                                <i class="fas fa-edit"></i>
                                </button>` : '';
                            const btn_delete = can_delete ? `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-danger btn-sm me-1" title="Hapus Data" onClick="deleteFunc('${data}')">
                                <i class="fas fa-trash"></i>
                                </button>` : '';
                            return btn_update + btn_delete;
                        },
                        className: 'text-nowrap',
                        orderable: false,
                    }] : []),
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


            // insertForm ===================================================================================
            $('#MainForm').submit(function(e) {
                e.preventDefault();
                resetErrorAfterInput();
                var formData = new FormData(this);
                setBtnLoading('#btn-save', 'Save Changes');
                const route = ($('#id').val() == '') ?
                    "{{ route(h_prefix('insert')) }}" :
                    "{{ route(h_prefix('update')) }}";
                $.ajax({
                    type: "POST",
                    url: route,
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
                            title: 'Data saved successfully',
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
                        setBtnLoading('#btn-save',
                            '<li class="fas fa-save mr-1"></li> Simpan',
                            false);
                    }
                });
            });

            $('#jenis').on('select2:select', function(e) {
                $('#kode').val(jenis_kode.get($(this).val()));
            });
        });

        function add() {
            if (!isEdit) return false;
            $('#MainForm').trigger("reset");
            $('#modal-default-title').html("Tambah {{ $page_attr['title'] }}");
            $('#modal-default').modal('show');
            $('#id').val('');
            resetErrorAfterInput();
            isEdit = false;
            return true;
        }

        function editFunc(id) {
            $.LoadingOverlay("show");
            $.ajax({
                type: "GET",
                url: `{{ route(h_prefix('find')) }}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id
                },
                success: (data) => {
                    isEdit = true;
                    $('#modal-default-title').html("Ubah {{ $page_attr['title'] }}");
                    $('#modal-default').modal('show');
                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#kode').val(data.kode);
                    $('#harga').val(data.harga);
                    $('#jenis').val(data.jenis).trigger('change');
                    $('#satuan').val(data.satuan).trigger('change');
                    $('#keterangan').val(data.keterangan);
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

        function deleteFunc(id) {
            swal.fire({
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin akan menghapus data ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: `{{ url(h_prefix_uri()) }}/${id}`,
                        type: 'DELETE',
                        dataType: 'json',
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
                                title: '{{ $page_attr['title'] }} berhasil dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var oTable = table_html.dataTable();
                            oTable.fnDraw(false);
                        },
                        complete: function() {
                            swal.hideLoading();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal.hideLoading();
                            swal.fire("!Opps ", "Something went wrong, try again later", "error");
                        }
                    });
                }
            });
        }
    </script>
@endsection
