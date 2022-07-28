<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaKelas;
use App\Models\Semester;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semester_aktif = Semester::where('status', '1')->first();
        $siswa = AnggotaKelas::where('id_semester', $semester_aktif->id)->count();
        $kelasA = AnggotaKelas::where([
            ['id_semester', '=', $semester_aktif->id],
            ['id_kelas', '=', '1']
        ])->count();
        $kelasB = AnggotaKelas::where([
            ['id_semester', $semester_aktif->id],
            ['id_kelas', 2]
        ])->count();
        $kelasC = AnggotaKelas::where([
            ['id_semester', $semester_aktif->id],
            ['id_kelas', 3]
        ])->count();
        $kelasD = AnggotaKelas::where([
            ['id_semester', $semester_aktif->id],
            ['id_kelas', 4]
        ])->count();
        return view('content.home', compact(
            'siswa',
            'kelasA',
            'kelasB',
            'kelasC',
            'kelasD'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
}
