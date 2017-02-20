@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Menu</div>

                <div class="panel-body">
                    <a href="  " class="btn btn-danger btn-block">Admin</a>
                </div>
                <div class="panel-body">
                    <a href="{{route('penggajian.create')}}" class="btn btn-warning btn-block">Tambah Penggajian</a>
                </div>
                <div class="panel-body">
                    <a href="{{ route('pegawai.create') }}" class="btn btn-success btn-block">Tambah Pegawai</a>
                </div>
                <div class="panel-body">
                    <a href=" " class="btn btn-primary btn-block">Gajiku</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
