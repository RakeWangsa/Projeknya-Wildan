<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::group(['middleware' => ['auth', 'cekRole:user']], function() {
    route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
    route::get('/pesananSaya', [HomeController::class, 'pesananSaya'])->name('pesananSaya')->middleware('auth');
    route::get('/pesananSaya/buatPesanan', [HomeController::class, 'sewa'])->name('sewa')->middleware('auth');
    route::get('/pesananSaya/buatPesanan/submit', [HomeController::class, 'sewaSubmit'])->name('sewaSubmit')->middleware('auth');
    route::get('/pesananSaya/editPesanan/{id}', [HomeController::class, 'editPesanan'])->name('editPesanan')->middleware('auth');
    route::get('/pesananSaya/editPesanan/{id}/submit', [HomeController::class, 'editPesananSubmit'])->name('editPesananSubmit')->middleware('auth');
    route::get('/pesananSaya/hapus/{id}', [HomeController::class, 'hapusPesanan'])->name('hapusPesanan')->middleware('auth');

});

Route::group(['middleware' => ['auth', 'cekRole:admin']], function() {
    route::get('/home/admin', [HomeController::class, 'homeAdmin'])->name('homeAdmin')->middleware('auth');
});