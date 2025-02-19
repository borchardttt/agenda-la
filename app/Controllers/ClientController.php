<?php

namespace App\Controllers;

use App\Models\BarberSchedule;
use Core\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Scheduling;
use Core\Http\Request;
use Lib\Authentication\Auth;
use App\Enums\StatusEnum;

class ClientController extends Controller
{
    public function index(): void
    {
        $this->render('client/index');
    }

    public function indexCreateSchedule(): void
    {
        $barbers = User::where(['type' => 'barber']);
        $services = Service::all();

        $barbersDisponibility = [];
        foreach ($barbers as $barber) {
            $barbersDisponibility[$barber->id] = $this->getBarbersDisponibility($barber->id);
        }

        $this->render('client/createSchedule', compact('barbers', 'services', 'barbersDisponibility'));
    }

    public function mySchedules()
    {
        $authUserId = Auth::user()->id;

        $schedules = Scheduling::where(['client_id' => $authUserId]);

        $formattedSchedules = [];
        foreach ($schedules as $schedule) {

            $formattedSchedules[] = [
                'id' => $schedule->id,
                'dateAux' => $schedule->date,
                'date' => date('d/m/Y', strtotime($schedule->date)),
                'time' => date('H:i', strtotime($schedule->date)),
                'barber' => User::where(['id' => $schedule->barber_id])[0]->name ?? 'Desconhecido',
				'service' => Service::where(['id' => $schedule->service_id])[0]->name ?? 'Indefinido',
                'status' => StatusEnum::getName($schedule->status),
                'disapproval_justification' => $schedule->disapproval_justification ?? 'Sem comentários',
            ];
        }

        $this->render('client/mySchedules', compact('formattedSchedules'));
    }

    public function createSchedule(): void
    {
        $authUser = Auth::user()->id;
    }

    public function cancelSchedule(Request $request): void
    {
        $id = $request->getParam('id');
        $schedule = Scheduling::cancelSchedule($id);

        echo json_encode(['success' => $schedule]);
    }

    public function createScheduling(Request $request)
    {
        $params = $request->validate([
            'barber_id',
            'service_id',
            'date',
            'time',
        ]);

        $schedule = new Scheduling();
        $schedule->client_id = Auth::user()->id;
        $schedule->barber_id = $params['barber_id'];
        $schedule->service_id = $params['service_id'];
        $schedule->date = $params['date'];
        $schedule->status = 'confirmed';
        $schedule->disapproval_justification = ' ';

        if ($schedule->save()) {
            return json_encode(['status' => 'ok']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    private function getBarbersDisponibility(int $barberId): array
    {
        $disponibility = BarberSchedule::where(['barber_id' => $barberId]);

        if (empty($disponibility)) {
            return [];
        }

        $disponibility = $disponibility[0];

        return [
            'week_days' => json_decode($disponibility->week_days) ?: [],
            'initial_hour' => $disponibility->initial_hour,
            'final_hour' => $disponibility->final_hour,
        ];
    }
}
