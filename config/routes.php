<?php

use App\Controllers\HomeController;
use App\Controllers\ServicesController;
use App\Controllers\AuthController;

use App\Controllers\UsersController;
use App\Middleware\AdminMiddleware;
use Core\Router\Route;

Route::get('/', [HomeController::class, 'index'])->name('root');

Route::get('/login', [AuthController::class, 'index'])->name('indexLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/services', [ServicesController::class, 'index'])->name('services');

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AuthController::class, 'adminIndex'])->name('admin-index');
        // Rota que exibe a página principal de serviços de admin
        Route::get('/admin/services', [ServicesController::class, 'indexAdmin'])->name('services');

        //Rota para editar um serviço (Página de Edição)
        Route::get('/admin/services/edit/{id}', [ServicesController::class, 'edit'])->name('services.edit');

        //Rota para criar um novo serviço (POST)
        Route::post('/admin/services/create', [ServicesController::class, 'store'])->name('services.create');

        //Rota para atualizar um serviço
        Route::post('/admin/services/update/{id}', [ServicesController::class, 'update'])->name('services.update');

        //Rota para deletar um serviço
        Route::post('/services/delete/', [ServicesController::class, 'destroy'])->name('services.delete');

        Route::get('/admin/create-barber', [UsersController::class, 'indexCreateBarber'])->name('create-barber');
        Route::post('/admin/create-barber', [UsersController::class, 'register'])->name('create-barber-ṕost');

    });


});