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
                <input type="hidden" name="id" id="id" value="{{ $surat->id }}">
                <input type="hidden" name="surat_detail_id" id="surat_detail_id" value="{{ $surat->kelahiran->id }}">
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
                <hr>
                {{-- calon a --}}
                <h4 class="card-title mb-1">Anak</h4>
                <div class="ms-md-3 ms-sm-1">
                    <div class="row mb-3">
                        <label for="nama_anak" class="col-sm-3 col-form-label">Nama
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Nama" id="nama_anak"
                                value="{{ $surat->kelahiran->nama_anak }}" name="nama_anak" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat, Tanggal lahir
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9 d-flex flex-row">
                            <div class="w-100 me-2">
                                <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempat_lahir"
                                    value="{{ $surat->kelahiran->tempat_lahir }}" name="tempat_lahir"required>
                            </div>
                            <div>
                                <input type="date" class="form-control date-input-str" placeholder="Tanggal Lahir"
                                    id="tanggal_lahir" value="{{ $surat->kelahiran->tanggal_lahir }}" name="tanggal_lahir"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="waktu_lahir" class="col-sm-3 col-form-label">Pukul
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9 d-flex flex-row">
                            <input class="form-control" type="time" id="waktu_lahir" name="waktu_lahir"
                                value="{{ $surat->kelahiran->waktu_lahir }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="LAKI-LAKI"
                                    {{ $surat->kelahiran->jenis_kelamin == 'LAKI-LAKI' ? 'selected' : '' }}>
                                    LAKI-LAKI
                                </option>
                                <option value="PEREMPUAN"
                                    {{ $surat->kelahiran->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>
                                    PEREMPUAN
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="anak_ke" class="col-sm-3 col-form-label">Anak Ke
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9 d-flex flex-row">
                            <input class="form-control" placeholder="Anak ke" type="number" min="1"
                                id="anak_ke" name="anak_ke" value="{{ $surat->kelahiran->anak_ke }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="berat" class="col-sm-3 col-form-label">Berat & Panjang
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9 d-flex flex-row">
                            <div class="w-100 me-1">
                                <div class="input-group">
                                    <input type="number" min="1" class="form-control" placeholder="Berat"
                                        id="berat" name="berat" value="{{ $surat->kelahiran->berat }}" required>
                                    <span class="input-group-text">GRAM</span>
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="input-group">
                                    <input type="number" min="1" class="form-control" placeholder="panjang"
                                        id="panjang" name="panjang" value="{{ $surat->kelahiran->panjang }}" required>
                                    <span class="input-group-text">CM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <h4 class="card-title mb-1">Orang Tua</h4>

                {{-- ayah --}}
                <div class="ms-md-4 ms-sm-1">
                    <h4 class="card-title mb-1">Ayah</h4>
                    <div class="row mb-3">
                        <label for="ayah_nik" class="col-sm-3 col-form-label">Nomor Induk Kependudukan
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9 d-flex flex-row justify-content-between">
                            <span style="display: none;" id="ayah_nik_text">{{ $surat->kelahiran->ayah_nik }}</span>
                            <div class="w-100">
                                <input type="number" class="form-control" placeholder="Nomor Induk Kependudukan"
                                    id="ayah_nik" value="{{ $surat->kelahiran->ayah_nik }}" name="ayah_nik" required>
                            </div>
                            <div class="ms-2" id="btn_cari_ayah_nik">
                                <button type="button" class="btn btn-primary" onclick="cek_nik('ayah')">
                                    <i class="fas fa-search me-2"></i>Cari</button>
                            </div>
                            <div class="ms-2" id="btn_reset_ayah_nik" style="display: none">
                                <button type="button" class="btn btn-danger" onclick="reset_form('ayah')">
                                    <i class="fas fa-times me-2"></i>Reset</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ayah_nama" class="col-sm-3 col-form-label">Nama Ayah
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Nama Lengkap" id="ayah_nama"
                                value="{{ $surat->kelahiran->ayah_nama }}" name="ayah_nama" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ayah_tempat_lahir" class="col-sm-3 col-form-label">Tempat, Tanggal lahir
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9 d-flex flex-row">
                            <div class="w-100 me-2">
                                <input type="text" class="form-control" placeholder="Tempat Lahir"
                                    id="ayah_tempat_lahir" value="{{ $surat->kelahiran->ayah_tempat_lahir }}"
                                    name="ayah_tempat_lahir"required>
                            </div>
                            <div>
                                <input type="date" class="form-control date-input-str" placeholder="Tanggal Lahir"
                                    id="ayah_tanggal_lahir" value="{{ $surat->kelahiran->ayah_tanggal_lahir }}"
                                    name="ayah_tanggal_lahir" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ayah_agama" class="col-sm-3 col-form-label">Agama
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="ayah_agama" name="ayah_agama">
                                <option value="">Pilih Agama</option>
                                @foreach ($agamas as $agama)
                                    <option value="{{ $agama }}"
                                        {{ $surat->kelahiran->ayah_agama == $agama ? 'selected' : '' }}>
                                        {{ $agama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ayah_pekerjaan" class="col-sm-3 col-form-label">Pekerjaan
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="ayah_pekerjaan" name="ayah_pekerjaan" required>
                                <option value="">Pilih Pekerjaan</option>
                                @foreach ($pekerjaans as $pekerjaan)
                                    <option value="{{ $pekerjaan }}"
                                        {{ $surat->kelahiran->ayah_pekerjaan ? 'selected' : '' }}>
                                        {{ $pekerjaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ayah_alamat" class="col-sm-3 col-form-label">Alamat
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" placeholder="Alamat" id="ayah_alamat" name="ayah_alamat" required>{{ $surat->kelahiran->ayah_alamat }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ibu --}}
                <div class="ms-md-4 ms-sm-1">
                    <h4 class="card-title mb-1">Ibu</h4>

                    <div class="row mb-3">
                        <label for="ibu_nik" class="col-sm-3 col-form-label">Nomor Induk Kependudukan
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9 d-flex flex-row justify-content-between">
                            <span style="display: none;" id="ibu_nik_text">{{ $surat->kelahiran->ibu_nik }}</span>
                            <div class="w-100">
                                <input type="number" class="form-control" placeholder="Nomor Induk Kependudukan"
                                    id="ibu_nik" value="{{ $surat->kelahiran->ibu_nik }}" name="ibu_nik" required>
                            </div>
                            <div class="ms-2" id="btn_cari_ibu_nik">
                                <button type="button" class="btn btn-primary" onclick="cek_nik('ibu')">
                                    <i class="fas fa-search me-2"></i>Cari</button>
                            </div>
                            <div class="ms-2" id="btn_reset_ibu_nik" style="display: none">
                                <button type="button" class="btn btn-danger" onclick="reset_form('ibu')">
                                    <i class="fas fa-times me-2"></i>Reset</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ibu_nama" class="col-sm-3 col-form-label">Nama Ibu
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Nama Lengkap" id="ibu_nama"
                                value="{{ $surat->kelahiran->ibu_nama }}" name="ibu_nama" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ibu_tempat_lahir" class="col-sm-3 col-form-label">Tempat, Tanggal lahir
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9 d-flex flex-row">
                            <div class="w-100 me-2">
                                <input type="text" class="form-control" placeholder="Tempat Lahir"
                                    id="ibu_tempat_lahir" value="{{ $surat->kelahiran->ibu_tempat_lahir }}"
                                    name="ibu_tempat_lahir"required>
                            </div>
                            <div>
                                <input type="date" class="form-control date-input-str" placeholder="Tanggal Lahir"
                                    id="ibu_tanggal_lahir" value="{{ $surat->kelahiran->ibu_tanggal_lahir }}"
                                    name="ibu_tanggal_lahir" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ibu_agama" class="col-sm-3 col-form-label">Agama
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="ibu_agama" name="ibu_agama">
                                <option value="">Pilih Agama</option>
                                @foreach ($agamas as $agama)
                                    <option value="{{ $agama }}"
                                        {{ $surat->kelahiran->ibu_agama == $agama ? 'selected' : '' }}>
                                        {{ $agama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ibu_pekerjaan" class="col-sm-3 col-form-label">Pekerjaan
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="ibu_pekerjaan" name="ibu_pekerjaan" required>
                                <option value="">Pilih Pekerjaan</option>
                                @foreach ($pekerjaans as $pekerjaan)
                                    <option value="{{ $pekerjaan }}"
                                        {{ $surat->kelahiran->ibu_pekerjaan ? 'selected' : '' }}>
                                        {{ $pekerjaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ibu_alamat" class="col-sm-3 col-form-label">Alamat
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" placeholder="Alamat" id="ibu_alamat" name="ibu_alamat" required>{{ $surat->kelahiran->ibu_alamat }}</textarea>
                        </div>
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
        const nik_ibu_ada = {{ $nik_ibu_ada ? 'true' : 'false' }};
        const nik_ayah_ada = {{ $nik_ayah_ada ? 'true' : 'false' }};

        $(document).ready(function() {
            // setting kewarganegaraan
            const jenis_penduduk = ['ayah', 'ibu'];
            for (const jenis of jenis_penduduk) {
                $(`#${jenis}_warga_negara`).val('WNI');
                $(`#${jenis}_negara_nama`).val('INDONESIA');

                $(`#${jenis}_warga_negara`).change(function() {
                    if (this.value == "WNI") {
                        $(`#${jenis}_negara_nama`).val('INDONESIA');
                    } else {
                        $(`#${jenis}_negara_nama`).val('');
                    }
                });

                $(`#${jenis}_negara_nama`).keyup(function() {
                    if (String(this.value).toLocaleLowerCase() == 'indonesia') {
                        $(`#${jenis}_warga_negara`).val('WNI');
                    } else if (String(this.value).toLocaleLowerCase() == '') {
                        $(`#${jenis}_warga_negara`).val('');
                    } else {
                        $(`#${jenis}_warga_negara`).val('WNA');
                    }
                });
            }

            setTimeout(() => {
                if (nik_ibu_ada) {
                    set_button_cari('ibu', false);
                }
                if (nik_ayah_ada) {
                    set_button_cari('ayah', false);
                }
            }, 500);

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

                        $('#MainForm').trigger("reset");
                        for (const jenis of jenis_penduduk) {
                            reset_form(jenis);
                        }

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

        function cek_nik(jenis) {
            const nik = $(`#${jenis}_nik`).val();
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
                    render_data_penduduk(jenis, penduduk);
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

        function reset_form(jenis) {
            $(`#${jenis}_no_kk`).val('');
            $(`#${jenis}_nama`).val('');
            $(`#${jenis}_tempat_lahir`).val('');
            $(`#${jenis}_tanggal_lahir`).val('');
            $(`#${jenis}_warga_negara`).val('');
            $(`#${jenis}_negara_nama`).val('');
            $(`#${jenis}_agama`).val('');
            $(`#${jenis}_status_kawin`).val('');
            $(`#${jenis}_pendidikan`).val('');
            $(`#${jenis}_pekerjaan`).val('');
            $(`#${jenis}_alamat`).val('');

            // render nik
            const nik = $(`#${jenis}_nik`);
            const nik_text = $(`#${jenis}_nik_text`);
            const btn_cari_nik = $(`#btn_cari_${jenis}_nik`);
            const btn_reset_nik = $(`#btn_reset_${jenis}_nik`);
            nik.val('');
            nik.show();
            nik_text.html(nik.val());
            nik_text.hide();

            // nik
            btn_cari_nik.show();
            btn_reset_nik.hide();
            render_tanggal(`#${jenis}_tanggal_lahir`);

            $('.is-valid').removeClass('is-valid');
            $(`#${jenis}_warga_negara`).val('WNI');
            $(`#${jenis}_negara_nama`).val('INDONESIA');
        }

        function set_button_cari(jenis, set = false) {
            // render nik
            const nik = $(`#${jenis}_nik`);
            const nik_text = $(`#${jenis}_nik_text`);
            const btn_cari_nik = $(`#btn_cari_${jenis}_nik`);
            const btn_reset_nik = $(`#btn_reset_${jenis}_nik`);

            if (set) {
                nik.show();
                nik_text.html(nik.val());
                nik_text.hide();

                btn_cari_nik.show();
                btn_reset_nik.hide();
            } else {
                nik.hide();
                nik_text.html(nik.val());
                nik_text.show();

                btn_cari_nik.hide();
                btn_reset_nik.show();
            }
        }
    </script>
@endsection
