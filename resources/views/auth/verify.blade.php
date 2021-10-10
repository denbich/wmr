@extends('layouts.app')

@section('title')
{{ __('index.login.title') }}
@endsection

@section('body')
class="bg-default"
@endsection

@section('content')

<!-- Navbar -->

  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
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
                <div class="col-lg-6 zdjecie-login"></div>
                <div class="col-lg-6">
                    <div class="card-header bg-transparent text-center">
                        <a href="http://wmr.local/login"><img src="https://panel.wolontariat.rybnik.pl/assets/img/mosir-logo1.svg" class="text-center"></a>
                        <div class="mt-2 h2">{{ __('Zanim przejdziesz dalej, sprawdź pocztę e-mail pod kątem linku weryfikacyjnego.') }}</div>
                      </div>
                      <div class="card-body pt-lg-3 pb-lg-4 px-lg-5">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Na Twój adres e-mail został wysłany nowy link weryfikacyjny.') }}
                        </div>
                        @endif
                        <form class="user mt-3" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('kliknij tutaj, jeśli nie dostałeś emaila') }}</button>
                        </form>
                        <form class="user mt-3" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('Wyloguj się') }}</button>
                        </form>
                          <hr class="my-2">
                          <div class="text-center py-2">
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
                                <div class="col d-none">
                                    <a href="/language/de"><img src="{{ URL::asset('lang/208-germany.svg') }}" alt="" class="w-75"></a>
                                </div>
                                <div class="col d-none">
                                    <a href="/language/ua"><img src="{{ URL::asset('lang/198-ukraine.svg') }}" alt="" class="w-75"></a>
                                </div>
                            </div>
                            <a class="text-danger d-none" href="">Więcej języków...</a>
                        </div>
                      </div>
                </div>
            </div>


          </div>
          <div class="row mt-3">
            <div class="col-6">

            </div>
            <div class="col-6 text-right">

            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2019 - {{ date('Y') }} <a href="https://facebook.com/denis.bichler" class="font-weight-bold ml-1" target="_blank">Denis Bichler for MOSiR Rybnik</a>
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



