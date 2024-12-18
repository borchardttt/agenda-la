<?php

namespace App\Controllers;

use App\Enums\RolesEnum;
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
    $params = $request->getBody();
    $user = new User($params);

    if ($user->isValid()) {
      if ($user->save()) {
        echo json_encode(['success' => 'Criado com sucesso']);
      } else {
        echo json_encode(['error' => 'Erro ao salvar user']);
      }
    } else {
      echo json_encode(['error' => 'Erro ao criar user']);
    }
  }

  public function login(Request $request): void
  {
    $params = $request->getBody();
    $user = User::findById($params['id']);

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
      'admin' => '/admin/dashboard',
      'barber' => '/student/home',
      'client' => '/teacher/portal',
      default => '/login'
    };
  }


  public function destroySession(): void
  {
    Auth::logout();
    echo json_encode(['success' => 'Logout feito com sucesso']);
  }
}
