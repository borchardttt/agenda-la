<?php

namespace Tests\Unit\Services;

use Core\Http\Request;
use App\Services\BarberScheduleService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class BarberScheduleServiceTest extends TestCase
{
    private BarberScheduleService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new BarberScheduleService();
    }

    /**
     * @throws Exception
     */
    public function testCreateScheduleSuccessfully(): void
    {
        $request = $this->createMock(Request::class);

        $request->method('getBody')->willReturn([
            'barber_id' => 2,
            'week_days' => [0, 2, 3],
            'initial_hour' => '08:30:00',
            'final_hour' => '09:30:00',
        ]);

        $result = $this->service->createSchedule($request);

        $this->assertTrue($result);
    }

    /**
     * @throws Exception
     */
    public function testCreateScheduleFail(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getBody')->willReturn([
            'barber_id' => 2,
            'week_days' => [0, 2, 3],
            'initial_hour' => '08:30:00',
            'final_hour' => '09:30:00',
        ]);
        $result = $this->service->createSchedule($request);
        $this->assertFalse($result);
    }

    public function testUpdateScheduleSuccessfully(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getBody')->willReturn([
        'id' => 12,
        'week_days' => [0, 1, 2],
        'initial_hour' => '10:00:00',
        'final_hour' => '11:00:00',
        ]);
        $validatedRequest = $request->validate([
            'id',
            'week_days',
            'initial_hour',
            'final_hour',
        ]);

        $result = $this->service->updateSchedule($validatedRequest);

        $this->assertTrue($result);
    }

    /**
     * @throws Exception
     */
    public function testUpdateScheduleWithMissingId(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getBody')->willReturn([
            'week_days' => [0, 2, 3],
            'initial_hour' => '08:30:00',
            'final_hour' => '09:30:00',
        ]);
        $validatedRequest = $request->validate([
            'id',
            'week_days',
            'initial_hour',
            'final_hour',
        ]);

        $result = $this->service->updateSchedule($validatedRequest);

        $this->assertFalse($result);
    }

    /**
     * @throws Exception
     */
    public function testUpdateScheduleNotFound(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getBody')->willReturn([
            'id' => 999,
            'week_days' => [0, 1, 2],
            'initial_hour' => '10:00:00',
            'final_hour' => '11:00:00',
        ]);
        $validatedRequest = $request->validate([
            'id',
            'week_days',
            'initial_hour',
            'final_hour',
        ]);

        $result = $this->service->updateSchedule($validatedRequest);

        $this->assertFalse($result);
    }
}
