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

public function edit($id)
    {
        // Buscar o serviço por ID para pré-preencher o formulário de edição
        $service = $this->service->getById($id);
        if (!$service) {
            return "Serviço não encontrado!";
        }

        // Exibir o formulário de edição com os dados do serviço
        include 'app/Views/admin/edit-service.php';
    }

    public function update($id)
    {
        // Receber os dados do formulário de edição
        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? '';
        $time = $_POST['time'] ?? '';
        $description = $_POST['description'] ?? '';

        // Obter o serviço do banco de dados
        $service = $this->service->getById($id);
        if (!$service) {
            return "Serviço não encontrado!";
        }

        // Atualizar os dados do serviço
        $service->name = $name;
        $service->price = $price;
        $service->time = $time;
        $service->description = $description;

        // Salvar o serviço atualizado no banco
        if ($this->service->update($service)) {
            // Caso de sucesso, redirecionar ou exibir mensagem
            echo json_encode([
                'status' => 'success',
                'message' => 'Serviço atualizado com sucesso!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Erro ao atualizar o serviço!'
            ]);
        }
    }


}