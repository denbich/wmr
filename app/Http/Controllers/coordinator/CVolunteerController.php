<?php

namespace App\Http\Controllers\coordinator;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;

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
}
