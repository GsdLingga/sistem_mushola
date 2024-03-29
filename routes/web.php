<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalPengajianController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AnggotaKelasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\SemesterController;

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
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::prefix('admin')->middleware('is_admin')->group(function(){
    Route::get('dashboard', [AdminController::class,'index'])->name('admin.dashboard');
    Route::resource('user', UsersController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('pengajar', PengajarController::class);
    Route::resource('semester', SemesterController::class);
    Route::post('change-semester', [SemesterController::class, 'changeSemester'])->name('semester.change');
});

Route::prefix('pengurus')->middleware('is_pengurus')->group(function(){
    Route::get('dashboard', [PengurusController::class,'index'])->name('pengurus.dashboard');
});

Route::prefix('guru')->middleware('is_guru')->group(function(){
    Route::get('dashboard', [GuruController::class,'index'])->name('guru.dashboard');
});

Route::middleware('is_adminpengurus')->group(function () {
    Route::resource('spp', SppController::class);
    Route::resource('zakat', ZakatController::class);
    Route::resource('jadwal-pengajian', JadwalPengajianController::class);
});

Route::middleware('is_adminguru')->group(function () {
    Route::resource('siswa', SiswaController::class);
    Route::resource('absensi', AbsensiController::class);
    Route::resource('nilai', NilaiController::class);
    Route::post('create-pdf-file', [NilaiController::class, 'createPDF'])->name('nilai.pdf');
});
