@extends('layouts.app')

@section('title')
{{ __('main.login') }}
@endsection

@section('body')
class="bg-default"
@endsection

@section('content')
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img class="h-25" style="max-height: 110px" src="/img/logowmr.svg">
      </a>
      <a class="navbar-brand" href="https://pomagamukrainie.gov.pl/" target="_blank" rel="noopener noreferrer">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/49/Flag_of_Ukraine.svg" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{ route('home') }}">
                <img class="h-100" style="max-height: 110px; min-height:100px;" src="/img/logowmr.svg">

              </a>
              <a href="https://pomagamukrainie.gov.pl/" target="_blank" rel="noopener noreferrer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/49/Flag_of_Ukraine.svg" alt="">
            </a>
            </div>
            <div class="col-6 collapse-close">
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
                <span class="nav-link-inner--text font-weight-900">{{ __('Strona główna') }}</span>
              </a>
            </li>
            <li class="nav-item">
                <li class="nav-item text-center">
                    <div class="dropdown">
                      <a class="nav-link dropdown-toggle text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Social Media
                      </a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item d-none" href=""><i class="fas fa-info-circle"></i> O nas</a>
                        <a class="dropdown-item" href="https://facebook.com/wolontariat.rybnik" target="_blank"><i class="fab fa-facebook-square"></i> Facebook</a>
                        <a class="dropdown-item" href="https://instagram.com/wolontariat.rybnik" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                      </div>
                    </div>
                  </li>
            </li>
            @include('include.menu')

          </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          @include('include.lang')

          <li class="nav-item d-lg-block ml-lg-4 text-center">
            <a href="{{ route('register') }}" class="btn btn-neutral btn-icon text-center">
              <span class="btn-inner--icon">
                <i class="fas fa-laptop mr-2"></i>
              </span>
              <span class="nav-link-inner--text">Zarejestruj się</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="main-content">
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
          <div class="header-body text-center mb-6">
            <div class="row justify-content-center">
              <div class="col-xl-8 col-lg-8 col-md-8 px-5">
                <h1 class="display-1 text-white font-weight-700">WOLONTARIAT <br> MOSIR RYBNIK</h1>
                <a href="{{ route('login') }}" class="btn btn-neutral btn-icon text-center btn-lg">
                    <span class="btn-inner--icon">
                      <i class="fas fa-laptop mr-2"></i>
                    </span>
                    <span class="nav-link-inner--text">ZALOGUJ SIĘ DO PANELU</span>
                  </a>
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

        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 text-center my-auto">
                            <h1>CZYM SIĘ ZAJMUJEMY?</h1>
                            <h3 class="text-primary italic">Ponad 4 lata doświadczenia</h3>
                            <br>
                            <p class="text-dark font-weight-500">Wolontariusze MOSiR Rybnik to aktywna społeczność, która angażuje się w organizację wydarzeń na terenie całego Rybnika organizowanych przez Miejski ośrodek sportu i rekreacji w Rybniku! MOSiR Rybnik uczestniczy w międzynarodowym programie Erasmus+ Sport <a href="https://vol4life.aiij.org/" target="_blank" rel="noopener noreferrer">"Volunteering Sporty and Healthy Life"</a> (skrót: "Vol4Life"). </p>
                            <a href="{{ url('/files/kodeks_wolontariuszy_MOSiR_Rybnik.pdf') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">KODEKS WOLONTARIUSZA</a>
                            <a href="{{ url('/files/regulamin_wolontariatu_MOSiR_Rybnik.pdf') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">REGULAMIN WOLONTARIATU</a>
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
                        <h1>JAK DO NAS DOŁĄCZYĆ?</h1>
                        <h3>Jeśli chcesz dołączyć do naszej społeczności wystarczy wykonać parę kroków:</h3>
                        <ol style="list-style-position: inside;" class="my-4">
                            <li>Kliknij przycisk poniżej by się zarejestrować,</li>
                            <li>Uzupełniasz wszystkie pola, przesyłasz zgodę (znajdziesz je na samym dole tej strony) i zdjęcie profilowe,</li>
                            <li>W ciągu 48 godzin twoje konto zostanie zatwierdzone przez koordynatora wolontariatu,</li>
                            <li>Zapisz się na pierwszą imprezę!</li>
                        </ol>
                        <a href="{{ route('register') }}" class="btn btn-primary text-lg px-5">Zarejestruj się</a>
                    </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                    <div class="text-center">
                    <h1>CO MOŻESZ ZYSKAĆ?</h1>
                        <div class="row mt-4 px-4">
                            <div class="col-lg-4">
                                <h2 class="text-primary">Nowe znajomości</h2>
                                <p class="text-dark font-weight-500">Czas poświęcony na wolontariat, owocuje nabywaniem nowych znajomości, zwiększeniem poczucia wspólnoty oraz podnoszeniem umiejętności interpersonalnych. Stały kontakt z ludźmi pomaga rozwijać naturalny system wsparcia, stanowiący doskonałą ochronę przed stresem i przygnębieniem.</p>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="text-primary">Doświadczenie</h2>
                                <p class="text-dark font-weight-500">Wolontariat jest świetnym sposobem na zdobycie doświadczeń w danym obszarze. Wolontariat umożliwia zdobycie nowych umiejętności, przydatnych w każdej pracy, takich jak: komunikacja interpersonalna, rozwiązywanie problemów, planowanie, czy zarządzanie zadaniami. Dodatkowo, zdobycie umiejętności językowych czy po prostu możliwość dodania wątku o wolontariacie do twojego CV, jest niewątpliwie znaczącą korzyścią.</p>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="text-primary">Nagrody</h2>
                                <p class="text-dark font-weight-500">Za każdą imprezę, na której się pojawisz, otrzymasz odpowiednią ilość punktów i będziesz mógł/mogła wymienić punkty na nagrody!</p>
                            </div>
                        </div>
                    </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                    <div class="text-center">
                    <h1>NASI PARTNERZY</h1>
                        <div class="row mt-4 px-4">
                            <div class="col-lg-4">
                                <a href="https://www.facebook.com/zolty.mlynek.klubokawiarnia/" target="_blank" rel="noopener noreferrer"><img src="{{ url('img/zoltymlynek.jpg') }}" alt="" class="w-100 p-5"></a>
                            </div>
                            <div class="col-lg-4">
                                <a href="https://mosir.rybnik.pl" target="_blank" rel="noopener noreferrer"><img src="{{ url('img/mosirrybnik.png') }}" alt="" class="w-100 p-5"></a>
                            </div>
                            <div class="col-lg-4">
                                <a href="https://rybnik.eu" target="_blank" rel="noopener noreferrer"><img src="{{ url('img/rybnik.png') }}" alt="" class="w-100 p-5"></a>
                            </div>
                        </div>
                    </div>
            </div>
          </div>

    </div>
  </div>

  @include('auth.footer')

@endsection
