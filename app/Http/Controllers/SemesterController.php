<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Pengajar;
use App\Models\Nilai;
use App\Models\AnggotaKelas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semester = Semester::get();

        return view('content.semester.semester_index', compact(
            'semester'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.semester.semester_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $semester = $request->validate([
            'semester' => ['required'],
            'tahun_ajaran' => ['required']
        ]);

        $tahun_ajaran =  new Carbon($request->tahun_ajaran);
        $tahun_ajaran_awal = $tahun_ajaran->year;
        $tahun_ajaran_akhir = $tahun_ajaran_awal +1;
        $combine_semester = $request->semester.' '.$tahun_ajaran_awal.'/'.$tahun_ajaran_akhir;

        try {
            $check = Semester::where('tahun_ajaran',$combine_semester)->first();

            if (!isset($check)) {
                $semester = Semester::create([
                    'tahun_ajaran' => $combine_semester,
                    'status'       => '0',
                ]);

                return redirect()->route('semester.index')->with('success', 'Semester Created Successfully');
            } else {
                return redirect()->back()->with('error', 'Already Registered');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
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
        $semester = Semester::where('id',$id)->first();
        $get_tahun_ajaran =  explode(' ',$semester->tahun_ajaran);
        $periode = $get_tahun_ajaran[0];
        $split_tahun_ajaran = explode('/',$get_tahun_ajaran[1]);
        $format_tahun_awal_ajaran = strtotime('1/1/'.$split_tahun_ajaran[0].'T00:00');
        $tahun_awal_ajaran = new Carbon($format_tahun_awal_ajaran);

        $semester->periode = $periode;
        $semester->awal_ajaran = $tahun_awal_ajaran;

        return view('content.semester.semester_edit', compact(
            'semester',
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
        $semester = $request->validate([
            'semester' => ['required'],
            'tahun_ajaran' => ['required']
        ]);

        $tahun_ajaran =  new Carbon($request->tahun_ajaran);
        $tahun_ajaran_awal = $tahun_ajaran->year;
        $tahun_ajaran_akhir = $tahun_ajaran_awal +1;
        $combine_semester = $request->semester.' '.$tahun_ajaran_awal.'/'.$tahun_ajaran_akhir;

        try {
            $check = Semester::where('tahun_ajaran',$combine_semester)->first();

            if (isset($check)) {
                if ($id == $check->id) {
                    return redirect()->route('semester.index')->with('success', 'Semester Edited Successfully');
                } else {
                    return redirect()->back()->with('error', 'Already Registered');
                }
            } else {
                $semester = Semester::find($id);
                $semester->tahun_ajaran = $combine_semester;
                $semester->save();
                return redirect()->route('semester.index')->with('success', 'Semester Edited Successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $get_pengajar =  Pengajar::where('id_semester',$id)->pluck('id')->toArray();
        $get_anggota_kelas =  AnggotaKelas::where('id_semester',$id)->pluck('id')->toArray();
        $get_nilai =  Nilai::whereIn('id_anggota_kelas',$get_anggota_kelas)->pluck('id')->toArray();

        DB::beginTransaction();
        try {
            Pengajar::destroy($get_pengajar);
            Nilai::destroy($get_nilai);
            AnggotaKelas::destroy($get_anggota_kelas);
            Semester::where('id',$id)->delete();
            DB::commit();
            return redirect()->route('semester.index')->with('success', 'Semester Deleted Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e);
        }
    }

    public function changeSemester(Request $request)
    {
        DB::beginTransaction();
        try {
            Semester::query()->update(['status' => '0']);
            Semester::where('id',$request->semester)->update(['status' => '1']);
            DB::commit();
            return redirect()->route('semester.index')->with('success', 'Semester Changed Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e);
        }
    }
}
