<?php

namespace App\Controllers;

use App\Models\BarberSchedule;
use App\Services\BarberScheduleService;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;

class BarberScheduleController extends Controller
{
    private BarberScheduleService $scheduleService;

    public function __construct()
    {
        $this->scheduleService = new BarberScheduleService();
    }

    public function index():void {
        $userId = Auth::user()->id;
        $mySchedule = BarberSchedule::where(['barber_id' => $userId]);
        $this->render('barber/barber-schedule', compact('mySchedule', 'mySchedule'));
    }

    public function createSchedule(Request $data): void
    {
        $success = $this->scheduleService->createSchedule($data);

        if ($success) {
            echo json_encode(['success' => 'Disponibilidade criada com sucesso!']);
            $this->render('barber/barber-home');
        } else {
            echo json_encode(['error' => 'Erro ao criar o agendamento.']);
        }
    }

    public function editScheduleIndex(Request $request):void {
        $id = $request->getParam('id');
        $schedule = BarberSchedule::findById($id);
        $this->render('barber/edit-schedule', compact('schedule', 'schedule'));
    }
    public function editSchedule(Request $request):void {
        $params = $request;
        $this->scheduleService->updateSchedule($params);
    }
}
