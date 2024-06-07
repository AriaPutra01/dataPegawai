<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Pegawai;
use App\Models\User;

Route::get('/welcome', function () {
    return view('welcome');
});

//dashboard user
Route::get('/userDashboard', [\App\Http\Controllers\DashboardUserController::class, 'index'])->middleware(['auth', 'verified', 'user'])->name('userDashboard');

Route::middleware(['auth', 'verified', 'supervisor'])->group(function () {
    //Dashboard supervisor
    Route::get('/supervisorDashboard', [\App\Http\Controllers\DashboardSupervisorController::class, 'index'])->name('supervisorDashboard');
    // tabel user supervisor
    Route::resource('/userSupervisor', \App\Http\Controllers\UserSupervisorController::class);
    // tabel pegawai supervisor
    Route::resource('pegawaiSupervisor', \App\Http\Controllers\PegawaiSupervisorController::class);
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    //Dahsboard admin
    Route::get('/adminDashboard', [\App\Http\Controllers\DashboardAdminController::class, 'index'])->name('adminDashboard');
    // tabel pegawai admin
    Route::resource('pegawaiAdmin', \App\Http\Controllers\PegawaiAdminController::class);
    // tabel user admin
    Route::resource('/userAdmin', \App\Http\Controllers\UserAdminController::class);
    // update profile wajib
    Route::get('/profileAdmin', [\App\Http\Controllers\ProfileAdminController::class, 'create'])->name('profileAdmin.create');
    Route::post('/profileAdmin', [\App\Http\Controllers\ProfileAdminController::class, 'store'])->name('profileAdmin.store');
});

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
