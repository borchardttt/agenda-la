<?php

namespace App\Services;

use App\Models\BarberSchedule;
use Core\Http\Request;
use Lib\Authentication\Auth;

class BarberScheduleService
{
    /**
     * @param Request $data
     * @return bool
     */
    public function createSchedule(Request $data): bool
    {
        $params = $data->getBody();

        $barberId = Auth::user()->id;
        $weekDays = $params['week_days'];
        $initialHour = $params['initial_hour'];
        $finalHour = $params['final_hour'];

        $schedule = new BarberSchedule();

        $schedule->barber_id = $barberId;
        $schedule->week_days = json_encode($weekDays);
        $schedule->initial_hour = $initialHour;
        $schedule->final_hour = $finalHour;

        return $schedule->save();
    }

    public function updateSchedule(Request $data): void {
        $params = $data->validate([
            'id',
            'week_days',
            'initial_hour',
            'final_hour',
        ]);

        if (!isset($params['id'])) {
            $_SESSION['alert'] = ['type' => 'error', 'message' => 'ID do agendamento não informado!'];
            header("Location: /barber/schedule");
            exit;
        }

        $schedule = BarberSchedule::findById($params['id']);

        if (!$schedule) {
            $_SESSION['alert'] = ['type' => 'error', 'message' => 'Agendamento não encontrado!'];
            header("Location: /barber/schedule");
            exit;
        }

        if (isset($params['week_days']) && is_array($params['week_days'])) {
            $params['week_days'] = json_encode($params['week_days']);
        }

        $updateSuccess = $schedule->update($params);

        if ($updateSuccess) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Agendamento atualizado com sucesso!'];
        } else {
            $_SESSION['alert'] = ['type' => 'error', 'message' => 'Erro ao alterar agendamento!'];
        }

        header("Location: /barber/schedule");
        exit;
    }



}
