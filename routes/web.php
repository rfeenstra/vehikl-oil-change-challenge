<?php

use App\Http\Controllers\VehicleCheckController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VehicleCheckController::class, 'create'])->name('check.create');
Route::post('/check', [VehicleCheckController::class, 'store'])->name('check.store');
Route::get('/result/{check:id}', [VehicleCheckController::class, 'show'])->name('check.show');
