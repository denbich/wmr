@extends('layouts.app')

@section('title')
#PomagamUkrainie
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
              <a href="{{ route('help_ukraine') }}" class="w-100 text-center mx-auto" rel="noopener noreferrer">
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

  <div class="main-content">
    <div class="header bg-gradient-primary py-8 py-lg-8 pt-lg-9">
        <div class="container-fluid">
          <div class="header-body text-center mb-6">
            <div class="row justify-content-center">
              <div class="col-xl-8 col-lg-8 col-md-8 px-5">
                <h1 class="display-1 text-white mt-3 font-weight-700">{{ Str::upper(__('home.ukraine.header')) }}</h1>
                <a href="{{ route('register') }}" class="btn btn-success text-lg">{{ __('home.ukraine.button') }}</a> <br><br>
              @switch(session('locale'))
                  @case('pl')
                  <a href="{{ route('language', ['en']) }}" class="btn btn-info text-dark">Change language to english</a>
                      @break

                  @case('en')
                  <a href="{{ route('language', ['pl']) }}" class="btn btn-info text-dark">Zmień język na polski</a>
                  @break

              @endswitch
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

    <div class="container mt--8">

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center font-weight-900">{{ __('home.ukraine.text1') }}</h1>
                        <h2 class="text-center">{{ __('home.ukraine.text2') }}</h2>
                        <h3 class="font-weight-900">{{ Str::upper(__('home.ukraine.text3')) }}</h3>
                        <h3>
                            <ul>
                                <li>{{ __('home.ukraine.list1') }}</li>
                                <li>{{ __('home.ukraine.list2') }}</li>
                                <li>{{ __('home.ukraine.list3') }}</li>
                                <li>{{ __('home.ukraine.list4') }}</li>
                                <li>{{ __('home.ukraine.list5') }}</li>
                                <li>{{ __('home.ukraine.list6') }}</li>
                            </ul>
                        </h3>
                        <h3 class="font-weight-900"> {{ Str::upper(__('home.ukraine.text4')) }}</h3>
                        <h3><ol>
                            <li>{{ __('home.ukraine.list11') }}</li>
                            <li>{{ __('home.ukraine.list12') }}</li>
                            <li>{{ __('home.ukraine.list13') }}</li>
                            <li>{{ __('home.ukraine.list14') }}</li>
                        </ol></h3>
                        <h3 class="text-danger text-center">{{ __('home.ukraine.age') }}</h3>
                        <h3>{{ __('home.ukraine.questions') }} <a href="mailto:sportkultura.rybnik@gmail.com">sportkultura.rybnik@gmail.com</a></h3>
                        <div class="text-center mt-2">
                            <a href="{{ route('register') }}" class="btn btn-success text-lg mx-auto">{{ __('home.ukraine.button') }}</a> <br><br>
                        </div>

                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>

  @include('auth.footer')

@endsection

