<?php

return [
	'/' => ['controller' => 'App\Controllers\HomeController', 'method' => 'index'],
	'/about' => ['controller' => 'App\Controllers\HomeController', 'method' => 'about'],
	'/services' => ['controller' => 'App\Controllers\ServicesController', 'method' => 'index'],
	'/login' => ['controller' => 'App\Controllers\UserController', 'method' => 'index'],
	'/logout' => ['controller' => 'App\Controllers\UserController', 'method' => 'logout'],
	'/authenticate' => ['controller' => 'App\Controllers\UserController', 'method' => 'login'],
	'/admin-home' => ['controller' => 'App\Controllers\HomeController', 'method' => 'adminHome'],
	'/users' => ['controller' => 'App\Controllers\UserController', 'method' => 'getAll'],
	'/dashboard' => ['controller' => 'App\Controllers\BarberController', 'method' => 'index'],
	'/register' => ['controller' => 'App\Controllers\LoginController', 'method' => 'index'],
	'/user-registration' => ['controller' => 'App\Controllers\UserController', 'method' => 'register'],
];
