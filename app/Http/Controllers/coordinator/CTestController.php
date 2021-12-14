<?php

namespace App\Http\Controllers\coordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CTestController extends Controller
{
    public function pdf()
    {
        return view('coordinator.test');
    }

    public function analyse(Request $request)
    {
        dd($request->all());
    }
}
