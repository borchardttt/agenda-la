<?php

namespace App\Controllers;

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
        $this->render('auth/login');
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
