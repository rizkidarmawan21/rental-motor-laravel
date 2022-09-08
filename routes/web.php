<?php

use App\Http\Controllers\MotorController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/admin', function () {
    return view('pages.dashboard');
})->middleware('auth')->name('dashboard');

Route::resource('user', UserController::class)->middleware('auth');
Route::resource('penyewa', PenyewaController::class)->middleware('auth');
Route::resource('motor', MotorController::class)->middleware('auth');
Route::resource('penyewaan', PenyewaanController::class)->middleware('auth');
Route::resource('pengembalian', PengembalianController::class)->middleware('auth');

require __DIR__ . '/auth.php';
