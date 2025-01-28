<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Instruktur\KategoriController;
use App\Http\Controllers\User\JurnalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/mahasiswa')->group(
    function () {
        Route::post('/login', [AuthController::class, 'login_mahasiswa']);
        Route::post('/register', [AuthController::class, 'register_mahasiswa']);
    }
);
Route::prefix('/instruktur')->group(
    function () {
        Route::post('/login', [AuthController::class, 'login_instruktur']);
        Route::post('/register', [AuthController::class, 'register_instruktur']);
    }
);

Route::get('/test', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
