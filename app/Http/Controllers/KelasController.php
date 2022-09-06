<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\AnggotaKelas;
use App\Models\Pengajar;
use App\Models\Nilai;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::get();

        return view('content.kelas.kelas_index', compact(
            'kelas'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.kelas.kelas_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelas = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255'],
        ]);

        $lower = Str::lower($request->nama_kelas);

        try {
            $check = Kelas::where('nama_kelas',$lower)->first();

            if (!isset($check)) {
                $kelas = Kelas::create([
                    'nama_kelas'    => $lower,
                ]);

                return redirect()->route('kelas.index')->with('success', 'Kelas Created Successfully');
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
        $kelas = Kelas::where('id',$id)->first();

        return view('content.kelas.kelas_edit', compact(
            'kelas',
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
        $kelas = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255'],
        ]);

        $lower = Str::lower($request->nama_kelas);

        try {
            $check = Kelas::where('nama_kelas',$lower)->first();
            if (isset($check)) {
                if ($id == $check->id) {
                    return redirect()->route('kelas.index')->with('success', 'Kelas Edited Successfully');
                } else {
                    return redirect()->back()->with('error', 'Already Registered');
                }
            } else
                $kelas = Kelas::find($id);
                $kelas->nama_kelas = $lower;
                $kelas->save();

                return redirect()->route('kelas.index')->with('success', 'Kelas Created Successfully');{
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
        $get_pengajar =  Pengajar::where('id_kelas',$id)->pluck('id')->toArray();
        $get_anggota_kelas =  AnggotaKelas::where('id_kelas',$id)->pluck('id')->toArray();
        $get_nilai =  Nilai::whereIn('id_anggota_kelas',$get_anggota_kelas)->pluck('id')->toArray();

        DB::beginTransaction();
        try {
            Pengajar::destroy($get_pengajar);
            Nilai::destroy($get_nilai);
            AnggotaKelas::destroy($get_anggota_kelas);
            Kelas::where('id',$id)->delete();
            DB::commit();
            return redirect()->route('kelas.index')->with('success', 'Kelas Deleted Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e);
        }
    }
}
