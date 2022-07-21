<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    public function index(){
        return view('Admin.profil.index');
    }

    // 2. ubah profil
    public function update(Request $request){
        $username = auth()->user()->username;
        $email = auth()->user()->email;

        if($request->input('password') != $request->input('konfirmpass')){
            return back()->with('password_fail', 'password tidak sama!');
        }else{
            $validateData = [
                'name' => 'required|min:3',
                'password' => 'required|min:8|max:255',
            ];

            if($request->username != $username || $request->email != $email){
                $validateData['username'] = 'required|unique:users';
                $validateData['email'] = 'required|unique:users';
            }

            // proses validasi
            $validated = $request->validate($validateData);

            $validated['password'] = Hash::make($validated['password']);

            User::where('id', auth()->user()->id)->update($validated);

            return back()->with('success', 'data telah diubah!');
        }
    }
}
