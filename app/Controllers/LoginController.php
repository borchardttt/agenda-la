<?php

namespace App\Controllers;

class LoginController
{
	public function index(): void
	{
		require_once __DIR__ . '/../Views/auth/register.php';
	}
}
