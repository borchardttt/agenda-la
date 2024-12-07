<?php

namespace App\Models;

use PDO;

class Service
{
	private $pdo;
	private $table = 'services';

	public $id;
	public $name;
	public $description;
	public $price;

	public $time;
	//public $created_at;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function save()
	{
		if (empty($this->id)) {
			$sql = "INSERT INTO {$this->table} (name, price, time) 
                    VALUES (:name, :price, :time)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':name', $this->name);
			//$stmt->bindParam(':description', $this->description);
			$stmt->bindParam(':price', $this->price);
			$stmt->bindParam(':time', $this->time);
			//$stmt->bindParam(':created_at', $this->created_at);
			return $stmt->execute();
		} else {
			$sql = "UPDATE {$this->table} 
                    SET name = :name, description = :description, price = :price, created_at = :created_at 
                    WHERE id = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':name', $this->name);
			//$stmt->bindParam(':description', $this->description);
			$stmt->bindParam(':price', $this->price);
			$stmt->bindParam(':time', $this->time);
			//$stmt->bindParam(':created_at', $this->created_at);
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

	public function deleteService($id)
{
    $stmt = $this->pdo->prepare('DELETE FROM services WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute(); // Retorna true em caso de sucesso ou false em caso de falha
}

}
