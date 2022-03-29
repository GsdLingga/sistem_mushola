<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zakat;

class ZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zakat = Zakat::get();

        return view('content.zakat.zakat_index', compact(
            'zakat'
        ));
        // return $zakat;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.zakat.zakat_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zakat = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tgl' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'numeric'],
        ]);

        
        $zakat  = Zakat::create([
            'nama'  => $request->name,
            'tgl'   => $request->tgl,
            'ket'   => $request->keterangan,
        ]);

        return redirect()->route('zakat.index')->with('success', 'Zakat Created Successfully');
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
        $zakat = Zakat::where('zakat.id','=',$id)->first();

        return view('content.zakat.zakat_edit', compact(
            'zakat'
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
        $zakat = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tgl' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'numeric'],
        ]);

        $zakat = Zakat::find($id);
        $zakat->nama  = $request->name;
        $zakat->tgl   = $request->tgl;
        $zakat->ket   = $request->keterangan;
        $zakat->save();

        return redirect()->route('zakat.index')->with('success', 'Zakat Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zakat = Zakat::find($id);
        $zakat->delete();

        return redirect()->route('zakat.index')->with('success', 'Zakat Deleted Successfully');
    }
}
