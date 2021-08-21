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
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/dashboard', [KasirController::class, 'home'])->name('dashboard');
Route::get('/stok', [StockController::class, 'home'])->name('stok');
Route::get('/laporan', [HistoryController::class, 'index'])->name('laporan');
Route::get('/testprint', [HistoryController::class, 'testPrint']);
Route::get('/export', [HistoryController::class, 'export']);
Route::get('/setting', [\App\Http\Controllers\TokoController::class, 'index']);
Route::get('/getToko/{uuid}', [\App\Http\Controllers\TokoController::class, 'getToko']);
Route::get('editAkun', [\App\Http\Controllers\TokoController::class, 'editAkun']);
Route::post('changePassword', [\App\Http\Controllers\TokoController::class, 'changePassword']);
Route::post('changeData', [\App\Http\Controllers\TokoController::class, 'changeData']);
Route::post('stopToko', [\App\Http\Controllers\TokoController::class, 'stopToko']);
Route::post('/createToko', [\App\Http\Controllers\TokoController::class, 'createToko']);
Route::post('/followToko', [\App\Http\Controllers\TokoController::class, 'followToko']);
Route::post('/toPremium', [KasirController::class, 'toPremium'])->name('toPremium');


require __DIR__.'/auth.php';
