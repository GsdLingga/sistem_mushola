<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaKelas;
use App\Models\Siswa;
use App\Models\Semester;
use App\Models\Kelas;

class AnggotaKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $semester_active = Semester::where('status', '1')->first();
        // $anggota_kelas = AnggotaKelas::join('siswa', 'anggota_kelas.id_siswa', '=', 'siswa.id')
        // ->join('kelas', 'anggota_kelas.id_kelas', '=', 'kelas.id')
        // ->join('semester', 'anggota_kelas.id_semester', '=', 'semester.id')
        // ->where('id_semester', $semester_active->id)->get();

        $anggota_kelas = AnggotaKelas::select('anggota_kelas.id as id','id_siswa', 'id_kelas', 'id_semester', 'nama', 'nama_kelas', 'tahun_ajaran')
        ->join('siswa', 'anggota_kelas.id_siswa', '=', 'siswa.id')
        ->join('kelas', 'anggota_kelas.id_kelas', '=', 'kelas.id')
        ->join('semester', 'anggota_kelas.id_semester', '=', 'semester.id')
        ->where('anggota_kelas.status', 1)
        ->get();

        // return $anggota_kelas;

        return view('content.anggota_kelas.anggota_kelas_index', compact(
            'anggota_kelas'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semester = Semester::get();
        $kelas = Kelas::get();
        $siswa = Siswa::get();

        return view('content.anggota_kelas.anggota_kelas_create', compact(
            'semester','kelas','siswa',
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
        // return $request->all();
        $anggota_kelas = $request->validate([
            'nama' => ['required', 'string'],
            'kelas' => ['required', 'string'],
            'semester' => ['required', 'string'],
        ]);

        $anggota_kelas  = AnggotaKelas::create([
            'id_siswa'      => $request->nama,
            'id_kelas'      => $request->kelas,
            'id_semester'   => $request->semester,
            'status'        => 1
        ]);

        return redirect()->route('anggota_kelas.index')->with('success', 'Anggota Kelas Created Successfully');
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
        $semester = Semester::get();
        $kelas = Kelas::get();
        $siswa = Siswa::get();
        $anggota_kelas = AnggotaKelas::join('siswa', 'anggota_kelas.id_siswa', '=', 'siswa.id')
        ->where('anggota_kelas.id', $id)->first();

        return view('content.anggota_kelas.anggota_kelas_edit', compact(
            'semester','kelas','siswa','anggota_kelas',
        ));
        // return $anggota_kelas;
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
        $anggota_kelas = $request->validate([
            'kelas' => ['required', 'string'],
            'semester' => ['required', 'string'],
        ]);

        $anggota_kelas = AnggotaKelas::find($id);
        $anggota_kelas->id_kelas    = $request->kelas;
        $anggota_kelas->id_semester = $request->semester;
        $anggota_kelas->save();

        return redirect()->route('anggota_kelas.index')->with('success', 'Anggota Kelas Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $get_nilai =  Nilai::whereIn('id_anggota_kelas',$id)->pluck('id')->toArray();

        DB::beginTransaction();
        try {
            Nilai::destroy($get_nilai);
            AnggotaKelas::where('id',$id)->delete();
            DB::commit();
            return redirect()->route('anggota_kelas.index')->with('success', 'Anggota Kelas Deleted Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e);
        }
    }
}
