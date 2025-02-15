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
		$authUserId = Auth::user();

		$schedules = Scheduling::where(['client_id' => $authUserId->id]);


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
			];
		}


		$this->render('client/mySchedules', compact(['formattedSchedules'], ['formattedSchedules']));
	}
	public function createSchedule(): void
	{
		$authUser = Auth::user()->id;
	}

	public function deleteSchedule(Request $request): void
	{
		$id = $request->getParam('id');
		$schedule = Scheduling::findById($id);

		if ($schedule->destroy()) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Serviço excluído com sucesso.'
			]);
		} else {
			http_response_code(500);
			echo json_encode([
				'status' => 'error',
				'message' => 'Erro ao excluir o serviço.'
			]);
		}
	}
}
