<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Calendar;
use App\Models\Signed_form;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); //<button type="button" class="btn btn-primary mt-4 w-100 g-recaptcha"  data-sitekey="{{ env('RECAPTCHA_PUBLIC_KEY') }}"  data-callback='onSubmit' data-action='submit'>Utwórz konto</button>
        //return view('oldhome');
    }

    public function regulations()
    {
        return view('regulations');
    }
    public function codex()
    {
        return view('codex');
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

    public function volunteer($volunteer)
    {

        $code = [
            substr($volunteer, 0, 1), //firstname
            substr($volunteer, 1, 1), //lastname
            substr($volunteer, 2, 4), //created_at
            substr($volunteer, 6, 1), //gender
            substr($volunteer, 7, 4), //agreement_src
            substr($volunteer, 11), //ID
        ];

        $volunteer = User::where('id', $code[5])->first();

        if ($volunteer != null)
        {
            $ok = true;
            if ($code[0] != substr($volunteer->firstname, 0, 1)) $ok = false;
            if ($code[1] != substr($volunteer->lastname, 0, 1)) $ok = false;
            if ($code[2] != date('dm', strtotime($volunteer->created_at))) $ok = false;
            if ($code[3] != $volunteer->gender) $ok = false;
            if ($code[4] != date('dm', strtotime($volunteer->agreement_date))) $ok = false;
            if ($ok == true)
            {
                $signed = Signed_form::where('volunteer_id', $code[5])->pluck('form_id');
                $events = Calendar::where('start', '>=', date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')."- 1 day")))->whereIn('form_id', $signed)->get();
                return view('id')->with(['volunteer' => $volunteer, 'events' => $events]);
            } else {
                return view('id')->with(['notexist' => true]);
            }
        } else {
            return view('id')->with(['notexist' => true]);
        }
    }

    public function testregistration()
    {
        return view('auth.test');
    }
}
