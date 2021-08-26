<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            //'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'numeric', 'digits_between:8,12'],
            'tshirt_size' => ['required'],
            'address' =>['required', 'string', 'max:255'],
            'school' => ['required', 'string', 'max:255'],
            'birth' => ['required', 'date'],
            'gender' => ['required'],
            'profile' => ['required'],
            'terms' => ['required'],
        ]);
    }

    protected function create(array $data)
    {
        $image_64 = $data['profile'];
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(100).time().'.'.$extension;
        Storage::disk('profiles')->put($imageName, base64_decode($image));

        $agreementName = Str::random(100).time();
        Storage::putFileAs('agreements', $data['agreement'], $agreementName.'.pdf');
        //Storage::disk('profiles')->;
        return User::create([
            'name' => $data['firstname'].$data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'volunteer',
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'gender' => $data['gender'],
            'photo_src' => '/profiles/'.$imageName,
            'agreement_src' => '/agreements/'.$agreementName.'.pdf',
        ]);
    }
}
