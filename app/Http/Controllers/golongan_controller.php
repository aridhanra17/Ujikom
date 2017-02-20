<?php

namespace App\Http\Controllers;

use Request;
use App\Golongan;
use Validator;

class golongan_controller extends Controller
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
        $gol = Golongan::paginate(5);
        return view('golongan.index', compact('gol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('golongan.create');
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
        $gol = array (
            'kode_golongan'=>'required|unique:golongans',
            'nama_golongan'=>'required',
            'besaran_uang'=>'required',
            );
        $pesan = array(
            'kode_golongan.required' =>'Harus Diisi broo',
            'nama_golongan.required' =>'Harus Diisi broo',
            'besaran_uang.required' =>'Harus Diisi broo',
            );

        $validation = Validator::make(Request::all(), $gol, $pesan);

        if($validation->fails())
        {
            return redirect('golongan/create')->withErrors($validation)->withInput();
        }

        $jbt = Request::all();
        Golongan::create($jbt);
        
        return redirect('golongan');
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
        $gol = Golongan::find($id);
        return view('golongan.edit', compact('gol'));
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
        $cariid = Golongan::find($id);
        if($cariid->kode_golongan == Request('kode_golongan'))
        {
            $gol = array (
                    'kode_golongan'=>'required',
                    'nama_golongan'=>'required',
                    'besaran_uang'=>'required',
            );
        }
        else {
            $gol = array (
                    'kode_golongan'=>'required|unique:golongans',
                    'nama_golongan'=>'required',
                    'besaran_uang'=>'required',
            );
        }
        $pesan = array(
            'kode_golongan.unique' => 'Maaf Sudah Ada',
            'kode_golongan.required' =>'Harus Diisi broo',
            'nama_golongan.required' =>'Harus Diisi broo',
            'besaran_uang.required' =>'Harus Diisi broo',
            );

        $validation = Validator::make(Request::all(), $gol, $pesan);
        if($validation->fails())
        {
            return redirect('golongan/'.$id.'/edit')->withErrors($validation)->withInput();
        }

        $gol = Request::all();
        $golongan = Golongan::find($id);
        $golongan->update($gol);
        return redirect('golongan');
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
        Golongan::find($id)->delete();
        return redirect('golongan');
    }
}
