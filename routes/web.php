<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\OfficerController;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'registerpage']);


Route::prefix('panel-control')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');

    Route::get('/officers', [OfficerController::class, 'index'])->name('officers.index');
    Route::get('/officers/create', [OfficerController::class, 'create'])->name('officers.create');
    Route::post('/officers', [OfficerController::class, 'store'])->name('officers.store');
    Route::get('/officers/{id}', [OfficerController::class, 'show'])->name('officers.show');
    Route::get('/officers/{id}/edit', [OfficerController::class, 'edit'])->name('officers.edit');
    Route::put('/officers/{id}', [OfficerController::class, 'update'])->name('officers.update');
    Route::delete('/officers/{id}', [OfficerController::class, 'destroy'])->name('officers.destroy');
});



