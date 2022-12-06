<?php
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource("mahasiswa", MahasiswaController::class);
Route::resource("ruangan", RuanganController::class);
Route::resource("petugas", PetugasController::class);
Route::resource("transaksi", TransaksiController::class);
Route::post("pembeli/soft/{id}", [MahasiswaController::class, "soft"])->name("pembeli.soft");
Route::post("kasir/soft/{id}", [PetugasController::class, "soft"])->name("kasir.soft");
Route::post("buku/soft/{id}", [RuanganController::class, "soft"])->name("buku.soft");
require __DIR__.'/auth.php';
