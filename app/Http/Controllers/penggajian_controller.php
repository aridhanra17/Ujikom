<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Penggajian;
use App\Tunjangan;
use App\Tunjangan_pegawai;
use App\Lembur_pegawai;
use App\Kategori_lembur;
use App\Jabatan;
use App\Golongan;
use App\Pegawai;
use Validator;
use App\User;
use Input;

class penggajian_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $penggajian = Penggajian::paginate(5);
        $tp = Tunjangan_pegawai::all();
        $peg = Pegawai::all();
        $user = User::all();
        return view('penggajian.index', compact('penggajian','tp','user','peg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tun = Tunjangan_pegawai::all();
        $user = User::all();
        return view('penggajian.create',compact('tun','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $gaji = array (
        //     'tunjangan_pegawai_id'=>'required',
        //     'status_pengambilan' => 'required',
        //     );
        // $pesan = array(
        //     'tunjangan_pegawai_id.required' =>'Harus Diisi broo',
        //     'status_pengambilan.required' =>'Harus Diisi broo',
        //     );

        // $validation = Validator::make(Request::all(), $gaji, $pesan);

        // if($validation->fails())
        // {
        //     return redirect('tunjangan/create')->withErrors($validation)->withInput();
        // }

        $gaji = Input::all();
        //dd($gaji);
        $tunjangan_pegawai = Tunjangan_pegawai::where('id', $gaji['tunjangan_pegawai_id'])->first();
        //dd($tunjangan_pegawai);
        $tunjangan = Tunjangan::where('id', $tunjangan_pegawai->kode_tunjangan_id)->first();
        //dd($tunjangan_pegawai);
        $pegawai = Pegawai::where('id', $tunjangan_pegawai->pegawai_id)->first();
        //dd($pegawai);
        $kategori_lembur = Kategori_lembur::where('jabatan_id', $pegawai->jabatan_id)->where('golongan_id', $pegawai->golongan_id)->first();
        //dd($kategori_lembur);
        $lembur_pegawai = Lembur_pegawai::where('pegawai_id', $pegawai->id)->first();
        //dd($lembur_pegawai);
        $jabatan = Jabatan::where('id', $pegawai->jabatan_id)->first();
        //dd($jabatan);
        $golongan = Golongan::where('id', $pegawai->golongan_id)->first();
        //dd($golongan);
        $data_penggajian = Penggajian::where('tunjangan_pegawai_id', $tunjangan_pegawai->id)->first();

        $penggajian = new Penggajian;

        if(isset($data_penggajian))
        {
            $error = true;
            $tun = Tunjangan_pegawai::paginate(5);
            return view('penggajian.create', compact('error','tun'));
        }
        elseif (!isset($lembur_pegawai)) {
            $nol = 0;
            $penggajian->jumlah_jam_lembur= $nol;
            $penggajian->jumlah_uang_lembur = $nol;
            $penggajian->gaji_pokok=$jabatan->besaran_uang+$golongan->besaran_uang;
            $penggajian->total_gaji = ($tunjangan->jumlah_anak*$tunjangan->besaran_uang)+($jabatan->besaran_uang+$golongan->besaran_uang);
            $penggajian->tanggal_pengambilan = date('d-m-y');
            $penggajian->status_pengambilan = Input::get('status_pengambilan');
            $penggajian->tunjangan_pegawai_id = Input::get('tunjangan_pegawai_id');
            $penggajian->petugas_penerima = Auth::user()->name;
            $penggajian->save();
        }

        elseif(!isset($lembur_pegawai) || !isset($kategori_lembur))
        {
            $nol = 0;
            $penggajian->jumlah_jam_lembur= $nol;
            $penggajian->jumlah_uang_lembur = $nol;
            $penggajian->gaji_pokok=$jabatan->besaran_uang+$golongan->besaran_uang;
            $penggajian->total_gaji = ($tunjangan->jumlah_anak*$tunjangan->besaran_uang)+($jabatan->besaran_uang+$golongan->besaran_uang);
            $penggajian->tanggal_pengambilan = date('d-m-y');
            $penggajian->status_pengambilan = Input::get('status_pengambilan');
            $penggajian->tunjangan_pegawai_id = Input::get('tunjangan_pegawai_id');
            $penggajian->petugas_penerima = Auth::user()->name;
            $penggajian->save();
        }

        else
        {
            $penggajian->jumlah_jam_lembur=$lembur_pegawai->jumlah_jam;
            $penggajian->jumlah_uang_lembur =($lembur_pegawai->jumlah_jam)*($kategori_lembur->besaran_uang);
            $penggajian->gaji_pokok=$jabatan->besaran_uang+$golongan->besaran_uang;
            $penggajian->total_gaji = ($lembur_pegawai->jumlah_jam*$kategori_lembur->besaran_uang)+($tunjangan->jumlah_anak*$tunjangan->besaran_uang)+($jabatan->besaran_uang+$golongan->besaran_uang);
            $penggajian->tanggal_pengambilan = date('d-m-y');
            $penggajian->status_pengambilan = Input::get('status_pengambilan');
            $penggajian->tunjangan_pegawai_id = Input::get('tunjangan_pegawai_id');
            $penggajian->petugas_penerima = Auth::user()->name;
            $penggajian->save();
        }
        
        return redirect('penggajian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Penggajian::find($id)->delete();
        return redirect('penggajian');
    }
}
