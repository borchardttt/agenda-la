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

	public function register()
	{
		$name = $_POST['name'] ?? '';
		$email = $_POST['email'] ?? '';
		$password = $_POST['password'] ?? '';

		if (empty($name) || empty($email) || empty($password)) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Email e senha são obrigatórios.'
			]);
			return;
		}

		$user = $this->user->register($name, $email, $password);

		var_dump($user);

		if ($user) {
			$_SESSION['user'] = $user;

			$redirect = '/login';

			echo json_encode([
				'status' => 'success',
				'message' => 'Usuario cadastrado',
				'redirect' => $redirect
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Usuario já existe Controller',
			]);
		}
		return;
	}

}
