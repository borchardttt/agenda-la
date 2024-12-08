<?php

use App\Router\Route;

return [
	Route::get('/', ['App\Controllers\HomeController', 'index'])->name('index'),
	Route::get('/about', ['App\Controllers\HomeController', 'about']),
	Route::get('/services', ['App\Controllers\ServicesController', 'index']),
	Route::get('/login', ['App\Controllers\LoginController', 'indexLogin']),
	Route::get('/logout', ['App\Controllers\LoginController', 'logout']),
	Route::post('/authenticate', ['App\Controllers\LoginController', 'login']),
	Route::get('/admin-home', ['App\Controllers\HomeController', 'adminHome']),
	Route::get('/client-home', ['App\Controllers\HomeController', 'clientHome']),
	Route::get('/users', ['App\Controllers\UserController', 'getAll']),
	Route::get('/dashboard', ['App\Controllers\BarberController', 'index']),
	Route::get('/register', ['App\Controllers\LoginController', 'index']),
	Route::post('/user-registration', ['App\Controllers\UserController', 'register']),
	Route::post('/create-service', ['App\Controllers\ServicesController', 'create']),
	Route::post('/admin/services/create', ['App\Controllers\ServicesController', 'store']),
	Route::delete('/admin/services/delete/{id}', ['App\Controllers\ServicesController', 'delete']),
	Route::post('/scheduling/create', ['App\Controllers\SchedulingController', 'create']),
	Route::get('/scheduling', ['App\Controllers\SchedulingController', 'getAll']),
	Route::get('/scheduling/{id}', ['App\Controllers\SchedulingController', 'getById']),
	Route::get('/scheduling/client/{clientId}', ['App\Controllers\SchedulingController', 'getByClient']),
	Route::put('/scheduling/update', ['App\Controllers\SchedulingController', 'update']),
	Route::delete('/scheduling/delete/{id}', ['App\Controllers\SchedulingController', 'delete']),
];
