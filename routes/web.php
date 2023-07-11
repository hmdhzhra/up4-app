<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Pelanggan\ProfileController;
use App\Http\Controllers\Pelanggan\RiwayatController;
use App\Http\Controllers\Pelanggan\PermohonanController;
use App\Http\Controllers\Pelanggan\BayarLayananController;
use App\Http\Controllers\Bendahara\ValidasiController;
use App\Http\Controllers\Bendahara\StatusBayarController;
use App\Http\Controllers\Tatausaha\TugasController;
use App\Http\Controllers\Tatausaha\LaporanController;
use App\Http\Controllers\Laboran\JadwalController;
use App\Http\Controllers\Laboran\MonitoringController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;


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

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'store'])->name('login');

Route::get('/register',[RegisterController::class, 'index'])->middleware('guest');
Route::post('/register',[RegisterController::class, 'store']);


Route::group(['middleware' => ['auth']], function(){
    
    Route::get('/dashboard', [DashboardController::class, 'index2'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route User Admin
    Route::group(['middleware' => 'checkRole:admin'], function(){
        Route::group(['prefix' => 'admin'], function(){
            
            // Route::get('admin/datauser','DUserController@index')->name('Data-User');
            // Route::post('user/store', [UserController::class, 'store'])->name('user.store');
            Route::resource('user', UserController::class)->only([
                'index','store', 'update', 'destroy'
            ]);
            Route::resource('pelanggan', PelangganController::class)->only([
                'index', 'update', 'edit', 'destroy'
            ]);
            



        });
    });

    // Route User Pelanggan
    Route::group(['middleware' => 'checkRole:pelanggan'], function(){
        Route::group(['prefix' => 'pelanggan'], function(){

            Route::resource('profile', ProfileController::class)->only([
                'index', 'update',
            ]);
            Route::resource('riwayat', RiwayatController::class)->only([
                'index',
            ]);
            
            Route::resource('permohonan', PermohonanController::class)->only([
                'index', 'store', 'update',
            ]);

            Route::resource('bayar', BayarLayananController::class)->only([
                'index'
            ]);

            Route::get('/bayar/{id}', [BayarLayananController::class, 'showDetail'])->name('bayar.showDetail');
            
            



        });
    });

    // Route User Bendahara
    Route::group(['middleware' => 'checkRole:bendahara'], function(){
        Route::group(['prefix' => 'bendahara'], function(){

            Route::resource('validasi', ValidasiController::class)->only([
                'index', 'update',
            ]);
            Route::post('/validasi_berkas/{id}', [ValidasiController::class, 'validasi_berkas'])->name('validasi_berkas');

            Route::resource('statusbayar', StatusBayarController::class)->only([
                'index'
            ]);

            

        });
    });

    // Route User Tata Usaha
    Route::group(['middleware' => 'checkRole:tatausaha'], function(){
        Route::group(['prefix' => 'tatausaha'], function(){
            
            Route::resource('bagitugas', TugasController::class)->only([
                'index', 'update',
            ]);
            Route::post('/surat_tugas/{id}', [TugasController::class, 'surat_tugas'])->name('bagitugas.surat_tugas');
            Route::resource('laporan', LaporanController::class)->only([
                'index', 'update',
            ]);


        });
    });

    // Route User Laboran
    Route::group(['middleware' => 'checkRole:laboran'], function(){
        Route::group(['prefix' => 'laboran'], function(){
            Route::resource('penjadwalan', JadwalController::class)->only([
                'index', 'update'
            ]);
            Route::post('/status_material/{id}', [JadwalController::class, 'status_material'])->name('penjadwalan.status_material');
            
            Route::resource('monitoring', MonitoringController::class)->only([
                'index', 'update',
            ]);

        });
    });


    // Route User Bidang
    Route::group(['middleware' => 'checkRole:bidang'], function(){
        Route::group(['prefix' => 'bidang'], function(){
            

        });
    });
});

