<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Instruktur\AkunController;
use App\Http\Controllers\Instruktur\KelasController;
use App\Http\Controllers\Instruktur\UsersController;
use App\Http\Controllers\Instruktur\KategoriController;
use App\Http\Controllers\Instruktur\MonitoringController;
use App\Http\Controllers\Instruktur\ProfileInstrukturController;

Route::prefix('/mahasiswa')->group(
    function () {
        Route::post('/login', [AuthController::class, 'login_mahasiswa']);
        Route::post('/register', [AuthController::class, 'register_mahasiswa']);
        Route::apiResource('/kategori', KategoriController::class);
        Route::apiResource('/akun', AkunController::class);
        Route::apiResource('/kelas', KelasController::class);
        Route::apiResource('/users', UsersController::class);
        Route::apiResource('/krs', KrsController::class);
        Route::apiResource('/profileinstruktur', ProfileInstrukturController::class);
        // Route::get('/all', [AuthController::class, 'getAllData']); // Route untuk semua data
        // Route::get('/{id}', [AuthController::class, 'getDataById']); // Route untuk data by ID
        Route::get('/monitoring', [MonitoringController::class, 'index']);

        // Menampilkan anggota kelas berdasarkan kelas_id
        Route::get('/monitoring/{kelas_id}/anggota', [MonitoringController::class, 'showKelasAnggota']);
        Route::get('/kelas/{profile_instruktur_id}', [MonitoringController::class, 'getKelasByProfileInstruktur']);
        Route::get('/anggota/{profile_instruktur_id}', [MonitoringController::class, 'getAnggotaByProfileInstruktur']);

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
