<?php

namespace App\Http\Controllers\volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VHomeController extends Controller
{
    public function dashboard()
    {
        return view('volunteer.dashboard');
    }
}
