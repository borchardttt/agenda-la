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

	public function create()
	{
		$services = $this->service->getAll();
		include 'app/Views/admin/create-service.php';
	}

	public function show($id)
	{
		$service = $this->service->getById($id);
		if (!$service) {
			return "Serviço não encontrado!";
		}
		return $service;
	}

	public function store()
	{
		$name = $_POST['name'] ?? '';
		$price = $_POST['price'] ?? '';
		$time = $_POST['time'] ??'';

		$this->service->name = $name;
		//$this->service->description = $data['description'];
		$this->service->price = $price;
		$this->service->time = $time;	
		//$this->service->created_at = date('Y-m-d H:i:s');

		// if (isset($data['id'])) {
		// 	$this->service->id = $data['id'];
		// }

		if ($this->service->save()) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Cadastro bem-sucedido'
			]);
		}
		return "Erro ao salvar o serviço!";
	}

	public function delete($id)
{
    // Lógica de exclusão
    $success = $this->service->deleteService($id);

    if ($success) {
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Serviço excluído com sucesso!']);
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Falha ao excluir o serviço!']);
    }
}

}
