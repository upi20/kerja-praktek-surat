@extends('templates.admin.master')

@section('content')
    @include('app.penduduk.components.pengajuan_surat', $compact)

    {{-- menu lain --}}
    <hr>
    <h3 class="h4 fw-bold">Menu Lain</h3>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="">
                <div class="card bg-indigo img-card card-main">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h3 class="mb-0 me-2 fs-18">Pelacakan Surat</h3>
                            </div>
                            <div class="ms-auto">
                                <i class="fas fa-list text-white fs-30 me-2 mt-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ route('password') }}">
                <div class="card  bg-gray-dark img-card card-main">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h3 class="mb-0 number-font">Ganti Password</h3>
                            </div>
                            <div class="ms-auto"> <i class="fas fa-key text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@section('stylesheet')
    <style>
        .card-main {
            transition: all 0.3s;
        }

        .card-main:hover {
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        .pelacakan-image {
            width: 70px;
            height: 70px;
            border-radius: 20%;
        }

        .pelacakan-counter {
            position: relative;
            top: -75px;
        }
    </style>
@endsection
