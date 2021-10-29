@extends('layouts.app')

@section('title')
{{ __('Zaloguj się') }}
@endsection

@section('body')
class="bg-default"
@endsection

@section('content')

  <div class="main-content">
    <div class="header bg-gradient-primary py-5 py-lg-6 pt-lg-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">

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
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class=""> <!-- row justify-content-center col-lg-5 col-md-7 -->
          <div class="card bg-secondary border-0 mb-0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="zdjecie-login w-100 h-100" style="margin-left:20px;"></div>
                </div>
                <div class="col-lg-6">
                    <div class="card-header bg-transparent text-center">
                        <a href="{{ route('home') }}"><img src="{{ url('/img/mosir-logo1.svg') }}" class="text-center"></a>
                        <div class="mt-2 h1">Zaloguj się do ISOW!</div>
                      </div>
                      <div class="card-body pt-lg-3 pb-lg-4 px-lg-5">
                          @if (session('agreement'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"><strong>Sukces!</strong> Zgoda została wysłana pomyślnie! Oczekuj maila z widadomością o aktywacji.</span>
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
                                <strong>Twoje konto nie jest aktywne! Oczekuj maila o aktywacji lub spróbuj później.</strong>
                            </span>
                            @endif
                          </div>
                          <div class="custom-control custom-control-alternative custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">
                              <span class="text-muted">Zapamiętaj mnie</span>
                            </label>
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3 mb-1 w-100">Zaloguj się</button>
                          </div>
                        </form>

                        <table class="w-100 d-none">
                            <tbody><tr>
                              <td><hr></td>
                              <td style="width:1px; padding: 0 10px; white-space: nowrap;">LUB</td>
                              <td><hr></td>
                            </tr>
                          </tbody></table>
                          <div class="btn-wrapper text-center pb-3 d-none">
                            <button href="#" class="btn btn-neutral btn-icon"><!--  disabled -->
                              <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                              <span class="btn-inner--text">Zaloguj się za pomocą Google</span>
                            </button>
                          </div>
                          <hr class="my-2">
                          <div class="text-center py-2 d-none">
                            <h2><strong>Wybierz język</strong></h2>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="shortcut-media avatar rounded-circle">
                                        <a href="/language/pl"><img src="{{ URL::asset('lang/165-poland.svg') }}"></a>
                                    </span>

                                </div>
                                <div class="col">
                                    <span class="shortcut-media avatar rounded-circle">
                                        <a href="/language/en"><img src="{{ URL::asset('lang/110-united kingdom.svg') }}"></a>
                                    </span>
                                </div>
                                <div class="col">
                                    <span class="shortcut-media avatar rounded-circle">
                                        <a href="/language/de"><img src="{{ URL::asset('lang/208-germany.svg') }}"></a>
                                    </span>
                                </div>

                                <div class="col">
                                    <span class="shortcut-media avatar rounded-circle">
                                        <a href="/language/ua"><img src="{{ URL::asset('lang/198-ukraine.svg') }}"></a>
                                    </span>
                                </div>
                            </div>
                            <a class="text-danger" href="">Więcej języków...</a>
                        </div>

                          <div class="text-center text-sm mt-2">
                            <a href="{{ route('password.request') }}" class="mx-2">Zapomniałeś hasła?</a> |
                            <a href="{{ route('register') }}" class="mx-2">Utwórz nowe konto</a>
                          </div>
                      </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2019 - {{ date('Y') }} <a href="https://linktr.ee/denis.bichler" class="font-weight-bold ml-1" target="_blank">Denis Bichler for MOSiR Rybnik</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
                <a href="" class="nav-link" target="_blank">Regulamin wolontariatu</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link" target="_blank">Kodeks Wolontariuszy</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link" target="_blank">Polityka Prywatności</a>
              </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

@endsection



