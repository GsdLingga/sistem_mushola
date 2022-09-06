<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Semester;
use App\Models\Absensi;
use App\Models\Spp;
use App\Models\Nilai;
use App\Models\Pengajar;
use App\Models\AnggotaKelas;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getNextId(){

        $statement = DB::select("show table status like 'siswa'");
        return $statement[0]->Auto_increment;
    }

    public function index()
    {
        Carbon::setLocale('id');
        $role = Auth::user()->role;
        $id = Auth::user()->id;
        $semester_active = Semester::select('id','tahun_ajaran')
            ->where('status',"1")->first();
        $get_kelas = Pengajar::where([['id_user',$id],['id_semester',$semester_active->id]])->pluck('id_kelas')->toArray();

        if ($role == 'Guru') {
            $siswa = Siswa::select('siswa.id as id','siswa.nama','siswa.no_induk','kelas.nama_kelas','siswa.jenis_kelamin','siswa.alamat','siswa.telepon')
            ->join('anggota_kelas','anggota_kelas.id_siswa','=','siswa.id')
            ->join('kelas','kelas.id','=','anggota_kelas.id_kelas')
            ->where([['siswa.status','=','1']])
            ->whereIn('kelas.id',$get_kelas)
            ->get();
        } else {
            $siswa = Siswa::select('siswa.id as id','siswa.nama','siswa.no_induk','kelas.nama_kelas','siswa.jenis_kelamin','siswa.alamat','siswa.telepon')
            ->join('anggota_kelas','anggota_kelas.id_siswa','=','siswa.id')
            ->join('kelas','kelas.id','=','anggota_kelas.id_kelas')
            ->where('siswa.status','=','1')->get();
        }

        return view('content.siswa.siswa_index', compact(
            'siswa'
        ));
        // return Carbon::parse($siswa[0]->tgl_lahir)->translatedFormat('l jS F Y');;
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
        $get_kelas = Pengajar::where('id_user',$id)->pluck('id')->toArray();

        if ($role == 'Guru') {
            $kelas = Kelas::whereIn('kelas.id',$get_kelas)->get();
        } else {
            $kelas = Kelas::get();
        }

        return view('content.siswa.siswa_create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siswa = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_induk' => ['required', 'string', 'numeric'],
            'tgl_lahir' => ['required', 'date'],
            'kelas' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'numeric', 'digits_between:10,13'],
        ]);

        try {
            $get_id = $this->getNextId();

            $semester_active = Semester::select('id','tahun_ajaran')
            ->where('status',"1")->first();

            $siswa = Siswa::create([
                'nama'          => $request->name,
                'no_induk'      => $request->no_induk,
                'tgl_lahir'     => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat'        => $request->alamat,
                'telepon'       => $request->telepon,
                'status'        => 1,
                // 'slug'      => Str::slug($request->name),
            ]);

            $anggota_kelas = AnggotaKelas::create([
                'id_kelas'      => $request->kelas,
                'id_siswa'      => $get_id,
                'id_semester'   => $semester_active->id,
                'status'        => 1,
                // 'slug'      => Str::slug($request->name),
            ]);

            return redirect()->route('siswa.index')->with('success', 'Siswa Created Successfully');
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
        $siswa = Siswa::select('id_siswa as id','nama','no_induk','tgl_lahir','id_kelas','jenis_kelamin','alamat','telepon')
        ->join('anggota_kelas','anggota_kelas.id_siswa','=','siswa.id')
        ->where('siswa.id','=',$id)->first();

        $kelas = Kelas::get();

        // return $siswa;
        return view('content.siswa.siswa_edit', compact(
            'siswa',
            'kelas',
        ));
        // return $siswa;
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
        $siswa = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_induk' => ['required', 'string', 'numeric'],
            'tgl_lahir' => ['required', 'date'],
            'kelas' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'numeric', 'digits_between:10,13'],
        ]);

        DB::beginTransaction();
        try {
            $semester_active = Semester::select('id','tahun_ajaran')
            ->where('status',"1")->first();
            $id_anggota_kelas = AnggotaKelas::where([['id_semester',$semester_active->id],['id_siswa',$id]])->first();

            $siswa = Siswa::find($id);
            $siswa->nama            = $request->name;
            $siswa->no_induk        = $request->no_induk;
            $siswa->tgl_lahir       = $request->tgl_lahir;
            $siswa->jenis_kelamin   = $request->jenis_kelamin;
            $siswa->alamat          = $request->alamat;
            $siswa->telepon         = $request->telepon;
            $siswa->save();

            $anggota_kelas = AnggotaKelas::find($id_anggota_kelas->id);
            $anggota_kelas->id_kelas = $request->kelas;
            $anggota_kelas->save();

            DB::commit();
            return redirect()->route('siswa.index')->with('success', 'Siswa Edit Successfully');
        } catch (Exception $e) {
            DB::rollback();
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
        $get_absensi = Absensi::where('id_siswa', $id)->pluck('id')->toArray();
        $get_spp = Spp::where('id_siswa',$id)->pluck('id')->toArray();
        $get_anggota_kelas =  AnggotaKelas::where('id_siswa',$id)->pluck('id')->toArray();
        $get_nilai =  Nilai::whereIn('id_anggota_kelas',$get_anggota_kelas)->pluck('id')->toArray();

        DB::beginTransaction();
        try {
            Absensi::destroy($get_absensi);
            Spp::destroy($get_spp);
            Nilai::destroy($get_nilai);
            AnggotaKelas::destroy($get_anggota_kelas);
            Siswa::where('id',$id)->delete();
            DB::commit();
            return redirect()->route('siswa.index')->with('success', 'Siswa Deleted Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e);
        }
    }
}
