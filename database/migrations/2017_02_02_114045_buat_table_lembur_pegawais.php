<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTableLemburPegawais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur_pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kode_lembur_id')->unique();
            $table->integer('pegawai_id')->unsigned();
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('jumlah_jam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lembur_pegawais');
    }
}
