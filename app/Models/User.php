<?php

namespace App\Models;

use PDO;

class User
{
	private $pdo;
	private $table = 'users';

	public $id;
	public $name;
	public $email;
	public $password;
	public $type;
	public $created_at;
	public $updated_at;


	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function save()
	{
		if (empty($this->id)) {
			$sql = "INSERT INTO {$this->table} (name, email, password, type, created_at) 
                    VALUES (:name, :email, :password, :type, :created_at)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':password', $this->password);
			$stmt->bindParam(':type', $this->type);
			$stmt->bindParam(':created_at', $this->created_at);
			return $stmt->execute();
		} else {
			$sql = "UPDATE {$this->table} 
                    SET name = :name, email = :email, password = :password, type = :type , updated_at =  updated_at
                    WHERE id = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':password', $this->password);
			$stmt->bindParam(':type', $this->type);
			$stmt->bindParam(':updated_at', $this->updated_at);
			$stmt->bindParam(':id', $this->id);
			return $stmt->execute();
		}
	}

	public function getAll()
	{
		$sql = "SELECT * FROM {$this->table}";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM {$this->table} WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getByEmail($email)
	{
		$sql = "SELECT * FROM {$this->table} WHERE email = :email";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function delete()
	{
		$sql = "DELETE FROM {$this->table} WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':id', $this->id);
		return $stmt->execute();
	}

	public function register($name, $email, $password){ 

		$existingUser = $this->getByEmail($email);
		if ($existingUser){
			return false;
		}

		$sql = "INSERT INTO {$this->table}
						(name, email, password, type, created_at, updated_at)
						VALUES (:name, :email, :password, 'client', NOW(), NOW())";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		return $user ?: false;
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



}
