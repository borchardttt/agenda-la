<?php

return [
	'/' => ['controller' => 'App\Controllers\HomeController', 'method' => 'index'],
	'/about' => ['controller' => 'App\Controllers\HomeController', 'method' => 'about'],
	'/services' => ['controller' => 'App\Controllers\ServicesController', 'method' => 'index'],
	'/login' => ['controller' => 'App\Controllers\LoginController', 'method' => 'indexLogin'],
	'/logout' => ['controller' => 'App\Controllers\LoginController', 'method' => 'logout'],
	'/authenticate' => ['controller' => 'App\Controllers\LoginController', 'method' => 'login'],
	'/admin-home' => ['controller' => 'App\Controllers\HomeController', 'method' => 'adminHome'],
	'/users' => ['controller' => 'App\Controllers\UserController', 'method' => 'getAll'],
	'/dashboard' => ['controller' => 'App\Controllers\BarberController', 'method' => 'index'],
	'/register' => ['controller' => 'App\Controllers\LoginController', 'method' => 'index'],
	'/user-registration' => ['controller' => 'App\Controllers\UserController', 'method' => 'register'],
	'/create-service' => ['controller' => 'App\Controllers\ServicesController', 'method' => 'create'],
	'/admin/services/create' => ['controller' => 'App\Controllers\ServicesController', 'method' => 'store'],
	'/admin/services/delete/{id}' => ['controller' => 'App\Controllers\ServicesController', 'method' => 'delete'],
	'/scheduling/create' => ['controller' => 'App\Controllers\SchedulingController', 'method' => 'create'],
	'/scheduling' => ['controller' => 'App\Controllers\SchedulingController', 'method' => 'getAll'],
	'/scheduling/{id}' => ['controller' => 'App\Controllers\SchedulingController', 'method' => 'getById'],
	'/scheduling/client/{clientId}' => ['controller' => 'App\Controllers\SchedulingController', 'method' => 'getByClient'],
	'/scheduling/update' => ['controller' => 'App\Controllers\SchedulingController', 'method' => 'update'],
	'/scheduling/delete/{id}' => ['controller' => 'App\Controllers\SchedulingController', 'method' => 'delete'],
];
?>