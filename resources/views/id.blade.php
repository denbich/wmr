@extends('layouts.app')

@section('title')
{{ __('Idetyfikator wolontariusza') }}
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
                        <a href="{{ route('home') }}"><img src="https://panel.wolontariat.rybnik.pl/assets/img/mosir-logo1.svg" class="text-center"></a>
                        <div class="mt-2 h1">Idetyfikator wolontariusza</div>
                      </div>
                      <div class="card-body pt-lg-3 pb-lg-4 px-lg-5">
                        @isset($volunteer)
                            <div class="w-100">
                                <img class="align-content-center m-auto d-block w-100" style="max-height:250px; max-width:250px" src="{{ $volunteer->photo_src }}">
                                <h3>Dane wolontariusza:</h3>
                                <p><b>Imię wolontariusza: </b>{{ $volunteer->firstname }}</p>
                                <p><b>Nazwisko wolontariusza: </b>{{ $volunteer->lastname }}</p>
                                <p><b>ID: </b>{{ substr($volunteer->name, 12) }}</p>
                                <h3>Akcje w których uczestniczy dziś <br> ({{ date('d-m-Y'); }}):</h3>
                                @php $i = 0 @endphp
                                @if (count($events) > 0)
                                    <ul>
                                    @foreach ($events as $event)
                                    @if (date('Y-m-d') == date('Y-m-d', strtotime($event->start)) || date('Y-m-d') == date('Y-m-d', strtotime($event->end)))
                                        <li>{{ $event->title }}</li>
                                        @php $i++ @endphp
                                    @endif
                                    @endforeach
                                    </ul>
                                @if ($i == 0)
                                    <div class="w-100">
                                        <h3 class="text-danger">Dziś wolontariusz nie uczestniczy w żadnej imprezie!</h3>
                                    </div>
                                @endif
                                @else
                                    <div class="w-100">
                                        <h3 class="text-danger">Dziś wolontariusz nie uczestniczy w żadnej imprezie!</h3>
                                    </div>
                                @endif
                            </div>
                        @endisset
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



