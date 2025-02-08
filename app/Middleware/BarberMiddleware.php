<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class BarberMiddleware implements Middleware
{

    public function handle(Request $request): void
    {
        if (!Auth::check() || !Auth::isBarber()) {
            FlashMessage::danger('Você deve ser um administrador para acessar essa página');
            $this->redirectTo(route('indexLogin'));
        }
    }
    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}