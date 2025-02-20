<?php

namespace App\Controllers;

use App\Models\BarberSchedule;
use App\Models\BarberService;
use App\Models\Service;
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
        $userId = Auth::id();
        $mySchedule = BarberSchedule::where(['barber_id' => $userId]);
        $services = Service::all();
        $myServices = BarberService::where(['barber_id' => $userId]);
        $this->render('barber/barber-schedule', compact('mySchedule',  'services', 'myServices'));
    }

    public function createSchedule(Request $data): void
    {
        $success = $this->scheduleService->createSchedule($data);

        if ($success) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Disponibilidade cadastrada com sucesso!'];
            $this->redirectTo('barber/barber-home');
        } else {
            $_SESSION['alert'] = ['type' => 'error', 'message' => 'Erro ao cadastrar disponibilidade!'];
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
