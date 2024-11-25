<?php

namespace App\Controllers;

use App\Models\Service;

class ServicesController
{
	private $service;

	public function __construct(Service $service)
	{
		$this->service = $service;
	}

	public function index()
	{
		$services = $this->service->getAll();

		include 'app/Views/services.php';
	}

	public function show($id)
	{
		$service = $this->service->getById($id);
		if (!$service) {
			return "Serviço não encontrado!";
		}
		return $service;
	}

	public function store($data)
	{
		$this->service->name = $data['name'];
		$this->service->description = $data['description'];
		$this->service->price = $data['price'];
		$this->service->created_at = date('Y-m-d H:i:s');

		if (isset($data['id'])) {
			$this->service->id = $data['id'];
		}

		if ($this->service->save()) {
			return "Serviço salvo com sucesso!";
		}
		return "Erro ao salvar o serviço!";
	}

	public function destroy($id)
	{
		$this->service->id = $id;
		if ($this->service->delete()) {
			return "Serviço excluído com sucesso!";
		}
		return "Erro ao excluir o serviço!";
	}
}
