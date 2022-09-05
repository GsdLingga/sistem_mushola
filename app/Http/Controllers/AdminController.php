<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AnggotaKelas;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;
        $semester_aktif = Semester::where('status', '1')->first();
        $siswa = AnggotaKelas::where('id_semester', $semester_aktif->id)->count();

        $chart_get_kelas = Kelas::get();
        $chart_get_anggota_kelas = AnggotaKelas::where('id_semester',$semester_aktif->id)->get();

        $chart_get_total_kelas = [];
        foreach ($chart_get_kelas as $chart_kls) {
            $counter = 0;
            foreach ($chart_get_anggota_kelas as $chart_anggota) {
                if ($chart_anggota->id_kelas == $chart_kls->id) {
                    $counter += 1;
                }
            }
            $chart_kls->total = $counter;
            array_push($chart_get_total_kelas, $chart_kls);
        }

        $chart_total_anggota_kelas = $chart_get_anggota_kelas->count();

        $total_user = User::count();
        $admin = User::where('role', 'Admin')->count();
        $pengurus = User::where('role', 'Pengurus')->count();
        $guru = User::where('role', 'Guru')->count();

        return view('content.home', compact(
            'siswa',
            'role',
            'chart_get_total_kelas',
            'chart_total_anggota_kelas',
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
