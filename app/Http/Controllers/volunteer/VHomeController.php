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
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

    public function change_photo(Request $request)
    {
        $validated = $request->validate(['profile' => 'required']);

        $image_64 = $request->profile;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);

        Storage::disk('profiles')->delete(substr(Auth::user()->photo_src, 10));

        $imageName = Str::random(100).time().'.'.$extension;
        Storage::disk('profiles')->put($imageName, base64_decode($image));

        $user = User::where('id', Auth::id())->first();
        $user->photo_src = '/profiles/'.$imageName;
        $user->save();

        return redirect(route('v.profile'))->with(['change_profile' => true]);
    }

    public function save_profile(Request $request)
    {
        $validated = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telephone' => ['required', 'max:255'],
            'school' => ['required', 'string', 'max:255'],
            'ice' => ['required', 'max:255'],
            'street' =>['required', 'string', 'max:255'],
            'house_number' =>['required', 'string', 'max:255'],
            'city' =>['required', 'string', 'max:255'],
            'tshirt_size' => ['required'],
        ]);

        $count = User::where([['id', '!=', Auth::id()], ['email', $request->email]])->get()->count();
        if ($count == 0)
        {
            $user = User::where('id', Auth::id())->first();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->telephone = $request->telephone;
            $user->save();

            $volunteer = Volunteer::where('user_id', Auth::id())->first();
            $volunteer->school = $request->school;
            $volunteer->ice = $request->ice;
            $volunteer->street = $request->street;
            $volunteer->house_number = $request->house_number;
            $volunteer->city = $request->city;
            $volunteer->tshirt_size = $volunteer->tshirt_size;
            $volunteer->save();

            return redirect(route('v.profile'))->with(['change' => true]);
        } else {
            return redirect(route('v.profile'))->withErrors(['email' => __('validation.unique', ['attribute' => 'email'])]);
        }
    }

    public function settings()
    {
        return view('volunteer.settings');
    }

    public function save_settings(Request $request)
    {

        if ($request->old_password != null && $request->password != null)
        {
            $validated = $request->validate([
                'old_password' => ['nullable', 'required_with:password'],
                'password' => ['string', 'min:8', 'confirmed', 'required_with:old_password', 'different:old_password'],
            ]);

            $user = User::where('id', Auth::id())->first();
            if (Hash::check($request->old_password, Auth::user()->password)) {
                $user->fill(['password' => Hash::make($request->password)])->save();
                return redirect(route('v.settings'))->with(['change' => true]);
            } else {
                return redirect(route('v.settings'))->with(['password_err' => true]);
            }
        } else {
            return redirect(route('v.settings'))->with(['password_err' => true]);
        }

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
}
