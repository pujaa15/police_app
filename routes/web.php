<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AuthController::class, 'index']);
Route::get('/register',[AuthController::class,'registerpage']);

Route::group(['prefix' => 'panel-control'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
});


