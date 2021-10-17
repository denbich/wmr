<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgreementCheck
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('id', Auth::user()->id)->first();
        switch($user->condition) {
            case 0:
                Auth::logout();
                return redirect(route('login'))->with(['user_check' => true]);
            break;
            case 1:
                if ($user->agreement_date < date('Y-m-d'))
                {
                    return redirect(route('new.agreement'));
                } else {
                    return $next($request);
                }
            break;
        }

    }
}
