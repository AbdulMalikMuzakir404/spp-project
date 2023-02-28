<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\siswa\bayarController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\data\makeUserController;
use App\Http\Controllers\Auth\LoginSiswaController;
use App\Http\Controllers\PDF\detailCetakController;
use App\Http\Controllers\profile\profileController;
use App\Http\Controllers\transaksi\transaksiController;
use App\Http\Controllers\PDF\adminCreateLaporanController;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('login', [loginController::class, 'loginForm'])->name('login');
// Route::post('login/action', [loginController::class, 'loginAction'])->name('loginAction');

Route::get('register', [registerController::class, 'registerForm'])->name('register');
// Route::post('register/action', [registerController::class, 'registerAction'])->name('registerAction');

Route::get('login-siswa', [LoginSiswaController::class, 'showLoginForm'])->name('loginSiswa');
Route::post('login-siswa', [LoginSiswaController::class, 'loginSiswa'])->name('loginSiswaProses');

// Route::get('/logout', function() {
//     if(session()->has('user')){
//         session()->pull('user');
//     }

//     return redirect('/login');
// });


// Route::get('/home', function () {
//     return "home";
// })->name('home')->middleware('login');


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'home'], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/home/show-profile', [profileController::class, 'showProfile'])->name('showProfile')->middleware('pengelola');;
        Route::get('/home/change-profile', [profileController::class, 'changeProfile'])->name('changeProfile')->middleware('pengelola');;

        Route::get('/home/make-siswa', [makeUserController::class, 'showFormSiswa'])->name('makeSiswa')->middleware('admin');
        Route::get('/home/make-petugas', [makeUserController::class, 'showFormPetugas'])->name('makePetugas')->middleware('admin');
        Route::get('/home/data-create', [makeUserController::class, 'showDataCreate'])->name('dataCreate')->middleware('admin');

        Route::get('/home/transaksi', [transaksiController::class, 'showDataTransaksi'])->name('dataTransaksi')->middleware('pengelola');

        Route::get('/home/create-transaksi-laporan', [adminCreateLaporanController::class, 'createTransaksiLaporan'])->name('createTransaksiLaporan')->middleware('admin');

        Route::get('/home/detail-cetak/{nisn}/{tahun}', [detailCetakController::class, 'showDetail'])->name('detailCetak')->middleware('pengelola');
        Route::get('/home/transaksi-to-pdf/{nisn}/{tahun}', [adminCreateLaporanController::class, 'createTransaksiLaporan'])->name('cetakTransaksiPdf')->middleware('pengelola');

        Route::get('/home/bayar', [bayarController::class, 'showBayar'])->name('dataBayar')->middleware('siswa');
        Route::get('/home/bayar-detail/{id}', [bayarController::class, 'bayarDetail'])->name('dataBayarDetail')->middleware('siswa');
    });
});
