@extends('layouts.app')

@section('title')
{{ __('Nowa zgoda') }}
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
                <div class="col-lg-6">
                    <div class="zdjecie-login w-100 h-100" style="margin-left:20px;"></div>
                </div>
                <div class="col-lg-6">
                    <div class="card-header bg-transparent text-center">
                        <a href="http://wmr.local/login"><img src="{{ url('/img/mosir-logo1.svg') }}" class="text-center"></a>
                        <div class="mt-2 h1">Dodaj zgodę</div>
                      </div>
                      <div class="card-body pt-lg-3 pb-lg-4 px-lg-5">
                        <h4>Twoja zgoda <b>straciła ważność</b> lub koordynator <b>nie zatwierdził</b> twojej zgody, dodaj nową zgodę by zalogować się do systemu!</h4>
                        <form role="form" method="POST" action="{{ route('new.agreement') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="agreement">Zgoda na uczestnicwo w wolontariacie (plik PDF) <br>
                                    Znajdziesz je tutaj:
                                    <a href="https://wolontariat.rybnik.pl/pliki/zgoda_wolontariat_pelnoletni.pdf" target="_blank">pełnoletni</a> |
                                    <a href="https://wolontariat.rybnik.pl/pliki/zgoda_wolontariat_niepelnoletni.pdf" target="_blank">niepełnoletni</a>
                                </label>
                                <input type="file" class="form-control" accept=".pdf" name="agreement" required>
                                <small>Maksymalny rozmiar pliku: 7MB</small><br>
                                @error('agreement')
                                    <span class="text-danger small" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (session('agreement_err') == true)
                                    <span class="text-danger small" role="alert">
                                        <strong>Wystąpił problem techniczny! prosimy spóbować później!</strong>
                                    </span>
                                @endif
                            </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3 mb-1 w-100">Dodaj zgodę</button>
                          </div>
                        </form>
                          <div class="w-100 mt-4">
                              <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">Wyloguj się</button>
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



