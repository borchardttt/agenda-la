<?php

namespace App\Services;

use App\Models\BarberSchedule;

class BarberScheduleService
{
    /**
     * @param array $data
     * @return bool
     */
    public function createSchedule(array $data): bool
    {
        $barberId = $data['barber_id'];
        $weekDays = $data['week_days'];
        $initialHour = $data['initial_hour'];
        $finalHour = $data['final_hour'];

        $schedule = new BarberSchedule();

        $schedule->barber_id = $barberId;
        $schedule->week_days = json_encode($weekDays);
        $schedule->initial_hour = $initialHour;
        $schedule->final_hour = $finalHour;

        return $schedule->save();
    }
}
