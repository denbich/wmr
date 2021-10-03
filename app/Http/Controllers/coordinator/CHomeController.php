<?php

namespace App\Http\Controllers\coordinator;

use App\Models\Prize;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Form;

class CHomeController extends Controller
{
    public function dashboard()
    {
        $count = [
            'volunteers' => count(Volunteer::all()),
            'volunteers_p' => '3,5%',
            'volunteers_active' => '3',
            'prizes' => count(Prize::all()),
            'prizes_p' => '0%',
        ];

        $forms = Form::with(['form_translate', 'formposition', 'signedform'])->orderBy('id', 'desc')->limit(5)->get();
        return view('coordinator.dashboard', ['count' => $count, 'forms' => $forms]);
    }

    public function profile()
    {
        return view('coordinator.profile');
    }

    public function settings()
    {
        return view('coordinator.settings');
    }

    public function calendar()
    {
        return view('coordinator.calendar');
    }

    public function maps()
    {
        return view('coordinator.maps');
    }

    public function info()
    {
        return view('coordinator.info');
    }

    public function load_events()
    {
        $events = Calendar::all();
        return $events;
    }
}
