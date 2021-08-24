<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return redirect('/login');
    }

    public function loginauth()
    {
        switch (Auth::user()->role) {
            case "volunteer":
                return redirect(route('v.dashboard'));
            break;
            case "coordinator":
                return redirect(route('c.dashboard'));
            break;
            case "admin":
                return redirect(route('a.dashboard'));
            break;
        }
    }
}
