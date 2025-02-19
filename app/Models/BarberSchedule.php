<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;
use Lib\Validations;

class BarberSchedule extends Model
{
    protected static string $table = 'barbers_schedules';
    protected static array $columns = ['barber_id',	'week_days',	'initial_hour',	'final_hour'];

    /**
     * @var false|mixed|string
     */
    public mixed $week_days;
    public mixed $barber_id;
    public mixed $initial_hour;
    public mixed $final_hour;

    public function validates(): void
    {
        Validations::notEmpty('barber_id', $this);
        Validations::notEmpty('initial_hour', $this);
        Validations::notEmpty('final_hour', $this);
        Validations::uniqueness('barber_id', $this);
    }
}