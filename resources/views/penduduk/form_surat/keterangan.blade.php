@extends('templates.admin.master')
@section('content')
    <div class="card">
        <div class="card-header bg-info d-md-flex flex-row justify-content-between">
            <h3 class="card-title text-light">{{ $page_attr['title'] }}</h3>
            <a type="button" class="btn btn-rounded btn-gray btn-sm" href="{{ route('penduduk.home') }}">
                <i class="fe fe-arrow-left"></i> Kembali
            </a>
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
