<?php

use App\Controllers\BarberScheduleController;
use App\Controllers\HomeController;
use App\Controllers\ServicesController;
use App\Controllers\AuthController;
use App\Controllers\ClientController;
use App\Controllers\NotFoundController;
use App\Controllers\SettingsController;
use App\Controllers\UsersController;
use App\Middleware\AdminMiddleware;
use Core\Router\Route;

Route::get('/', [HomeController::class, 'index'])->name('root');

Route::get('/login', [AuthController::class, 'index'])->name('indexLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register-user', [AuthController::class, 'indexRegisterUser'])->name('indexLogin');
Route::post('/create-client', [UsersController::class, 'createClient'])->name('create-client-post');

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
        // Rotas de configurações (Settings)
        Route::get('/admin/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/admin/settings/logo/update', [SettingsController::class, 'updateLogo'])->name('settings.logo.update');
        Route::post('/admin/settings/logo/delete', [SettingsController::class, 'deleteLogo'])->name('settings.logo.delete');

    });


    //Rotas protegidas para barbeiro
    Route::middleware('barber')->group(function () {
       Route::get('/barber/schedule', [BarberScheduleController::class, 'index'])->name('schedule');
        Route::post('/barber/create-schedule', [BarberScheduleController::class, 'createSchedule'])->name('createBarberSchedule');
        Route::get('/barber/schedule/{id}', [BarberScheduleController::class, 'editScheduleIndex'])->name('editScheduleIndex');
        Route::post('/barber/schedule/{id}', [BarberScheduleController::class, 'editSchedule'])->name('editSchedule');
        Route::get('/barber/dashboard', [UsersController::class, 'indexBarbers'])->name('indexBarbers');
        Route::post('/barber/add-service', [UsersController::class, 'addServiceToBarber'])->name('addService');
        Route::post('/barber/remove-service/{id}', [UsersController::class, 'removeServiceFromBarber'])->name('removeServiceFromBarber');
        Route::get('/barber/my-scheduling', [UsersController::class, 'schedulingBarbers'])->name('schedulingBarbers');
        Route::post('/barber/cancel-scheduling/{id}', [UsersController::class, 'cancelSchedullingBarber'])->name('cancelScheduling');
    });

    //Rotas protegidas para cliente
    Route::middleware('client')->group(function () {
        Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client-dashboard');
        Route::get('/client/mySchedules', [ClientController::class, 'mySchedules'])->name('client-schedules');
        Route::get('/client/createSchedule', [ClientController::class, 'indexCreateSchedule'])->name('client-schedule-index');
        Route::post('/client/cancelSchedule/{id}', [ClientController::class, 'cancelSchedule'])->name('client-cancel-schedule');
        Route::get('/client/get-barbers-disponibility', [ClientController::class, 'getBarbersDisponibility'])->name('getBarbersDisponibility');
        Route::post('/client/createScheduling', [ClientController::class, 'createScheduling'])->name('createScheduling');
    });

});
Route::get('/404', [NotFoundController::class, 'index'])->name('not-found');