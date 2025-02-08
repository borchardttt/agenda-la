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
}
