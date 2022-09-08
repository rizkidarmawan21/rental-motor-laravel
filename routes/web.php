<?php

use App\Http\Controllers\MotorController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\UserController;
use App\Models\Motor;
use App\Models\Penyewa;
use App\Models\Sewa;
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
    $penyewa = Penyewa::all()->count();
    $motor   = Motor::all()->count();
    $sewa   = Sewa::where('status', 0)->count();
    $kembali   = Sewa::where('status', 1)->count();
    $total_transaksi   = Sewa::all()->count();
    $total_pendapatan   = Sewa::all()->sum('total_biaya') + Sewa::all()->sum('denda');
    return view('pages.dashboard' ,compact('penyewa','motor','sewa','kembali','total_transaksi','total_pendapatan'));
})->middleware('auth')->name('dashboard');

Route::resource('user', UserController::class)->middleware('auth');
Route::resource('penyewa', PenyewaController::class)->middleware('auth');
Route::resource('motor', MotorController::class)->middleware('auth');
Route::resource('penyewaan', PenyewaanController::class)->middleware('auth');
Route::resource('pengembalian', PengembalianController::class)->middleware('auth');

Route::get('pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index')->middleware('auth');

require __DIR__ . '/auth.php';
