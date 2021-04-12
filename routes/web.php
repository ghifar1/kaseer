<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\HistoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [KasirController::class, 'home'])->name('dashboard');
Route::get('/stok', [StockController::class, 'home'])->name('stok');
Route::get('/laporan', [HistoryController::class, 'index'])->name('laporan');

require __DIR__.'/auth.php';
