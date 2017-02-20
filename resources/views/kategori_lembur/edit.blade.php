@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">EDIT KATEGORI LEMBUR</div>

                <div class="panel-body">
                {!! Form::model($kl,['method'=>'PATCH', 'route'=>['kategori_lembur.update', $kl->id]]) !!}

					<div class="form-group">
						{!! Form::label('Kode Lembur','Kode Lembur :') !!}
						{!!Form::text('kode_lembur',null,['class'=>'form-control']) !!}
						
					</div>
                    <div class="form-group">
                        {!! Form::label('Besaran Uang','Besaran Uang :') !!}
                        {!!Form::text('besaran_uang',null,['class'=>'form-control']) !!}
                        
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Save',['class'=>'btn btn-primary form control']) !!}
                        {!! Form::close() !!}
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        @endsection