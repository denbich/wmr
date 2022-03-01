@extends('layouts.app')

@section('title')
{{ __('main.login') }}
@endsection

@section('body')
class="bg-default"
@endsection

@section('content')

<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container text-primary">
        <div class="navbar-brand">
            <a class="" href="{{ route('home') }}">
                <img class="h-25" style="max-height: 110px" src="{{ url('/img/logowmrwhite.svg') }}">
              </a>
              <a class="" href="https://pomagamukrainie.gov.pl/" target="_blank" rel="noopener noreferrer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/49/Flag_of_Ukraine.svg" alt="">
              </a>
        </div>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-8 collapse-brand text-center mx-auto">
              <a href="{{ route('home') }}">
                <img class="h-100" style="max-height: 110px; min-height:100px;" src="{{ url('/img/logowmr1.svg') }}" alt="wmr logo">

              </a>
              <a href="https://pomagamukrainie.gov.pl/" class="w-100 text-center mx-auto" target="_blank" rel="noopener noreferrer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/49/Flag_of_Ukraine.svg" class="text-center mx-auto my-2" alt="Ukraine flag">
            </a>
            </div>
            <div class="col-4 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link text-center">
                <span class="nav-link-inner--text">{{ __('home.title') }}</span>
              </a>
            </li>
            <li class="nav-item">
                <li class="nav-item text-center">
                    <div class="dropdown">
                      <a class="nav-link dropdown-toggle text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('home.socialmedia.title')}}</a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item d-none" href=""><i class="fas fa-info-circle"></i> O nas</a>
                        <a class="dropdown-item" href="https://facebook.com/wolontariat.rybnik" target="_blank"><i class="fab fa-facebook-square"></i> {{ __('home.socialmedia.facebook') }}</a>
                        <a class="dropdown-item" href="https://instagram.com/wolontariat.rybnik" target="_blank"><i class="fab fa-instagram"></i> {{ __('home.socialmedia.instagram') }}</a>
                      </div>
                    </div>
                  </li>
            </li>
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link text-center font-weight-900">
                    <span class="nav-link-inner--text">{{ __('main.login') }}</span>
                </a>
            </li>

          </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          @include('include.lang')

          <li class="nav-item d-lg-block ml-lg-4 text-center">
            <a href="{{ route('register') }}" class="btn btn-info btn-icon text-center text-dark">
              <span class="btn-inner--icon">
                <i class="fas fa-handshake mr-2"></i>
              </span>
              <span class="nav-link-inner--text">{{ __('main.signin') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="main-content">
    <div class="header bg-gradient-primary py-8 py-lg-8 pt-lg-9">
        <div class="container">
          <div class="header-body text-center mb-6">
            <div class="row justify-content-center">
              <div class="col-xl-8 col-lg-8 col-md-8 px-5">
                <h1 class="display-1 text-white mt-3 font-weight-700">{{ Str::upper(__('index.login.title')) }}</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
          </div>
      </div>

    <div class="container mt--8 pb-5">
      <div class="row justify-content-center "> <!-- row justify-content-center col-lg-5 col-md-7 -->
          <div class="card bg-secondary border-0 mb-0 col-lg-5 col-md-7">
            <div class="">
                  <div class="">
                    <div class="card-header bg-transparent text-center">
                        <a href="{{ route('home') }}"><img src="{{ url('/img/mosir-logo1.svg') }}" class="text-center"></a>
                      </div>
                      <div class="card-body pt-lg-3 pb-lg-4 px-lg-5">
                          @if (session('agreement'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"><strong>{{ __('index.login.alerts.success') }}!</strong> {{ __('index.login.alerts.agreement') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                          @endif
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                          <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                              </div>
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('index.login.type-login') }}" autofocus>
                            </div>
                          </div>
                          <div class="mt-2 mb-3">
                            @error('email')
                                <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                              </div>
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password" placeholder="{{ __('index.login.type-password') }}">
                            </div>
                          </div>
                          <div class="form-group">
                            @error('password')
                                <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if (session('user_check') == true)
                            <span class="text-danger small" role="alert">
                                <strong>{{ __('index.login.alerts.active') }}</strong>
                            </span>
                            @endif
                          </div>
                          <div class="custom-control custom-control-alternative custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">
                              <span class="text-muted">{{ __('index.login.rememberme') }}</span>
                            </label>
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-info text-dark mt-3 mb-1 w-100">{{ __('main.login') }}</button>
                          </div>
                        </form>

                        <table class="w-100 d-none">
                            <tbody><tr>
                              <td><hr></td>
                              <td style="width:1px; padding: 0 10px; white-space: nowrap;">{{ __('index.login.or') }}</td>
                              <td><hr></td>
                            </tr>
                          </tbody></table>
                          <div class="btn-wrapper text-center pb-3 d-none">
                            <button href="#" class="btn btn-neutral btn-icon"><!--  disabled -->
                              <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                              <span class="btn-inner--text">{{ __('index.login.google.button') }}</span>
                            </button>
                          </div>
                          <hr class="my-2">
                          <div class="text-center py-2">
                            <h2><strong>{{ __('main.lang') }}</strong></h2>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="shortcut-media avatar rounded-circle">
                                        <a href="{{ route('language', ['pl']) }}"><img src="{{ URL::asset('lang/165-poland.svg') }}"></a>
                                    </span>

                                </div>
                                <div class="col">
                                    <span class="shortcut-media avatar rounded-circle">
                                        <a href="{{ route('language', ['en']) }}"><img src="{{ URL::asset('lang/110-united kingdom.svg') }}"></a>
                                    </span>
                                </div>
                                <div class="col d-none">
                                    <span class="shortcut-media avatar rounded-circle">
                                        <a href="{{ route('language', ['uk']) }}"><img src="{{ URL::asset('lang/198-ukraine.svg') }}"></a>
                                    </span>
                                </div>
                            </div>
                            <a class="text-primary d-none" href="">{{ __('main.morelang') }}</a>
                        </div>

                          <div class="text-center text-sm mt-2">
                            <a href="{{ route('password.request') }}" class="mx-2">{{ __('index.footer.rememberpwd') }}</a> |
                            <a href="{{ route('register') }}" class="mx-2">{{ __('index.footer.createaccount') }}</a>
                          </div>
                      </div>
                </div>
          </div>
      </div>
    </div>
  </div>
  @include('auth.footer')

@endsection



