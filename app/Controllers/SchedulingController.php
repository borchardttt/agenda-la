<?php

namespace App\Controllers;

use App\Models\Scheduling;

class SchedulingController
{
	private $service;

	public function __construct(Scheduling $service)
	{
		$this->service = $service;
	}

	public function create(array $data)
	{
		$this->service->client_id = $data['client_id'];
		$this->service->barber_id = $data['barber_id'];
		$this->service->service_id = $data['service_id'];
		$this->service->date = $data['date'];
		$this->service->status = $data['status'];

		if ($this->service->create()) {
			echo json_encode(['success' => true, 'message' => 'Agendamento criado com sucesso.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Erro ao criar agendamento.']);
		}
	}

	public function getAll()
	{
		$schedulings = $this->service->getAll();

		header('Content-Type: application/json');
		echo json_encode([
			'success' => true,
			'agendamentos' => $schedulings
		]);
	}

	public function getById(int $id)
	{
		$scheduling = $this->service->getById($id);

		header('Content-Type: application/json');
		if ($scheduling) {
			echo json_encode(['success' => true, 'agendamento' => $scheduling]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Agendamento não encontrado.']);
		}
	}

	public function getByClient(int $clientId)
	{
		$schedulings = $this->service->getByClient($clientId);

		header('Content-Type: application/json');
		echo json_encode([
			'success' => true,
			'agendamentos' => $schedulings
		]);
	}

	public function update(array $data)
	{
		$this->service->id = $data['id'];
		$this->service->client_id = $data['client_id'];
		$this->service->barber_id = $data['barber_id'];
		$this->service->service_id = $data['service_id'];
		$this->service->date = $data['date'];
		$this->service->status = $data['status'];

		if ($this->service->update()) {
			echo json_encode(['success' => true, 'message' => 'Agendamento atualizado com sucesso.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Erro ao atualizar agendamento.']);
		}
	}

	public function delete(int $id)
	{
		if ($this->service->delete($id)) {
			echo json_encode(['success' => true, 'message' => 'Agendamento excluído com sucesso.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Erro ao excluir agendamento.']);
		}
	}
}
