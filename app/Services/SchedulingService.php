<?php

namespace App\Services;

use App\Models\Scheduling;
use Core\Http\Request;
use Lib\Authentication\Auth;

class SchedulingService
{
    /**
     * Cria um novo agendamento
     * 
     * @param Request $data
     * @return bool
     */
    public function createSchedule(Request $data): bool
    {
        $params = $data->getBody();

        $schedule = new Scheduling();
        $schedule->client_id = Auth::user()->id;
        $schedule->barber_id = $params['barber_id'];
        $schedule->service_id = $params['service_id'];
        $schedule->date = $params['date'];
        $schedule->status = 'pending';
        $schedule->disapproval_justification = '';

        return $schedule->save();
    }

    /**
     * Obtém os agendamentos do cliente autenticado
     * 
     * @return array
     */
    public function getClientSchedules(): array
    {
        return Scheduling::where(['client_id' => Auth::user()->id]);
    }

    /**
     * Cancela um agendamento
     * 
     * @param int $scheduleId
     * @return bool
     */
    public function cancelSchedule(int $scheduleId): bool
    {
        $schedule = Scheduling::where(['id' => $scheduleId]);

        $schedule = !empty($schedule) ? $schedule[0] : null;
  
        if (!$schedule || $schedule->client_id !== Auth::user()->id) {
            return false;
        }

        $schedule->status = 'canceled';
        return $schedule->save();
    }
}