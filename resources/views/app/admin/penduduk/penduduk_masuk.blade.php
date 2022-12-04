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
                        <th>Aksi</th>
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
                            <label for="nama" class="col-sm-3 col-form-label">NIK
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9 d-flex flex-row justify-content-between">
                                <span style="display: none;" id="nik_text"></span>
                                <div class="w-100">
                                    <input type="number" class="form-control" placeholder="Nomor Induk Kependudukan"
                                        id="nik" name="nik" required>
                                </div>
                                <div class="ms-2" id="btn_cari_nik">
                                    <button type="button" class="btn btn-primary" onclick="cek_nik()">
                                        <i class="fas fa-search me-2"></i>Cari</button>
                                </div>
                                <div class="ms-2" id="btn_reset_nik">
                                    <button type="button" class="btn btn-danger" onclick="reset_form()">
                                        <i class="fas fa-times me-2"></i>Reset</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="no_kk" class="col-sm-3 col-form-label">NO KK
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="no_kk_text"></span>
                                <input type="number" class="form-control" placeholder="Nomor Kartu Keluarga"
                                    id="no_kk" name="no_kk">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hub_dgn_kk" class="col-sm-3 col-form-label">Hubungan Dengan KK
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="hub_dgn_kk_text"></span>
                                <select class="form-control" id="hub_dgn_kk" name="hub_dgn_kk">
                                    <option value="">Pilih Hubungan Dengan KK</option>
                                    @foreach ($hub_dgn_kks as $hub)
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
                                <span style="display: none;" id="nama_text"></span>
                                <input type="text" class="form-control" placeholder="Nama Lengkap" id="nama"
                                    name="nama" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama" class="col-sm-3 col-form-label">Tempat, Tanggal lahir
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9 d-flex flex-row">
                                <span style="display: none;" id="ttl_text"></span>
                                <div class="w-100">
                                    <input type="text" class="form-control me-lg-2" placeholder="Tempat Lahir"
                                        value="" id="tempat_lahir" name="tempat_lahir"required>
                                </div>
                                <div>
                                    <input type="date" class="form-control date-input-str" placeholder="Tanggal Lahir"
                                        value="" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="jenis_kelamin_text"></span>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                                    <option value="PEREMPUAN">PEREMPUAN</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="agama" class="col-sm-3 col-form-label">Agama
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="agama_text"></span>
                                <select class="form-control" id="agama" name="agama">
                                    <option value="">Pilih Agama</option>
                                    @foreach ($agamas as $agama)
                                        <option value="{{ $agama }}">{{ $agama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="pendidikan_text"></span>
                                <select class="form-control" id="pendidikan" name="pendidikan" required>
                                    <option value="">Pilih Pendidikan</option>
                                    @foreach ($pendidikans as $pendidikan)
                                        <option value="{{ $pendidikan }}">{{ $pendidikan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="pekerjaan_text"></span>
                                <select class="form-control" id="pekerjaan" name="pekerjaan" required>
                                    <option value="">Pilih Pekerjaan</option>
                                    @foreach ($pekerjaans as $pekerjaan)
                                        <option value="{{ $pekerjaan }}">{{ $pekerjaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status_kawin" class="col-sm-3 col-form-label">Status Kawin
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="status_kawin_text"></span>
                                <select class="form-control" id="status_kawin" name="status_kawin" required>
                                    <option value="">Pilih Status Kawin</option>
                                    <option value="KAWIN">KAWIN</option>
                                    <option value="BELUM KAWIN">BELUM KAWIN</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="warga_negara" class="col-sm-3 col-form-label">Kewarganegaraan
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="warga_negara_text"></span>
                                <select class="form-control" id="warga_negara" name="warga_negara" required>
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
                                <span style="display: none;" id="negara_nama_text"></span>
                                <input type="text" class="form-control" placeholder="Negara Asal Penduduk"
                                    id="negara_nama" name="negara_nama" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="rw" class="col-sm-3 col-form-label">RT/RW
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9 d-flex flex-row">
                                <span style="display: none;" id="rt_rw_text"></span>
                                <div class="w-100"><input type="number" class="form-control me-lg-2"
                                        placeholder="Rukun Tetangga" value="" id="rt"
                                        name="rt"required></div>
                                <div class="w-100"><input type="number" class="form-control me-lg-2"
                                        placeholder="Rukun Warga" value="" id="rw" name="rw"required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="alamat_text"></span>
                                <textarea class="form-control" placeholder="Alamat Lengkap" id="alamat" name="alamat" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Masuk
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="tanggal_text"></span>
                                <input type="date" class="form-control date-input-str"
                                    placeholder="Tanggal Penduduk Masuk" id="tanggal" name="tanggal" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal" class="col-sm-3 col-form-label">Keterangan Masuk
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="masuk_nama_text"></span>
                                <input type="text" class="form-control" placeholder="Keterangan Penduduk Masuk"
                                    id="masuk_nama" name="masuk_nama" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="masuk_keterangan" class="col-sm-3 col-form-label">Catatan Masuk
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <span style="display: none;" id="masuk_keterangan_text"></span>
                                <textarea class="form-control" placeholder="Catatan Penduduk Masuk" id="masuk_keterangan" name="masuk_keterangan"></textarea>
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

            $('#warga_negara').change(function() {
                if (this.value == "WNI") {
                    $('#negara_nama').val('INDONESIA');
                } else {
                    $('#negara_nama').val('');
                }
            })

            $('#negara_nama').keyup(function() {
                if (String(this.value).toLocaleLowerCase() == 'indonesia') {
                    $('#warga_negara').val('WNI');
                } else if (String(this.value).toLocaleLowerCase() == '') {
                    $('#warga_negara').val('');
                } else {
                    $('#warga_negara').val('WNA');
                }
            })

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
                            return `${oleh? `${oleh}<br>` : ''}<small>${tanggal}</small>`;
                        },
                        className: 'text-nowrap'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render(data, type, full, meta) {
                            const btn_view = `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-info btn-sm me-1" title="Lihat Data" onClick="viewFunc('${data}')">
                                <i class="fas fa-eye"></i>
                                </button>`;
                            const btn_update = can_update ? `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-primary btn-sm me-1" title="Ubah Data" onClick="editFunc('${data}')">
                                <i class="fas fa-edit"></i>
                                </button>` : '';
                            const btn_delete = can_delete ? `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-danger btn-sm me-1" title="Hapus Data" onClick="deleteFunc('${data}')">
                                <i class="fas fa-trash"></i>
                                </button>` : '';
                            return btn_view + btn_update + btn_delete;
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
            $('#modal-default-title').html("Tambah {{ $page_attr['title'] }}");
            $('#modal-default').modal('show');
            reset_form();
            resetErrorAfterInput();
            return true;
        }

        function viewFunc(id) {
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
                    $('#modal-default-title').html("Lihat {{ $page_attr['title'] }}");
                    $('#modal-default').modal('show');
                    input_form_data(data);
                    view_form('view');
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
                    $('#modal-default-title').html("Ubah {{ $page_attr['title'] }}");
                    $('#modal-default').modal('show');
                    $('#id').val(data.id);
                    input_form_data(data);
                    view_form('update');
                    render_tanggal('#tanggal');
                    render_tanggal('#tanggal_lahir');
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

        function input_form_data(data) {
            $('#nik').val(data.penduduk.nik);
            $('#no_kk').val(data.penduduk.no_kk);
            $('#hub_dgn_kk').val(data.penduduk.hub_dgn_kk);
            $('#nama').val(data.penduduk.nama);
            $('#tempat_lahir').val(data.penduduk.tempat_lahir);
            $('#tanggal_lahir').val(data.penduduk.tanggal_lahir);
            $('#agama').val(data.penduduk.agama);
            $('#pendidikan').val(data.penduduk.pendidikan);
            $('#pekerjaan').val(data.penduduk.pekerjaan);
            $('#status_kawin').val(data.penduduk.status_kawin);
            $('#warga_negara').val(data.penduduk.warga_negara);
            $('#negara_nama').val(data.penduduk.negara_nama);
            $('#rt').val(data.penduduk.rt.nomor);
            $('#rw').val(data.penduduk.rt.rw.nomor);
            $('#alamat').val(data.penduduk.alamat);
            $('#jenis_kelamin').val(data.penduduk.jenis_kelamin);
            $('#tanggal').val(data.tanggal);
            $('#masuk_nama').val(data.nama);
            $('#masuk_keterangan').val(data.keterangan);
        }

        function view_form(view = null) {
            const btn_cari_nik = $('#btn_cari_nik');
            const btn_reset_nik = $('#btn_reset_nik');
            const btn_submit = $('#modal-default').find('button[type=submit]');

            const nik_text = $('#nik_text');
            const no_kk_text = $('#no_kk_text');
            const hub_dgn_kk_text = $('#hub_dgn_kk_text');
            const nama_text = $('#nama_text');
            const ttl_text = $('#ttl_text');
            const agama_text = $('#agama_text');
            const pendidikan_text = $('#pendidikan_text');
            const pekerjaan_text = $('#pekerjaan_text');
            const status_kawin_text = $('#status_kawin_text');
            const warga_negara_text = $('#warga_negara_text');
            const negara_nama_text = $('#negara_nama_text');
            const rt_rw_text = $('#rt_rw_text');
            const alamat_text = $('#alamat_text');
            const jenis_kelamin_text = $('#jenis_kelamin_text');
            const tanggal_text = $('#tanggal_text');
            const masuk_nama_text = $('#masuk_nama_text');
            const masuk_keterangan_text = $('#masuk_keterangan_text');

            const nik = $('#nik');
            const no_kk = $('#no_kk');
            const hub_dgn_kk = $('#hub_dgn_kk');
            const nama = $('#nama');
            const tempat_lahir = $('#tempat_lahir');
            const tanggal_lahir = $('#tanggal_lahir');
            const agama = $('#agama');
            const pendidikan = $('#pendidikan');
            const pekerjaan = $('#pekerjaan');
            const status_kawin = $('#status_kawin');
            const warga_negara = $('#warga_negara');
            const negara_nama = $('#negara_nama');
            const rt = $('#rt');
            const rw = $('#rw');
            const alamat = $('#alamat');
            const jenis_kelamin = $('#jenis_kelamin');
            const tanggal = $('#tanggal');
            const masuk_nama = $('#masuk_nama');
            const masuk_keterangan = $('#masuk_keterangan');

            switch (view) {
                case 'insert-nik': // insert dengan nik yang sudah terdaftar yang bisa di ubah cuman status tombol reset ada
                    nik_text.html(nik.val());
                    nik_text.show();
                    nik.hide();

                    no_kk_text.html(no_kk.val());
                    no_kk_text.show();
                    no_kk.hide();

                    hub_dgn_kk_text.html(hub_dgn_kk.val());
                    hub_dgn_kk_text.show();
                    hub_dgn_kk.hide();

                    nama_text.html(nama.val());
                    nama_text.show();
                    nama.hide();

                    ttl_text.html(`${tempat_lahir.val()}, ${format_tanggal(tanggal_lahir.val()).tanggal}`);
                    ttl_text.show();
                    tempat_lahir.parent().hide();
                    tanggal_lahir.parent().hide();

                    pendidikan_text.html(pendidikan.val());
                    pendidikan_text.show();
                    pendidikan.hide();

                    pekerjaan_text.html(pekerjaan.val());
                    pekerjaan_text.show();
                    pekerjaan.hide();

                    status_kawin_text.html(status_kawin.val());
                    status_kawin_text.show();
                    status_kawin.hide();

                    warga_negara_text.html(warga_negara.val());
                    warga_negara_text.show();
                    warga_negara.hide();

                    negara_nama_text.html(negara_nama.val());
                    negara_nama_text.show();
                    negara_nama.hide();

                    rt_rw_text.html(`${rt.val()}/${rw.val()}`);
                    rt_rw_text.show();
                    rt.parent().hide();
                    rw.parent().hide();

                    alamat_text.html(alamat.val());
                    alamat_text.show();
                    alamat.hide();

                    jenis_kelamin_text.html(jenis_kelamin.val());
                    jenis_kelamin_text.show();
                    jenis_kelamin.hide();

                    agama_text.html(agama.val());
                    agama_text.show();
                    agama.hide();

                    tanggal_text.html(format_tanggal(tanggal_lahir.val()).tanggal);
                    tanggal_text.hide();
                    tanggal.show();

                    masuk_nama_text.html(masuk_nama.val());
                    masuk_nama_text.hide();
                    masuk_nama.show();

                    masuk_keterangan_text.html(masuk_keterangan.val());
                    masuk_keterangan_text.hide();
                    masuk_keterangan.show();

                    // nik
                    btn_cari_nik.hide();
                    btn_reset_nik.show();
                    btn_submit.show();
                    break;

                case 'update': // update data yang bisa diubah cuman status, tombol reset tidak ada
                    nik_text.html(nik.val());
                    nik_text.show();
                    nik.hide();

                    no_kk_text.html(no_kk.val());
                    no_kk_text.hide();
                    no_kk.show();

                    hub_dgn_kk_text.html(hub_dgn_kk.val());
                    hub_dgn_kk_text.hide();
                    hub_dgn_kk.show();

                    nama_text.html(nama.val());
                    nama_text.hide();
                    nama.show();

                    ttl_text.html(`${tempat_lahir.val()}, ${format_tanggal(tanggal_lahir.val()).tanggal}`);
                    ttl_text.hide();
                    tempat_lahir.parent().show();
                    tanggal_lahir.parent().show();

                    pendidikan_text.html(pendidikan.val());
                    pendidikan_text.hide();
                    pendidikan.show();

                    pekerjaan_text.html(pekerjaan.val());
                    pekerjaan_text.hide();
                    pekerjaan.show();

                    status_kawin_text.html(status_kawin.val());
                    status_kawin_text.hide();
                    status_kawin.show();

                    warga_negara_text.html(warga_negara.val());
                    warga_negara_text.hide();
                    warga_negara.show();

                    negara_nama_text.html(negara_nama.val());
                    negara_nama_text.hide();
                    negara_nama.show();

                    rt_rw_text.html(`${rt.val()}/${rw.val()}`);
                    rt_rw_text.hide();
                    rt.parent().show();
                    rw.parent().show();

                    alamat_text.html(alamat.val());
                    alamat_text.hide();
                    alamat.show();

                    jenis_kelamin_text.html(jenis_kelamin.val());
                    jenis_kelamin_text.hide();
                    jenis_kelamin.show();

                    agama_text.html(agama.val());
                    agama_text.hide();
                    agama.show();

                    tanggal_text.html(format_tanggal(tanggal_lahir.val()).tanggal);
                    tanggal_text.hide();
                    tanggal.show();

                    masuk_nama_text.html(masuk_nama.val());
                    masuk_nama_text.hide();
                    masuk_nama.show();

                    masuk_keterangan_text.html(masuk_keterangan.val());
                    masuk_keterangan_text.hide();
                    masuk_keterangan.show();
                    // nik
                    btn_cari_nik.hide();
                    btn_reset_nik.hide();
                    btn_submit.show();
                    break;


                case 'view': // view data
                    nik_text.html(nik.val());
                    nik_text.show();
                    nik.hide();
                    nik_text.html(nik.val());
                    nik_text.show();
                    nik.hide();

                    no_kk_text.html(no_kk.val());
                    no_kk_text.show();
                    no_kk.hide();

                    hub_dgn_kk_text.html(hub_dgn_kk.val());
                    hub_dgn_kk_text.show();
                    hub_dgn_kk.hide();

                    nama_text.html(nama.val());
                    nama_text.show();
                    nama.hide();

                    ttl_text.html(`${tempat_lahir.val()}, ${format_tanggal(tanggal_lahir.val()).tanggal}`);
                    ttl_text.show();
                    tempat_lahir.parent().hide();
                    tanggal_lahir.parent().hide();

                    pendidikan_text.html(pendidikan.val());
                    pendidikan_text.show();
                    pendidikan.hide();

                    pekerjaan_text.html(pekerjaan.val());
                    pekerjaan_text.show();
                    pekerjaan.hide();

                    status_kawin_text.html(status_kawin.val());
                    status_kawin_text.show();
                    status_kawin.hide();

                    warga_negara_text.html(warga_negara.val());
                    warga_negara_text.show();
                    warga_negara.hide();

                    negara_nama_text.html(negara_nama.val());
                    negara_nama_text.show();
                    negara_nama.hide();

                    rt_rw_text.html(`${rt.val()}/${rw.val()}`);
                    rt_rw_text.show();
                    rt.parent().hide();
                    rw.parent().hide();

                    alamat_text.html(alamat.val());
                    alamat_text.show();
                    alamat.hide();

                    jenis_kelamin_text.html(jenis_kelamin.val());
                    jenis_kelamin_text.show();
                    jenis_kelamin.hide();

                    agama_text.html(agama.val());
                    agama_text.show();
                    agama.hide();

                    tanggal_text.html(format_tanggal(tanggal_lahir.val()).tanggal);
                    tanggal_text.show();
                    tanggal.hide();

                    masuk_nama_text.html(masuk_nama.val());
                    masuk_nama_text.show();
                    masuk_nama.hide();

                    masuk_keterangan_text.html(masuk_keterangan.val());
                    masuk_keterangan_text.show();
                    masuk_keterangan.hide();

                    // nik
                    btn_cari_nik.hide();
                    btn_reset_nik.hide();
                    btn_submit.hide();
                    break;



                default: // insert dengan nik yang belum terdaftar semua bisa di ubah tombol reset tidak ada
                    nik_text.html(nik.val());
                    nik_text.hide();
                    nik.show();

                    no_kk_text.html(no_kk.val());
                    no_kk_text.hide();
                    no_kk.show();

                    hub_dgn_kk_text.html(hub_dgn_kk.val());
                    hub_dgn_kk_text.hide();
                    hub_dgn_kk.show();

                    nama_text.html(nama.val());
                    nama_text.hide();
                    nama.show();

                    ttl_text.html(`${tempat_lahir.val()}, ${format_tanggal(tanggal_lahir.val()).tanggal}`);
                    ttl_text.hide();
                    tempat_lahir.parent().show();
                    tanggal_lahir.parent().show();

                    pendidikan_text.html(pendidikan.val());
                    pendidikan_text.hide();
                    pendidikan.show();

                    pekerjaan_text.html(pekerjaan.val());
                    pekerjaan_text.hide();
                    pekerjaan.show();

                    status_kawin_text.html(status_kawin.val());
                    status_kawin_text.hide();
                    status_kawin.show();

                    warga_negara_text.html(warga_negara.val());
                    warga_negara_text.hide();
                    warga_negara.show();

                    negara_nama_text.html(negara_nama.val());
                    negara_nama_text.hide();
                    negara_nama.show();

                    rt_rw_text.html(`${rt.val()}/${rw.val()}`);
                    rt_rw_text.hide();
                    rt.parent().show();
                    rw.parent().show();

                    alamat_text.html(alamat.val());
                    alamat_text.hide();
                    alamat.show();

                    jenis_kelamin_text.html(jenis_kelamin.val());
                    jenis_kelamin_text.hide();
                    jenis_kelamin.show();

                    agama_text.html(agama.val());
                    agama_text.hide();
                    agama.show();

                    tanggal_text.html(format_tanggal(tanggal_lahir.val()).tanggal);
                    tanggal_text.hide();
                    tanggal.show();

                    masuk_nama_text.html(masuk_nama.val());
                    masuk_nama_text.hide();
                    masuk_nama.show();

                    masuk_keterangan_text.html(masuk_keterangan.val());
                    masuk_keterangan_text.hide();
                    masuk_keterangan.show();

                    // nik
                    btn_cari_nik.show();
                    btn_reset_nik.hide();
                    btn_submit.show();
                    break;
            }
        }

        function cek_nik() {
            const nik = $('#nik').val();
            $.LoadingOverlay("show");
            $.ajax({
                type: "GET",
                url: `{{ route(h_prefix('find_by_nik')) }}`,
                data: {
                    nik
                },
                success: (penduduk) => {
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: `NIK ditemukan`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#nik').val(penduduk.nik);
                    $('#no_kk').val(penduduk.no_kk);
                    $('#hub_dgn_kk').val(penduduk.hub_dgn_kk);
                    $('#nama').val(penduduk.nama);
                    $('#tempat_lahir').val(penduduk.tempat_lahir);
                    $('#tanggal_lahir').val(penduduk.tanggal_lahir);
                    $('#agama').val(penduduk.agama);
                    $('#pendidikan').val(penduduk.pendidikan);
                    $('#pekerjaan').val(penduduk.pekerjaan);
                    $('#status_kawin').val(penduduk.status_kawin);
                    $('#warga_negara').val(penduduk.warga_negara);
                    $('#negara_nama').val(penduduk.negara_nama);
                    $('#rt').val(penduduk.rt.nomor);
                    $('#rw').val(penduduk.rt.rw.nomor);
                    $('#alamat').val(penduduk.alamat);
                    $('#jenis_kelamin').val(penduduk.jenis_kelamin);
                    view_form('insert-nik');
                    render_tanggal('#tanggal');
                },
                error: function(err) {
                    Swal.fire({
                        position: 'center',
                        icon: err.status == 400 ? 'info' : 'error',
                        title: ((err.responseJSON) ? err.responseJSON.message :
                            'Something went wrong'),
                        showConfirmButton: false,
                        timer: 3000
                    })
                },
                complete: function() {
                    $.LoadingOverlay("hide");
                }
            });
        }

        function reset_form() {
            $('.is-valid').removeClass('is-valid');
            $('#MainForm').trigger("reset");
            $('#warga_negara').val('WNI');
            $('#negara_nama').val('INDONESIA');
            $('#id').val('');
            $('#tanggal').val("{{ date('Y-m-d') }}");
            view_form();
            render_tanggal('#tanggal');
        }
    </script>
@endsection
