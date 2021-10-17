<?php

namespace App\Http\Controllers\coordinator;

use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use App\Mail\VolunteerActivation;
use App\Mail\VolunteerDeactivation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class CVolunteerController extends Controller
{
    public function list()
    {
        //$volunteers = User::where('role', 'volunteer')->with('volunteer')->get();
        $volunteers = Volunteer::with('user')->get();
        return view('coordinator.volunteers.list', ['volunteers' => $volunteers]);
    }

    public function volunteer($id)
    {
        $volunteer = Volunteer::where('id', $id)->with('user')->first();
        return view('coordinator.volunteers.volunteer', ['volunteer' => $volunteer]);
    }

    public function search()
    {
        if (isset($_GET['q']))
        {
            $q = $_GET['q'];
            $volunteers = Volunteer::with('user')->whereHas('user', function ($query) use ($q){
                $query->where('name', 'like', '%'.$q.'%')->orwhere('firstname', 'like', '%'.$q.'%')->orwhere('lastname', 'like', '%'.$q.'%')->orwhere('email', 'like', '%'.$q.'%');})->orWhere('telephone', 'like', '%'.$q.'%')->orWhere('school', 'like', '%'.$q.'%')->get();
                return view('coordinator.volunteers.search', ['volunteers' => $volunteers]);
        } else {
            return view('coordinator.volunteers.search');
        }


    }

    public function active()
    {
        $volunteers = Volunteer::with('user')->whereHas('user', function ($query){
            $query->where('condition', '0');})->get();

        return view('coordinator.volunteers.active', ['volunteers' => $volunteers]);
    }

    public function activation(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|after:'.date('Y-m-d'),
        ]);
        $user = User::where('id', $request->id)->first();
        $user->update(['condition' => '1', 'agreement_date' => $request->date]);
        $datam = array('name' => $user->name);

        Mail::to($user->email)->send(new VolunteerActivation($datam));

        return redirect(route('c.v.active'))->with(['activation' => true]);
    }

    public function dactivation(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->update([
            'agreement_date' => date('Y-m-d', strtotime(date('Y-m-d')." - 1 day")),
            'condition' => 1,
        ]);

        $datam = array(
            'name' => $user->name,
            'reason' => 'Zła zgoda'
    );
        Mail::to($user->email)->send(new VolunteerDeactivation($datam));
        return redirect(route('c.v.active'))->with(['deactivation' => true]);
    }

    public function birthday()
    {
        $volunteers = Volunteer::with('user')->get();
        return response(view('coordinator.volunteers.birthday'));
    }

    public function agreement($volunteer)
    {
        $code = [
            substr($volunteer, 0, 1), //firstname
            substr($volunteer, 1, 1), //lastname
            substr($volunteer, 2, 4), //created_at
            substr($volunteer, 6, 1), //gender
            substr($volunteer, 7, 4), //agreement_src
            substr($volunteer, 11), //ID

        ];

        $volunteer_agreement = User::where('id', $code[5])->first();
        $ok = true;

        if ($code[0] != substr($volunteer_agreement->firstname, 0, 1)) $ok = false;
        if ($code[1] != substr($volunteer_agreement->lastname, 0, 1)) $ok = false;
        if ($code[2] != date('dm', strtotime($volunteer_agreement->created_at))) $ok = false;
        if ($code[3] != $volunteer_agreement->gender) $ok = false;
        if ($code[4] != date('dm', strtotime($volunteer_agreement->agreement_date))) $ok = false;

        if ($ok == true)
        {
            return response()->file(substr($volunteer_agreement->agreement_src, 1));
        } else {
            return redirect(route('c.v.active'));
        }
    }
}
