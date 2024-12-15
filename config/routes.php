<?php

use App\Controllers\HomeController;
use App\Controllers\ServicesController;
use Core\Router\Route;

Route::get('/', [HomeController::class, 'index'])->name('root');

Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/admin/services', [ServicesController::class, 'indexAdmin'])->name('services');
Route::get('/admin/services/edit/{id}', [ServicesController::class, 'edit'])->name('services.edit');
Route::post('/admin/services/create', [ServicesController::class, 'store'])->name('services.create');
Route::post('/admin/services/update/{id}', [ServicesController::class, 'update'])->name('services.update');
Route::post('/services/delete', [ServicesController::class, 'destroy'])->name('services.delete');
