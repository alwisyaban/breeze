<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardGowningController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KualifikasiGowningController;
use App\Http\Controllers\KualifikasiTeoriController;
use App\Http\Controllers\LaporanGowningController;
use App\Http\Controllers\MonitoringDrController;
use App\Http\Controllers\ProfileController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('departemen', DepartemenController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('kualifikasiTerori', KualifikasiTeoriController::class);
    Route::resource('kualifikasiGowning', KualifikasiGowningController::class);
    Route::resource('monitoringDR', MonitoringDrController::class);
    Route::get('dashboard/teori', [DashboardGowningController::class, 'teori'])->name('teori');
    Route::get('dashboard/steril', [DashboardGowningController::class, 'steril'])->name('steril');
    Route::get('dashboard/aseptis', [DashboardGowningController::class, 'aseptis'])->name('aseptis');
    Route::get('dashboard', [DashboardGowningController::class, 'index'])->name('dashboard');

    Route::get('/laporan-gowning/generate-pdf', [LaporanGowningController::class, 'generatePDF'])->name('laporan-gowning.generatePDF');
    Route::resource('laporan-gowning', LaporanGowningController::class);

    Route::get('/export-karyawan', [KaryawanController::class, 'export'])->name('karyawan.export');
    Route::post('/import-karyawan', [KaryawanController::class, 'import'])->name('karyawan.import');

    // Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');
    // Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/export/kualifikasi-teori', [KualifikasiTeoriController::class, 'export'])->name('kualifikasiTeori.export');
});



require __DIR__ . '/auth.php';
