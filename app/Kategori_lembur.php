<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori_lembur extends Model
{
    //
    protected $table = 'kategori_lemburs';
    protected $fillable = array('kode_lembur','jabatan_id','golongan_id','besaran_uang','created_at','updated');
    protected $visible = array('kode_lembur','jabatan_id','golongan_id','besaran_uang','created_at','updated');

    public function jabatan()
    {
    	return $this->belongsTo('App\Jabatan','jabatan_id');
    }
    public function golongan()
    {
    	return $this->belongsTo('App\Golongan','golongan_id');
    }
    public function Lembur_pegawai()
    {
        return $this->HasMany('App\Lembur_pegawai', 'kode_lembur_id');
    }
}
