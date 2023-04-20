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
    route::get('/buatPesanan', [HomeController::class, 'sewa'])->name('sewa')->middleware('auth');
    route::get('/buatPesanan/submit', [HomeController::class, 'sewaSubmit'])->name('sewaSubmit')->middleware('auth');
});