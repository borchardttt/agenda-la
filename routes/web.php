<?php

return [
	'/' => ['controller' => 'App\Controllers\HomeController', 'method' => 'index'],
	'/about' => ['controller' => 'App\Controllers\HomeController', 'method' => 'about'],
	'/services' => ['controller' => 'App\Controllers\ServicesController', 'method' => 'index'],
	'/login' => ['controller' => 'App\Controllers\UserController', 'method' => 'index'],
	'/authenticate' => ['controller' => 'App\Controllers\UserController', 'method' => 'login']
];
