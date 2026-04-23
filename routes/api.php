<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdiController; // Memanggil Asisten Gudang Prodi
use App\Http\Controllers\MahasiswaController; // Memanggil Asisten Gudang Mahasiswa
use App\Http\Controllers\KategoriController; // Memanggil Asisten Gudang Kategori
use App\Http\Controllers\MediaController; // Memanggil Asisten Gudang Media

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::apiResource('prodi', ProdiController::class); // Rute untuk Prodi
route::apiResource('mahasiswa', MahasiswaController::class); // Rute untuk Mahasiswa
route::apiResource('kategori', KategoriController::class); // Rute untuk Kategori
route::apiResource('media', MediaController::class); // Rute untuk Media

//prodi
route::get('/prodi', [ProdiController::class, 'index']);
route::post('/prodi', [ProdiController::class, 'store']);
route::put('/prodi/{id}', [ProdiController::class, 'update']);   
route::delete('/prodi/{id}', [ProdiController::class, 'destroy']);

//mahasiswa
route::get('/mahasiswa', [MahasiswaController::class, 'index']);
route::post('/mahasiswa', [MahasiswaController::class, 'store']);
route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);

//kategori
route::get('/kategori', [KategoriController::class, 'index']);
route::post('/kategori', [KategoriController::class, 'store']);
route::put('/kategori/{id}', [KategoriController::class, 'update']);
route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);    

//media
route::get('/media', [MediaController::class, 'index']);
route::post('/media', [MediaController::class, 'store']);
route::put('/media/{id}', [MediaController::class, 'update']);
route::delete('/media/{id}', [MediaController::class, 'destroy']);

