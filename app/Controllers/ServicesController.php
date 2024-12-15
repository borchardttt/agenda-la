<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;
use App\Models\Service;

class ServicesController extends Controller
{
  public function index(): void
  {
    $title = 'Serviços';
    $services = Service::all();
    $this->render('services/index', compact('title', 'services'));
  }

  public function indexAdmin(Request $request): void
  {
    $title = 'Serviços';
    $services = Service::all();
    $this->render('admin/services/services', compact('title', 'services'));
  }
  public function edit(Request $request): void
  {
    $id = $request->getParam('id');

    if (!$id || !is_numeric($id)) {
      http_response_code(400);
      echo json_encode([
        'status' => 'error',
        'message' => 'ID inválido.'
      ]);
      return;
    }

    $service = Service::findById($id);

    if (!$service) {
      http_response_code(404);
      echo json_encode([
        'status' => 'error',
        'message' => 'Serviço não encontrado.'
      ]);
      return;
    }

    $title = "Editar Serviço - {$service->name}";

    $this->render('admin/services/edit', compact('title', 'service'));
  }



  public function store(Request $request): void
  {
    $name = $request->getParam('name');
    $price = $request->getParam('price');
    $time = $request->getParam('time');

    $service = new Service();
    $service->name = $name;
    $service->price = $price;
    $service->time = $time;

    if ($service->save()) {
      echo json_encode([
        'status' => 'success',
        'message' => 'Serviço criado com sucesso.',
        'data' => [
          'id' => $service->id,
          'name' => $service->name,
          'price' => $service->price,
          'time' => $service->time
        ]
      ]);
    } else {
      http_response_code(500);
      echo json_encode([
        'status' => 'error',
        'message' => 'Ocorreu um erro ao criar o serviço.'
      ]);
    }
  }

  public function show(Request $request, int $id): void
  {
    $service = Service::findById($id);
    if ($service) {
      echo json_encode([
        'status' => 'success',
        'data' => $service
      ]);
    } else {
      http_response_code(404);
      echo json_encode([
        'status' => 'error',
        'message' => 'Serviço não encontrado.'
      ]);
    }
  }

  public function update(Request $request): void
  {
    $params = $request->getParams();

    $body = json_decode(file_get_contents('php://input'), true);
    if (is_array($body)) {
      $params = array_merge($params, $body);
    }

    if (empty($params['id']) || !is_numeric($params['id'])) {
      http_response_code(400);
      echo json_encode([
        'status' => 'error',
        'message' => 'ID inválido.'
      ]);
      return;
    }
    $id = $params['id'];
    $service = Service::findById($id);
    if (!$service) {
      http_response_code(404);
      echo json_encode([
        'status' => 'error',
        'message' => 'Serviço não encontrado.'
      ]);
      return;
    }

    $name = $request->getParam('name');
    $price = $request->getParam('price');
    $time = $request->getParam('time');

    if (!$name || !$price || !$time) {
      http_response_code(400);
      echo json_encode([
        'status' => 'error',
        'message' => 'Todos os campos são obrigatórios.'
      ]);
      return;
    }

    $service->name = $name;
    $service->price = $price;
    $service->time = $time;

    if ($service->save()) {
      echo json_encode([
        'status' => 'success',
        'message' => 'Serviço atualizado com sucesso.',
        'data' => $service
      ]);
    } else {
      http_response_code(500);
      echo json_encode([
        'status' => 'error',
        'message' => 'Erro ao atualizar o serviço.'
      ]);
    }
  }


  public function destroy(Request $request): void
  {
    $params = $request->getParams();

    $body = json_decode(file_get_contents('php://input'), true);
    if (is_array($body)) {
      $params = array_merge($params, $body);
    }

    if (empty($params['id']) || !is_numeric($params['id'])) {
      http_response_code(400); // Bad Request
      echo json_encode([
        'status' => 'error',
        'message' => 'ID inválido.'
      ]);
      return;
    }

    $service = Service::findById($params['id']);
    if (!$service) {
      http_response_code(404);
      echo json_encode([
        'status' => 'error',
        'message' => 'Serviço não encontrado.'
      ]);
      return;
    }

    if ($service->destroy()) {
      echo json_encode([
        'status' => 'success',
        'message' => 'Serviço excluído com sucesso.'
      ]);
    } else {
      http_response_code(500);
      echo json_encode([
        'status' => 'error',
        'message' => 'Erro ao excluir o serviço.'
      ]);
    }
  }

}
