<?php

namespace App\Models;

use PDO;
use PDOException;

class Scheduling
{
	private $pdo;
	private $table = 'scheduling';

	public $id;
	public $client_id;
	public $barber_id;
	public $service_id;
	public $date;
	public $status;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function create(): bool
	{
		try {
			$sql = "INSERT INTO {$this->table} (client_id, barber_id, service_id, date, status) 
					VALUES (:client_id, :barber_id, :service_id, :date, :status)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':client_id', $this->client_id);
			$stmt->bindParam(':barber_id', $this->barber_id);
			$stmt->bindParam(':service_id', $this->service_id);
			$stmt->bindParam(':date', $this->date);
			$stmt->bindParam(':status', $this->status);
			return $stmt->execute();
		} catch (PDOException $e) {
			// Log de erro
			error_log('Create Error: ' . $e->getMessage());
			return false;
		}
	}

	public function getAll(): array
	{
		try {
			$sql = "SELECT * FROM {$this->table}";
			$stmt = $this->pdo->query($sql);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			error_log('Read Error: ' . $e->getMessage());
			return [];
		}
	}

	public function getById(int $id): ?array
	{
		try {
			$sql = "SELECT * FROM {$this->table} WHERE id = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
		} catch (PDOException $e) {
			error_log('Read Error: ' . $e->getMessage());
			return null;
		}
	}
	public function getByClient(int $clientId): array
	{
		try {
			$sql = "SELECT * FROM {$this->table} WHERE client_id = :client_id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':client_id', $clientId);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			error_log('Get By User Error: ' . $e->getMessage());
			return [];
		}
	}

	public function update(): bool
	{
		try {
			$sql = "UPDATE {$this->table} 
					SET client_id = :client_id, barber_id = :barber_id, service_id = :service_id, 
						date = :date, status = :status
					WHERE id = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':client_id', $this->client_id);
			$stmt->bindParam(':barber_id', $this->barber_id);
			$stmt->bindParam(':service_id', $this->service_id);
			$stmt->bindParam(':date', $this->date);
			$stmt->bindParam(':status', $this->status);
			return $stmt->execute();
		} catch (PDOException $e) {
			error_log('Update Error: ' . $e->getMessage());
			return false;
		}
	}

	public function delete(int $id): bool
	{
		try {
			$sql = "DELETE FROM {$this->table} WHERE id = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':id', $id);
			return $stmt->execute();
		} catch (PDOException $e) {
			error_log('Delete Error: ' . $e->getMessage());
			return false;
		}
	}
}
