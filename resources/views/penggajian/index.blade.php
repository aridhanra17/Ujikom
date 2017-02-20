@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading">PENGGAJIAN</div>
				<div class="panel-body">
                </div>
            </div>
            </div>
        </div>
    
 <div class="panel-body panel-primary">
                    <center><a href="{{route('penggajian.create')}}" class="btn btn-success">Hitung Peggajian</a></center>
                    <center>{{$penggajian->links()}}</center>
    <br>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr class="bg-info">
                <th>No</th>
                <th>Id Pegawai</th>
                <th>Jumlah Jam Lembur</th>
                <th>Jumlah Uang Lembur</th>
                <th>Gaji Pokok</th>
                <th>Total Gaji</th>
                <th>Tanggal Pengambilan</th>
                <th>Status Pengambilan</th>
                <th>Petugas Penerima</th>
                <th></th>
                <th colspan="3"><center>Action</center></th>
            </tr>
        </thead>
        @php
        $no = 1;
        @endphp
        @foreach($penggajian as $data)
        <tbody>
            <tr>
                <td>{{$no++}}</td>
                <td>{{$data->Tujangan_pegawai->Pegawai->user->name}}</td>
                <td>{{$data->jumlah_jam_lembur}} </td>
                <td>{{$data->jumlah_uang_lembur}} </td>
                <td>{{$data->gaji_pokok}} </td>
                <td>{{$data->total_gaji}} </td>
                <td>{{$data->updated_at}} </td>
                @if($data->status_pengambilan == 0)
                
                    <td>Belum Diambil </td>
                
                @endif
                @if($data->status_pengambilan == 1)
                
                    <td>Sudah Diambil</td>
                
                @endif
                <td>{{$data->petugas_penerima}} </td>
                <td><center><a href="{{route('penggajian.edit', $data->id)}}" class="btn btn-warning">Edit</a></center></td>
                <td><center>
                    <form method="POST" action="{{route('penggajian.destroy', $data->id)}}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                    <input class="btn btn-danger" onclick="return confirm('Yakin Mau Menghapus Data? ');" type="submit" value="Hapus"></form>
                </center></td>
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
        