<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuDashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PesananDashboardController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserAdminController;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Test
Route::get('/test', function () {
    return view('Customer.menu', [
        'menus' => Menu::all()
    ]);
});

Route::get('/test1', function () {
    return view('Admin.Laporan.cetakExcel');
});

Route::get('/test2', function () {
    return view('Dashboard.Pesanan.index', [
        'pesanans' => Pesanan::latest()->filter(request(['search', 'status']))->paginate(10)
    ]);
});

// A. Pesanan
// 1. Index
Route::get('/', [PesananController::class, 'index']);

// 2. Menyimpan pelanggan
Route::post('/pesanan/storePelanggan', [PesananController::class, 'storePelanggan']);

// 3. Pergi ke menu pemesanan
Route::get('/pesanan/menu/{slug}', [PesananController::class, 'menuPesanan']);

// 4. Menyimpan Pesanan Pelanggan
Route::post('/pesanan/menu/storePesanan', [PesananController::class, 'storePesanan']);

// 5.
Route::get('/menu/checkOut/{id}', [PesananController::class, 'checkOut']);


// B. Login Ke Dashboard
// 1. Login Dashboard view
Route::get('/loginDashboard', [LoginController::class, 'index'])->name('login')->middleware('guest');

// 2. Proses Login ke Dashboard
Route::post('/loginDashboard/login', [LoginController::class, 'login']);

// 3. Masuk Ke Dashboard
Route::get('/dashboard', [LoginController::class, 'dashboard'])->middleware('auth');

// 4. Logout dari Dashboard
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// 5. Lupa Password
Route::get('/lupa-password', [LoginController::class, 'lupaPassword']);

// 6. Mengirim email untuk Reset Password
Route::post('/lupa-password/reset', [LoginController::class, 'sendEmail']);

// 7. Halaman Reset Password Dari E-mail
Route::get('/lupa-password/reset-pass/{token}', [LoginController::class, 'resetPassword'])->name('reset.password.form');

// 8. Proses Reset Password
Route::post('/lupa-password/reset-pass/', [LoginController::class, 'reset']);


// C. Dashboard Menu Makanan/Minuman
Route::resource('/dashboard/menu', MenuDashboardController::class)->except('show')->middleware('auth');


// D. Dashboard Daftar Pesanan
// 1. Dashboard Daftar Pesanan view
Route::get('/dashboard/pesanan', [PesananDashboardController::class, 'index'])->middleware('auth');

// 2. Detail Pesanan
Route::get('/dashboard/pesanan/detail/{id}', [PesananDashboardController::class, 'detail'])->middleware('auth');

// 3. Proses Terima Pesanan
Route::post('/dashboard/pesanan/konfirmasi/{id}', [PesananDashboardController::class, 'konfirmasi'])->middleware('auth');

// 4. Batalkan Pemesanan
Route::post('/dashboard/pesanan/batal/{id}', [PesananDashboardController::class, 'batal'])->middleware('auth');

// 5. Cetak Invoice
Route::get('/dashboard/pesanan/invoice/{id}', [PesananDashboardController::class, 'invoice'])->middleware('auth');


// E. Dasboard User
// 1. Dashboard User
Route::get('/dashboard/user', [UserDashboardController::class, 'index'])->middleware('auth');

// 2. Update Profil
Route::post('/dashboard/user/update/{id}', [UserDashboardController::class, 'update'])->middleware('auth');


// F. Resource Dashboard Daftar Users
Route::resource('/dashboard/users', UserAdminController::class)->except('show')->middleware('admin');


// G. Riwayat Transaksi Dashboard
// 1. index (Seluruh Pesanan)
Route::get('/dashboard/riwayat', [LaporanController::class, 'index'])->middleware('admin');

// 2. Export Excel
Route::get('/dashboard/riwayat/export-excel', [LaporanController::class, 'exportexcel'])->middleware('admin');

// 3. Export PDF
Route::get('/dashboard/riwayat/export-PDF', [LaporanController::class, 'exportpdf'])->middleware('admin');

// 4. View Cetak
Route::get('/dashboard/riwayat/viewCetak', [LaporanController::class, 'penjualan'])->middleware('admin');

Route::get('/dashboard/riwayat/viewCetak1', [LaporanController::class, 'test'])->middleware('admin');


