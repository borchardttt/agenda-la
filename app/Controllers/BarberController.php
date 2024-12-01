<?php

namespace App\Controllers;

class BarberController
{
	public function index(): void
	{
		require_once __DIR__ . '/../Views/barber/dashboard.php';
	}
}
