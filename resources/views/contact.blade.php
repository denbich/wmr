@extends('layouts.app')

@section('title')
{{ __('Kontakt') }}
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
                <h1 class="display-1 text-white mt-3 font-weight-700">{{ Str::upper(__('Kontakt')) }}</h1>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mapouter"><div class="gmap_canvas w-100"><iframe width="600" height="350" id="gmap_canvas" src="https://maps.google.com/maps?q=Municipal%20Sports%20and%20Recreation%20in%20Rybnik%20gliwicka%2072&t=&z=11&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><br><style>.mapouter{position:relative;text-align:right;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;}</style></div></div>
                            </div>
                            <div class="col-lg-6">
                                <h2 class="text-center">Wolontariat MOSiR Rybnik w Miejskim Ośrodku Sportu i Rekreacji w Rybniku</h2>
                                <h3>Adres MOSiR Rybnik</h3>
                                <p class="text-dark">ul. Gliwicka 72 44-200 Rybnik</p>
                                <h3>Telefony</h3>
                                <p class="text-dark"> +48 601 062 746 - Koordynatorka Wiktoria <br> +48 530 403 181 - Administrator Denis</p>
                                <h3>Email<h3>
                                <p><a href="mailto:wolontariat.mosirrybnik@gmail.com">wolontariat.mosirrybnik@gmail.com</a> <br>
                                    <a href="mailto:denis@mosir.rybnik.pl">denis@mosir.rybnik.pl</a>
                                </p>
                            </div>
                        </div>

                        <div class="my-2">
                            <h1 class="text-center">Formularz kontaktowy</h1>
                            <form action="{{ route('contact') }}" method="post">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="form-group @error('name') has-danger @enderror">
                                        <label for="name">Imię i Nazwisko</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" placeholder="np. Jan Kowalski" autofocus required>
                                    </div>
                                    <div class="form-group @error('email') has-danger @enderror">
                                        <label for="email">Adres email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" placeholder="np. imie@example.com" required>
                                    </div>
                                    <div class="form-group @error('message') has-danger @enderror">
                                        <label for="message">Wiadomość</label>
                                        <textarea name="message" id="message" cols="30" rows="4" style="resize: none" class="form-control @error('email') is-invalid @enderror"></textarea>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                        <label class="custom-control-label h-auto" for="customCheck1">Oświadczam, że zapoznałem się z zasadami przetwarzania danych osobowych i wyrażam zgodę na przetwarzanie moich danych osobowych zawartych w niniejszym formularzu przez Miejski Ośrodek Sportu i Rekreacji w Rybniku w celu przetworzenia wiadomości napisanej w niniejszym formularzu.</label>
                                      </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-3">Wyślij wiadomość</button>
                                </div>
                            </div>

                            </form>
                        </div>

                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>

  @include('auth.footer')

@endsection

