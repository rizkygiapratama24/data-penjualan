<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProductController;
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
Route::get('/product/ambil_product', [ProductController::class, 'ambil_product'])->name('product.ambil_product');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/barang/ambil_barang', [BarangController::class, 'ambil_barang'])->name('barang.ambil_barang');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/show/{id}', [BarangController::class, 'show'])->name('barang.show');
Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::get('/barang/delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');

Route::get('transaksi/transaksi_barang', [TransaksiController::class, 'transaksi_barang'])->name('transaksi_barang');
