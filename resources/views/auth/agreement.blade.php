@extends('layouts.app')

@section('title')
{{ __('index.agreement.title') }}
@endsection

@section('body')
class="bg-default"
@endsection

@section('content')

<!-- Navbar -->

<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container text-primary">
        <div class="navbar-brand">
            <a class="" href="{{ route('home') }}">
                <img class="h-25" style="max-height: 110px" src="{{ url('/img/logowmrwhite.svg') }}">
              </a>
              <a class="" href="{{ route('help_ukraine') }}" rel="noopener noreferrer">
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
              <a href="https://pomagamukrainie.gov.pl/" class="w-100 text-center mx-auto" rel="noopener noreferrer">
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
                <a href="{{ route('login') }}" class="nav-link text-center">
                    <span class="nav-link-inner--text">{{ __('main.login') }}</span>
                </a>
            </li>

          </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          @include('include.lang')

          <li class="nav-item d-lg-block ml-lg-4 text-center">
            <a href="{{ route('register') }}" class="btn btn-neutral btn-icon text-center">
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
                <div class="col-lg-6">
                    <div class="zdjecie-login w-100 h-100" style="margin-left:20px;"></div>
                </div>
                <div class="col-lg-6">
                    <div class="card-header bg-transparent text-center">
                        <a href="{{ route('login') }}"><img src="{{ url('/img/mosir-logo1.svg') }}" class="text-center"></a>
                        <div class="mt-2 h1">{{ __('index.agreement.title') }}</div>
                      </div>
                      <div class="card-body pt-lg-3 pb-lg-4 px-lg-5">
                        <h4>{{ __('index.agreement.text.text1') }} <b>{{ __('index.agreement.text.text2') }}</b> {{ __('index.agreement.text.text3') }} <b>{{ __('index.agreement.text.text4') }}</b> {{ __('index.agreement.text.text5') }}</h4>
                        <form role="form" method="POST" action="{{ route('new.agreement') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="agreement"> {{ __('index.agreement.label1') }} <br> {{ __('index.agreement.label2') }}
                                    <a href="{{ url('/files/zgoda_wolontariat_pelnoletni.pdf') }}" target="_blank">{{ __('index.agreement.adult') }}</a> |
                                    <a href="{{ url('/files/zgoda_wolontariat_niepelnoletni.pdf') }}" target="_blank">{{ __('index.agreement.minor') }}</a>
                                </label>
                                <input type="file" class="form-control" accept=".pdf" name="agreement" required>
                                <small>{{ __('index.agreement.file') }}: 7MB</small><br>
                                @error('agreement')
                                    <span class="text-danger small" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (session('agreement_err') == true)
                                    <span class="text-danger small" role="alert">
                                        <strong>{{ __('index.agreement.err') }}</strong>
                                    </span>
                                @endif
                            </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-info text-dark mt-3 mb-1 w-100">{{ __('index.agreement.button') }}</button>
                          </div>
                        </form>
                          <div class="w-100 mt-4">
                              <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">{{ __('main.logout') }}</button>
                            </form>
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
  @include('auth.footer')

@endsection



