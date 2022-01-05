<?php

namespace App\Http\Controllers\coordinator;

use App\Models\Form;
use App\Models\User;
use App\Models\Prize;
use App\Models\Calendar;
use App\Models\Volunteer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Mail\CoordinatorMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CHomeController extends Controller
{
    public function dashboard()
    {
        $volunteers = Volunteer::with('user')->get();
        $count = [
            'volunteers' => Volunteer::all()->count(),
            'volunteers_p' => '3,5%',
            'volunteers_active' => User::where([['role', 'volunteer'], ['condition', 0]])->count(),
            'prizes' => count(Prize::all()),
            'prizes_p' => '0%',
        ];

        $months = [
            '1' => 'Styczeń',
            '2' => 'Luty',
            '3' => 'Marzec',
            '4' => 'Kwiecień',
            '5' => 'Maj',
            '6' => 'Czerwiec',
            '7' => 'Lipiec',
            '8' => 'Sierpień',
            '9' => 'Wrzesień',
            '10' => 'Październik',
            '11' => 'Listopad',
            '12' => 'Grudzień',
        ];

        $forms = Form::with(['form_translate', 'formposition', 'signedform', 'calendar'])->whereHas('calendar', function ($query) {
            return $query->where('end', '>=', date( 'Y-m-d H:i:s', strtotime(date( 'Y-m-d H:i:s') .' -7 day'))); })->orderBy('id', 'desc')->limit(5)->get();


        $stats = Volunteer::where('created_at', '>=', date( 'Y-m-d H:i:s', strtotime(date( 'Y-m-d H:i:s') .' -1 year')))->with('user')->get();

        return view('coordinator.dashboard', ['count' => $count, 'forms' => $forms, 'volunteers' => $volunteers, 'months' => $months, 'stats' => $stats]);
    }

    public function profile()
    {
        return view('coordinator.profile');
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

        return redirect(route('c.profile'))->with(['change_profile' => true]);
    }

    public function update_profile(Request $request)
    {
        $validate = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telephone' => ['required', 'max:255'],
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

            return redirect(route('c.profile'))->with(['change' => true]);
        } else {
            return redirect(route('c.profile'))->withErrors(['email' => __('validation.unique', ['attribute' => 'email'])]);
        }


    }

    public function settings()
    {
        return view('coordinator.settings');
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
                return redirect(route('c.settings'))->with(['change' => true]);
            } else {
                return redirect(route('c.settings'))->with(['password_err' => true]);
            }
        } else {
            return redirect(route('c.settings'))->with(['password_err' => true]);
        }

    }

    public function calendar()
    {
        return view('coordinator.calendar');
    }

    public function maps()
    {
        return view('coordinator.maps');
    }

    public function info()
    {
        return view('coordinator.info');
    }

    public function load_events()
    {
        $events = Calendar::all();
        return $events;
    }

    public function update_v()
    {
        return view('coordinator.updatev');
    }

    public function update_volunteer(Request $request)
    {
        $user = User::where('name', 'wolontariusz'.$request->id)->first();

        $imageName = Str::random(100).time().'.png';
        $profile = Storage::disk('profiles')->putFileAs('', $request->file('profile'), $imageName);

        if ($request->agreement != null)
        {
            $agreementName = Str::random(100).time();
            $agreement = Storage::disk('agreements')->put($agreementName, $request->agreement);
            $user->agreement_src = '/agreements/'.$agreement;
        }

        $user->photo_src = '/profiles/'.$imageName;
        $user->save();

        return redirect(route('c.update.v'))->with(['v' => true]);
    }

    public function mail()
    {
        return view('coordinator.sendmail');
    }

    public function send_mail(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $datam = array(
            'title' => $request->title,
            'content' => str_replace('"', "'", str_replace("\r\n", '', $request->content)),
        );

        Mail::bcc(User::where('role', 'volunteer')->pluck('email'))->send(new CoordinatorMessage($datam));

        return redirect()->route('c.mail')->with('succes', true);
    }
}
