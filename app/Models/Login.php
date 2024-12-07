<?php

namespace App\Models;
use PDO;
class Login
{
	private $pdo;
	private $table = 'users';
	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	public function authenticate($email, $password)
	{
		$sql = "SELECT * FROM {$this->table} WHERE email = :email AND password = SHA2(:password, 256)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
	}
}
