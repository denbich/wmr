<?php

namespace App\Http\Controllers\volunteer;

use App\Models\Form;
use App\Models\Prize;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VHomeController extends Controller
{
    public function dashboard()
    {
        $forms = Form::with(['form_translate', 'formposition', 'signedform'])->orderBy('id', 'desc')->limit(5)->get();
        $volunteer = Volunteer::where('user_id', Auth::id())->first();
        $count = [
            'forms' => count(Form::all()),
            'prizes' => count(Prize::all()),
        ];
        return view('volunteer.dashboard', ['forms' => $forms, 'volunteer' => $volunteer, 'count' => $count]);
    }

    public function profile()
    {
        $volunteer = Volunteer::where('user_id', Auth::id())->first();
        return view('volunteer.profile', ['volunteer' => $volunteer]);
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
