<?php

namespace App\Controllers;

use App\Models\BarberSchedule;
use App\Models\BarberService;
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

        $barbersServices = [];

        foreach ($barbers as $barber) {
            $barberServices = BarberService::where(['barber_id' => $barber->id]);

            $serviceIds = [];
            foreach ($barberServices as $barberService) {
                $serviceIds[] = $barberService->service_id;
            }

            $services = [];
            foreach ($serviceIds as $serviceId) {
                $service = Service::findBy(['id' => $serviceId]);
                if ($service) {
                    $services[] = $service;
                }
            }

            $barbersServices[$barber->id] = $services;
        }


        $barbersDisponibility = [];
        foreach ($barbers as $barber) {
            $barbersDisponibility[$barber->id] = $this->getBarbersDisponibility($barber->id);
        }

        $this->render('client/createSchedule', compact('barbers', 'barbersServices', 'barbersDisponibility'));
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
        $this->redirectTo(route('client-schedules'));

        //echo json_encode(['success' => $schedule]);
    }

    public function createScheduling(Request $request): void
    {
        $params = $request->validate([
            'barber_id',
            'service_id',
            'date',
            'time',
        ]);
        $canCreate = Scheduling::canCreate($params['barber_id'], $params['date'], $params['service_id']);
        if ($canCreate) {
            $schedule = new Scheduling();
            $schedule->client_id = Auth::user()->id;
            $schedule->barber_id = $params['barber_id'];
            $schedule->service_id = $params['service_id'];
            $schedule->date = $params['date'];
            $schedule->status = 'confirmed';
            $schedule->disapproval_justification = ' ';
            if ($schedule->save()) {
                $_SESSION['alert'] = ['type' => 'success', 'message' => 'Agendamento criado com sucesso!'];
            } else {
                $_SESSION['alert'] = ['type' => 'error', 'message' => 'Erro ao criar agendamento!'];
            }
        } else {
            $_SESSION['alert'] = ['type' => 'error', 'message' => 'Já existem agendamentos nesse horário para o barbeiro!'];
            $this->redirectTo('createSchedule');
        }

        $this->redirectTo("createSchedule");
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
