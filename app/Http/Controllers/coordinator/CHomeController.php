<?php

namespace App\Http\Controllers\coordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CHomeController extends Controller
{
    public function dashboard()
    {
        $count = [
            'volunteers' => '35',
            'volunteers_p' => '3,5%',
            'volunteers_active' => '3',
            'prizes' => '10',
            'prizes_p' => '0%',
        ];
        return view('coordinator.dashboard', ['count' => $count]);
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
}
