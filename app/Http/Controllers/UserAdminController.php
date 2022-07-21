<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('password') != $request->input('konfirmpass')){
            return back()->with('password_fail', 'password tidak sama!');
        }else{
            $validateData = [
                'name' => 'required|min:3',
                'username' => 'required|min:3|unique:users',
                'password' => 'required|min:8|max:255',
                'email' => 'required|unique:users',
                
            ];

            // proses validasi
            $validated = $request->validate($validateData);

            $validated['password'] = Hash::make($validated['password']);

            // User::where('id', $user->id)->update($validated);
            User::create($validated);

            return redirect('/dashboard/users')->with('success', 'Berhasil Menambahkan User Baru!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('Admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($request->input('password') != $request->input('konfirmpass')){
            return back()->with('password_fail', 'password tidak sama!');
        }else{
            $validateData = [
                'name' => 'required|min:3',
                'password' => 'required|min:8|max:255',
            ];

            if($request->username != $user->username || $request->email != $user->email){
                $validateData['username'] = 'required|unique:users';
                $validateData['email'] = 'required|unique:users';
            }

            if($request->admin){
                User::where('id', $user->id)->update(['is_admin' => true]);
            }else{
                User::where('id', $user->id)->update(['is_admin' => false]);
            }

            // proses validasi
            $validated = $request->validate($validateData);

            $validated['password'] = Hash::make($validated['password']);

            User::where('id', $user->id)->update($validated);

            return redirect('/dashboard/users')->with('success', 'Data User Telah Ter-update!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('success', 'User Berhasil Dihapus!');
    }
}
