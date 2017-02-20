@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-black panel-primary">
                <div class="panel-heading ">JABATAN</div>
                <div class="panel-body">
				@if(  Auth::user()->permission  == "Super Admin")
                    <center><a href="{{route('jabatan.create')}}" class="btn btn-success">Tambah Data</a></center>
                @endif
                    <center>{{$jabatan->links()}}</center>
	<br>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr class="bg-info">
				<th>No</th>
				<th>Kode Jabatan</th>
				<th>Nama Jabatan</th>
				<th>Besaraan Uang</th>
				@if (Auth::user()->permission == "Super Admin")
				<th colspan="3"><center>Action</center></th>
				@endif
			</tr>
		</thead>
		@php
		$no = 1;
		@endphp
		@foreach($jabatan as $data)
		<tbody>
			<tr>
				
				<td>{{$no++}}</td>
				<td>{{$data->kode_jabatan}}</td>
				<td>{{$data->nama_jabatan}}</td>
				<?php $data->besaran_uang=number_format($data->besaran_uang,2,',','.'); ?>
				<td>Rp.{{$data->besaran_uang}}</td>
				@if (Auth::user()->permission == "Super Admin")
				<td><center><a href="{{route('jabatan.edit', $data->id)}}" class="btn btn-warning">Edit</a></center></td>
				<td><center>
					<form method="POST" action="{{route('jabatan.destroy', $data->id)}}">
					{{csrf_field()}}
					<input type="hidden" name="_method" value="DELETE">
					<input class="btn btn-danger" onclick="return confirm('Yakin Mau Menghapus Data? ');" type="submit" value="Hapus"></form>
				</center></td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
