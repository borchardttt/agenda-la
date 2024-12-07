<?php

namespace App\Controllers;
use PDO;

class LoginController
{
	private $table = 'users';
	private $pdo;

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

		$user = $this->authenticate($email, $password);

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
	public function authenticate($email, $password)
	{
		$sql = "SELECT * FROM {$this->table} WHERE email = :email AND password = SHA2(:password, 256)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		return $user ?: false;
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
