@extends('templates.admin.master')
@section('content')
    <div class="card">
        <div class="card-header bg-info d-md-flex flex-row justify-content-between">
            <h3 class="card-title text-light">{{ $page_attr['title'] }}</h3>
            <a type="button" class="btn btn-rounded btn-gray btn-sm" href="{{ url()->previous() }}">
                <i class="fe fe-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="javascript:void(0)" id="MainForm" name="MainForm" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="rw" class="col-sm-3 col-form-label">RT/RW
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9 d-flex flex-row">
                        <span style="display: none;" id="rt_rw_text"></span>
                        <div class="w-100 me-2">
                            <input type="number" class="form-control" placeholder="Rukun Tetangga"
                                value="{{ $surat->rt->nomor }}" id="rt" name="rt"required>
                        </div>
                        <div class="w-100">
                            <input type="number" class="form-control" placeholder="Rukun Warga"
                                value="{{ $surat->rw->nomor }}" id="rw" name="rw"required>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id" value="{{ $surat->id }}">
                <input type="hidden" name="surat_detail_id" id="surat_detail_id" value="{{ $surat->keterangan->id }}">
                <div class="row mb-3">
                    <label for="nik" class="col-sm-3 col-form-label">Nomor Induk Kependudukan
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9 d-flex flex-row justify-content-between">
                        <span style="display: none;" id="nik_text"></span>
                        <div class="w-100">
                            <input type="number" class="form-control" placeholder="Nomor Induk Kependudukan" id="nik"
                                name="nik" required value="{{ $surat->nik_untuk_penduduk }}">
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
                    <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="nama_text"></span>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="nama" name="nama"
                            required value="{{ $surat->nama_untuk_penduduk }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat, Tanggal lahir
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9 d-flex flex-row">
                        <span style="display: none;" id="ttl_text"></span>
                        <div class="w-100  me-2">
                            <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempat_lahir"
                                name="tempat_lahir"required value="{{ $surat->keterangan->tempat_lahir }}">
                        </div>
                        <div>
                            <input type="date" class="form-control date-input-str" placeholder="Tanggal Lahir"
                                id="tanggal_lahir" name="tanggal_lahir" required
                                value="{{ $surat->keterangan->tanggal_lahir }}">
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
                            <option value="LAKI-LAKI"
                                {{ $surat->keterangan->jenis_kelamin == 'LAKI-LAKI' ? 'selected' : '' }}>
                                LAKI-LAKI
                            </option>
                            <option value="PEREMPUAN"
                                {{ $surat->keterangan->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>
                                PEREMPUAN
                            </option>
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
                            <option value="WNI"{{ $surat->keterangan->warga_negara == 'WNI' ? 'selected' : '' }}>
                                Warga Negara Indonesia
                            </option>
                            <option value="WNA"{{ $surat->keterangan->warga_negara == 'WNA' ? 'selected' : '' }}>
                                Warga Negara Asing
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="negara_nama" class="col-sm-3 col-form-label">Nama Negara
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="negara_nama_text"></span>
                        <input type="text" class="form-control" placeholder="Negara Asal Penduduk" id="negara_nama"
                            name="negara_nama" value="{{ $surat->keterangan->negara_nama }}" required>
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
                                <option value="{{ $agama }}"
                                    {{ $surat->keterangan->agama == $agama ? 'selected' : '' }}>
                                    {{ $agama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="status_kawin" class="col-sm-3 col-form-label">Status Perkawinan
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="status_kawin_text"></span>
                        <select class="form-control" id="status_kawin" name="status_kawin" required>
                            <option value="">Pilih Status Perkawinan</option>
                            <option value="KAWIN" {{ $surat->keterangan->status_kawin == 'KAWIN' ? 'selected' : '' }}>
                                KAWIN
                            </option>
                            <option value="BELUM KAWIN"
                                {{ $surat->keterangan->status_kawin == 'BELUM KAWIN' ? 'selected' : '' }}>
                                BELUM KAWIN
                            </option>
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
                                <option value="{{ $pendidikan }}"
                                    {{ $surat->keterangan->pendidikan == $pendidikan ? 'selected' : '' }}>
                                    {{ $pendidikan }}
                                </option>
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
                                <option value="{{ $pekerjaan }}"
                                    {{ $surat->keterangan->pekerjaan == $pekerjaan ? 'selected' : '' }}>
                                    {{ $pekerjaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="alamat_text"></span>
                        <textarea class="form-control" placeholder="Alamat Lengkap" id="alamat" name="alamat" required>{{ $surat->keterangan->alamat }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jenis_surat_id" class="col-sm-3 col-form-label">Jenis Surrat
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="jenis_surat_text"></span>
                        <select class="form-control" id="jenis_surat_id" name="jenis_surat_id" required>
                            <option value="">Pilih Jenis Surat</option>
                            @foreach ($jenis_keterangan as $jenis)
                                <option
                                    value="{{ $jenis->id }}"{{ $surat->keterangan->jenis_surat_keterangan_id == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-success" form="MainForm">
                    <li class="fas fa-save mr-1"></li> Simpan
                </button>
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
        const nik_ada = {{ $nik_ada ? 'true' : 'false' }};
        $(document).ready(function() {
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

            if (nik_ada) {
                setTimeout(() => {
                    view_form('insert-nik');
                }, 500);
            }

            // simpan form ============================================================================================
            $('#MainForm').submit(function(e) {
                e.preventDefault();
                resetErrorAfterInput();
                var formData = new FormData(this);
                setBtnLoading('button[form=MainForm]', 'Simpan');
                $.ajax({
                    type: "POST",
                    url: "{{ route(h_prefix('perbaiki_simpan', 2)) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Data berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = "{{ route('penduduk.pelacakan') }}";
                        }, 2000);
                        view_form();
                        $('#nik').val('');
                        $('#no_kk').val('');
                        $('#hub_dgn_kk').val('');
                        $('#nama').val('');
                        $('#tempat_lahir').val('');
                        $('#tanggal_lahir').val('');
                        $('#agama').val('');
                        $('#pendidikan').val('');
                        $('#pekerjaan').val('');
                        $('#status_kawin').val('');
                        $('#rt').val('');
                        $('#rw').val('');
                        $('#alamat').val('');
                        $('#jenis_kelamin').val('');
                        $('#jenis_surat_id').val('');
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
                            '<li class="fas fa-save mr-1"></li> Simpan',
                            false);
                    }
                });
            });
        });

        function input_form_data(data) {
            $('#warga_negara').val(data.penduduk.warga_negara);
            $('#negara_nama').val(data.penduduk.negara_nama);
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
            $('#rt').val(data.penduduk.rt.nomor);
            $('#rw').val(data.penduduk.rt.rw.nomor);
            $('#alamat').val(data.penduduk.alamat);
            $('#jenis_kelamin').val(data.penduduk.jenis_kelamin);
        }

        function view_form(view = null) {
            const btn_cari_nik = $('#btn_cari_nik');
            const btn_reset_nik = $('#btn_reset_nik');

            const nik_text = $('#nik_text');
            const nik = $('#nik');

            switch (view) {
                case 'insert-nik': // insert dengan nik yang sudah terdaftar yang bisa di ubah cuman status tombol reset ada
                    nik_text.html(nik.val());
                    nik_text.show();
                    nik.hide();

                    // nik
                    btn_cari_nik.hide();
                    btn_reset_nik.show();
                    break;

                case 'update': // update data yang bisa diubah cuman status, tombol reset tidak ada
                    nik_text.html(nik.val());
                    nik_text.show();
                    nik.hide();

                    // nik
                    btn_cari_nik.hide();
                    btn_reset_nik.hide();
                    break;


                case 'view': // view data
                    nik_text.html(nik.val());
                    nik_text.show();
                    nik.hide();

                    // nik
                    btn_cari_nik.hide();
                    btn_reset_nik.hide();
                    break;

                default: // insert dengan nik yang belum terdaftar semua bisa di ubah tombol reset tidak ada
                    nik_text.html(nik.val());
                    nik_text.hide();
                    nik.show();

                    // nik
                    btn_cari_nik.show();
                    btn_reset_nik.hide();
                    break;
            }
        }

        function cek_nik() {
            const nik = $('#nik').val();
            $.LoadingOverlay("show");
            $.ajax({
                type: "GET",
                url: `{{ route(h_prefix('cari_penduduk', 4)) }}`,
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
                    $('#rt').val(penduduk.rt.nomor);
                    $('#rw').val(penduduk.rt.rw.nomor);
                    $('#alamat').val(penduduk.alamat);
                    $('#jenis_kelamin').val(penduduk.jenis_kelamin);
                    $('#warga_negara').val(penduduk.warga_negara);
                    $('#negara_nama').val(penduduk.negara_nama);
                    view_form('insert-nik');
                    render_tanggal('#tanggal_lahir');
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
            $('#id').val('');
            $('#tanggal').val("{{ date('Y-m-d') }}");
            $('#warga_negara').val('WNI');
            $('#negara_nama').val('INDONESIA');
            view_form();
            render_tanggal('#tanggal');
        }

        view_form();
    </script>
@endsection
