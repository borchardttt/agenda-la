<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class Authenticate implements Middleware
{
    public function handle(Request $request): void
    {
        if (!Auth::check()) {
            $_SESSION['alert'] = ['type' => 'warning', 'message' => 'Você deve estar autenticado para acessar essa página página!'];
            $this->redirectTo(route('users.login'));
        }
    }

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}
