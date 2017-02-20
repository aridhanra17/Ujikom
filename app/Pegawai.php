<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = 'pegawais';
    protected $fillable = array('nip','user_id','jabatan_id','golongan_id','photo','created_at','updated_at');
    protected $visible = array('nip','user_id','jabatan_id','golongan_id','photo','created_at','updated_at');

    public function jabatan()
    {
    	return $this->belongsTo('App\Jabatan','jabatan_id');
    }
    public function golongan()
    {
    	return $this->belongsTo('App\Golongan','golongan_id');
    }
    public function lembur_pegawai()
    {
    	return $this->hasMany('App\Lembur_pegawai','pegawai_id');
    }
    public function tunjangan_pegawai()
    {
    	return $this->hasOne('App\Tunjangan_pegawai','pegawai_id');
    }
    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
