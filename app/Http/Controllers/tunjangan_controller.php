<?php

namespace App\Http\Controllers;

use Request;
use App\Tunjangan;
use App\Jabatan;
use App\Golongan;
use Validator;


class tunjangan_controller extends Controller
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
        $tun = Tunjangan::paginate(5);
        $jab = Jabatan::all();
        $gol = Golongan::all();
        return view('tunjangan.index', compact('tun','jab','gol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $jb = Jabatan::all();
        $gol = Golongan::all();
        return view('tunjangan.create', compact('jb','gol'));
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
        $tun = array (
            'kode_tunjangan'=>'required|unique:tunjangans',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'status'=>'required',
            'jumlah_anak'=>'required',
            'besaran_uang'=>'required',
            );
        $pesan = array(
            'kode_tunjangan.required' =>'Harus Diisi broo',
            'jabatan_id.required' =>'Harus Diisi broo',
            'golongan_id.required' =>'Harus Diisi broo',
            'status.required' =>'Harus Diisi broo',
            'jumlah_anak.required' =>'Harus Diisi broo',
            'besaran_uang.required' =>'Harus Diisi broo',
            );

        $validation = Validator::make(Request::all(), $tun, $pesan);

        if($validation->fails())
        {
            return redirect('tunjangan/create')->withErrors($validation)->withInput();
        }
        $tunjangan = Request::all();
        Tunjangan::create($tunjangan);
        return redirect('tunjangan');
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
        $tun = Tunjangan::find($id);
        $jb = Jabatan::all();
        $gol = Golongan::all();
        return view('tunjangan.edit', compact('tun','jb','gol'));
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
        $cariid = Tunjangan::find($id);
        if($cariid->kode_tunjangan == Request('kode_tunjangan'))
        {
            $tnjgn = array (
                    'kode_tunjangan'=>'required',
                    'jabatan_id'=>'required',
                    'golongan_id'=>'required',
                    'status'=>'required',
                    'jumlah_anak'=>'required',
                    'besaran_uang'=>'required',
            );
        }
        else {
            $tnjgn = array (
                    'kode_tunjangan'=>'required|unique:tunjangans',
                    'jabatan_id'=>'required',
                    'golongan_id'=>'required',
                    'status'=>'required',
                    'jumlah_anak'=>'required',
                    'besaran_uang'=>'required',
            );
        }
        $pesan = array(
            'kode_tunjangan.unique' => 'Maaf Sudah Ada',
            'jabatan_id.required' =>'Harus Diisi broo',
            'golongan_id.required' =>'Harus Diisi broo',
            'status.required' =>'Harus Diisi broo',
            'jumlah_anak.required' =>'Harus Diisi broo',
            'besaran_uang.required' =>'Harus Diisi broo',
            );

        $validation = Validator::make(Request::all(), $tnjgn, $pesan);
        if($validation->fails())
        {
            return redirect('tunjangan/'.$id.'/edit')->withErrors($validation)->withInput();
        }
        $tun = Request::all();
        $tunjangan = Tunjangan::find($id);
        $tunjangan->update($tun);
        return redirect('tunjangan');
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
        Tunjangan::find($id)->delete();
        return redirect('tunjangan');

    }
}
