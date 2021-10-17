<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Volunteer;
use App\Mail\NewVolunteer;
use Illuminate\Support\Str;
use App\Mail\NewVolunteerMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'max:255'], //, 'numeric', 'digits_between:8,12'
            'school' => ['required', 'string', 'max:255'],
            'ice' => ['required', 'max:255'],
            'street' =>['required', 'string', 'max:255'],// max="255" required
            'house_number' =>['required', 'string', 'max:255'],
            'city' =>['required', 'string', 'max:255'],
            'tshirt_size' => ['required'],
            'birth' => ['required', 'date'],
            'gender' => ['required'],
            'agreement' => ['required', 'mimes:pdf', 'max:7168'], //, 'mimetypes:application/pdf'  'file',
            'profile' => ['required'],
            'terms' => ['required'],
            'g-recaptcha-response' => ['recaptcha'],
        ]);
    }

    protected function create(array $data)
    {
        //dd($data);
        $image_64 = $data['profile'];
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);

        $imageName = Str::random(100).time().'.'.$extension;
        Storage::disk('profiles')->put($imageName, base64_decode($image));

        $agreementName = Str::random(100).time();
        $agreement = Storage::disk('agreements')->put($agreementName, $data['agreement']);

        $user = User::create([
            'name' => $data['firstname'].$data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'volunteer',
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'gender' => $data['gender'],
            'telephone' => $data['telephone'],
            'photo_src' => '/profiles/'.$imageName,
            'agreement_src' => '/agreements/'.$agreement,
            'condition' => 0,
            'marketing_agreement' => 0,
        ]);

        $volunteer = Volunteer::create([
            'user_id' => $user->id,
            'points' => 0,
            'birth' => $data['birth'],
            'school' => $data['school'],
            'tshirt_size' => $data['tshirt_size'],
            'street' => $data['street'],
            'house_number' => $data['house_number'],
            'city' => $data['city'],
            'ice' => 123456789,
            'description' => 'Brak opisu',
        ]);

        $username = "wolontariusz".$volunteer->id;
        User::where('id', $user->id)->update(['name' => $username]);

        $datam = array(
            'name' => $username,
        );

        Mail::to('denis@mosir.rybnik.pl')->send(new NewVolunteer($datam));

        return $user;
    }
}
