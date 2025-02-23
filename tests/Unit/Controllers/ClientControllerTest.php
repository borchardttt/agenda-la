<?php

namespace Tests\Controllers;

use App\Controllers\ClientController;
use App\Models\User;
use App\Models\Service;
use App\Models\Scheduling;
use App\Models\BarberSchedule;
use Core\Http\Request;
use Lib\Authentication\Auth;
use PHPUnit\Framework\TestCase;

class ClientControllerTest extends TestCase
{
    protected $clientController;

    protected function setUp(): void
    {
        $this->clientController = new ClientController();
    }

    public function testIndex(): void
    {
        ob_start();
        $this->clientController->index();
        $output = ob_get_clean();

        $this->assertNotEmpty($output);
    }

    public function testIndexCreateSchedule(): void
    {
        $barber = new User(['id' => 1, 'name' => 'Barber 1', 'type' => 'barber']);
        $service = new Service(['id' => 1, 'name' => 'Haircut']);

        $userMock = $this->createMock(User::class);
        $userMock->method('where')->willReturn([$barber]);

        $serviceMock = $this->createMock(Service::class);
        $serviceMock->method('all')->willReturn([$service]);

        $barberScheduleMock = $this->createMock(BarberSchedule::class);
        $barberScheduleMock->method('where')->willReturn([]);

        $this->clientController->user = $userMock;
        $this->clientController->service = $serviceMock;
        $this->clientController->barberSchedule = $barberScheduleMock;

        ob_start();
        $this->clientController->indexCreateSchedule();
        $output = ob_get_clean();

        $this->assertNotEmpty($output);
    }

    public function testMySchedules(): void
    {
        $authUser = new User(['id' => 1, 'name' => 'Client 1']);

        $authMock = $this->createMock(Auth::class);
        $authMock->method('user')->willReturn($authUser);

        $this->clientController->auth = $authMock;

        $schedule = new Scheduling([
            'id' => 1,
            'date' => '2023-10-01 10:00:00',
            'barber_id' => 1,
            'service_id' => 1,
            'status' => 'confirmed',
            'disapproval_justification' => ''
        ]);

        $schedulingMock = $this->createMock(Scheduling::class);
        $schedulingMock->method('where')->willReturn([$schedule]);

        $this->clientController->scheduling = $schedulingMock;

        ob_start();
        $this->clientController->mySchedules();
        $output = ob_get_clean();

        $this->assertNotEmpty($output);
    }
}