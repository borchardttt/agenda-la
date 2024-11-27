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

	public function login()
	{
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
			echo json_encode([
				'status' => 'success',
				'message' => 'Login bem-sucedido',
				'redirect' => '/dashboard'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Credenciais inválidas.'
			]);
		}

		exit;
	}

}
