@extends('layouts.app')

@section('title')
{{ __('index.login.title') }}
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
                                  <h1 class="h4 text-gray-900 mb-3 mt-3">{{ __('index.login.login') }}</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('login') }}">

                                    @csrf

                                    <div class="form-group">
                                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('index.login.type-login') }}" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                            <input id="password" type="password"  class="form-control form-control-user @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password" placeholder="{{ __('index.login.type-password') }}">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('index.login.rememberme') }}
                                                </label>
                                            </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('index.login.login') }}</button>
                                    <div class="form-group">
                                        <table class="mt-2 w-100">
                                        <tr>
                                            <td><hr></td>
                                            <td style="width:1px; padding: 0 10px; white-space: nowrap;">{{ __('index.login.or') }}</td>
                                            <td><hr></td>
                                        </tr>
                                    </table>
                                    <a href="" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i>
                                        {{ __('index.login.google.button') }}</a>
                                    <p class="text-center pt-1" style="font-size:12px;">{{ __('index.login.google.text') }}</p>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    @if (Route::has('password.request'))
                                    <a class="small" href="{{ route('password.request') }}">{{ __('index.login.rememberpwd') }}</a>
                                    @endif
                                     |
                                    <a class="small" href="{{ route('register') }}">{{ __('index.login.createaccount') }}</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" target="_blank" href="https://wolontariat.rybnik.pl/pliki/kodeks_wolontariuszy_MOSiR_Rybnik.pdf">{{ __('index.login.regulations') }}</a> |
                                    <a class="small" target="_blank" href="https://wolontariat.rybnik.pl/pliki/kodeks_wolontariuszy_MOSiR_Rybnik.pdf">{{ __('index.login.terms') }}</a> |
                                    <a class="small" target="_blank" href="https://wolontariat.rybnik.pl/pliki/polityka_prywatnosci.pdf">{{ __('index.login.privacypolicy') }}</a>
                                </div>
                                <div class="text-center pt-1">
                                    <h6>{{ __('index.login.pick-lang') }}</h6>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <a href="/language/pl"><img src="{{ URL::asset('lang/165-poland.svg') }}" alt="" class="w-50"></a>
                                        </div>
                                        <div class="col">
                                            <a href="/language/en"><img src="{{ URL::asset('lang/110-united kingdom.svg') }}" alt="" class="w-50"></a>
                                        </div>
                                        <!--<div class="col">
                                            <a href="/language/ua"><img src="{{ URL::asset('lang/198-ukraine.svg') }}" alt="" class="w-50"></a>
                                        </div>-->
                                    </div>
                                    <!--<a href="">{{ __('index.login.more-lang') }}...</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


