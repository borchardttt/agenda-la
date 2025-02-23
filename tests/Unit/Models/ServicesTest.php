<?php

namespace Tests\Models;

use App\Models\Service;
use App\Models\User;
use Core\Database\ActiveRecord\BelongsToMany;
use PHPUnit\Framework\TestCase;

class ServicesTest extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        $this->service = new Service(['name' => 'Haircut', 'price' => 50, 'time' => 30]);
    }

    public function testValidates(): void
    {
        $this->service->validates();
        $this->assertEmpty($this->service->errors);

        $this->service->name = '';
        $this->service->validates();
        $this->assertArrayHasKey('name', $this->service->errors);

        $this->service->name = 'Haircut';
        $this->service->price = '';
        $this->service->validates();
        $this->assertArrayHasKey('price', $this->service->errors);

        $this->service->price = 50;
        $this->service->time = '';
        $this->service->validates();
        $this->assertArrayHasKey('time', $this->service->errors);
    }

    public function testBarbers(): void
    {
        $this->assertInstanceOf(BelongsToMany::class, $this->service->barbers());

        $this->assertEquals(User::class, $this->service->barbers()->getRelatedClass());
        $this->assertEquals('barbers_services', $this->service->barbers()->getTable());
        $this->assertEquals('service_id', $this->service->barbers()->getForeignKey());
        $this->assertEquals('barber_id', $this->service->barbers()->getOtherKey());
    }
}