<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Scheduling;
use Lib\Authentication\Auth;
use App\Enums\StatusEnum;
use Core\Http\Request;

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
				'id' => $schedule->id,
				'dateAux' => $schedule->date,
				'date' => date('d/m/Y', strtotime($schedule->date)),
				'time' => date('H:i', strtotime($schedule->date)),
				'barber' => User::where(['id' => $schedule->barber_id])[0]->name ?? 'Desconhecido',
				'service' => Service::where(['id' => $schedule->service_id])[0]->name ?? 'Indefinido',
				'status' => StatusEnum::getName($schedule->status),
				'disapproval_justification' => $schedule->disapproval_justification?? 'Sem comentários'
			];
		}


		$this->render('client/mySchedules', compact(['formattedSchedules'], ['formattedSchedules']));
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
}
