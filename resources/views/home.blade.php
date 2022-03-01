@extends('layouts.app')

@section('title')
{{ __('home.title') }}
@endsection

@section('content')
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container text-primary">
        <div class="navbar-brand">
            <a class="" href="{{ route('home') }}">
                <img class="h-25" style="max-height: 110px" src="{{ url('/img/logowmrwhite.svg') }}">
              </a>
              <a class="" href="{{  route('help_ukraine')  }}" target="_blank" rel="noopener noreferrer">
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
              <a href="{{ route('help_ukraine') }}" class="w-100 text-center mx-auto" target="_blank" rel="noopener noreferrer">
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
              <a href="{{ route('home') }}" class="nav-link text-center font-weight-900">
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
        <div class="container-fluid my-5">
          <div class="header-body text-center mb-8">
            <div class="row justify-content-center">
              <div class="col-xl-8 col-lg-8 col-md-8 px-5">
                <h1 class="display-1 text-white mt-3 font-weight-700">{{ Str::upper(__('home.header')) }}</h1>

                <a href="{{ route('login') }}" class="btn btn-neutral btn-icon text-center btn-lg mt-2">
                    <span class="btn-inner--icon">
                      <i class="fas fa-sign-in-alt mr-2"></i>
                    </span>
                    <span class="nav-link-inner--text">{{ Str::upper(__('home.loginbutton')) }}</span>
                  </a><br>
                  <a href="{{ route('help_ukraine') }}" class="btn btn-neutral mt-2 text-lg" target="_blank" rel="noopener noreferrer">{{ __('home.text') }}</a>
              </div>
            </div>
          </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
            </svg>
          </div>
      </div>

    <div class="container-fluid mt--8">

        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 text-center my-auto">
                            <h1>{{ Str::upper(__('home.section1.header')) }}</h1>
                            <h3 class="text-success">{{ __('home.section1.text') }}</h3>
                            <br>
                            <p class="text-dark font-weight-500">{{ __('home.section1.article.part1') }}</p>

                            <ul class="text-left">
                                <li><a href="https://vol4life.aiij.org/" target="_blank" rel="noopener noreferrer">Volunteering for Sporty and Healthy Life</a></li>
                                <li><a href="https://svt.aiij.org/" target="_blank" rel="noopener noreferrer">Skills Development for Sports Volunteering Trainers</a></li>
                                <li><a href="https://sport4change.aiij.org/" target="_blank" rel="noopener noreferrer">Sport for Change</a></li>
                            </ul>
                             <p class="text-dark font-weight-500">{{ __('home.section1.article.part2') }}</p>
                            <a href="{{ url('/files/kodeks_wolontariuszy_MOSiR_Rybnik.pdf') }}" target="_blank" rel="noopener noreferrer" class="btn btn-info text-dark my-1">{{ Str::upper(__('index.footer.codex')) }}</a>
                            <a href="{{ url('/files/regulamin_wolontariatu_MOSiR_Rybnik.pdf') }}" target="_blank" rel="noopener noreferrer" class="btn btn-info text-dark my-1">{{ Str::upper(__('index.footer.regulations')) }}</a>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{ url('img/volunteers.jpg') }}" alt="" class="w-100 my-1">
                            <img src="{{ url('img/vol4life.jpg') }}" alt="" class="w-100 my-1">
                        </div>
                    </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                    <div class="text-center">
                        <h1>{{ Str::upper(__('home.section2.header')) }}</h1>
                        <h3 class="text-success">{{ __('home.section2.text') }}</h3>
                        <ol style="list-style-position: inside;" class="my-4 p-0">
                            <li>{{ __('home.section2.point1') }}</li>
                            <li>{{ __('home.section2.point2') }}</li>
                            <li>{{ __('home.section2.point3') }}</li>
                            <li>{{ __('home.section2.point4') }}</li>
                        </ol>
                        <a href="{{ route('register') }}" class="btn btn-info text-dark text-lg px-5">{{ __('main.signin') }}</a>
                    </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                    <div class="text-center">
                    <h1>{{ Str::upper(__('home.section3.header')) }}</h1>
                        <div class="row mt-4 px-4">
                            <div class="col-lg-4">
                                <h2 class="text-success">{{ __('home.section3.column1.header') }}</h2>
                                <p class="text-dark font-weight-500">{{ __('home.section3.column1.text') }}</p>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="text-success">{{ __('home.section3.column2.header') }}</h2>
                                <p class="text-dark font-weight-500">{{ __('home.section3.column2.text') }}</p>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="text-success">{{ __('home.section3.column3.header') }}</h2>
                                <p class="text-dark font-weight-500">{{ __('home.section3.column3.text') }}</p>
                            </div>
                        </div>
                    </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                    <div class="text-center">
                    <h1>{{ Str::upper(__('home.section4.header')) }}</h1>
                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <a href="https://www.facebook.com/zolty.mlynek.klubokawiarnia/" target="_blank" rel="noopener noreferrer"><img src="{{ url('img/zoltymlynek.jpg') }}" alt="" class="w-50"></a>
                            </div>
                            <div class="col-sm-4">
                                <a href="https://mosir.rybnik.pl" target="_blank" rel="noopener noreferrer"><img src="{{ url('img/mosirrybnik.png') }}" alt="" class="w-50"></a>
                            </div>
                            <div class="col-sm-4">
                                <a href="https://rybnik.eu" target="_blank" rel="noopener noreferrer"><img src="{{ url('img/rybnik.png') }}" alt="" class="w-50"></a>
                            </div>
                        </div>
                    </div>
            </div>
          </div>

    </div>
  </div>

  @include('auth.footer')

@endsection

@section('style')
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{ env('GOOGLE_ANALYTICS_KEY') }}');
  </script>
@endsection
