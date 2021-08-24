<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
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
        $imageName = "a";
        Storage::disk('public')->put($imageName, base64_decode($data['profile']));
        return User::create([
            'name' => $data['firstname'].$data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'volunteer',
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'gender' => $data['gender'],
            'photo_src' => 'src',
        ]);
    }
}
