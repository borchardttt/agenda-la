<?php

namespace Lib\Authentication;

use App\Models\User;

class Auth
{
    public static function login($user): void
    {
        $_SESSION['user']['id'] = $user->id;
    }

    public static function user(): ?User
    {
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            return User::findById($id);
        }

        return null;
    }

    public static function id(): ?int
    {
        return $_SESSION['user']['id'] ?? null;
    }


    public static function check(): bool
    {
        return isset($_SESSION['user']['id']) && self::user() !== null;
    }

    public static function logout(): void
    {
        unset($_SESSION['user']['id']);
    }
    public static function isAdmin(): bool
    {
        $user = self::user();
        return $user !== null && $user->getType() === 'admin';
    }

    public static function isBarber(): bool {
        $user = self::user();
        return $user !== null && $user->getType() === 'barber';
    }

    public  static function isClient(): bool {
        $user = self::user();
        return $user !== null && $user->getType() === 'client';
    }
}
