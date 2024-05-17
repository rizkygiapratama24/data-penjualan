<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// INTERFACE API
Route::get('/barang/ambil_barang', [BarangController::class, 'ambil_barang'])->name('barang.ambil_barang');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/show/{id}', [BarangController::class, 'show'])->name('barang.show');
Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::get('/barang/delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');

Route::get('transaksi/transaksi_barang', [TransaksiController::class, 'transaksi_barang'])->name('transaksi_barang');
