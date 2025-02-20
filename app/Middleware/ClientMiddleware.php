<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class ClientMiddleware implements Middleware
{

    public function handle(Request $request): void
    {
        if (!Auth::check() || !Auth::isClient()) {
            $_SESSION['alert'] = ['type' => 'warning', 'message' => 'Você deve ser um cliente para acessar essa página!'];
            $this->redirectTo(route('indexLogin'));
        }
    }
    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}