<?php

namespace App\Controllers;

use App\Models\Login;
use PDO;

class LoginController
{

	private $service;
	public function __construct(Login $service)
	{
		$this->service = $service;
	}

	public function index(): void
	{
		require_once __DIR__ . '/../Views/auth/register.php';
	}
	public function indexLogin(): void
	{
		require_once __DIR__ . '/../Views/auth/login.php';
	}
	public function login()
	{
		session_start();
		$email = $_POST['email'] ?? '';
		$password = $_POST['password'] ?? '';

		if (empty($email) || empty($password)) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Email e senha são obrigatórios.'
			]);
			exit;
		}

		$user = $this->service->authenticate($email, $password);

		if ($user) {
			$_SESSION['user'] = $user;

			$redirect = ($user['type'] === 'admin') ? '/admin-home' : '/dashboard';

			echo json_encode([
				'status' => 'success',
				'message' => 'Login bem-sucedido',
				'redirect' => $redirect
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Credenciais inválidas.'
			]);
		}

		exit;
	}
	public function logout()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$_SESSION = [];

		session_destroy();

		header('Location: /login');
		exit;
	}
}
