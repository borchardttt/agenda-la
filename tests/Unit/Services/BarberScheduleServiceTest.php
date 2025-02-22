<?php

namespace Tests\Unit\Services;

use Core\Http\Request;
use App\Services\BarberScheduleService;
use PHPUnit\Framework\TestCase;

class BarberScheduleServiceTest extends TestCase
{
    public function testCreateScheduleSuccessfully(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/barber/create-schedule';
        $_REQUEST = [
            'barber_id' => 1,
            'week_days' => [0, 2, 3],
            'initial_hour' => '8:30:00',
            'final_hour' => '9:30:00',
        ];

        $request = new Request();

        $service = new BarberScheduleService();
        $result = $service->createSchedule($request);

        $this->assertNotNull($result);
        $this->assertEquals(true, $result);
    }
}
