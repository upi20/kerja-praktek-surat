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
                                value="{{ is_null($surat->rt) ? '' : $surat->rt->nomor }}" id="rt"
                                name="rt"required>
                        </div>
                        <div class="w-100">
                            <input type="number" class="form-control" placeholder="Rukun Warga"
                                value="{{ is_null($surat->rw) ? '' : $surat->rw->nomor }}" id="rw"
                                name="rw"required>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id" value="{{ $surat->id }}">
                <input type="hidden" name="surat_detail_id" id="surat_detail_id" value="{{ $surat->pindah->id }}">
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
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="jenis_kelamin_text"></span>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="LAKI-LAKI" {{ $surat->pindah->jenis_kelamin == 'LAKI-LAKI' ? 'selected' : '' }}>
                                LAKI-LAKI
                            </option>
                            <option value="PEREMPUAN" {{ $surat->pindah->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>
                                PEREMPUAN
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat, Tanggal lahir
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9 d-flex flex-row">
                        <span style="display: none;" id="ttl_text"></span>
                        <div class="w-100 me-2">
                            <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempat_lahir"
                                name="tempat_lahir"required value="{{ $surat->pindah->tempat_lahir }}">
                        </div>
                        <div>
                            <input type="date" class="form-control date-input-str" placeholder="Tanggal Lahir"
                                id="tanggal_lahir" name="tanggal_lahir" required
                                value="{{ $surat->pindah->tanggal_lahir }}">
                        </div>
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="warga_negara" class="col-sm-3 col-form-label">Kewarganegaraan
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="warga_negara_text"></span>
                        <select class="form-control" id="warga_negara" name="warga_negara" required>
                            <option value="">Pilih Kewarganegaraan</option>
                            <option value="WNI"{{ $surat->pindah->warga_negara == 'WNI' ? 'selected' : '' }}>
                                Warga Negara Indonesia
                            </option>
                            <option value="WNA"{{ $surat->pindah->warga_negara == 'WNA' ? 'selected' : '' }}>
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
                            name="negara_nama" value="{{ $surat->pindah->negara_nama }}" required>
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
                                    {{ $surat->pindah->agama == $agama ? 'selected' : '' }}>
                                    {{ $agama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan Terakhir
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="pendidikan_text"></span>
                        <select class="form-control" id="pendidikan" name="pendidikan" required>
                            <option value="">Pilih Pendidikan</option>
                            @foreach ($pendidikans as $pendidikan)
                                <option value="{{ $pendidikan }}"
                                    {{ $surat->pindah->pendidikan == $pendidikan ? 'selected' : '' }}>
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
                                    {{ $surat->pindah->pekerjaan == $pekerjaan ? 'selected' : '' }}>
                                    {{ $pekerjaan }}
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
                            <option value="KAWIN" {{ $surat->pindah->status_kawin == 'KAWIN' ? 'selected' : '' }}>
                                KAWIN
                            </option>
                            <option value="BELUM KAWIN"
                                {{ $surat->pindah->status_kawin == 'BELUM KAWIN' ? 'selected' : '' }}>
                                BELUM KAWIN
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat Asal
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="alamat_text"></span>
                        <textarea class="form-control" placeholder="Alamat Asal" id="alamat" name="alamat" required>{{ $surat->pindah->alamat }}</textarea>
                    </div>
                </div>

                <hr>
                <h4 class="card-title mb-1">Pindah Ke</h4>
                <div class="ms-md-3 ms-sm-1">
                    <div class="row mb-3">
                        <label for="ke_alamat_lengkap" class="col-sm-3 col-form-label">Kp / Jl.
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Alamat" id="ke_alamat_lengkap"
                                name="ke_alamat_lengkap" value="{{ $surat->pindah->ke_alamat_lengkap }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ke_rt" class="col-sm-3 col-form-label">RT/RW
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9 d-flex flex-row">
                            <div class="w-100 me-2">
                                <input type="number" class="form-control" placeholder="Rukun Tetangga"
                                    value="{{ $surat->pindah->ke_rt }}" id="ke_rt" name="ke_rt"required>
                            </div>
                            <div class="w-100">
                                <input type="number" class="form-control" placeholder="Rukun Warga"
                                    value="{{ $surat->pindah->ke_rw }}" id="ke_rw" name="ke_rw"required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ke_desa_kel" class="col-sm-3 col-form-label">Desa / Kel.
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Desa atau Kelurahan"
                                id="ke_desa_kel" name="ke_desa_kel" value="{{ $surat->pindah->ke_desa_kel }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ke_provinsi" class="col-sm-3 col-form-label">Kecamatan
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Kecamatan" id="ke_kecamatan"
                                name="ke_kecamatan" value="{{ $surat->pindah->ke_kecamatan }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ke_kab_kota" class="col-sm-3 col-form-label">Kabupaten / Kota
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Kabupaten Atau Kota"
                                id="ke_kab_kota" name="ke_kab_kota" value="{{ $surat->pindah->ke_kab_kota }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ke_provinsi" class="col-sm-3 col-form-label">Provinsi
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Provinsi" id="ke_provinsi"
                                name="ke_provinsi" value="{{ $surat->pindah->ke_provinsi }}" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="alasan_pindah" class="col-sm-3 col-form-label">Alasan Pindah
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <span style="display: none;" id="alasan_pindah_text"></span>
                        <textarea class="form-control" placeholder="Alasan Pindah" id="alasan_pindah" name="alasan_pindah" required>{{ $surat->pindah->alasan_pindah }}</textarea>
                    </div>
                </div>
            </form>
            <hr>
            <div class="d-md-flex flex-row justify-content-between">
                <h3 class="card-title">Pengikut</h3>
                <div>
                    <button type="button" class="btn btn-rounded btn-success btn-sm" onclick="pengikut_tambah()">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </div>
            <div id="pengikut_table"></div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-success" form="MainForm">
                    <li class="fas fa-save mr-1"></li> Simpan
                </button>
            </div>
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
                    <form action="javascript:void(0)" id="pengikut_MainForm" name="pengikut_MainForm" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" id="pengikut_id">
                        <input type="hidden" name="surat_pindah_id" id="surat_pindah_id"
                            value="{{ $surat->pindah->id }}">
                        <div class="row mb-3">
                            <label for="pengikut_nama" class="col-sm-3 col-form-label">NIK
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9 d-flex flex-row justify-content-between">
                                <span style="display: none;" id="pengikut_nik_text"></span>
                                <div class="w-100">
                                    <input type="number" class="form-control" placeholder="Nomor Induk Kependudukan"
                                        id="pengikut_nik" name="nik" required>
                                </div>
                                <div class="ms-2" id="pengikut_btn_cari_nik">
                                    <button type="button" class="btn btn-primary" onclick="pengikut_cek_nik()">
                                        <i class="fas fa-search me-2"></i>Cari</button>
                                </div>
                                <div class="ms-2" id="pengikut_btn_reset_nik">
                                    <button type="button" class="btn btn-danger" onclick="pengikut_reset_form()">
                                        <i class="fas fa-times me-2"></i>Reset</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pengikut_nama" class="col-sm-3 col-form-label">Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Nama Lengkap" id="pengikut_nama"
                                    name="nama" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pengikut_jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="pengikut_jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                                    <option value="PEREMPUAN">PEREMPUAN</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pengikut_nama" class="col-sm-3 col-form-label">Tanggal lahir
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control date-input-str" placeholder="Tanggal Lahir"
                                    value="" id="pengikut_tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pengikut_pekerjaan" class="col-sm-3 col-form-label">Pekerjaan
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="pengikut_pekerjaan" name="pekerjaan" required>
                                    <option value="">Pilih Pekerjaan</option>
                                    @foreach ($pekerjaans as $pekerjaan)
                                        <option value="{{ $pekerjaan }}">{{ $pekerjaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pengikut_pendidikan" class="col-sm-3 col-form-label">Pendidikan
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="pengikut_pendidikan" name="pendidikan" required>
                                    <option value="">Pilih Pendidikan</option>
                                    @foreach ($pendidikans as $pendidikan)
                                        <option value="{{ $pendidikan }}">{{ $pendidikan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pengikut_keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Keterangan Penduduk"
                                    id="pengikut_keterangan" name="keterangan">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="pengikut_MainForm">
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
        const nik_ada = {{ $nik_ada ? 'true' : 'false' }};
        const url_list_pengikut = "{{ route(h_prefix('pengikut_list'), $surat->id) }}";
        let pengikuts = [];
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
                    url: "{{ route(h_prefix('simpan')) }}",
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
                        reset_form();
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

            // simpan pengikut ============================================================================================
            $('#pengikut_MainForm').submit(function(e) {
                e.preventDefault();
                resetErrorAfterInput();
                var formData = new FormData(this);
                setBtnLoading('button[form=pengikut_MainForm]', 'Simpan');
                const url = ($('#pengikut_id').val() == '') ? "{{ route(h_prefix('pengikut_simpan')) }}" :
                    "{{ route(h_prefix('pengikut_update')) }}";
                $.ajax({
                    type: "POST",
                    url: url,
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
                        pengikut_refresh();
                        $('#modal-default').modal('hide');
                    },
                    error: function(data) {
                        const res = data.responseJSON ?? {};
                        errorAfterInput = [];
                        for (const property in res.errors) {
                            errorAfterInput.push(property);
                            setErrorAfterInput(res.errors[property], `#pengikut_${property}`);
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
                        setBtnLoading('button[form=pengikut_MainForm]',
                            '<li class="fas fa-save mr-1"></li> Simpan',
                            false);
                    }
                });
            });
        });

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
                url: `{{ route(h_prefix('cari_penduduk', 2)) }}`,
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
                    $('#tinggal_sejak').val(penduduk.masuk.tanggal);
                    $('#agama').val(penduduk.agama);
                    $('#pendidikan').val(penduduk.pendidikan);
                    $('#pekerjaan').val(penduduk.pekerjaan);
                    $('#status_kawin').val(penduduk.status_kawin);
                    $('#rt').val(penduduk.rt.nomor);
                    $('#rw').val(penduduk.rt.rw.nomor);
                    $('#alamat').val(penduduk.alamat);
                    $('#alamat_asal').val(penduduk.masuk.alamat);
                    $('#jenis_kelamin').val(penduduk.jenis_kelamin);
                    $('#warga_negara').val(penduduk.warga_negara);
                    $('#negara_nama').val(penduduk.negara_nama);
                    view_form('insert-nik');
                    render_tanggal('#tanggal_lahir');
                    render_tanggal('#tinggal_sejak');
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
            $('#warga_negara').val('WNI');
            $('#negara_nama').val('INDONESIA');
            view_form();
            render_tanggal('#tanggal_lahir');
        }

        // pengikut ===================================================================================================

        function pengikut_tambah() {
            $('#modal-default-title').html("Tambah Pengikut");
            $('#modal-default').modal('show');
            pengikut_reset_form();
            resetErrorAfterInput();
            return true;
        }

        function pengikut_reset_form() {
            $('.is-valid').removeClass('is-valid');
            $('#pengikut_MainForm').trigger("reset");
            $('#pengikut_id').val('');
            pengikut_view_form();
            render_tanggal('#pengikut_tanggal_lahir');

        }

        function pengikut_view_form(view = null) {
            const btn_cari_nik = $('#pengikut_btn_cari_nik');
            const btn_reset_nik = $('#pengikut_btn_reset_nik');

            const nik_text = $('#pengikut_nik_text');
            const nik = $('#pengikut_nik');

            switch (view) {
                case 'insert-nik': // insert dengan nik yang sudah terdaftar yang bisa di ubah cuman status tombol reset ada
                    nik_text.html(nik.val());
                    nik_text.show();
                    nik.hide();

                    // nik
                    btn_cari_nik.hide();
                    btn_reset_nik.show();
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

        function pengikut_cek_nik() {
            const nik = $('#pengikut_nik').val();
            $.LoadingOverlay("show");
            $.ajax({
                type: "GET",
                url: `{{ route(h_prefix('cari_penduduk', 2)) }}`,
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
                    $('#pengikut_nik').val(penduduk.nik);
                    $('#pengikut_nama').val(penduduk.nama);
                    $('#pengikut_jenis_kelamin').val(penduduk.jenis_kelamin);
                    $('#pengikut_tanggal_lahir').val(penduduk.tanggal_lahir);
                    $('#pengikut_pekerjaan').val(penduduk.pekerjaan);
                    $('#pengikut_pendidikan').val(penduduk.pendidikan);

                    pengikut_view_form('insert-nik');
                    render_tanggal('#pengikut_tanggal_lahir');
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

        function pengikut_refresh() {
            $.LoadingOverlay("show");
            $.ajax({
                type: "GET",
                url: url_list_pengikut,
                success: (data) => {
                    // jika data ada maka render
                    const container = $('#pengikut_table');
                    container.html('');
                    if (data.pengikuts.length < 1) {
                        // jika data tidak ada maka stop
                        return;
                    }
                    pengikuts = data.pengikuts;

                    let table_body = '';
                    let nomor = 1;
                    data.pengikuts.forEach(pengikut => {
                        const btn_update = `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-primary btn-sm me-1" title="Ubah Data" onClick="pengikut_edit('${pengikut.id}')">
                                <i class="fas fa-edit"></i>
                                </button>`;
                        const btn_delete = `<button type="button" data-toggle="tooltip" class="btn btn-rounded btn-danger btn-sm me-1" title="Hapus Data" onClick="pengikut_delete('${pengikut.id}')">
                                <i class="fas fa-trash"></i>
                                </button>`;

                        table_body += `
                                <tr>
                                    <td>${nomor++}</td>
                                    <td>${pengikut.nama}</td>
                                    <td>${pengikut.jenis_kelamin}</td>
                                    <td>${pengikut.umur} Tahun</td>
                                    <td>${pengikut.pekerjaan}</td>
                                    <td>${pengikut.pendidikan}</td>
                                    <td>${pengikut.keterangan??''}</td>
                                    <td>${btn_update} ${btn_delete}</td>
                                </tr>`;
                    });

                    container.html(`
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur / Tahun</th>
                                    <th>Pekerjaan</th>
                                    <th>Pendidikan</th>
                                    <th>Ket.</th>
                                    <th>Aksi.</th>
                                </tr>
                            </thead>
                            <tbody>${table_body}</tbody>
                        </table>
                    `);
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

        function pengikut_edit(id) {
            const pengikut = pengikuts.find(pengikut => pengikut.id == id);

            if (pengikut == null) {
                return;
            }
            $('#modal-default-title').html("Ubah Pengikut");
            $('#modal-default').modal('show');
            pengikut_reset_form();
            resetErrorAfterInput();

            $('#pengikut_id').val(pengikut.id);
            $('#pengikut_nik').val(pengikut.nik);
            $('#pengikut_nama').val(pengikut.nama);
            $('#pengikut_jenis_kelamin').val(pengikut.jenis_kelamin);
            $('#pengikut_tanggal_lahir').val(pengikut.tanggal_lahir);
            $('#pengikut_pekerjaan').val(pengikut.pekerjaan);
            $('#pengikut_pendidikan').val(pengikut.pendidikan);
            $('#pengikut_keterangan').val(pengikut.keterangan);

            const ada_penduduk = pengikut.penduduk_id == null ? null : 'insert-nik';
            pengikut_view_form(ada_penduduk);
            render_tanggal('#pengikut_tanggal_lahir');
        }

        function pengikut_delete(id) {
            swal.fire({
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin akan menghapus data ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: `{{ url(h_prefix_uri('pengikut/hapus/')) }}/${id}`,
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
                                title: 'Data berhasil dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            pengikut_refresh();
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

        view_form();
        pengikut_refresh();
    </script>
@endsection
