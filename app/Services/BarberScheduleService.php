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
}
