@extends('templates.admin.master')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
    </div>

    <!-- ROW OPEN -->
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary img-card box-primary-shadow card-main">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $total_anggota }}</h2>
                            <p class="text-white mb-0">Total Users </p>
                        </div>
                        <div class="ms-auto"> <i class="fas fa-users text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ route('password') }}">
                <div class="card  bg-success img-card box-success-shadow card-main">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h3 class="mb-0 number-font">Change Password</h3>
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
            margin: 3px;
        }

        .card-main:hover {
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }
    </style>
@endsection
