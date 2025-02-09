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
      unset($params['__stripe_mid']);
      unset($params['_ga']);
      unset($params['g_state']);
      unset($params['_ga_3M6N5587SG']);
      unset($params['_pk_id_1_1fff']);
      unset($params['PHPSESSID']);
      unset($params['portainer_api_key']);
      unset($params['_gorilla_csrf']);
      unset($params['phpMyAdmin']);
      unset($params['pma_lang']);
      $user = new User($params);

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
