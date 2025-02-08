<?php

namespace App\Services;

use App\Models\User;
use Core\Http\Request;
use Lib\Authentication\Auth;

class AuthService
{
    public function login(Request $request): void
    {
        $params = $request->getBody();
        $user = User::findBy(['email' => $params['email']]);

        if ($user && $user->authenticate($params['password'])) {
            Auth::login($user);

            $userType = $user->getType();
            $route = $this->getRouteByUserType($userType);

            echo json_encode([
                'success' => 'Logado com sucesso',
                'redirect' => $route
            ]);
        } else {
            echo json_encode(['error' => 'Usuário ou Senha incorretos']);
        }
    }

    /**
     * Retorna a rota com base no tipo de usuário.
     *
     * @param string $userType
     * @return string
     */
    private function getRouteByUserType(string $userType): string
    {
        return match ($userType) {
            'admin' => '/admin',
            'barber' => '/barber/dashboard',
            'client' => '/client/dashboard',
            default => '/login'
        };
    }

    public function destroySession(): void
    {
        Auth::logout();
        echo json_encode(['success' => 'Logout feito com sucesso']);
    }
}