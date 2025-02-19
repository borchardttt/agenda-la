<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;
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
}