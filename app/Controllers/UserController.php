<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function index()
	{
		include 'app/Views/auth/login.php';
	}
	public function getAll()
	{
		$users = $this->user->getAll();
		include 'app/Views/admin/users.php';

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

		$user = $this->user->authenticate($email, $password);

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
