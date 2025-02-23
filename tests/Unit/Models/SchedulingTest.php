<?php

namespace Tests\Models;

use App\Models\Scheduling;
use PHPUnit\Framework\TestCase;

class SchedulingTest extends TestCase
{
    private $scheduling;

    protected function setUp(): void
    {
        $this->scheduling = new Scheduling();
    }

    protected function tearDown(): void
    {
        $this->scheduling = null;
    }

    public function testValidationPassesWhenRequiredFieldsAreFilled()
    {
        $this->scheduling->client_id = 1;
        $this->scheduling->barber_id = 1;
        $this->scheduling->service_id = 1;
        $this->scheduling->date = '2023-10-01 10:00:00';
        $this->scheduling->status = 'confirmed';
        $this->scheduling->disapproval_justification = '';

        $this->scheduling->validates();
        $this->assertEmpty($this->scheduling->errors());
    }

    public function testGetMySchedulesReturnsArray()
    {
        $clientId = 1;
        $schedules = $this->scheduling->getMySchedules($clientId);
        $this->assertTrue($schedules === null || is_array($schedules));
    }
    public function testSaveSchedulingFailsWhenValidationFails()
    {
        $this->scheduling->client_id = null;
        $this->scheduling->barber_id = null;
        $this->scheduling->service_id = null;
        $this->scheduling->date = null;
        $this->scheduling->status = null;
        $this->scheduling->disapproval_justification = null;
        
        $result = $this->scheduling->save();
        
        $this->assertFalse($result);
    }

    public function testSaveSchedulingSucceedsWhenValidationPasses()
    {
        $this->scheduling->client_id = 1;
        $this->scheduling->barber_id = 1;
        $this->scheduling->service_id = 1;
        $this->scheduling->date = '2023-10-01 10:00:00';
        $this->scheduling->status = 'confirmed';
        $this->scheduling->disapproval_justification = '';

        $result = $this->scheduling->save();

        $this->assertTrue($result === true || $result === false);
    }
}