<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Carbon\Carbon;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('id');

        $siswa = Siswa::where('status','=','1')->get();

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
        return view('content.siswa.siswa_create');
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
            'tgl_lahir' => ['required', 'date'],
            'kelas' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'numeric', 'digits_between:10,13'],
        ]);

        
        $siswa  = Siswa::create([
            'nama'          => $request->name,
            'tgl_lahir'     => $request->tgl_lahir,
            'kelas'         => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
            'status'        => 1,
            // 'slug'      => Str::slug($request->name),
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa Created Successfully');
        
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
        $siswa = Siswa::where('id','=',$id)->first();
        return view('content.siswa.siswa_edit', compact(
            'siswa'
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
            'tgl_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'numeric', 'digits_between:10,13'],
        ]);

        $siswa = Siswa::find($id);
        $siswa->nama            = $request->name;
        $siswa->tgl_lahir       = $request->tgl_lahir;
        $siswa->kelas           = $request->kelas;
        $siswa->jenis_kelamin   = $request->jenis_kelamin;
        $siswa->alamat          = $request->alamat;
        $siswa->telepon         = $request->telepon;
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Siswa Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->status = 0;
        
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Siswa Deleted Successfully');
    }
}
