<h3 class="h4 fw-bold">Pengajuan Surat</h3>
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('penduduk.surat.kelahiran') }}">
            <div class="card bg-primary img-card card-main">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h3 class="mb-0 me-2 fs-18">Surat Pengantar Keterangan Kelahiran</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-id-card text-white fs-30 me-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('penduduk.surat.domisili') }}">
            <div class="card bg-info img-card card-main">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h3 class="mb-0 me-2 fs-18">Surat Pengantar Keterangan Domisili</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-map-marker-alt text-white fs-30 me-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('penduduk.surat.keterangan') }}">
            <div class="card bg-secondary img-card card-main">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h3 class="mb-0 me-2 fs-18">Surat Keterangan</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-user-check text-white fs-30 me-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('penduduk.surat.domisili') }}">
            <div class="card bg-warning img-card card-main">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h3 class="mb-0 me-2 fs-18">Surat Pengajuan Kartu Keluarga</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-file-alt text-white fs-30 me-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div> --}}

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('penduduk.surat.pindah') }}">
            <div class="card bg-danger img-card card-main">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h3 class="mb-0 me-2 fs-18">Surat Pengantar Keterangan Pindah</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-suitcase-rolling text-white fs-30 me-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('penduduk.surat.nikah') }}">
            <div class="card bg-success img-card card-main">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h3 class="mb-0 me-2 fs-18">Surat Pengantar Keterangan Nikah</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-calendar-alt text-white fs-30 me-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('penduduk.surat.domisili') }}">
            <div class="card bg-purple img-card card-main">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h3 class="mb-0 me-2 fs-18">Surat Pengantar Keterangan Kematian</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-user-times text-white fs-30 me-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div> --}}
</div>
