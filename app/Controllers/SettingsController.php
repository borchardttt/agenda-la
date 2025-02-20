<?php

namespace App\Controllers;

use App\Services\Logotype;
use Core\Http\Controllers\Controller;

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
}
