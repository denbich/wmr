<?php

namespace App\Http\Controllers\coordinator;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
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
        $d = 0;
        $volunteers = Volunteer::with('user')->whereHas('user', function ($query){
            $query->where('condition', '0');})->get();
        //dd($volunteers);
        return view('coordinator.volunteers.active', ['volunteers' => $volunteers]);
    }

    public function activation(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user_data = $user;
        User::where('id', $request->id)->update(['condition' => '1']);

        $volunteers = Volunteer::with('user')->whereHas('user', function ($query){
            $query->where('condition', '0');})->get();
        return view('coordinator.volunteers.active', ['volunteers' => $volunteers, 'activation' => $user_data]);
    }

    public function dactivation(Request $request)
    {
        dd($request);
    }

    public function birthday()
    {
        $volunteers = Volunteer::with('user')->get();
        return response(view('coordinator.volunteers.birthday'));
    }
}
