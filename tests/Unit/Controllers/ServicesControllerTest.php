<?php
namespace Tests\Unit\Controllers;

use App\Models\Service;
use App\Controllers\ServicesController;
use Core\Http\Request;
use Tests\TestCase;

class ServicesControllerTest extends TestCase
{
  private ServicesController $controller;
  private Service $service;

  protected function setUp(): void
  {
    parent::setUp();

    $this->controller = new ServicesController();

    $this->service = new Service([
      'name' => 'Corte de Cabelo',
      'price' => 50.0,
      'time' => 30,
    ]);
    $this->service->save();
  }

  public function test_should_create_new_service(): void
  {
    $_REQUEST = [
      'name' => 'Barba',
      'price' => 30.0,
      'time' => 15,
    ];

    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_SERVER['REQUEST_URI'] = '/admin/services/create';

    $request = new Request();

    $this->controller->store($request);

    $this->assertCount(2, Service::all());
  }

  public function test_should_update_service(): void
  {
    $_REQUEST = [
      'name' => 'Corte de Cabelo - Atualizado',
      'price' => 55.0,
      'time' => 45,
    ];

    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_SERVER['REQUEST_URI'] = '/admin/services/update/' . $this->service->id;

    $request = new Request();

    $this->controller->update($request);

    $updatedService = Service::findById($this->service->id);
    $this->assertEquals('Corte de Cabelo - Atualizado', $updatedService->name);
  }

  public function test_should_delete_service(): void
  {
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_SERVER['REQUEST_URI'] = '/services/delete';

    $request = new Request();

    $_REQUEST['id'] = $this->service->id;

    $this->controller->destroy($request);

    $this->assertCount(0, Service::all());
  }
}
