@extends('templates.admin.master')

@section('content')
    <div class="row" id="main-content">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-md-flex flex-row justify-content-between">
                    <h3 class="card-title">Pegawai Penerima Surat</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="app-form">
                        <div class="form-group">
                            <label for="pegawai_id" class="form-label">Pegawai
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="pegawai_id" name="pegawai_id" style="width: 100%;">
                                @if ($pegawai)
                                    <option value="{{ $pegawai->id }}"selected>
                                        {{ $pegawai->jabatan->nama }} | {{ $pegawai->penduduk->nama }}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary" form="app-form">
                        <li class="fas fa-save mr-1"></li> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    {{-- nestable --}}
    <script src="{{ asset('assets/templates/admin/plugins/nestable2v1.6.0/jquery.nestable.min.js') }}"></script>
    {{-- sweetalert --}}
    <script src="{{ asset('assets/templates/admin/plugins/sweet-alert/sweetalert2.all.js') }}"></script>
    {{-- loading --}}
    <script src="{{ asset('assets/templates/admin/plugins/loading/loadingoverlay.min.js') }}"></script>
    {{-- select2 --}}
    <script src="{{ asset('assets/templates/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- icon --}}
    <script>
        $(document).ready(function() {
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
                dropdownParent: $('#main-content'),
            });

            // insertForm ===================================================================================
            $('#app-form').submit(function(e) {
                const load_el = $(this).parent().parent();
                e.preventDefault();
                var formData = new FormData(this);
                load_el.LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: `{{ route(h_prefix('simpan')) }}`,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
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
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: res.message ?? 'Something went wrong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    complete: function() {
                        load_el.LoadingOverlay("hide");
                    }
                });
            });
        })
    </script>
@endsection
