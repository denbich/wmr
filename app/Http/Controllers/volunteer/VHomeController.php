<?php

namespace App\Http\Controllers\volunteer;

use App\Models\Form;
use App\Models\Post;
use App\Models\User;
use App\Models\Prize;
use App\Models\Calendar;
use App\Models\Volunteer;
use App\Mail\NewVolunteer;
use App\Models\Signed_form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VHomeController extends Controller
{
    public function dashboard()
    {
        $forms = Form::with(['form_translate', 'formposition', 'signedform', 'calendar'])->orderBy('id', 'desc')->limit(5)->get();
        $volunteer = Volunteer::where('user_id', Auth::id())->first();
        $count = ['forms' => count(Form::all()),'prizes' => count(Prize::all())];
        $events = Calendar::where([['end', '<', date('Y-m-d H:i:s', strtotime(" + 14 days"))],['end', '>', date('Y-m-d H:i:s')]])->get();

        $forms_p = Signed_form::where('volunteer_id', Auth::user()->id)->pluck('form_id');
        $posts = Post::where('form_id', 0)->orWhereIn('form_id', $forms_p)->with(['post_translate', 'author'])->get();

        return view('volunteer.dashboard', ['forms' => $forms, 'volunteer' => $volunteer, 'count' => $count, 'posts' => $posts, 'events' => $events]);
    }

    public function profile()
    {
        $volunteer = Volunteer::where('user_id', Auth::id())->first();
        return view('volunteer.profile', ['volunteer' => $volunteer]);
    }

    public function settings()
    {
        return view('volunteer.settings');
    }

    public function calendar()
    {
        return view('volunteer.calendar');
    }

    public function maps()
    {
        return view('volunteer.maps');
    }

    public function info()
    {
        return view('volunteer.info');
    }

    public function id()
    {
        $signed = Signed_form::where('volunteer_id', Auth::id())->pluck('form_id');
        $events = Calendar::where('start', '>=', date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')."- 1 day")))->whereIn('form_id', $signed)->get();
        return view('volunteer.id', ['events' => $events]);
    }

    public function load_events()
    {
        $events = Calendar::all();
        return $events;
    }

    public function mailtest()
    {
        $datam = array(
            'name' => 'test',
        );

        //dd(User::where('role', 'volunteer')->pluck('email'));

        //$mail = Mail::to(['denis@mosir.rybnik.pl', 'denis.bichler9@gmail.com'])->send(new NewVolunteer($datam));
        $mail = Mail::bcc(User::where('role', 'volunteer')->pluck('email'))->send(new NewVolunteer($datam));

        dd($mail);
    }
}
