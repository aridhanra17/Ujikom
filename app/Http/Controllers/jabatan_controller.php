<?php

namespace App\Http\Controllers;

use Request;
use App\Jabatan;
use Validator;

class jabatan_controller extends Controller
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
        $jabatan = Jabatan::paginate(5);
        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->middleware('Admin:Admin');
        return view('jabatan.create');
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
        $jb = array (
            'kode_jabatan'=>'required|unique:jabatans',
            'nama_jabatan'=>'required',
            'besaran_uang'=>'required',
            );
        $pesan = array(
            'kode_jabatan.required' =>'Harus Diisi broo',
            'nama_jabatan.required' =>'Harus Diisi broo',
            'besaran_uang.required' =>'Harus Diisi broo',
            );

        $validation = Validator::make(Request::all(), $jb, $pesan);

        if($validation->fails())
        {
            return redirect('jabatan/create')->withErrors($validation)->withInput();
        }
        $jbt = Request::all();
        Jabatan::create($jbt);
        
        return redirect('jabatan');
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
        $jb = Jabatan::find($id);
        return view('jabatan.edit', compact('jb'));
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
        $cariid=Jabatan::find($id);
        if($cariid->kode_jabatan == Request('kode_jabatan'))
        {
            $jb = array (
                'kode_jabatan'=>'required',
                'nama_jabatan'=>'required',
                'besaran_uang'=>'required',
                );
        }
        else
        {
            $jb = array (
                'kode_jabatan'=>'required|unique:jabatans',
                'nama_jabatan'=>'required',
                'besaran_uang'=>'required',
                );
        }
        $pesan = array(
            'kode_jabatan.unique' => 'Maaf Sudah Ada',
            'kode_jabatan.required' =>'Harus Diisi broo',
            'nama_jabatan.required' =>'Harus Diisi broo',
            'besaran_uang.required' =>'Harus Diisi broo',
            );

        $validation = Validator::make(Request::all(), $jb, $pesan);
        if($validation->fails())
        {
            return redirect('jabatan/'.$id.'/edit')->withErrors($validation)->withInput();
        }
        
        $jb = Request::all();
        $jbt = Jabatan::find($id);
        $jbt->update($jb);
        return redirect('jabatan');
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
        Jabatan::find($id)->delete();
        return redirect('jabatan');
    }
}
