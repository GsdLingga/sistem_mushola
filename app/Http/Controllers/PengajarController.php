<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajar;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajar = Pengajar::select('pengajar.id','nama_kelas','name','tahun_ajaran')
        ->join('kelas','kelas.id','=','pengajar.id_kelas')
        ->join('users','users.id','=','pengajar.id_user')
        ->join('semester','semester.id','=','pengajar.id_semester')
        ->get();

        return view('content.pengajar.Pengajar_index', compact(
            'pengajar'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::get();
        $semester = Semester::get();
        $guru = User::where('role','Guru')->get();
        return view('content.pengajar.pengajar_create', compact(
            'kelas',
            'semester',
            'guru'
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
        $pengajar = $request->validate([
            'guru' => ['required'],
            'kelas' => ['required'],
            'semester' => ['required'],
        ]);

        try {
            $check = Pengajar::where([
                ['id_user',$request->guru],
                ['id_semester', $request->semester],
                ['id_kelas', $request->kelas]
                ])->first();

            if (!isset($check)) {
                $pengajar = Pengajar::create([
                    'id_user'        => $request->guru,
                    'id_kelas'       => $request->kelas,
                    'id_semester'    => $request->semester,
                ]);

                return redirect()->route('pengajar.index')->with('success', 'Pengajar Created Successfully');
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
        $pengajar = Pengajar::where('id',$id)->first();
        $kelas = Kelas::get();
        $semester = Semester::get();
        $guru = User::where('role','Guru')->get();
        return view('content.pengajar.pengajar_edit', compact(
            'kelas',
            'semester',
            'guru',
            'pengajar'
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
        $pengajar = $request->validate([
            'guru' => ['required'],
            'kelas' => ['required'],
            'semester' => ['required'],
        ]);

        try {
            $check = Pengajar::where([
                ['id_user',$request->guru],
                ['id_semester', $request->semester],
                ['id_kelas', $request->kelas]
                ])->first();

            if (isset($check)) {
                if ($id == $check->id) {
                    return redirect()->route('pengajar.index')->with('success', 'Pengajar Created Successfully');
                } else {
                    return redirect()->back()->with('error', 'Already Registered');
                }
            } else {
                $pengajar = Pengajar::find($id);
                $pengajar->id_user = $request->guru;
                $pengajar->id_kelas = $request->kelas;
                $pengajar->id_semester = $request->semester;
                $pengajar->save();

                return redirect()->route('pengajar.index')->with('success', 'Pengajar Updated Successfully');
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
        DB::beginTransaction();
        try {
            Pengajar::where('id',$id)->delete();
            DB::commit();
            return redirect()->route('pengajar.index')->with('success', 'Pengajar Deleted Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e);
        }
    }
}
