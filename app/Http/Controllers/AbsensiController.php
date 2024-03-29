<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Semester;
use App\Models\Pengajar;
use App\Models\Absensi;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;
        $id = Auth::user()->id;
        $getdate = Carbon::now();
        $datenow = $getdate->toDateString();
        $get_kelas = Pengajar::where('id_user',$id)->pluck('id')->toArray();

        if ($role == 'Guru') {
            $absensi = DB::table('absensi')
            ->join('siswa', 'absensi.id_siswa', '=', 'siswa.id' )
            ->join('anggota_kelas','anggota_kelas.id_siswa','=','siswa.id')
            ->join('kelas','kelas.id','=','anggota_kelas.id_kelas')
            ->select('absensi.*', 'siswa.nama','kelas.nama_kelas')
            ->where([['absensi.tgl', '=', $datenow]])
            ->whereIn('kelas.id',$get_kelas)
            ->get();
        } else {
            $absensi = DB::table('absensi')
            ->join('siswa', 'absensi.id_siswa', '=', 'siswa.id' )
            ->select('absensi.*', 'siswa.nama')
            ->where('absensi.tgl', '=', $datenow)
            ->get();
        }

        // return $absensi;
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
        $role = Auth::user()->role;
        $id = Auth::user()->id;
        $getdate = Carbon::now();
        $datenow = $getdate->toDateString();
        $semester_active = Semester::select('id','tahun_ajaran')
            ->where('status',"1")->first();
        $get_kelas = Pengajar::where([['id_user',$id],['id_semester',$semester_active->id]])->pluck('id_kelas')->toArray();

        if ($role == 'Guru') {
            $absensi = DB::table('siswa')
                ->select('siswa.id','siswa.nama', 'kelas.nama_kelas')
                ->join('anggota_kelas','anggota_kelas.id_siswa','=','siswa.id')
                ->join('kelas','anggota_kelas.id_kelas','=','kelas.id')
                ->where([['siswa.status', '1']])
                ->whereIn('kelas.id',$get_kelas)
                ->whereNotIn('siswa.id',
                    DB::table('absensi')
                    ->select('absensi.id_siswa')
                    ->where('absensi.tgl', '=', $datenow)
                )
                ->get();
        }else {
            $absensi = DB::table('siswa')
                ->select('siswa.id','siswa.nama', 'kelas.nama_kelas')
                ->join('anggota_kelas','anggota_kelas.id_siswa','=','siswa.id')
                ->join('kelas','anggota_kelas.id_kelas','=','kelas.id')
                ->where('siswa.status', '1')
                ->whereNotIn('siswa.id',
                    DB::table('absensi')
                    ->select('absensi.id_siswa')
                    ->where('absensi.tgl', '=', $datenow)
                )
                ->get();
        }

        return view('content.absensi.absensi_create', compact(
            'absensi'
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
        $get_absen = $request->radio;
        $getdate = Carbon::now();
        $arrayId = [];
        $arrayAbsen = [];
        $datenow = $getdate->toDateString();
        for ($i=1; $i <= count($get_absen) ; $i++) {
            $save = $get_absen['absen'.$i];
            $simpan = explode("-", $save);
            $arrayAbsen[] = $simpan[0];
            $arrayId[] = $simpan[1];
        }

        for ($i=0; $i < count($arrayId) ; $i++) {
            // Log::info($arrayId[$i]);
            $absensi  = Absensi::create([
                'id_siswa'      => $arrayId[$i],
                'status'        => $arrayAbsen[$i],
                'tgl'           => $datenow,
            ]);
        }
        return redirect()->route('absensi.index')->with('success', 'Absensi Created Successfully');
        // return count($arrayId);

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
        $absensi = Absensi::select('absensi.id as id', 'nama', 'absensi.status as status')
        ->join('siswa', 'absensi.id_siswa', '=', 'siswa.id')
        ->where('absensi.id', $id)->first();
        // return $absensi;
        return view('content.absensi.absensi_edit', compact(
            'absensi'
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
        $absensi = $request->validate([
            'status' => ['required', 'string'],
        ]);

        $absensi = Absensi::find($id);
        $absensi->status = $request->status;
        $absensi->save();

        return redirect()->route('absensi.index')->with('success', 'Absensi Edit Successfully');
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
