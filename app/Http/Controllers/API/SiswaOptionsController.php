<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnggotaKelas;
use App\Models\Semester;
use App\Models\Siswa;

class SiswaOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSiswaOptions(Request $request) {
        // return response()->json($request->semesterValue);
        $kelas = AnggotaKelas::select('id_siswa')->where([
            ['id_semester', '=', $request->semesterValue],
            ['id_kelas', '=', $request->kelasValue]
            ])->get();

        $siswa = Siswa::select('id', 'nama')
        ->whereIn('id', $kelas)
        ->get();
        return response()->json($siswa);
    }

    public function getSiswaCreate(Request $request) {
        // return response()->json($request->semesterValue);
        $semesterActive = Semester::where('status','1')->first();
        $kelas = AnggotaKelas::select('id_siswa')->where([
            ['id_semester', '=', $semesterActive->id],
            ['id_kelas', '=', $request->kelasValue]
            ])->get();

        $siswa = Siswa::select('id', 'nama')
        ->whereIn('id', $kelas)
        ->get();
        return response()->json($siswa);
    }

    // public function getNilaiCreate(Request $request) {
    //     // return response()->json($request->all());
    //     try {
    //         $semesterActive = Semester::where('status','1')->first();
    //         $anggota_kelas = Nilai::select('id_siswa')->where([
    //             ['id_semester', '=', $semesterActive->id],
    //             ['id_kelas', '=', $request->kelasValue]
    //             ])->get();

    //         $siswa = Siswa::select('id', 'nama')
    //         ->whereIn('id', $kelas)
    //         ->get();
    //         return response()->json($siswa);
    //     } catch (\Throwable $th) {
    //         return response()->json($th);
    //     }
    // }
}
