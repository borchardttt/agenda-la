<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\BelongsToMany;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $type
 */
class User extends Model
{
    protected static string $table = 'users';
    protected static array $columns = ['name', 'email', 'password', 'type'];

    protected ?string $password = null;
    protected ?string $password_confirmation = null;

    public function validates(): void
    {
        Validations::notEmpty('name', $this);
        Validations::notEmpty('email', $this);

        Validations::uniqueness('email', $this);
    }

    public function authenticate(string $password): bool
    {
        return hash('sha256', $password) === $this->password;
    }



    public function __set(string $property, mixed $value): void
    {
        parent::__set($property, $value);

        if (
            $property === 'password' &&
            $this->newRecord() &&
            $value !== null && $value !== ''
        ) {
            $this->password = hash('sha256', $value);
        }
    }
    public function getType(): string
    {
        return $this->type ?? '';
    }
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'barbers_services', 'barber_id', 'service_id');
    }
}
