<?php

namespace App\Router;

class Route
{
	private string $name = '';
	public function __construct(
		private string $method,
		private string $path,
		private string $controller,
		private string $action
	) {
	}

	public function name(string $name): void
	{
		$this->name = $name;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getMethod(): string
	{
		return $this->method;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function getController(): string
	{
		return $this->controller;
	}

	public function getAction(): string
	{
		return $this->action;
	}

	public function match(string $method, string $uri)
	{
		return $this->method === $method && $this->path === $uri;
	}

	public static function get(string $uri, $action): Route
	{
		return Router::getInstance()->addRoute(new Route('GET', $uri, $action[0], $action[1]));
	}

	public static function post(string $uri, $action)
	{
		Router::getInstance()->addRoute(new Route('POST', $uri, $action[0], $action[1]));
	}

	public static function put(string $uri, $action)
	{
		Router::getInstance()->addRoute(new Route('PUT', $uri, $action[0], $action[1]));
	}

	public static function delete(string $uri, $action)
	{
		Router::getInstance()->addRoute(new Route('DELETE', $uri, $action[0], $action[1]));
	}
}
