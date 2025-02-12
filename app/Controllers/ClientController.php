<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Scheduling;
use Lib\Authentication\Auth;

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

        $this->render('client/createSchedule', compact(['barbers', 'services'], ['barbers', 'services']));
    }

    public function mySchedules()
    {
        $authUserId = Auth::user()->id;

        $schedules = Scheduling::where(['client_id' => $authUserId]);

        $formattedSchedules = [];
        foreach ($schedules as $schedule) {
            $formattedSchedules[] = [
                'date' => $schedule->date,
                'time' => date('H:i', strtotime($schedule->date)), // Extraindo a hora
                'barber' => User::where($schedule->barber_id)->name ?? 'Desconhecido',
                'service' => Service::where($schedule->service_id)->name ?? 'Indefinido',
                'status' => ucfirst(string: $schedule->status),
            ];
        }

        $this->render('client/mySchedules', compact(['formattedSchedules'], ['formattedSchedules']));
    }
    public function createSchedule(): void
    {
        $authUser = Auth::user()->id;
    }
}
