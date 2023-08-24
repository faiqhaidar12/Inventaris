<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\GudangStokController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\TransactionsController;
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
Route::resource('barang', BarangController::class)->middleware(['auth', 'verified', 'role:admin|staff']);
Route::resource('kategori', KategoriController::class)->middleware(['auth', 'verified', 'role:admin']);
Route::resource('gudang', GudangController::class)->middleware(['auth', 'verified', 'role_or_permission:view-reports|admin|gudang']);
Route::resource('gudangstok', GudangStokController::class)->middleware(['auth', 'verified', 'role_or_permission:view-reports|admin|gudang']);
Route::resource('customers', CustomersController::class)->middleware(['auth', 'verified', 'role:admin|staff']);
Route::resource('suppliers', SuppliersController::class)->middleware(['auth', 'verified', 'role:admin|staff']);
Route::resource('laporan', PenggunaController::class)->middleware(['auth', 'verified', 'role:admin|staff']);
Route::resource('transactions', TransactionsController::class)->middleware(['auth', 'verified', 'role:admin|staff']);
Route::resource('transactionsdetail', TransactionDetailController::class)->middleware(['auth', 'verified', 'role:admin|staff']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
