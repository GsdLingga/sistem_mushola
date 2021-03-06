<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPengajian;
use Carbon\Carbon;

class JadwalPengajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('id');

        $jadwal_pengajian = JadwalPengajian::get();

        // $siswa = Siswa::get();

        // return view('content.jadwal_pengajian.jadwal_pengajian_index', compact(
        //     'siswa'
        // ));
        return view('content.jadwal_pengajian.jadwal_pengajian_index', compact(
            'jadwal_pengajian'
        ));
        // return $jadwal_pengajian;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.jadwal_pengajian.jadwal_pengajian_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jadwal = $request->validate([
            'judul'   => ['required'],
            'tanggal' => ['required', 'date'],
        ]);

        
        $jadwal  = JadwalPengajian::create([
            'title'     => $request->judul,
            'start'     => $request->tanggal,
        ]);

        return redirect()->route('jadwal-pengajian.index')->with('success', 'Jadwal Pengajian Created Successfully');
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
        $jadwal_pengajian = JadwalPengajian::where('id','=',$id)->first();
        return view('content.jadwal_pengajian.jadwal_pengajian_edit', compact(
            'jadwal_pengajian'
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
        $jadwal = $request->validate([
            'judul'   => ['required'],
            'tanggal' => ['required', 'date'],
        ]);

        $jadwal = JadwalPengajian::find($id);
        $jadwal->title    = $request->judul;
        $jadwal->start    = $request->tanggal;
        $jadwal->save();

        return redirect()->route('jadwal-pengajian.index')->with('success', 'Jadwal Pengajian Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal_pengajian = JadwalPengajian::find($id);
        $jadwal_pengajian->delete();
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}
