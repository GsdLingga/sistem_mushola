<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Raport;
use App\Models\Pengajar;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Semester;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\AnggotaKelas;
use PDF;
use \stdClass;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;

        // return $role;

        $siswa = Siswa::select('id','nama')->get();
        $semester_active = Semester::select('id','tahun_ajaran')
        ->where('status',"1")->first();
        $mata_pelajaran = MataPelajaran::get();

        if ($role == 'Guru') {
            $id = Auth::user()->id;
            $pengajar = Pengajar::where([['id_user',$id],['id_semester',$semester_active->id]])->first();
            // return $semester_active;
            $nilai = DB::table('nilai')
            ->join('anggota_kelas','anggota_kelas.id', '=', 'nilai.id_anggota_kelas')
            ->join('siswa','siswa.id', '=', 'anggota_kelas.id_siswa')
            ->join('kelas','kelas.id','=','anggota_kelas.id_siswa')
            ->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'nilai.id_mata_pelajaran')
            ->where([['anggota_kelas.id_semester', $semester_active->id], ['kelas.id', $pengajar->id_kelas]])
            ->get();
            // return $nilai;
        }else {
            $nilai = DB::table('nilai')
            ->join('anggota_kelas','anggota_kelas.id', '=', 'nilai.id_anggota_kelas')
            ->join('siswa','siswa.id', '=', 'anggota_kelas.id_siswa')
            ->join('kelas','kelas.id','=','anggota_kelas.id_siswa')
            ->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'nilai.id_mata_pelajaran')
            ->where('anggota_kelas.id_semester', $semester_active->id)
            // ->select('raport.*','siswa.nama')
            ->get();
        }

        // return $mata_pelajaran;

        $semester = Semester::select('id','tahun_ajaran')->get();
        $kelas = Kelas::select('id', 'nama_kelas')->get();

        // return $nilai;

        return view('content.nilai.nilai_index', compact(
            'nilai',
            'semester',
            'kelas',
            'mata_pelajaran'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // $rules = [
        //     'kelas' => 'required',
        //     'mata_pelajaran' => 'required',
        // ];

        // $customMessages = [
        //     'required' => 'The :attribute field is required.'
        // ];

        // $this->validate($request, $rules, $customMessages);

        $role = Auth::user()->role;

        // return $id;

        if ($role == 'Guru') {
            $id = Auth::user()->id;
            $semester_active = Semester::select('id','tahun_ajaran')
                            ->where('status',"1")->first();
            $pengajar = Pengajar::where([['id_user',$id],['id_semester',$semester_active->id]])->first();
            // return $semester_active;
            $kelas = Kelas::select('id','nama_kelas')
            ->where('id',$pengajar->id_kelas)
            ->first();
        }else {
            $kelas = Kelas::select('id','nama_kelas')
            ->where('id',$request->kelas)
            ->first();
        }

        $mata_pelajaran = MataPelajaran::select('id','nama_pelajaran')
        ->where('id',$request->mata_pelajaran)
        ->first();

        $semester_active = Semester::select('id','tahun_ajaran')
                            ->where('status',"1")->first();

        $nilai = Nilai::where('id_mata_pelajaran', $mata_pelajaran->id)
        ->pluck('id_anggota_kelas')->all();

        $anggota_kelas = AnggotaKelas::join('siswa', 'anggota_kelas.id_siswa', '=', 'siswa.id')
        ->where([['id_semester', $semester_active->id], ['id_kelas', $kelas->id]])
        ->whereNotIn('anggota_kelas.id', $nilai)
        ->get();

        // return $anggota_kelas->isEmpty();

        if ($anggota_kelas->isEmpty()) {
            return redirect()->back()->with('error', 'Semua Anggota Kelas Sudah Memiliki Nilai');
        }else {
            return view('content.nilai.nilai_create', compact(
                'anggota_kelas',
                'mata_pelajaran',
                'kelas'
            ));
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'kelas_id'              => ['required'],
            'mata_pelajaran_id'     => ['required'],
            'id'                    => ['required'],
            'nilai.*'               => ['required', 'numeric', 'between:0,100'],
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.',
            // 'between' => 'The nilai field must be between 0 and 100.',
        ];

        $this->validate($request, $rules, $customMessages);

        // return $request;

        try {
            // $semester_active = Semester::select('id','tahun_ajaran')
            //                 ->where('status',"1")->first();

            // $get_anggota_kelas = AnggotaKelas::where("id_kelas", $request->kelasValue)
            //                                     ->where("id_semester", $semester_active->id)
            //                                     ->where("id_siswa", $request->nama)
            //                                     ->first();

            $pelajaran = [];

            for ($i=0; $i < count($request->id) ; $i++) {
                $temp = ['id_anggota_kelas' => $request->id[$i], 'id_mata_pelajaran' => $request->mata_pelajaran_id, 'nilai' => $request->nilai[$i]];
                array_push($pelajaran, $temp);
                // return $temp;
            }

            $nilai = Nilai::insert($pelajaran);

            // return $pelajaran;

            // $raport  = Raport::create([
            //     'id_anggota_kelas'  => $get_anggota_kelas->id,
            //     'alquran'           => $request->alquran,
            //     'iqro'              => $request->iqro,
            //     'aqidah_akhlak'     => $request->aqidah_akhlak,
            //     'hafalan_surat'     => $request->hafalan_surat,
            //     'pai'               => $request->pai,
            //     'tajwid'            => $request->tajwid,
            //     'khot'              => $request->khot,
            // ]);

            return redirect()->route('nilai.index')->with('success', 'Nilai Created Successfully');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e);
        }

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
        $nilai = Nilai::join('anggota_kelas','anggota_kelas.id','=', 'nilai.id_anggota_kelas')
        ->join('siswa','siswa.id','=','anggota_kelas.id_siswa')
        ->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'nilai.id_mata_pelajaran')
        ->join('kelas','kelas.id','=','anggota_kelas.id_kelas')
        ->where('nilai.id','=',$id)->first();
        // $get_anggota_kelas = AnggotaKelas::where('id', $raport->id_anggota_kelas)->first();
        // $siswa = Siswa::where('id',$get_anggota_kelas->id_siswa)->first();
        // return $nilai;
        return view('content.nilai.nilai_edit', compact(
            'nilai',
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
        $nilai = $request->validate([
            'nilai' => ['required', 'numeric', 'between:0,100'],
        ]);

        $nilai = Nilai::find($id);
        $nilai->nilai = $request->nilai;
        $nilai->save();

        return redirect()->route('nilai.index')->with('success', 'Nilai Edited Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai = Nilai::find($id);
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Nilai Deleted Successfully');
    }

    public function createPDF(Request $request)
    {
        $get_anggota_kelas = AnggotaKelas::where("id_kelas", $request->kelas)
                                            ->where("id_semester", $request->semester)
                                            ->where("id_siswa", $request->siswa)
                                            ->first();
        $temp_semester = Semester::select('tahun_ajaran')->where('id', $request->semester)->first();
        $temp_kelas = Kelas::where('id', $request->kelas)->first();
        $explode_semester = explode(' ', $temp_semester->tahun_ajaran);
        $semester = $explode_semester[0];
        $tahun_pelajaran = $explode_semester[1];
        $kelas = ucfirst($temp_kelas->nama_kelas);

        $siswa = Siswa::where('id', $request->siswa)->first();

        $izin = Absensi::where([
            ['id_siswa', $request->siswa],
            ['status', 'izin']
            ])->get()->count();

        $alpa = Absensi::where([
            ['id_siswa', $request->siswa],
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

        $mata_pelajaran = MataPelajaran::get();

        $nilai = Nilai::join('anggota_kelas','anggota_kelas.id', '=', 'nilai.id_anggota_kelas')
                        ->where('anggota_kelas.id_semester', $request->semester)
                        ->where('anggota_kelas.id_kelas', $request->kelas)
                        ->get();

        if (count($nilai) == 0) {
            return redirect()->back()->with('error', 'Belum ada nilai di kelas ini.');;
        }

        $rata_nilai_object = [];
        $rata_nilai_array = [];
        for ($i=0; $i < count($mata_pelajaran); $i++) {
            $temp_nilai = $nilai->where('id_mata_pelajaran', $mata_pelajaran[$i]->id)->pluck('nilai')->toArray();
            $average = array_sum($temp_nilai)/count($temp_nilai);
            array_push($rata_nilai_object, [$mata_pelajaran[$i]->nama_pelajaran => $average]);
            array_push($rata_nilai_array, $average);
        }

        //change array to object
        $rata_all = new StdClass();
        foreach ($rata_nilai_object as $ratas) {
            foreach ($mata_pelajaran as $mapel) {
                if (!empty($ratas[$mapel->nama_pelajaran])) {
                    $temp_pelajaran = $mapel->nama_pelajaran;
                    $rata_all->$temp_pelajaran = $ratas[$mapel->nama_pelajaran];
                }
            }
        }

        //get average from all class member
        $temp_rata_all = array_sum($rata_nilai_array)/count($rata_nilai_array);
        $rata_all->{'rata-rata'} = $temp_rata_all;

        $get_nilai_siswa = $nilai->where("id_anggota_kelas", $get_anggota_kelas->id);

        $nilai_siswa = new StdClass();
        foreach ($get_nilai_siswa as $sis) {
            foreach ($mata_pelajaran as $mapel) {
                if ($sis->id_mata_pelajaran == $mapel->id) {
                    $temp_pelajaran = $mapel->nama_pelajaran;
                    $nilai_siswa->$temp_pelajaran = $sis->nilai;
                }
            }
        }

        $temp_rata_siswa = $get_nilai_siswa->avg('nilai');
        $nilai_siswa->{'rata-rata'} = $temp_rata_siswa;

        $tempNilai = [];
        foreach ($nilai as $point) {
            $get_nilai_siswa_all = $nilai->where("id_anggota_kelas", $point->id);

            $nilai_siswa_all = new StdClass();
            foreach ($get_nilai_siswa_all as $sis) {
                foreach ($mata_pelajaran as $mapel) {
                    if ($sis->id_mata_pelajaran == $mapel->id) {
                        $temp_pelajaran = $mapel->nama_pelajaran;
                        $nilai_siswa_all->$temp_pelajaran = $sis->nilai;
                    }
                }
            }

            $temp_rata_siswa = $get_nilai_siswa_all->avg('nilai');
            $nilai_siswa_all->{'rata-rata'} = $temp_rata_siswa;
            // return $nilai_siswa;

            $tempNilai[] = (object)[
                'id_anggota_kelas'  => $point->id_anggota_kelas,
                'rata-rata'         => $nilai_siswa_all->{'rata-rata'}
            ];
        }

        $filterTempNilai = [];
        $check_array = [];
        for ($i=0; $i < count($tempNilai); $i++) {
            if (count($filterTempNilai) == 0) {
                array_push($filterTempNilai, (object)$tempNilai[$i]);
                array_push($check_array, $tempNilai[$i]->id_anggota_kelas);
            }else {
                for ($j=0; $j < count($filterTempNilai); $j++) {
                    if (!in_array($tempNilai[$i]->id_anggota_kelas, $check_array)) {
                        array_push($filterTempNilai, (object)$tempNilai[$i]);
                        array_push($check_array, $tempNilai[$i]->id_anggota_kelas);
                    }
                }
            }
        }

        $sortDesc = collect($filterTempNilai)->sortByDesc('nilai');

        // return $sortDesc;

        $increment = 1;
        $rank = [];
        foreach ($sortDesc as $sort){
            $rank[] = [
                'id_anggota_kelas'  => $sort->{'id_anggota_kelas'},
                'nilai'             => $sort->{'rata-rata'},
                'rank'              => $increment
            ];
            $increment += 1;
        }
        $find_rank = array_search($get_anggota_kelas->id, array_column($rank, 'id_anggota_kelas'));
        // return $find_rank;
        if ($find_rank != "") {
            $rank_siswa = (object) $rank[$find_rank];
        }else {
            $rank_siswa = 'Belum ada ranking';
        }

        // return $rank_siswa;
        // return array_search(1, array_column($rank, 'id_anggota_kelas'));

        $spiritual = [
            'title' => $request->spiritual,
            'description' => $request->spiritual_value,
        ];

        $sosial = [
            'title' => $request->sosial,
            'description' => $request->sosial_value,
        ];

        // assets/images/pdf/latar.jpeg
        // assets/images/pdf/header.png
        $path_latar = 'assets/images/pdf/latar.jpeg';
        $type_latar = pathinfo($path_latar, PATHINFO_EXTENSION);
        $data_latar = file_get_contents($path_latar);
        $image_latar = 'data:image/' . $type_latar . ';base64,' . base64_encode($data_latar);

        $path_header = 'assets/images/pdf/header.png';
        $type_header = pathinfo($path_header, PATHINFO_EXTENSION);
        $data_header = file_get_contents($path_header);
        $image_header = 'data:image/' . $type_header . ';base64,' . base64_encode($data_header);


        $data = [
            'semester'          => $semester,
            'kelas'             => $kelas,
            'tahun_pelajaran'   => $tahun_pelajaran,
            'siswa'             => $siswa,
            'spiritual'         => $spiritual,
            'sosial'            => $sosial,
            'nilai'             => (array) $nilai_siswa,
            'rata_rata'         => (array) $rata_all,
            'kehadiran'         => $kehadiran,
            'ranking'           => $rank_siswa,
            'catatan'           => $request->catatan,
            'mata_pelajaran'    => $mata_pelajaran,
            'image_latar'       => $image_latar,
            'image_header'      => $image_header,
        ];

        // return $data;

        // return view('content.nilai.raport_pdf', compact(
        //     'data',
        // ));

        $pdf = PDF::loadView('content.nilai.raport_pdf', $data);

        // $pdf = PDF::loadView('content.raport.raport_pdf');

        return $pdf->download('raport.pdf');

    }
}
