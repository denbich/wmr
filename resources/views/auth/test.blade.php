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
                <span class="nav-link-inner--text font-weight-900">{{ __('Strona g????wna') }}</span>
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
              <span class="nav-link-inner--text">Zarejestruj si??</span>
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
                    <span class="nav-link-inner--text">ZALOGUJ SI?? DO PANELU</span>
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
                            <h1>CZYM SI?? ZAJMUJEMY?</h1>
                            <h3 class="text-primary italic">Ponad 4 lata do??wiadczenia</h3>
                            <br>
                            <p class="text-dark font-weight-500">Wolontariusze MOSiR Rybnik to aktywna spo??eczno????, kt??ra anga??uje si?? w organizacj?? wydarze?? na terenie ca??ego Rybnika organizowanych przez Miejski o??rodek sportu i rekreacji w Rybniku! MOSiR Rybnik uczestniczy w mi??dzynarodowym programie Erasmus+ Sport <a href="https://vol4life.aiij.org/" target="_blank" rel="noopener noreferrer">"Volunteering Sporty and Healthy Life"</a> (skr??t: "Vol4Life"). </p>
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
                        <h1>JAK DO NAS DO????CZY???</h1>
                        <h3>Je??li chcesz do????czy?? do naszej spo??eczno??ci wystarczy wykona?? par?? krok??w:</h3>
                        <ol style="list-style-position: inside;" class="my-4">
                            <li>Kliknij przycisk poni??ej by si?? zarejestrowa??,</li>
                            <li>Uzupe??niasz wszystkie pola, przesy??asz zgod?? (znajdziesz je na samym dole tej strony) i zdj??cie profilowe,</li>
                            <li>W ci??gu 48 godzin twoje konto zostanie zatwierdzone przez koordynatora wolontariatu,</li>
                            <li>Zapisz si?? na pierwsz?? imprez??!</li>
                        </ol>
                        <a href="{{ route('register') }}" class="btn btn-primary text-lg px-5">Zarejestruj si??</a>
                    </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                    <div class="text-center">
                    <h1>CO MO??ESZ ZYSKA???</h1>
                        <div class="row mt-4 px-4">
                            <div class="col-lg-4">
                                <h2 class="text-primary">Nowe znajomo??ci</h2>
                                <p class="text-dark font-weight-500">Czas po??wi??cony na wolontariat, owocuje nabywaniem nowych znajomo??ci, zwi??kszeniem poczucia wsp??lnoty oraz podnoszeniem umiej??tno??ci interpersonalnych. Sta??y kontakt z lud??mi pomaga rozwija?? naturalny system wsparcia, stanowi??cy doskona???? ochron?? przed stresem i przygn??bieniem.</p>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="text-primary">Do??wiadczenie</h2>
                                <p class="text-dark font-weight-500">Wolontariat jest ??wietnym sposobem na zdobycie do??wiadcze?? w danym obszarze. Wolontariat umo??liwia zdobycie nowych umiej??tno??ci, przydatnych w ka??dej pracy, takich jak: komunikacja interpersonalna, rozwi??zywanie problem??w, planowanie, czy zarz??dzanie zadaniami. Dodatkowo, zdobycie umiej??tno??ci j??zykowych czy po prostu mo??liwo???? dodania w??tku o wolontariacie do twojego CV, jest niew??tpliwie znacz??c?? korzy??ci??.</p>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="text-primary">Nagrody</h2>
                                <p class="text-dark font-weight-500">Za ka??d?? imprez??, na kt??rej si?? pojawisz, otrzymasz odpowiedni?? ilo???? punkt??w i b??dziesz m??g??/mog??a wymieni?? punkty na nagrody!</p>
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
