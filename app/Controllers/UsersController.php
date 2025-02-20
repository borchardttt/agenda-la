<?php

namespace App\Controllers;

use App\Models\User;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;

use function array_push;
use function json_encode;

class UsersController extends Controller
{
  public function register(Request $request): void
  {
      $validatedParams = $request->validate([
          'name',
          'email',
          'type',
          'password',
      ]);

      $user = new User($validatedParams);

    if ($user->isValid()) {
      if ($user->save()) {
        $this->render('admin/dashboard/index');
      } else {
        echo json_encode(['error' => 'Erro ao salvar user']);
      }
    } else {
      echo json_encode(['error' => 'Erro ao criar user']);
    }
  }

  public function indexCreateBarber(): void
  {
      $users = User::where(['type' => 'barber']);

      $this->render('admin/barbers/create', compact('users', 'users'));
  }
  public function indexBarbers(): void {
      $this->render('barber/barber-home');
  }

  public function getAuthenticatedUser(): ?User
  {
      return Auth::user();
  }

    public function navbar()
    {
        $user = $this->getAuthenticatedUser();

        $routes = [];

        if ($user) {
            switch ($user->type) {
                case 'client':
                    $routes = [
                        ['href' => '/', 'label' => 'Início'],
                        ['href' => '/client/createSchedule', 'label' => 'Criar Agendamentos'],
                        ['href' => '/client/mySchedules', 'label' => 'Meus Agendamentos'],
                    ];
                    break;
                case 'barber':
                    $routes = [
                        ['href' => '/admin', 'label' => 'Painel de Barbeiro'],
                        ['href' => '/barber/my-schedulling', 'label' => 'Meus Serviços Agendados'],
                        ['href' => '/barber/schedule', 'label' => 'Gerenciar Horários'],
                    ];
                    break;
                case 'admin':
                    $routes = [
                        ['href' => '/admin', 'label' => 'Painel Admin'],
                        ['href' => '/admin/services', 'label' => 'Serviços'],
                        ['href' => '/admin/create-barber', 'label' => 'Barbeiros'],
                    ];
                    break;
            }
            $routes[] = ['href' => '/logout', 'label' => 'Logout', 'isForm' => true];
        } else {
            $routes = [
                ['href' => '/', 'label' => 'Início'],
                ['href' => '/login', 'label' => 'Entrar'],
            ];
        }
        return $routes;

    }

}
