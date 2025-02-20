<?php

namespace App\Controllers;

use App\Services\Logotype;
use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class SettingsController extends Controller
{
    public function index(): void
    {
        $settings = [
            'logoPath' => (new Logotype([]))->path()
        ];
        $this->render('admin/settings/settings', compact('settings'));
    }

    public function updateLogo(): void
    {
        if (!isset($_FILES['logo']) || $_FILES['logo']['error'] !== UPLOAD_ERR_OK) {
            $this->redirectTo('/admin/settings');
            return;
        }

        $logotype = new Logotype($_FILES['logo']);
        $logotype->update();

        $this->redirectTo('/admin/settings');
    }

    public function deleteLogo(): void
    {
        $logotype = new Logotype([]);
        $logotype->update();

        $this->redirectTo('/admin/settings');
    }
    public function navbar() : array
    {
        $user = Auth::user();

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
                        ['href' => '/barber/dashboard', 'label' => 'Painel de Barbeiro'],
                        ['href' => '/barber/my-schedulling', 'label' => 'Meus Serviços Agendados'],
                        ['href' => '/barber/schedule', 'label' => 'Gerenciamento de Barbeiro'],
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
