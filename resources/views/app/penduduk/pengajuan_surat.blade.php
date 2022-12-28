@extends('templates.admin.master')

@section('content')
    @include('app.penduduk.components.pengajuan_surat', $compact)
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
