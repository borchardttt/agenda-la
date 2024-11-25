<?php

use App\Controllers\ServicesController;

return [
	'/' => ['controller' => 'App\Controllers\HomeController', 'method' => 'index'],
	'/about' => ['controller' => 'App\Controllers\HomeController', 'method' => 'about'],
	'/services' => ['controller' => 'App\Controllers\ServicesController', 'method' => 'index'],
];
