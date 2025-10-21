<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PresensiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Semua endpoint di sini akan digunakan oleh aplikasi Flutter Presensi.
| Format disesuaikan agar login/register tetap berjalan seperti semula.
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/get-presensi',  [PresensiController::class, 'getPresensis']);
    Route::post('/save-presensi', [PresensiController::class, 'savePresensi']);
});
