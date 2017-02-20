@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-black panel-primary">
                <div class="panel-heading">GOLONGAN</div>
                <div class="panel-body">
                @if (Auth::user()->permission == "Super Admin")
                    <center><a href="{{route('golongan.create')}}" class="btn btn-success">Tambah Data</a></center>
                    <center>{{$gol->links()}}</center>
                @endif
	<br>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr class="bg-info">
				<th>No</th>
				<th>Kode Golongan</th>
				<th>Nama Golongan</th>
				<th>Besaraan Uang</th>
				@if (Auth::user()->permission == "Super Admin")
				<th colspan="3"><center>Action</center></th>
				@endif
			</tr>
		</thead>
		@php
		$no = 1;
		@endphp
		@foreach($gol as $data)
		<tbody>
			<tr>
				<td>{{$no++}}</td>
				<td>{{$data->kode_golongan}}</td>
				<td>{{$data->nama_golongan}}</td>
				<?php $data->besaran_uang=number_format($data->besaran_uang,2,',','.'); ?>
				<td>Rp.{{$data->besaran_uang}}</td>
				@if (Auth::user()->permission == "Super Admin")
				<td><center><a href="{{route('golongan.edit', $data->id)}}" class="btn btn-warning">Edit</a></center></td>
				<td><center>
					<form method="POST" action="{{route('golongan.destroy', $data->id)}}">
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
