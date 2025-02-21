<?php

namespace App\Controllers;

use App\Models\BarberService;
use App\Models\Service;
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

  public function createClient(Request $data)
  {
      $params = $data->getBody();

      $user = new User();

      $user->name = $params['name'];
      $user->email = $params['email'];
      $user->type = $params['type'];
      $user->password = $params['password'];

      if($user->save()){
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Sua conta foi criada com sucesso, acessa com suas credenciais!'];
        $this->render('auth/login');
        header("Location: /login");
      } else {
        return json_encode(['error' => 'Erro ao criar user, usuário já existe']);
      };
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

    public function addServiceToBarber(Request $request): void
    {
        $barberId = Auth::id();

        $validatedParams = $request->validate([
            'service_ids',
        ]);
        if (empty($validatedParams['service_ids'])) {
            $_SESSION['alert'] = ['type' => 'error', 'message' => 'Selecione um serviço!'];
            $this->redirectTo('/barber/schedule');
            return;
        }

        $barber = User::findById($barberId);

        if (!$barber || $barber->getType() !== 'barber') {
            $_SESSION['alert'] = ['type' => 'error', 'message' => 'Barbeiro não encontrado!'];
            $this->redirectTo('/barber/schedule');
            return;
        }

        foreach ($validatedParams['service_ids'] as $serviceId) {
            if ($barber->services()->exists($serviceId)) {
                $_SESSION['alert'] = ['type' => 'error', 'message' => "O serviço com ID $serviceId já está associado a este barbeiro."];
                $this->redirectTo('/barber/schedule');
                return;
            }
            $barber->services()->attach($serviceId);
        }

        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Serviço(s) adicionado(s) com sucesso!'];
        $this->redirectTo('/barber/schedule');
    }

    public function removeServiceFromBarber(Request $request): void {
      $validatedRequest = $request->validate([
          'id'
      ]);
      $barberService = BarberService::findById($validatedRequest['id']);
      if($barberService->destroy()) {
          $_SESSION['alert'] = ['type' => 'success', 'message' => 'Serviço deletado com sucesso!'];

          $this->redirectTo('/barber/schedule');
      } else {
          $_SESSION['alert'] = ['type' => 'error', 'message' => 'Erro ao deletar serviço!'];
          $this->redirectTo('/barber/schedule');
      }
    }




  public function schedulingBarbers() : void {
    $this->render('barber/barber-my-scheduling');
  }
}
