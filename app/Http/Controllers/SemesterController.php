<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use Carbon\Carbon;

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
                    'status'       => 0,
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
        $semester = Semester::where('id',$id)->first();

        return view('content.kelas.kelas_edit', compact(
            'semester',
        ));
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
