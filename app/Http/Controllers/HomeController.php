<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
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

    public function new_agreement()
    {
        return view('auth.agreement');
    }

    public function update_agreement(Request $request)
    {

        $validated = $request->validate(['agreement' => 'required|mimes:pdf|max:7168']);
        $remove = Storage::disk('agreements')->DeleteDirectory(substr(Auth::user()->agreement_src, 12, -45));
        if ($remove == true)
        {
            $agreementName = Str::random(100).time();
            $agreement = Storage::disk('agreements')->put($agreementName, $request->agreement);

            $volunteer = User::find(Auth::id())->update([
                'agreement_src' => '/agreements/'.$agreement,
                'agreement_date' => date('Y-m-d', strtotime(date('Y-m-d')." - 1 day")),
                'condition' => 0
            ]);

            Auth::logout();
            return redirect(route('login'))->with(['agreement' => true]);
        } else {
            return redirect(route('new.agreement'))->with(['agreement_err' => true]);
        }


    }
}
