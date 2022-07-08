<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raport;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use PDF;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raport = DB::table('raport')
        ->join('siswa','siswa.id','=','raport.id_siswa')
        ->select('raport.*','siswa.nama')
        ->get();

        return view('content.raport.raport_index', compact(
            'raport'
        ));
        // return $raport;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::get();
        return view('content.raport.raport_create', compact(
            'siswa'
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
            'nama' => ['required'],
            'nilai_bacaan' => ['required', 'numeric', 'between:0,100'],
            'nilai_hafalan' => ['required', 'numeric', 'between:0,100'],
            'nilai_praktek' => ['required', 'numeric', 'between:0,100'],
            'nilai_pai' => ['required', 'numeric', 'between:0,100'],
        ]);


        $raport  = Raport::create([
            'id_siswa'          => $request->nama,
            'nilai_bacaan'  => $request->nilai_bacaan,
            'nilai_hafalan' => $request->nilai_hafalan,
            'nilai_praktek' => $request->nilai_praktek,
            'nilai_pai'     => $request->nilai_pai,
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
        $siswa = Siswa::get();
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
            'nama' => ['required'],
            'nilai_bacaan' => ['required', 'numeric', 'between:0,100'],
            'nilai_hafalan' => ['required', 'numeric', 'between:0,100'],
            'nilai_praktek' => ['required', 'numeric', 'between:0,100'],
            'nilai_pai' => ['required', 'numeric', 'between:0,100'],
        ]);

        $raport = Raport::find($id);
        $raport->id_siswa        = $request->name;
        $raport->nilai_bacaan    = $request->nilai_bacaan;
        $raport->nilai_hafalan   = $request->nilai_hafalan;
        $raport->nilai_praktek   = $request->nilai_praktek;
        $raport->nilai_pai       = $request->nilai_pai;
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

    public function createPDF()
    {
        // $data = [
        //     'title' => 'Welcome to Tutsmake.com',
        //     'date' => date('m/d/Y')
        // ];

        // $pdf = PDF::loadView('content.raport.raport_pdf', $data);

        $pdf = PDF::loadView('content.raport.raport_pdf', [

        ]);

        return $pdf->download('raport.pdf');
        // return view('content.raport.raport_pdf');
    }
}
