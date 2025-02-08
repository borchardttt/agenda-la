<?php

namespace App\Controllers;

use App\Services\BarberScheduleService;

class BarberScheduleController
{
    private BarberScheduleService $scheduleService;

    public function __construct()
    {
        $this->scheduleService = new BarberScheduleService();
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
