<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Support\Facades\DB;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $spp = Spp::get();
        $spp = DB::table('spp')
        ->join('siswa','siswa.id','=','spp.id_siswa')
        ->select('spp.id','siswa.nama','spp.tgl')
        ->get();

        return view('content.spp.spp_index', compact(
            'spp'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::get();
        return view('content.spp.spp_create', compact(
            'siswa'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $spp = $request->validate([
            'nama' => ['required'],
            'tanggal' => ['required', 'date'],
        ]);
  
        $spp  = Spp::create([
            'id_siswa'      => $request->nama,
            'tgl'           => $request->tanggal,
        ]);

        return redirect()->route('spp.index')->with('success', 'SPP Created Successfully');
        // return $request->all();
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
        $spp = Spp::where('spp.id','=',$id)->first();
        $siswa = Siswa::get();
        return view('content.spp.spp_edit', compact(
            'spp',
            'siswa'
        ));
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
        $spp = $request->validate([
            'nama' => ['required'],
            'tanggal' => ['required', 'date'],
        ]);

        $spp = Spp::find($id);
        $spp->id_siswa  = $request->nama;
        $spp->tgl       = $request->tanggal;
        $spp->save();

        return redirect()->route('spp.index')->with('success', 'SPP Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spp = Spp::find($id);
        $spp->delete();

        return redirect()->route('spp.index')->with('success', 'SPP Deleted Successfully');
    }
}
