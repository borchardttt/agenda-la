<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;

class NotFoundController extends Controller
{
    public function index():void {
        $this->render('404/404');
    }

}
