<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    // 1. halaman awal login
    public function index(){
        // return view('loginDashboard');
        return view('Admin.loginAdmin');
    }

    // 2. Proses Login
    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // dd('berhasil login');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    // 3. Masuk Ke Dashboard
    public function dashboard(){

        // Total Harga Untuk Chart Bulanan (Pertahun)
        $total_harga = Pesanan::select(DB::raw("CAST(SUM(total) as int) as total_harga"))
        ->whereYear('tanggal', Carbon::now())
        ->where('status', 'Telah Dibayar')
        ->orderBy('tanggal', 'asc')
        ->GroupBy(DB::raw("Month(tanggal)"))
        ->pluck('total_harga');

        // dd($total_harga);

        // Total Harga Untuk Chart Tahunan
        $total_harga_tahunan = Pesanan::select(DB::raw("CAST(SUM(total) as int) as total_harga_tahunan"))
        ->orderBy('tanggal', 'asc')
        ->where('status', 'Telah Dibayar')
        ->GroupBy(DB::raw("year(tanggal)"))
        ->pluck('total_harga_tahunan');

        // dd($total_harga_tahunan);

        // Total Harga Untuk Chart Bulanan (Pertahun)
        $total_harga_tanggal = Pesanan::select(DB::raw("CAST(SUM(total) as int) as total_harga_tanggal"))
        ->whereMonth('tanggal', Carbon::now())
        ->where('status', 'Telah Dibayar')
        ->orderBy('tanggal', 'asc')
        ->GroupBy(DB::raw("Day(tanggal)"))
        ->pluck('total_harga_tanggal');

        // dd($total_harga_tanggal);

        // Menghitung Bulan
        $bulan = Pesanan::select(DB::raw("MONTHNAME(tanggal) as bulan"))
        ->orderBy('tanggal', 'asc')
        ->GroupBy(DB::raw("MONTHNAME(tanggal)"))
        ->pluck('bulan');

        // dd($bulan);

        // Menghitung Tahun
        $tahun = Pesanan::select(DB::raw("YEAR(tanggal) as tahun"))
        ->orderBy('tanggal', 'asc')
        ->GroupBy(DB::raw("YEAR(tanggal)"))
        ->pluck('tahun');

        // dd($tahun);

        // Menghitung Hari
        $tanggal = Pesanan::select(DB::raw("DAY(tanggal) as tanggal"))
        ->orderBy('tanggal', 'asc')
        ->GroupBy(DB::raw("DAY(tanggal)"))
        ->pluck('tanggal');

        // dd($tanggal);

        return view('Admin.index', [
            'menus' => Menu::all(),
            'dibayar' => Pesanan::where('status', 'Telah Dibayar')->get(),
            'batal' => Pesanan::where('status', 'Pesanan Dibatalkan')->get(),
            'tunggu' => Pesanan::where('status', 'Menunggu Pembayaran')->get(),
            'pesanan' => Pesanan::all()
        ], compact('total_harga', 'bulan', 'total_harga_tahunan', 'tahun', 'total_harga_tanggal', 'tanggal'));
    }

    // 4. Logout
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/loginDashboard');
    }

    // 5. Ke halaman Lupa Password
    public function lupaPassword(){
        return view('Admin.Lupapass.lupapass');
    }


    // 6. Ke halaman Lupa Password
    public function sendEmail(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Men-Generate Token
        $token = Str::random(64);

        // Memasukkan Data Ke Table Password_Reset
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $action_link = route('reset.password.form', [
            'token' => $token,
            'email' => $request->email
            ]);

        $body = "Atur Ulang Kata Sandi Pada Akun dengan e-mail : ". $request->email ." Dengan Menekan Link Di bawah Ini : ";

        // Mail::send('Nama_View)
        Mail::send('LupaPass.email-Lupapass', [
            'action_link' => $action_link,
            'body' => $body,
            ], function($message) use ($request){
                $message->to($request->email)
                        ->subject('Reset Password');
            });

        return redirect('/loginDashboard')->with('success', 'Tolong Cek E-mail Anda Untuk Me-reset Kata Sandi');
    }

    // 7. View dari email
    public function resetPassword(Request $request, $token = null){
        return view('LupaPass.resetPassword')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // 8. Proses Reset
    public function reset(Request $request){

        if($request->password != $request->konfirm){
            return back()->with('fail', 'Password Tidak Sama!');
        }else{
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:5',
                'konfirm' => 'required'
            ]);

            $check_token = DB::table('password_resets')->where('email', $request->email)
                            ->where('token', $request->token)->first();

            if(!$check_token){
                return back()->withInput()->with('fail', 'invalid token');
            }else{
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->password)
                ]);
    
                DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token
                ])->delete();
    
                return redirect('/loginDashboard')->with('success', 'Password Berhasil Diganti');
            }
        }
    }
}
