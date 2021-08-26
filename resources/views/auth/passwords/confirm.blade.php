@extends('layouts.app')

@section('title')
{{ __('Confirm password') }}
@endsection

@section('style')
    <style>
      .zdjecie-login{
      background: url("https://panel.wolontariat.rybnik.pl/assets/img/logo-wmr2.svg");
      background-position: center;
      background-repeat:no-repeat;
      background-size: contain;
      }

    </style>
@endsection

@section('body')
class="bg-gradient-primary"
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block zdjecie-login"></div>
                        <div class="col-lg-6">
                            <div class="p-4">
                                <div class="text-center">
                                    <img src="https://panel.wolontariat.rybnik.pl/assets/img/mosir-logo1.svg" class="text-center">
                                  <h1 class="h4 text-gray-900 mb-3 mt-3">{{ __('Reset password') }}</h1>
                                </div>
                                <div class="my-4">
                                    {{ __('Please confirm your password before continuing.') }}
                                </div>
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf
                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                        <div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('Confirm Password') }}</button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


