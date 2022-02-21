<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\GuruController;

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
});

Route::prefix('pengurus')->middleware('is_pengurus')->group(function(){
    Route::get('dashboard', [PengurusController::class,'index'])->name('pengurus.dashboard');
});

Route::prefix('guru')->middleware('is_guru')->group(function(){
    Route::get('dashboard', [GuruController::class,'index'])->name('guru.dashboard');
});

