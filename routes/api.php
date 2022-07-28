<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SiswaOptionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Get Siswa List
Route::get('/getSiswaOptions', [SiswaOptionsController::class,'getSiswaOptions']);
Route::get('/getSiswaCreate', [SiswaOptionsController::class,'getSiswaCreate']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
