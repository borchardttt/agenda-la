<?php

namespace App\Router;

class Router
{
	private static ?Router $instance = null;

	private $routes = [];
	public function addRoute(Route $route): Route
	{
		$this->routes[] = $route;
		return $route;
	}
	public static function getInstance(): Router
	{
		if (self::$instance === null) {
			self::$instance = new Router();
		}
		return self::$instance;
	}
	public function getPathByName(string $name): string
	{
		foreach ($this->routes as $route) {
			if ($route->getName() === $name) {
				return $route->getPath();
			}
		}
		throw new \Exception("Rota com nome $name não encontrada");
	}
	public function dispatch(): object|bool
	{
		$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];
		$uri = $_SERVER['REQUEST_URI'];
		foreach ($this->routes as $route) {
			if ($route->match($method, $uri)) {
				$class = $route->getController();
				$action = $route->getAction();

				$controller = new $class($action);
				$controller->$action();

				return $controller;
			}
		}
		return false;
	}


	public static function init()
	{
		require_once __DIR__ . "/../../routes/web.php";
		Router::getInstance()->dispatch();
	}

}
