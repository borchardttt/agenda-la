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

  }

}
