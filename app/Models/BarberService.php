<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;
use Lib\Validations;

class BarberService extends Model
{
    protected static string $table = 'barbers_services';
    protected static array $columns = ['barber_id',	'service_id'];

    public function validates(): void
    {
        Validations::notEmpty('barber_id', $this);
        Validations::notEmpty('service_id', $this);
    }
}