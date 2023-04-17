<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PenelitianController;

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

// Route::get('/', [BerandaController::class, 'index']);

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function () {

        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('admin/roles', RoleController::class);
        Route::post('admin/roles/search', 'RoleController@search')->name('roles.search');

        Route::resource('admin/users', UserController::class);
        Route::post('admin/users/search', 'UserController@search')->name('users.search');

        Route::resource('admin/instansi', InstansiController::class);

        Route::resource('admin/pegawai', PegawaiController::class);

        Route::resource('admin/kejaksaan/penelitian', PenelitianController::class);

        Route::prefix('admin/kejaksaan')->group(function() {
            Route::get('getterdakwa', [PenelitianController::class, 'getterdakwa'])->name('admin.getterdakwa');
            Route::post('simpanterdakwa', [PenelitianController::class, 'simpanterdakwa'])->name('admin.simpanterdakwa');

            Route::get('getsaksi', [PenelitianController::class, 'getsaksi'])->name('admin.getsaksi');
            Route::get('getnipsaksi', [PenelitianController::class, 'getnipsaksi'])->name('admin.getnipsaksi');
            Route::post('simpansaksi', [PenelitianController::class, 'simpansaksi'])->name('admin.simpansaksi');

            Route::get('getjaksa', [PenelitianController::class, 'getjaksa'])->name('admin.getjaksa');
            Route::get('getnip', [PenelitianController::class, 'getnip'])->name('admin.getnip');
            Route::post('simpanjaksa', [PenelitianController::class, 'simpanjaksa'])->name('admin.simpanjaksa');

            Route::post('simpanpegawai', [PenelitianController::class, 'simpanpegawai'])->name('admin.simpanpegawai');

            Route::get('getpeneliti', [PenelitianController::class, 'getpeneliti'])->name('admin.getpeneliti');
            Route::get('getnippgw', [PenelitianController::class, 'getnippgw'])->name('admin.getnippgw');


            Route::get('getkasibb', [PenelitianController::class, 'getkasibb'])->name('admin.getkasibb');
            Route::get('getpenyidik', [PenelitianController::class, 'getpenyidik'])->name('admin.getpenyidik');
            Route::get('getpenyerah', [PenelitianController::class, 'getpenyerah'])->name('admin.getpenyerah');
            Route::get('getpetugas', [PenelitianController::class, 'getpetugas'])->name('admin.getpetugas');

            Route::get('getRupbasan', [PenelitianController::class, 'getRupbasan'])->name('admin.getRupbasan');

            Route::get('tambahBasan/{id}/{nrp}', [PenelitianController::class, 'tambahBasan'])->name('admin.tambahBasan');
            Route::get('ubahBasan/{id}', [PenelitianController::class, 'ubahBasan'])->name('admin.ubahBasan');

            Route::get('tambahRekomendasi/{id}', [PenelitianController::class, 'tambahRekomendasi'])->name('admin.tambahRekomendasi');
            Route::post('simpanRekomendasi', [PenelitianController::class, 'simpanRekomendasi'])->name('admin.simpanRekomendasi');
            Route::delete('hapusRekomendasi/{id}/{pnl}', [PenelitianController::class, 'hapusRekomendasi'])->name('admin.hapusRekomendasi');

            Route::get('limpahkanBasan/{id}/{nrp}', [PenelitianController::class, 'limpahkanBasan'])->name('admin.limpahkanBasan');
            Route::post('simpanLimpahkanBasan/', [PenelitianController::class, 'simpanLimpahkanBasan'])->name('admin.simpanLimpahkanBasan');
            Route::post('ubahStatusBasan/', [PenelitianController::class, 'ubahStatusBasan'])->name('admin.ubahStatusBasan');
            Route::post('simpanBasan/', [PenelitianController::class, 'simpanBasan'])->name('admin.simpanBasan');
            Route::get('detailPenelitian/{id}', [PenelitianController::class, 'detailPenelitian'])->name('admin.detailPenelitian');
            Route::get('printPenelitian/{id}', [PenelitianController::class, 'printPenelitian'])->name('admin.printPenelitian');
            Route::get('printPenitipan/{id}', [PenelitianController::class, 'printPenitipan'])->name('admin.printPenitipan');
        });



        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
