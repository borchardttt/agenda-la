<?php

require_once __DIR__ . '/vendor/autoload.php';

$pdo = new PDO('mysql:host=database;dbname=agenda_la', 'root', 'agenda_la_adm_pwd');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$routes = require_once __DIR__ . '/routes/web.php';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$requestUri])) {
	$route = $routes[$requestUri];
	$controllerClass = $route['controller'];
	$method = $route['method'];

	if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
		$baseNamespace = 'App\\';
		$controllerName = (new \ReflectionClass($controllerClass))->getShortName();
		$modelName = str_replace('Controller', '', $controllerName);
		$modelName = rtrim($modelName, 's');

		$modelClass = $baseNamespace . 'Models\\' . $modelName;

		if (class_exists($modelClass)) {
			$modelInstance = new $modelClass($pdo);
			$controller = new $controllerClass($modelInstance);
		} elseif (method_exists($controllerClass, '__construct')) {
			throw new Exception("Erro: O controlador {$controllerClass} depende de {$modelClass}, mas a classe não existe!");
		} else {
			$controller = new $controllerClass();
		}



		$controller->$method();
	} else {
		http_response_code(500);
		echo "Controller ou método não encontrado!";
	}
} else {
	http_response_code(404);
	echo "404 - Página não encontrada!";
}