<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\AuthService;
use Core\Http\Request;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class AuthServiceTests extends TestCase
{
    private AuthService $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = new AuthService();
    }

    /**
     * @throws Exception
     */
    public function testAdminLoginSuccess(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getBody')->willReturn([
            'email' => 'adming@agendala.com',
            'password' => 'admin2024',
        ]);

        ob_start();
        $this->authService->login($request);
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['success' => 'Logado com sucesso', 'redirect' => '/admin']),
            $output
        );
    }

    /**
     * @throws Exception
     */
    public function testAdminLoginFail(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getBody')->willReturn([
            'email' => 'adming@agendala.com',
            'password' => 'senhaqualquer',
        ]);

        ob_start();
        $this->authService->login($request);
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['error' => 'Usuário ou Senha incorretos']),
            $output
        );
    }

    /**
     * @throws Exception
     */
    public function testBarberLoginSuccess(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getBody')->willReturn([
            'email' => 'joao@agendala.com',
            'password' => 'barbeiroJoao',
        ]);

        ob_start();
        $this->authService->login($request);
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['success' => 'Logado com sucesso', 'redirect' => '/barber/dashboard']),
            $output
        );
    }

    /**
     * @throws Exception
     */
    public function testLogout(): void
    {
        $_SESSION['user'] = ['id' => 1];

        ob_start();
        $this->authService->destroySession();
        $output = ob_get_clean();

        $this->assertArrayNotHasKey('id', $_SESSION['user']);

        $this->assertJsonStringEqualsJsonString(
            json_encode(['success' => 'Logout feito com sucesso']),
            $output
        );
    }
}
