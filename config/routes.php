<?php

use App\Controllers\HomeController;
use App\Controllers\ServicesController;
use Core\Router\Route;

Route::get('/', [HomeController::class, 'index'])->name('root');

// Ps: Será necessário incluir essas rotas dentro do Middleware de autenticação no próximo checkpoint.

Route::get('/services', [ServicesController::class, 'index'])->name('services');

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


