<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AnggotaKelas;
use App\Models\Pengajar;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\User;
class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $role = Auth::user()->role;
        $semester_aktif = Semester::where('status', '1')->first();
        $kelas = Kelas::where('id_guru', $id)->first();
        $siswa = AnggotaKelas::where([['id_semester', $semester_aktif->id],
        ['id_kelas', $kelas->id]])->count();
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

        $total_user = User::count();
        $admin = User::where('role', 'Admin')->count();
        $pengurus = User::where('role', 'Pengurus')->count();
        $guru = User::where('role', 'Guru')->count();

        return view('content.home', compact(
            'role',
            'kelas',
            'siswa',
            'kelasA',
            'kelasB',
            'kelasC',
            'kelasD',
            'admin',
            'pengurus',
            'guru',
            'total_user'
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
