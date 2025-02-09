<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use Lib\Authentication\Auth;

class ClientController extends Controller
{
    public function index():void{
        $this->render('client/index');
    }
    public function indexCreateSchedule():void{

        $barbers = User::where(['type' => 'barber']);
        
        $services = Service::all();

        $this->render('client/createSchedule', compact(['barbers','services'], ['barbers','services']));
    }

    public function mySchedules():void{
        $this->render('client/mySchedules');
    }
    
    public function createSchedule():void{
        $authUser = Auth::user()->id;
    }
}
