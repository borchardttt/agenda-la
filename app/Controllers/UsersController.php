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
}
