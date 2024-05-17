<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BarangController::class, 'index']);
Route::get('/barang/show_barang', [BarangController::class, 'show_barang'])->name('barang.show_barang');
Route::get('/barang/get_barang/{id}', [BarangController::class, 'get_barang']);
Route::post('/barang/action', [BarangController::class, 'action'])->name('barang.action');
Route::post('/barang/hapus_barang', [BarangController::class, 'hapus_barang'])->name('barang.hapus_barang');

Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/show_transaksi', [TransaksiController::class, 'show_transaksi'])->name('transaksi.show_transaksi');

