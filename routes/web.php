<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('dashboard');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/', DashboardController::class)->middleware(['auth', 'verified']);
Route::resource('dashboard', DashboardController::class)->middleware(['auth', 'verified']);
Route::resource('pengguna', PenggunaController::class)->middleware(['auth', 'verified', 'role:admin|staff']);
Route::resource('barang', PenggunaController::class)->middleware(['auth', 'verified', 'role:admin|staff']);
Route::resource('kategori', KategoriController::class)->middleware(['auth', 'verified', 'role:admin']);
Route::resource('gudang', PenggunaController::class)->middleware(['auth', 'verified', 'role_or_permission:view-reports|admin']);
Route::resource('laporan', PenggunaController::class)->middleware(['auth', 'verified', 'role:admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
