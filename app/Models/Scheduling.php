<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;
use DateTime;
use Lib\Validations;

class Scheduling extends Model
{
    protected static string $table = 'scheduling';
    protected static array $columns = ['client_id', 'barber_id', 'service_id', 'date', 'status', 'disapproval_justification'];

    /**
     * @var false|mixed|string
     */
    public mixed $client_id;
    public mixed $barber_id;
    public mixed $service_id;
    public mixed $date;
    public mixed $status;
    public mixed $disapproval_justification;

    public function validates(): void
    {
        Validations::notEmpty('client_id', $this);
        Validations::notEmpty('barber_id', $this);
        Validations::notEmpty('service_id', $this);
        Validations::notEmpty('date', $this);
        Validations::notEmpty('status', $this);
        Validations::notEmpty('disapproval_justification', $this);
    }

    public function getMySchedules(int $id)
    {
        $schedules = self::where(['client_id' => $id]);
    }

    public static function cancelSchedule(int $id)
    {
        $schedule = self::findById($id);
        $schedule->status = 'canceled';

        $schedule->disapproval_justification = 'Usuário cancelou o agendamento';

        $schedule->save();
    }

    public static function canCreate(int $barberId, string $date, int $serviceId): bool
    {
        $service = Service::findById($serviceId);
        $serviceTime = $service->time;

        $schedules = self::whereRaw("barber_id = ? AND DATE(date) = ?", [$barberId, date('Y-m-d', strtotime($date))]);


        usort($schedules, fn($a, $b) => strtotime($a->date) <=> strtotime($b->date));


        $newDateTime = new DateTime($date);

        foreach ($schedules as $schedule) {
            $scheduledDateTime = new DateTime($schedule->date);

            $scheduledService = Service::findById($schedule->service_id);
            $scheduledServiceTime = $scheduledService->time;

            $scheduledEndTime = clone $scheduledDateTime;
            $scheduledEndTime->modify("+{$scheduledServiceTime} minutes");

            if ($newDateTime >= $scheduledDateTime && $newDateTime < $scheduledEndTime) {
                return false;
            }
        }

        return true;
    }

}
