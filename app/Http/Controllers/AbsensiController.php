<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getdate = Carbon::now();
        $datenow = $getdate->toDateString();
        $absensi = DB::table('absensi')
        ->join('siswa', 'absensi.id_siswa', '=', 'siswa.id' )
        ->select('absensi.*', 'siswa.nama')
        ->where('absensi.tgl', '=', $datenow)
        ->get();
        
        return view('content.absensi.absensi_index', compact(
            'absensi'
        ));
        // return $absensi;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getdate = Carbon::now();
        $datenow = $getdate->toDateString();
        $absensi = DB::table('siswa')
                ->select('siswa.id','siswa.nama')
                ->whereNotIn('siswa.id', 
                    DB::table('absensi')
                    ->select('absensi.id_siswa')
                    ->where('absensi.tgl', '=', $datenow)
                )
                ->get();
        
        return view('content.absensi.absensi_create', compact(
            'absensi'
        ));
        // return $absensi;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get_id = $request->input('id_absen');
        $getdate = Carbon::now();
        $datenow = $getdate->toDateString();

        foreach ($get_id as $id) {
            $absensi  = Absensi::create([
                'id_siswa'      => $id,
                'status'        => 'hadir',
                'tgl'           => $datenow,
            ]);  
        }
        return redirect()->route('absensi.index')->with('success', 'Absensi Created Successfully');
        
        // return $datenow;
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
        $absensi = Absensi::find($id);
        $absensi->delete();

        return redirect()->route('absensi.index')->with('success', 'Absen Deleted Successfully');
    }
}
