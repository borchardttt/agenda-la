<?php

namespace App\Controllers;

use App\Services\Logotype;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function index(): void
    {
        $settings = [
            'logoPath' => (new Logotype([]))
        ];
        $this->render('auth/login', compact('settings'));
    }

    public function adminIndex(): void
    {
        $this->render('admin/dashboard/index');
    }

    public function login(Request $request): void
    {
        $this->authService->login($request);
    }

    public function logout(): void
    {
        $this->authService->destroySession();
    }
}
