<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengajar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();

        // return $user;
        return view('content.user.user_index', compact(
            'user'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.user.user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telepon' => ['required', 'string', 'numeric', 'digits_between:10,13'],
            'password' => ['required', 'string', 'min:7', 'confirmed'],
            'role' => ['required'],
        ]);

        $emailRequest = $request->email;
        $allEmail = User::select('id','email')->get();

        $count = 0;

        foreach($allEmail as $all){
            if ($emailRequest == $all->email) {
                // $userid = $all->id;
                $count = +1;
            }
        }

        if ($count == 1) {
            return redirect()->back()->with('emailtaken','Email is already taken');
        }else {
            $user  = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'telepon'   => $request->telepon,
                'password'  => Hash::make($request->password),
                'role'      => $request->role,
                'slug'      => Str::slug($request->name),
            ]);

            return redirect()->route('user.index')->with('success', 'User Created Successfully');
        }
        // return $user;
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
        $user = User::find($id);

        // return $user;
        return view('content.user.user_edit', compact(
            'user'
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
        $user = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telepon' => ['required', 'string', 'numeric', 'digits_between:10,13'],
            'password' => ['nullable', 'string', 'min:7', 'confirmed'],
            'role' => ['required'],
        ]);

        $emailRequest = $request->email;
        $allEmail = User::select('id','email')->get();
        $selfEmail = User::where('id',$id)->first();

        $count = 0;

        foreach($allEmail as $all){
            if ($emailRequest == $all->email) {
                $count = +1;
            }
        }

        if ($selfEmail->email == $emailRequest){

            if (isset($request->password)) {
                $user  = User::find($id);
                $user->name     = $request->name;
                $user->email    = $request->email;
                $user->telepon  = $request->telepon;
                $user->password = Hash::make($request->password);
                $user->role     = $request->role;
                $user->slug     = Str::slug($request->name);
                $user->save();

                return redirect()->route('user.index')->with('success', 'User Created Successfully');
            } else {
                $user  = User::find($id);
                $user->name     = $request->name;
                $user->email    = $request->email;
                $user->telepon  = $request->telepon;
                $user->role     = $request->role;
                $user->slug     = Str::slug($request->name);
                $user->save();

                return redirect()->route('user.index')->with('success', 'User Created Successfully');
            }
        }elseif($count == 1) {
            return redirect()->back()->with('emailtaken','Email is already taken');
        }else {

            if (isset($request->password)) {
                $user  = User::find($id);
                $user->name     = $request->name;
                $user->email    = $request->email;
                $user->telepon  = $request->telepon;
                $user->password = Hash::make($request->password);
                $user->role     = $request->role;
                $user->slug     = Str::slug($request->name);
                $user->save();

                return redirect()->route('user.index')->with('success', 'User Created Successfully');
            } else {
                $user  = User::find($id);
                $user->name     = $request->name;
                $user->email    = $request->email;
                $user->telepon  = $request->telepon;
                $user->role     = $request->role;
                $user->slug     = Str::slug($request->name);
                $user->save();

                return redirect()->route('user.index')->with('success', 'User Created Successfully');
            }
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
        $pengajar = Pengajar::where('id_user', $id)->pluck('id')->toArray();

        DB::beginTransaction();
        try {
            Pengajar::destroy($pengajar);
            User::where('id',$id)->delete();
            DB::commit();
            return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e);
        }
    }
}
