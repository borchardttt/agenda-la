<?php

namespace App\Controllers;

class HomeController
{
	public function index(): void
	{
		require_once __DIR__ . '/../Views/home.php';
	}

	public function about(): void
	{
		echo "Esta é a página Sobre!";
	}
}
