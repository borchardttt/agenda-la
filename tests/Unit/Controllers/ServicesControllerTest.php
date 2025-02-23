<?php

namespace Tests\Controllers;

use App\Controllers\ServicesController;
use App\Models\Service;
use Core\Http\Request;
use PHPUnit\Framework\TestCase;

class ServicesControllerTest extends TestCase
{
    protected $servicesController;

    protected function setUp(): void
    {
        $this->servicesController = new ServicesController();
    }

    public function testIndex(): void
    {
        $serviceMock = $this->createMock(Service::class);
        $serviceMock->method('all')->willReturn([
            new Service(['id' => 1, 'name' => 'Haircut', 'price' => 50, 'time' => 30]),
            new Service(['id' => 2, 'name' => 'Beard Trim', 'price' => 30, 'time' => 20]),
        ]);

        $this->servicesController->service = $serviceMock;

        ob_start();
        $this->servicesController->index();
        $output = ob_get_clean();

        $this->assertNotEmpty($output);
    }

    public function testEditWithInvalidId(): void
    {
        $requestMock = $this->createMock(Request::class);
        $requestMock->method('getParam')->willReturn('invalid');

        $serviceMock = $this->createMock(Service::class);
        $serviceMock->method('findById')->willReturn(null);

        $this->servicesController->service = $serviceMock;

        ob_start();
        $this->servicesController->edit($requestMock);
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(
            '{"status":"error","message":"ID inválido."}',
            $output
        );
    }

    public function testEditWithValidId(): void
    {
        $requestMock = $this->createMock(Request::class);
        $requestMock->method('getParam')->willReturn(1);

        $serviceMock = $this->createMock(Service::class);
        $serviceMock->method('findById')->willReturn(
            new Service(['id' => 1, 'name' => 'Haircut', 'price' => 50, 'time' => 30])
        );

        $this->servicesController->service = $serviceMock;

        ob_start();
        $this->servicesController->edit($requestMock);
        $output = ob_get_clean();

        $this->assertNotEmpty($output);
    }
}