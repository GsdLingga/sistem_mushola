<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raport;
use App\Models\Siswa;
use App\Models\Semester;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\AnggotaKelas;
use PDF;
use Illuminate\Support\Facades\DB;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::select('id','nama')->get();
        $semester_active = Semester::select('id','tahun_ajaran')
        ->where('status',"1")->first();

        $raport = DB::table('raport')
        ->join('anggota_kelas','anggota_kelas.id', '=', 'raport.id_anggota_kelas')
        ->join('siswa','siswa.id', '=', 'anggota_kelas.id_siswa')
        ->join('kelas','kelas.id','=','anggota_kelas.id_siswa')
        ->where('anggota_kelas.id_semester', $semester_active->id)
        // ->select('raport.*','siswa.nama')
        ->get();

        // return $raport;

        $semester = Semester::select('id','tahun_ajaran')->get();
        $kelas = Kelas::select('id', 'nama_kelas')->get();

        return view('content.raport.raport_index', compact(
            'raport',
            // 'siswa',
            'semester',
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
        $kelas = Kelas::select('id','nama_kelas')->get();
        // return $kelas;
        return view('content.raport.raport_create', compact(
            'kelas'
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
        $raport = $request->validate([
            'kelasValue'    => ['required'],
            'nama'          => ['required'],
            'alquran'       => ['required', 'numeric', 'between:0,100'],
            'iqro'          => ['required', 'numeric', 'between:0,100'],
            'aqidah_akhlak' => ['required', 'numeric', 'between:0,100'],
            'hafalan_surat' => ['required', 'numeric', 'between:0,100'],
            'pai'           => ['required', 'numeric', 'between:0,100'],
            'tajwid'        => ['required', 'numeric', 'between:0,100'],
            'khot'          => ['required', 'numeric', 'between:0,100'],
        ]);

        $semester_active = Semester::select('id','tahun_ajaran')
                            ->where('status',"1")->first();

        $get_anggota_kelas = AnggotaKelas::where("id_kelas", $request->kelasValue)
                                            ->where("id_semester", $semester_active->id)
                                            ->where("id_siswa", $request->nama)
                                            ->first();

        $raport  = Raport::create([
            'id_anggota_kelas'  => $get_anggota_kelas->id,
            'alquran'           => $request->alquran,
            'iqro'              => $request->iqro,
            'aqidah_akhlak'     => $request->aqidah_akhlak,
            'hafalan_surat'     => $request->hafalan_surat,
            'pai'               => $request->pai,
            'tajwid'            => $request->tajwid,
            'khot'              => $request->khot,
        ]);

        return redirect()->route('raport.index')->with('success', 'Raport Created Successfully');

        // return $request->all();
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
        $raport = Raport::where('id','=',$id)->first();
        $get_anggota_kelas = AnggotaKelas::where('id', $raport->id_anggota_kelas)->first();
        $siswa = Siswa::where('id',$get_anggota_kelas->id_siswa)->first();
        // return $siswa;
        return view('content.raport.raport_edit', compact(
            'raport',
            'siswa'
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
        $raport = $request->validate([
            'alquran' => ['required', 'numeric', 'between:0,100'],
            'iqro' => ['required', 'numeric', 'between:0,100'],
            'aqidah_akhlak' => ['required', 'numeric', 'between:0,100'],
            'hafalan_surat' => ['required', 'numeric', 'between:0,100'],
            'pai' => ['required', 'numeric', 'between:0,100'],
            'tajwid' => ['required', 'numeric', 'between:0,100'],
            'khot' => ['required', 'numeric', 'between:0,100'],
        ]);

        $raport = Raport::find($id);
        $raport->alquran        = $request->alquran;
        $raport->iqro           = $request->iqro;
        $raport->aqidah_akhlak  = $request->aqidah_akhlak;
        $raport->hafalan_surat  = $request->hafalan_surat;
        $raport->pai            = $request->pai;
        $raport->tajwid         = $request->tajwid;
        $raport->khot           = $request->khot;
        $raport->save();

        return redirect()->route('raport.index')->with('success', 'Raport Edited Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $raport = Raport::find($id);
        $raport->delete();

        return redirect()->route('raport.index')->with('success', 'Nilai Deleted Successfully');
    }

    public function createPDF(Request $request)
    {
        $get_anggota_kelas = AnggotaKelas::where("id_kelas", $request->kelasValue)
                                            ->where("id_semester", $request->semesterValue)
                                            ->where("id_siswa", $request->siswaValue)
                                            ->first();
        $temp_semester = Semester::select('tahun_ajaran')->where('id', $request->semesterValue)->first();
        $temp_kelas = Kelas::where('id', $request->kelasValue)->first();
        $explode_semester = explode(' ', $temp_semester->tahun_ajaran);
        $semester = $explode_semester[0];
        $tahun_pelajaran = $explode_semester[1];
        $kelas = ucfirst($temp_kelas->nama_kelas);

        $siswa = Siswa::where('id', $request->siswaValue)->first();

        $izin = Absensi::where([
            ['id_siswa', $request->siswaValue],
            ['status', 'izin']
            ])->get()->count();

        $alpa = Absensi::where([
            ['id_siswa', $request->siswaValue],
            ['status', 'alpa']
            ])->get()->count();

        $sakit = Absensi::where([
            ['id_siswa', $request->siswaValue],
            ['status', 'sakit']
            ])->get()->count();

        $total_kehadiran = $sakit + $izin + $alpa;

        $kehadiran = [
            'sakit' => $sakit,
            'alpa'  => $alpa,
            'izin'  => $izin,
            'total' => $total_kehadiran,
        ];

        $nilai = Raport::join('anggota_kelas','anggota_kelas.id', '=', 'raport.id_anggota_kelas')
                        ->where('anggota_kelas.id_semester', $request->semesterValue)
                        ->where('anggota_kelas.id_kelas', $request->kelasValue)
                        ->get();

        $rata_alquran = $nilai->avg('alquran');
        $rata_iqro = $nilai->avg('iqro');
        $rata_aqidah_akhlak = $nilai->avg('aqidah_akhlak');
        $rata_hafalan_surat = $nilai->avg('hafalan_surat');
        $rata_pai = $nilai->avg('pai');
        $rata_tajwid = $nilai->avg('tajwid');
        $rata_khot = $nilai->avg('khot');
        $rata_all = round(collect([
            $rata_alquran,
            $rata_iqro,
            $rata_aqidah_akhlak,
            $rata_hafalan_surat,
            $rata_pai,
            $rata_tajwid,
            $rata_khot,
        ])->average(), 1);

        $nilai_siswa = $nilai->where("id_anggota_kelas", $get_anggota_kelas->id)->first();
        $rata_siswa = round(collect([
            $nilai_siswa->alquran,
            $nilai_siswa->iqro,
            $nilai_siswa->aqidah_akhlak,
            $nilai_siswa->hafalan_surat,
            $nilai_siswa->pai,
            $nilai_siswa->tajwid,
            $nilai_siswa->khot,
        ])->average(), 1);

        $rata_rata = [
            'alquran'       => $rata_alquran,
            'iqro'          => $rata_iqro,
            'aqidah_akhlak' => $rata_aqidah_akhlak,
            'hafalan_surat' => $rata_hafalan_surat,
            'pai'           => $rata_pai,
            'tajwid'        => $rata_tajwid,
            'khot'          => $rata_khot,
            'all'           => $rata_all,
            'siswa'         => $rata_siswa,
        ];

        // $rank = Raport::from('')->sum(DB::raw('alquran + iqro'));

        // $agents = User::where('is_admin','=', 'false')->get();
        $tempNilai = [];
        foreach ($nilai as $point) {
            $tempNilai[] = [
                'id_anggota_kelas'  => $point->id_anggota_kelas,
                'nilai'             => $point->alquran + $point->iqro + $point->aqidah_akhlak + $point->hafalan_surat + $point->pai + $point->tajwid + $point->khot
            ];
        }

        // return $tempNilai;

        $sortDesc = collect($tempNilai)->sortByDesc('nilai');

        // return $sortDesc['id_anggota_kelas'];

        $increment = 1;
        $rank = [];
        foreach ($sortDesc as $sort){
            $rank[] = [
                'id_anggota_kelas'  => $sort['id_anggota_kelas'],
                'nilai'             => $sort['nilai'],
                'rank'              => $increment
            ];
            $increment += 1;
        }

        $rank_siswa = $rank[array_search($get_anggota_kelas->id, array_column($rank, 'id_anggota_kelas'))];

        // return $rank_siswa['rank'];

        $data = [
            'semester'          => $semester,
            'kelas'             => $kelas,
            'tahun_pelajaran'   => $tahun_pelajaran,
            'siswa'             => $siswa,
            'nilai'             => $nilai_siswa,
            'rata_rata'         => $rata_rata,
            'kehadiran'         => $kehadiran,
            'ranking'           => $rank_siswa['rank'],
        ];

        // return $data;

        $pdf = PDF::loadView('content.raport.raport_pdf', $data);

        // $pdf = PDF::loadView('content.raport.raport_pdf');

        return $pdf->download('raport.pdf');

    }
}
