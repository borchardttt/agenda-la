<?php

namespace App\Controllers;

use App\Services\BarberScheduleService;
use Core\Http\Controllers\Controller;

class BarberScheduleController extends Controller
{
    private BarberScheduleService $scheduleService;

    public function __construct()
    {
        $this->scheduleService = new BarberScheduleService();
    }

    public function index():void{
        $this->render('barber/barber-schedule');
    }

    public function createSchedule(array $data): void
    {
        $success = $this->scheduleService->createSchedule($data);

        if ($success) {
            echo json_encode(['success' => 'Agendamento criado com sucesso!']);
        } else {
            echo json_encode(['error' => 'Erro ao criar o agendamento.']);
        }
    }
}
