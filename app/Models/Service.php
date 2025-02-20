<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

class Service extends Model
{
  protected static string $table = 'services';
  protected static array $columns = ['name', 'price', 'time'];


  public function validates(): void
  {
      Validations::notEmpty('name', $this);
      Validations::notEmpty('price', $this);
      Validations::notEmpty('time', $this);
  }

  public function barbers()
  {
    return $this->belongsToMany(User::class, BarberService::class, 'service_id', 'barber_id');
  }
}
