@extends('layouts.app')

@section('title')
{{ __('Reset password') }}
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
                                <form class="user mt-3" method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <div class="form-group">
                                        <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('Reset Password') }}</button>
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


