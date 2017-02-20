@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">PEGAWAI</div>

                <div class="panel-body panel-primary">
                @if (Auth::user()->permission == "Super Admin" || Auth::user()->permission == "Admin" )
                    <center><a href="{{route('pegawai.create')}}" class="btn btn-success">Tambah Data</a></center>
                    <center>{{$pegawai->links()}}</center>
                @endif
	<br>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr class="bg-info">
				<th>No</th>
				<th>NIP</th>
				<th>User Id</th>
				<th>Jabatan Id</th>
				<th>Golongan Id</th>
				<th>Photo</th>
				@if (Auth::user()->permission == "Super Admin" || Auth::user()->permission == "Admin" )
				<th colspan="3"><center>Action</center></th>
				@endif
			</tr>
		</thead>
		@php
		$no = 1;
		@endphp
		@foreach($pegawai as $data)
		<tbody>
			<tr>
				<td>{{$no++}}</td>
				<td>{{$data->nip}}</td>
				<td>{{$data->User->name}}</td>
				<td>{{$data->Jabatan->nama_jabatan}}</td>
				<td>{{$data->Golongan->nama_golongan}}</td>
				<td><img src="{{ asset('gambar/'.$data->photo.'') }}" width="30" height="30"></td>
				@if (Auth::user()->permission == "Super Admin" || Auth::user()->permission == "Admin" )
				<td><center><a href="{{route('pegawai.show', $data->id)}}" class="btn btn-primary">Lihat</a></center></td>
				<td><center><a href="{{route('pegawai.edit', $data->id)}}" class="btn btn-warning">Edit</a></center></td>
				<td><center>
					<form method="POST" action="{{route('pegawai.destroy', $data->id)}}">
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
